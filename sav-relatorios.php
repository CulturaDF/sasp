<?php

/**
 * Copyright (c) 2011 Ministério da Cultura
 *
 * Written by
 *  Clara Farias <clara.farias@cultura.gov.br>
 *  Cleber Santos <cleber.santos@cultura.gov.br>
 *  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
 *  Ricardo Evangelista <ricardo.evangelista@cultura.gov.br>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the
 * Free Software Foundation, Inc.,
 * 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 *
 * Public License can be found at http://www.gnu.org/copyleft/gpl.html
 */

class SAV_Relatorios
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////
	var $error = '';

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////
	/**
	 * load scripts
	 *
	 * @name    admin_scripts
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-08
	 * @updated 2013-03-08
	 * @return  void
	 */
	function admin_scripts()
	{
		global $SAV;

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-mask', "{$SAV->url}/js/jquery-mask.js", array( 'jquery' ) );
		wp_enqueue_script( 'sav-editais', "{$SAV->url}/js/sav-editais.js", array( 'jquery' ) );
		wp_enqueue_script( 'sav-ajax', "{$SAV->url}/js/sav-ajax.js", array( 'jquery' ) );
	}

	/**
	 * create the administrative menus
	 *
	 * @name    menu
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-08
	 * @updated 2013-03-08
	 * @return  void
	 */
	function menus()
	{
		//global $SAV;

		$formulario_relatorio = add_submenu_page( 'editais', 'Relatórios', 'Relatórios', 'edit_sav_editais', 'relatorios', array( &$this, 'formulario_relatorio' ) );
		$resultado_relatorios   = add_submenu_page( 'editais', 'Resultado', 'Resultado', 'edit_sav_editais', 'resultado_relatorio', array( &$this, 'mostrar_relatorio' ) );

		add_action( "admin_print_scripts-{$formulario_relatorio}", array( &$this, 'admin_scripts' ) );

	}

	/**
	 * get propostas que o foram avaliadas por consultor
	 *
	 * @name    get_avaliadas_por_consultor
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-17
	 * @updated 2013-03-18
	 * @return  mixed
	 */
	function get_avaliadas_por_consultor($id_consultor, $id_edital, $count = false )
	{
		if( empty($id_consultor) or empty($id_edital) )
			return false;

		global $wpdb;

		// criterios de desempate
		$criterio_desempate_1 = $this->get_edital_meta( $id_edital, 'criterio_desempate_1' );
		$criterio_desempate_2 = $this->get_edital_meta( $id_edital, 'criterio_desempate_2' );

		if( $count )
		{
			$classificados_consultor = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT p.id_proposta) FROM  {$wpdb->sav_propostas} AS p INNER JOIN  {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d {$where_limit}", $id_consultor, $id_edital) );
			//$classificados_consultor = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(p.id_proposta) FROM  {$wpdb->sav_propostas} AS p INNER JOIN  {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d AND po.nota >= %d ORDER BY po.nota DESC {$where_limit}", $id_consultor, $id_edital, $nota_minima) );

		}
		else
			$avaliadas_consultor = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.titulo, p.id_author, p.id_edital, p.status, po.id_consultor, po.nota FROM {$wpdb->sav_propostas} AS p INNER JOIN {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pe ON p.id_proposta = pe.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pa ON p.id_proposta = pa.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d AND po.id_criterio = '' AND pe.id_criterio = %d AND pa.id_criterio = %d GROUP BY p.id_proposta ORDER BY po.nota DESC, pe.nota DESC, pa.nota DESC, p.id_proposta ASC $where_limit", $id_consultor, $id_edital, $criterio_desempate_1, $criterio_desempate_2 ) );
			print ( $wpdb->prepare( "SELECT p.id_proposta, p.titulo, p.id_author, p.id_edital, p.status, po.id_consultor, po.nota FROM {$wpdb->sav_propostas} AS p INNER JOIN {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pe ON p.id_proposta = pe.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pa ON p.id_proposta = pa.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d AND po.id_criterio = '' AND pe.id_criterio = %d AND pa.id_criterio = %d GROUP BY p.id_proposta ORDER BY po.nota DESC, pe.nota DESC, pa.nota DESC, p.id_proposta ASC", $id_consultor, $id_edital, $criterio_desempate_1, $criterio_desempate_2 ) );

		return $avaliadas_consultor;
	}

	/**
	 * get propostas avaliadas por grupo ordem de nota
	 *
	 *	pegar a média de projetos avaliados do grupo
	 *  dividr a soma da nota do grupo pela quantidade de consultores.
	 *
	 * @name    get_propostas_avaliadas_por_grupo
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-17
	 * @updated 2012-02-24
	 * @return  mixed
	 */
	function get_propostas_avaliadas_por_grupo( $id_edital, $grupo, $status=null )
	{
		if( empty($id_edital) OR empty($grupo) )
			return false;

		global $SAV, $wpdb;

		$nota_minima 						= $SAV->get_nota_minima( $id_edital );
		$quantidade_classificados			= $SAV->get_edital_meta( $id_edital, 'quantidade_classificados' );
		$where_limit 						= "LIMIT ". $quantidade_classificados;

		 //critérios de desempate
		$criterio_desempate_1 = $SAV->get_edital_meta( $id_edital, 'criterio_desempate_1' );
		$criterio_desempate_2 = $SAV->get_edital_meta( $id_edital, 'criterio_desempate_2' );

		$comissao = $SAV->get_edital_meta($id_edital, 'comissao');

		$count = count($comissao);
		$where_consultores = "AND (";

		for($i=0; $i<=$count; $i++){
			if($comissao[$i]['grupo'] == $grupo ) {

				//consulta o id do consultor do grupo informado
				$id_consultores[$i] = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->users} WHERE user_login = %s LIMIT 1", $comissao[$i]['consultor'] ) );

				if( count( $id_consultores ) == 1 )
					$where_consultores .= " po.id_consultor = {$id_consultores[$i]}";
				else
					$where_consultores .= " OR po.id_consultor = {$id_consultores[$i]}";
			}
		}
		$qtd_consultores = count($id_consultores);

		$where_consultores .= " )";

		$sql = $wpdb->prepare( "SELECT SUM(po.nota)/{$qtd_consultores} AS nota, p.id_proposta, p.titulo, p.id_author, p.id_edital, p.status, po.id_consultor,
				(SELECT SUM(pe.nota)/{$qtd_consultores} FROM {$wpdb->sav_avaliacao} as pe WHERE pe.id_proposta = p.id_proposta AND pe.id_criterio = %d ) as desempate_1,
				(SELECT SUM(po.nota)/{$qtd_consultores} FROM {$wpdb->sav_avaliacao} as po WHERE po.id_proposta = p.id_proposta AND po.id_criterio = %d ) as desempate_2
				FROM {$wpdb->sav_propostas} AS p
				LEFT JOIN {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta
				WHERE p.id_edital = %d
				AND po.id_criterio = '' {$where_consultores}
				GROUP BY p.id_proposta
				ORDER BY nota DESC, desempate_1 DESC, desempate_2 DESC
				{$where_limit}", $criterio_desempate_1, $criterio_desempate_2, $id_edital );

		$propostas = $wpdb->get_results($sql);

		return $propostas;
	}

	/**
	 * get todas as propostas com maiores notas juntando todos os grupos
	 *
	 * @name    get_propostas_avaliadas_grupos
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2013-03-15
	 * @updated 2013-03-15
	 * @return  mixed
	 */
	function get_propostas_avaliadas_grupos( $id_edital )
	{
		if ( empty( $id_edital ) )
			return false;

		global $wpdb;

		// busca os grupos que existem nas propostas deste edital
		$grupos = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT(meta_value) as grupo FROM {$wpdb->sav_propostas} as p LEFT JOIN {$wpdb->sav_proposta_meta} as m ON p.id_proposta = m.id_proposta WHERE p.id_edital = %d AND m.meta_key = 'grupo' ORDER BY meta_value ASC", $id_edital ) );

		if ( empty( $grupos ) )
			return false;

		foreach( $grupos as $grupo )
		{
			$propostas_avaliadas_por_grupo = $this->get_propostas_avaliadas_por_grupo( $id_edital, $grupo->grupo );

			if( !empty( $propostas_avaliadas_por_grupo )  )
			{
				foreach( $propostas_avaliadas_por_grupo as $proposta_avaliada )
				{
					// retirar propostas duplicadas
					if( !in_array( $proposta_avaliada->id_proposta, $id_propostas ) )
					{
						$propostas[] 	= $proposta_avaliada;
						$id_propostas[] = $proposta_avaliada->id_proposta;
					}
				}
			}
		}

		// ordena o array pela nota
		arsort($propostas);

		return (object) $propostas;
	}

	/**
	 * formulario relatorio
	 *
	 * @name    formulario_relatorio
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-08
	 * @updated 2013-03-08
	 * @return  void
	 */
	function formulario_relatorio()
	{
		global $wpdb, $SAV;

		if(!current_user_can('review_sav_propostas'))
			return false;

		//consulta editais
		$editais = $wpdb->get_results( $wpdb->prepare( "SELECT id_edital, titulo FROM {$wpdb->sav_editais} WHERE status = 'publico'" ) );

		//consulta analistas
		$analistas = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT(p.ID), p.user_login, p.display_name FROM wp_users as p LEFT JOIN wp_usermeta as pe ON p.ID = pe.user_id WHERE pe.meta_key LIKE %s AND pe.meta_value LIKE %s", "%capabilities", "%analista%" ) );

		// consulta consultores
		$consultores = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT(p.ID), p.user_login, p.display_name FROM wp_users as p LEFT JOIN wp_usermeta as pe ON p.ID = pe.user_id WHERE pe.meta_key LIKE %s AND pe.meta_value LIKE %s", "%capabilities", "%consultor%" ) );


	?>
		<div class="wrap">
			<h2>Relatórios</h2>

			<form action="?page=resultado_relatorio" method="post">
				<input type="hidden" name="acao" value="mostrar_relatorio" />
				<table id="the_list" class="wp-list-table widefat" cellspacing="0">
					<thead>
						<tr>
							<th colspan="2">Sistema de Apoio a Seleção Pública</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>
								<label for="edital">Edital</label>
							</td>
							<td>
								<select id="edital" name="edital" tabindex="1" >
									<option value="">Todos</option>
										<?php foreach( $editais as $edital ) : ?>
										<?php $avaliacao_grupo = $SAV->get_edital_meta( $edital->id_edital, 'avaliacao_por_grupo' ); ?>
											<option value="<?php print $edital->id_edital; ?>" <?php if (!empty( $avaliacao_grupo ) ) print "class='is_group'"; ?>><?php print $edital->titulo; ?></option>
										<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="status">Status</label>
							</td>
							<td>
								<?php print $SAV->dropdown_status( 'status', '', true, 'tabindex="1"' ); ?>
							</td>
						</tr>
						<tr>
							<td>
								<label for="uf">UF</label>
							</td>
							<td>
								<?php print $SAV->dropdown_states( 'uf', '', true, 'tabindex="1"' ); ?>
							</td>
						</tr>
						<tr>
							<td>
								<label for="grupo">Consultor</label>
							</td>
							<td>
								<select id="consultor" name="consultor" tabindex="1" >
									<option value="">Todos</option>

								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="grupo">Grupo</label>
							</td>
							<td>
								<select id="grupo" name="grupo" tabindex="1" >
									<option value="">Todos</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="campos">Campos</label>
							</td>
							<td>
								<label><input type="checkbox" name="campo_nota" value="1"> Nota</label>
								<label><input type="checkbox" name="campo_grupo" value="1"> Grupo</label>
							</td>
						</tr>
						<tr>
							<td>
								<label for="opções">Opções</label>
							</td>
							<td>
								<label><input type="checkbox" name="avaliadas_grupos" value="1"> Propostas avaliadas Grupos</label>
							</td>
						</tr>


					</tbody>
				</table>
				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Pesquisar"></p>
			</form>
		</div>

		<?php
	}

	/**
	 * mostra relatorio
	 *
	 * @name    mostrar_relatorio
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-08
	 * @updated 2013-03-08
	 * @return  void
	 */
	function mostrar_relatorio()
	{
		$acao = $_REQUEST['acao'];

		if( !current_user_can('edit_sav_editais'))
			return false;

		if( !isset( $acao ) ) {
			$msg = '<div class="updated">';
			$msg .= 	'<p>Selecione o tipo de relatório</p>';
			$msg .= '</div>';

			print $msg;

			wp_redirect( "?page=relatorios"); exit();
		}

		global $SAV, $wpdb;

		// filtros
		$id_edital 						= $_REQUEST['edital'];
		$status 						= $_REQUEST['status'];
		$uf 							= $_REQUEST['uf'];
		$id_consultor					= $_REQUEST['consultor'];
		$categoria						= $_REQUEST['categoria'];
		$grupo 							= $_REQUEST['grupo'];
		$propostas_avaliadas_grupos		= $_REQUEST['avaliadas_grupos'];

		//campos
		$mostrar_nota	= $_REQUEST['campo_nota'];
		$mostrar_grupo 	= $_REQUEST['campo_grupo'];

		// verifica se edital foi selecionado
		if( !empty( $id_edital ) )
			$where_edital = "AND p.id_edital = {$id_edital}";

		// verifica se o status foi selecionado
		if( !empty( $status ) )
			$where_status = "AND p.status = '{$status}'";

		// tipo da consulta
		if( !empty( $uf ) ) {
			$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.id_edital,  p.id_author, p.titulo, p.status, g.estado  FROM {$wpdb->sav_propostas} as p INNER JOIN {$wpdb->users} AS u ON (p.id_author = u.ID) INNER JOIN {$wpdb->sav_dados_geograficos} AS g ON (u.user_login = g.login) WHERE status <> 'lixo' AND g.estado=%s {$where_status} {$where_edital} ORDER BY id_proposta DESC", $uf) );
		}elseif( !empty( $grupo ) ) {
			$propostas = $this->get_propostas_avaliadas_por_grupo( $id_edital, $grupo, $where_status );
		}elseif( !empty( $id_consultor ) ) {
			$propostas = $SAV->get_classificacao_por_consultor( $id_consultor, $id_edital, $count = false );
		}elseif( !empty($propostas_avaliadas_grupos	) ) {
			$propostas = $this->get_propostas_avaliadas_grupos( $id_edital );
		} else {
			$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.id_author, p.id_edital, p.titulo, p.status FROM {$wpdb->sav_propostas} as p INNER JOIN {$wpdb->users} AS u ON (p.id_author = u.ID) WHERE status <> 'lixo' {$where_status} {$where_edital} ORDER BY id_proposta DESC" ) );
		}

		if( !empty( $mostrar_nota ) and !empty( $id_consultor ) )
			$criterios = $SAV->get_criterios_avaliacao( $id_edital );

		$excel ='<table border=1 cellspacing=0 cellpadding=2 bordercolor=666633>';

		?>
			<div class="wrap">
				<h2>Resultado</h2>

				<form action="" method="post">
					<input type="hidden" name="acao" value="mostrar_relatorio" />
					<table id="the_list" class="wp-list-table widefat" cellspacing="0">
						<thead>
						<?php $excel .= '<thead>'; ?>
							<tr>
								<?php $excel .= '<tr>'; ?>
								<th>Nº</th>
									<?php $excel .= '<th>Nº</th>'; ?>
								<th>Edital</th>
									<?php $excel .= '<th>Edital</th>'; ?>
								<th>Título</th>
									<?php $excel .= '<th>Título</th>'; ?>
								<th>Autor</th>
									<?php $excel .= '<th>Autor</th>'; ?>
								<th>UF</th>
									<?php $excel .= '<th>UF</th>'; ?>
								<th>Status</th>
									<?php $excel .= '<th>Status</th>'; ?>

								<?php if( !empty( $mostrar_grupo ) ) print '<th>Grupo</th>'; ?>
								<?php if( !empty( $mostrar_grupo ) ) $excel .= '<th>Grupo</th>'; ?>

								<?php if( !empty( $mostrar_nota ) ) : ?>
									<?php if( !empty( $id_consultor ) ) : ?>
										<?php foreach( $criterios as $criterio ) : ?>
											<th><?php print mb_substr( $criterio['descricao'],0,2,'UTF-8'); ?></th>
												<?php $excel .= '<th>' . mb_substr( $criterio['descricao'],0,2,'UTF-8') . '</th>'; ?>
										<?php endforeach; ?>
									<?php endif; ?>
									<th>Nota</th>
										<?php $excel .= '<th>Nota</th>'; ?>
								<?php endif; ?>
							</tr>
								<?php $excel .= '</tr>'; ?>
						</thead>
							<?php $excel .= '</thead>'; ?>
						<tbody>
							<?php $excel .= '<tbody>'; ?>
							<?php if( !empty( $propostas ) ): ?>
								<?php foreach($propostas as $proposta ) : ?>
									<?php
										$user = get_userdata( $proposta->id_author );
										$dados_geograficos = $SAV->get_dados_geograficos( $user->user_login );
										$grupo = $SAV->get_proposta_meta($proposta->id_proposta, 'grupo');
									?>
									<tr>
										<?php $excel .= '<tr>'; ?>
										<td>
											<?php print $proposta->id_proposta; ?>
										</td>
											<?php $excel .= '<td>' . $proposta->id_proposta . '</td>'; ?>
										<td>
											<?php print $proposta->id_edital; ?>
										</td>
											<?php $excel .= '<td>' . $proposta->id_edital . '</td>'; ?>
										<td>
											<strong><a href="?page=formulario-proposta&id_edital=<?php print $proposta->id_edital; ?>&id_proposta=<?php print $proposta->id_proposta; ?>" title="Editar: <?php print $proposta->titulo; ?>"><?php print $proposta->titulo; ?></a></strong>
										</td>
											<?php $excel .= '<td>' . $proposta->titulo . '</td>'; ?>
										<td>
											<?php print $user->display_name; ?>
										</td>
											<?php $excel .= '<td>' . $user->display_name . '</td>'; ?>
										<td>
											<?php print $dados_geograficos['estado']; ?>
										</td>
											<?php $excel .= '<td>' . $dados_geograficos['estado'] . '</td>'; ?>
										<td>
											<?php print $SAV->show_mask_status( $proposta->status ); ?>
										</td>
											<?php $excel .= '<td>' . $SAV->show_mask_status( $proposta->status ) . '</td>'; ?>

										<?php if( !empty( $mostrar_grupo ) ) print '<td align=center>' . $grupo . '</td>'; ?>
										<?php if( !empty( $mostrar_grupo ) ) $excel .= '<td>' . $grupo . '</td>'; ?>

										<?php if( !empty( $mostrar_nota ) ) : ?>
											<?php if( !empty( $id_consultor ) ) : ?>
												<?php foreach( $criterios as $criterio ) : ?>
													<?php $nota_criterio = $SAV->get_nota_criterio( $criterio['id_criterio'], $proposta->id_proposta, $id_consultor ); ?>
													<td align=left><?php print( $nota_criterio['nota'] ); ?></td>
													<?php $excel .= '<td>' . utf8_encode($nota_criterio['nota']) . '</td>'; ?>
												<?php endforeach; ?>
											<?php endif; ?>
											<td align=left><?php print number_format($proposta->nota, 2); ?></td>
											<?php $excel .= '<td>' . number_format($proposta->nota, 2) . '</td>'; ?>

										<?php endif; ?>
									</tr>
										<?php $excel .= "</tr>"; ?>
								<?php endforeach; ?>
								<?php $excel .= "</table>"; ?>
							<?php else : ?>
								<tr>
									<td colspan="5">Nenhum Resultado</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</form>
				<form action="" method="POST">
					<table width="100%" cellspacing="15px">
						<tr valign="top">
							<td>
								<input type="hidden" id="excel" name="acao" value="exportar_propostas_excel" />
								<input type="hidden" id="excel" name="excel" value="<?php print $excel; ?>">
								<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Exportar para excel"></p>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<?php
	}

	/**
	 * exporta as propostas para excel
	 *
	 * @name    exportar_propostas_excel
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2013-04-08
	 * updated 	2013-04-08
	 * return 	void
	*/
	function exportar_propostas_excel( $excel ) {

		// Nomeia o arquivo de acordo com a consulta
		$filename = "relatorio_editais_" . date("YmdHi") . ".xls";

		header('Content-Encoding: UTF-8');
		header('Content-type: application/msexcel; charset=UTF-8');
		header("Content-Disposition: attachment; filename={$filename}");

		// converte o arquivo e faz download do arquivo
		print utf8_decode($excel);

		exit;
	}

	/**
	 * direcionar relatorio
	 *
	 * @name    direcionar_relatorio
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-08
	 * @updated 2013-03-08
	 * @return  void
	 */
	function direcionar_relatorio()
	{
		$acao  = $_REQUEST[ 'acao' ];
		$excel = $_REQUEST['excel'];

		switch ( $acao )
		{
			case 'exportar_propostas_excel':
				$this->exportar_propostas_excel($excel);
				break;
		}

	}


	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////
	/**
	 * @name    SAV_Relatorios
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-08
	 * @updated 2013-03-08
	 * @return  void
	 */
	function SAV_Relatorios()
	{
		// menu
		add_action( 'admin_menu', array( &$this, 'menus' ) );

		// gerenciar editais
		add_action( 'init', array( &$this, 'direcionar_relatorio' ) );

	}

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

$SAV_Relatorios = new SAV_Relatorios();

?>