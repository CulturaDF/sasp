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

class SAV_Editais
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////
	var $error = '';

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////
	/**
	 * load scripts
	 *
	 * @name    admin_scripts
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-23
	 * @updated 2011-09-12
	 * @return  void
	 */
	function admin_scripts()
	{
		global $SAV;

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-mask', "{$SAV->url}/js/jquery-mask.js", array( 'jquery' ) );
		wp_enqueue_script( 'sav-editais', "{$SAV->url}/js/sav-editais.js", array( 'jquery' ) );
	}

	/**
	 * create the administrative menus
	 *
	 * @name    menu
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2011-08-17
	 * @return  void
	 */
	function menus()
	{
		global $SAV;

		// add_menu_page( $page_title, $menu_title, $access_level, $file, $function = '' )
		add_menu_page( 'Fomento', 'Fomento', 'read', 'editais', array( &$this, 'mostrar_editais' ) );

		// mostrar chamamento apenas para ongs
		if ( $SAV->is_user_ong() )
			add_submenu_page( 'editais', 'Chamamentos', 'Chamamentos', 'read', 'editais', array( &$this, 'mostrar_editais' ) );
		else
			add_submenu_page( 'editais', 'Editais', 'Editais', 'read', 'editais', array( &$this, 'mostrar_editais' ) );

		$adicionar_edital = add_submenu_page( 'editais', 'Adicionar Edital', 'Adicionar Edital', 'edit_sav_editais', 'formulario-edital', array( &$this, 'formulario_edital' ) );

		add_action( "admin_print_scripts-{$adicionar_edital}", array( &$this, 'admin_scripts' ) );
	}

	/**
	 * mostrar os editais
	 *
	 * @name    mostrar_editais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2012-02-23
	 * @return  void
	 */
	function mostrar_editais()
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		if( current_user_can( 'edit_sav_editais' ) )
			$add_new_edital = '<a href="admin.php?page=formulario-edital" class="add-new-h2">Adicionar Edital</a>';

		$hoje = date( 'Y-m-d' );

		$editais_por_pagina             = ( int ) 20;

		$pagina_edital                  = ( int ) $_REQUEST[ 'paged' ];
		$paginas_edital                 = 1;

		if( empty( $pagina_edital ) )
			$pagina_edital                = 1;

		$edital_inicial                 = 1;

		$status                           = $_REQUEST[ 'status' ];

		$pessoa_fisica   = $SAV->is_pessoa_fisica( $user_login );
		$pessoa_juridica = $SAV->is_pessoa_juridica( $user_login );

		if( $pessoa_fisica and  !current_user_can( 'administrator' ) )
			$where_pessoa = "AND pf = '1'";

		elseif( $pessoa_juridica )
			$where_pessoa = "AND pj = '1'";



		if ( $SAV->is_user_ong()  )
		{
			$quantidade_editais            = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( p.id_edital ) FROM {$wpdb->sav_editais} as po INNER JOIN {$wpdb->sav_edital_meta} as p ON po.id_edital = p.id_edital WHERE p.meta_key = 'chamada_convenio' AND p.meta_value = '1' AND status = 'publico' {$where_pessoa}" ) );
			$quantidade_editais_proximos   = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( p.id_edital ) FROM {$wpdb->sav_editais} as po INNER JOIN {$wpdb->sav_edital_meta} as p ON po.id_edital = p.id_edital WHERE p.meta_key = 'chamada_convenio' AND p.meta_value = '1' AND abertura > %s AND status = 'publico' {$where_pessoa}", $hoje ) );
			$quantidade_editais_abertos    = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( p.id_edital ) FROM {$wpdb->sav_editais} as po INNER JOIN {$wpdb->sav_edital_meta} as p ON po.id_edital = p.id_edital WHERE p.meta_key = 'chamada_convenio' AND p.meta_value = '1' AND abertura <= %s AND encerramento > %s AND status = 'publico' {$where_pessoa}", $hoje, $hoje ) );
			$quantidade_editais_encerrados = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( p.id_edital ) FROM {$wpdb->sav_editais} as po INNER JOIN {$wpdb->sav_edital_meta} as p ON po.id_edital = p.id_edital WHERE p.meta_key = 'chamada_convenio' AND p.meta_value = '1' AND encerramento < %s AND status = 'publico' {$where_pessoa}", $hoje ) );
			$quantidade_editais_excluidos  = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( p.id_edital ) FROM {$wpdb->sav_editais} as po INNER JOIN {$wpdb->sav_edital_meta} as p ON po.id_edital = p.id_edital WHERE p.meta_key = 'chamada_convenio' AND p.meta_value = '1' AND status = 'lixo' {$where_pessoa}", $hoje ) );
		}
		else
		{
			$quantidade_editais            = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( id_edital ) FROM {$wpdb->sav_editais} WHERE status = 'publico' {$where_pessoa}" ) );
			$quantidade_editais_proximos   = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( id_edital ) FROM {$wpdb->sav_editais} WHERE abertura > %s AND  status = 'publico' {$where_pessoa}", $hoje ) );
			$quantidade_editais_abertos    = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( id_edital ) FROM {$wpdb->sav_editais} WHERE abertura <= %s AND encerramento > %s AND status = 'publico' {$where_pessoa}", $hoje, $hoje ) );
			$quantidade_editais_encerrados = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( id_edital ) FROM {$wpdb->sav_editais} WHERE encerramento < %s AND status = 'publico' {$where_pessoa}", $hoje ) );
			$quantidade_editais_excluidos  = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( id_edital ) FROM {$wpdb->sav_editais} WHERE status = 'lixo' {$where_pessoa}", $hoje ) );
		}

		if( empty( $status ) )
			$quantidade_editais_status   = $quantidade_editais;
		else
			$quantidade_editais_status   = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_editais} WHERE status = %s", $status ) );

		switch( $status )
		{
			case 'proximos' :
				$editais = $wpdb->get_results( $wpdb->prepare( "SELECT id_edital, titulo, descricao, abertura, encerramento, pf, pj FROM {$wpdb->sav_editais} WHERE abertura > %s AND  status = 'publico'", $hoje ) );
			break;
			case 'abertos' :
				$editais = $wpdb->get_results( $wpdb->prepare( "SELECT id_edital, titulo, descricao, abertura, encerramento, pf, pj FROM {$wpdb->sav_editais} WHERE abertura <= %s AND encerramento > %s AND status = 'publico'", $hoje, $hoje ) );
			break;
			case 'encerrados' :
				$editais = $wpdb->get_results( $wpdb->prepare( "SELECT id_edital, titulo, descricao, abertura, encerramento, pf, pj FROM {$wpdb->sav_editais} WHERE encerramento < %s AND status = 'publico'", $hoje ) );
			break;
			case 'lixo' :
				$editais = $wpdb->get_results( $wpdb->prepare( "SELECT id_edital, titulo, descricao, abertura, encerramento, pf, pj FROM {$wpdb->sav_editais} WHERE status = %s", $status ) );
			break;
			default :
				$editais = $wpdb->get_results( $wpdb->prepare( "SELECT id_edital, titulo, descricao, abertura, encerramento, pf, pj FROM {$wpdb->sav_editais} WHERE status = 'publico'" ) );
			break;
		}

		?>
		<div class="wrap">
			<h2><?php print ( !$SAV->is_user_ong() ) ? "Editais" : "Chamamentos"; ?><?php print $add_new_edital; ?></h2>

			<?php if( '1' == $_GET[ 'message' ] ) : ?>
				<div id="message" class="updated below-h2">
					<p>Edital cadastrado!</p>
				</div>
			<?php elseif( '2' == $_GET[ 'message' ] ) : ?>
				<div id="message" class="updated below-h2">
					<p>Edital apagado!</p>
				</div>
			<?php endif; ?>

			<div class="subsubsub">
				<?php if( !empty( $quantidade_editais ) ) : ?><a href="admin.php?page=editais" title="Todos" class="<?php if( '' == $status ) print 'current'; ?>">Todos <span class="count">( <?php print $quantidade_editais; ?> )</span></a><?php endif; ?>
				<?php if( !empty( $quantidade_editais_proximos ) ) : ?>| <a href="admin.php?page=editais&status=proximos" title="Próximos" class="<?php if( 'proximos' == $status ) print 'current'; ?>">Póximos <span class="count">( <?php print $quantidade_editais_proximos; ?> )</span></a><?php endif; ?>
				<?php if( !empty( $quantidade_editais_abertos ) ) : ?>| <a href="admin.php?page=editais&status=abertos" title="Abertos" class="<?php if( 'abertos' == $status ) print 'current'; ?>">Abertos <span class="count">( <?php print $quantidade_editais_abertos; ?> )</span></a><?php endif; ?>
				<?php if( !empty( $quantidade_editais_encerrados ) ) : ?>| <a href="admin.php?page=editais&status=encerrados" title="Encerrados" class="<?php if( 'encerrados' == $status ) print 'current'; ?>">Encerrados <span class="count">( <?php print $quantidade_editais_encerrados; ?> )</span></a><?php endif; ?>
				<?php if( !empty( $quantidade_editais_excluidos ) ) : ?>| <a href="admin.php?page=editais&status=lixo" title="Lixo" class="<?php if( 'lixo' == $status ) print 'current'; ?>">Lixo <span class="count">( <?php print $quantidade_editais_excluidos; ?> )</span></a><?php endif; ?>
			</div>

			<table class="wp-list-table widefat" cellspacing="0">
				<thead>
					<tr>
					<th>Título</th>
					<th>Abertura</th>
					<th>Encerramento</th>
					<?php if( current_user_can( 'edit_sav_editais' ) ) : ?>
						<th>Inscritos</th>
					<?php endif; ?>
					</tr>
				</thead>
				<tfoot>
					<tr>
					<th>Título</th>
					<th>Abertura</th>
					<th>Encerramento</th>
					<?php if( current_user_can( 'edit_sav_editais' ) ) : ?>
						<th>Inscritos</th>
					<?php endif; ?>
					</tr>
				</tfoot>
				<tbody>
					<?php if( !empty( $editais ) ) : ?>
						<?php foreach( $editais as $edital ) : ?>

							<?php if( ( ( 1 == $edital->pf AND $pessoa_fisica ) or ( 1 == $edital->pj AND $pessoa_juridica ) ) OR ( current_user_can( 'edit_sav_editais' ) OR current_user_can( 'approve_sav_propostas' ) /* retirar approve_sav_propostas */ ) ) : ?>

								<?php $chamada_convenio = $SAV->get_edital_meta( $edital->id_edital, 'chamada_convenio' ); ?>
								<?php $is_ong = $SAV->is_user_ong(); ?>

								<?php if( ( $chamada_convenio and $is_ong ) or !$is_ong ) : ?>

									<?php $inscritos = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_edital = %d AND status <> 'lixo'", $edital->id_edital ) ); ?>
									<tr valign="top" <?php if($odd = !$odd) print 'class="alternate"'; ?>>
										<td>
											<?php if( current_user_can( 'edit_sav_editais' ) ) : ?>
												<strong><a href="?page=formulario-edital&id_edital=<?php print $edital->id_edital; ?>" title="Editar: <?php print $edital->titulo; ?>"><?php print $edital->titulo; ?></a></strong>
											<?php else : ?>
												<strong><?php print $edital->titulo; ?></strong>
											<?php endif; ?>
											<div class="row-actions">
												<?php $separador = true; ?>
												<?php if( current_user_can( 'edit_sav_editais' ) ) : ?>
													<?php ( $separador ) ? $separador = false : print '|'; ?>
													<span><a href="?page=formulario-edital&id_edital=<?php print $edital->id_edital; ?>" title="Editar: <?php print $edital->titulo; ?>">editar</a></span>
												<?php endif; ?>
												<?php if( current_user_can( 'delete_sav_editais' ) ) : ?>
													<?php ( $separador ) ? $separador = false : print '|'; ?>
													<span class="trash"><a href="?page=editais&acao=deletar-edital&id_edital=<?php print $edital->id_edital; ?>" title="Apagar: <?php print $edital->titulo; ?>">apagar</a></span>
												<?php endif; ?>
												<?php if( $SAV->is_edital_aberto( $edital->id_edital ) ) : ?>
													<?php if( ( 1 == $edital->pf AND $SAV->is_pessoa_fisica( $user_login ) ) or ( 1 == $edital->pj AND $SAV->is_pessoa_juridica( $user_login ) ) ) : ?>
														<?php ( $separador ) ? $separador = false : print '|'; ?>
														<span><a href="?page=formulario-proposta&id_edital=<?php print $edital->id_edital; ?>">inscrever</a></span>
													<?php endif; ?>
												<?php endif; ?>
												<?php ( $separador ) ? $separador = false : print '|'; ?>
												<span><a href="?page=propostas&id_edital=<?php print $edital->id_edital; ?>" title="Acompanhar Inscrições">acompanhar inscrições</a></span>
											</div>
										</td>
										<td><abbr title="<?php print $edital->abertura; ?>"><?php print mysql2date( 'd/m/Y', $edital->abertura ); ?></abbr></td>
										<td><abbr title="<?php print $edital->encerramento; ?>"><?php print mysql2date( 'd/m/Y', $edital->encerramento ); ?></abbr></td>
										<?php if( current_user_can( 'edit_sav_editais' ) ) : ?>
											<td><a href="?page=propostas&id_edital=<?php print $edital->id_edital; ?>" title="Acompanhar Inscrições"><?php print $inscritos; ?></a></td>
										<?php endif; ?>
									</tr>
								<?php endif; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="4">Nenhum Edital</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>

		</div>
		<?php
	}

	/**
	 * formulario edital
	 *
	 * @name    formulario_edital
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2012-01-03
	 * @return  void
	 */
	function formulario_edital()
	{
		if( !current_user_can( 'edit_sav_editais' ) )
			return false;

		global $wpdb, $SAV;

		$id_edital = ( int ) $_REQUEST[ 'id_edital' ];

		$edital = $SAV->get_edital( $id_edital );

		?>
		<div id="sav-editais" class="wrap">
			<?php if( !empty( $edital[ 'id_edital' ] ) ) : ?>
				<h2>Atualizar Edital</h2>
			<?php else : ?>
				<h2>Adicionar Novo Edital</h2>
			<?php endif; ?>

			<?php if( '1' == $_GET[ 'status' ] ) : ?>
				<div class="updated">
					<p>Edital atualizado!</p>
				</div>
			<?php endif; ?>

			<form method="post">
				<?php if( !empty( $edital[ 'id_edital' ] ) ) : ?>
					<input type="hidden" name="acao" value="editar-edital" />
					<input type="hidden" name="id_edital" value="<?php print $edital[ 'id_edital' ]; ?>" />
				<?php else : ?>
					<input type="hidden" name="acao" value="adicionar-edital" />
				<?php endif; ?>
				<div class="metabox-holder has-right-sidebar">
					<div class="inner-sidebar">

						<div class="postbox">
							<h3>Publicar</h3>
							<div class="inside">
								<div class="submitbox">
									<div id="major-publishing-actions">
										<?php if( !empty( $edital[ 'id_edital' ] ) ) : ?>
											<div id="delete-action">
												<a href="?page=editais&acao=deletar-edital&id_edital=<?php print $edital->id_edital; ?>" title="Apagar" class="submitdelete deletion">Apagar</a>
											</div>
										<?php endif; ?>
										<div id="publishing-action">
											<input type="submit" name="publish" id="publish" class="button-primary" value="Publicar" tabindex="6" />
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="postbox">
							<h3>Proponentes</h3>
							<div class="inside">
								<p><label><input type="checkbox" name="pf" value="1" tabindex="4" <?php if( !empty( $edital[ 'pf' ] ) ) print 'checked="checked"'; ?> /> Pessoas Físicas</label></p>
								<p><label><input type="checkbox" name="pj" value="1" tabindex="4" <?php if( !empty( $edital[ 'pj' ] ) ) print 'checked="checked"'; ?> /> Pessoas Jurídicas</label></p>

								<?php $edital_ong = $SAV->get_edital_meta( $id_edital, 'edital_para_ong' ); ?>
								<p><label><input type="checkbox" name="edital_para_ong" value="1" tabindex="4" <?php if( !empty( $edital_ong ) ) print 'checked="checked"'; ?> /> Edital para ONGs</label></p>

								<?php $propostas_por_proponente = $SAV->get_edital_meta( $id_edital, 'propostas_por_proponente' ); ?>
								<p><label for="propostas_por_proponente">Propostas por Proponente: <input type="text" name="propostas_por_proponente" id="propostas_por_proponente" maxlength="2" size="2" value="<?php print $propostas_por_proponente; ?>" /></label></p>
							</div>
						</div>

						<div class="postbox">
							<h3>Currículos</h3>
							<div class="inside">
								<?php $dados_produtor = $SAV->get_edital_meta( $id_edital, 'dados_produtor' ); ?>
								<p><label><input type="checkbox" name="dados_produtor" value="1" tabindex="5" <?php if( !empty( $dados_produtor ) ) print 'checked="checked"'; ?> /> Curriculo do Produtor</label></p>

								<?php $dados_diretor = $SAV->get_edital_meta( $id_edital, 'dados_diretor' ); ?>
								<p><label><input type="checkbox" name="dados_diretor" value="1" tabindex="5" <?php if( !empty( $dados_diretor ) ) print 'checked="checked"'; ?> /> Curriculo do Diretor</label></p>

								<?php $dados_roteirista = $SAV->get_edital_meta( $id_edital, 'dados_roteirista' ); ?>
								<p><label><input type="checkbox" name="dados_roteirista" value="1" tabindex="5" <?php if( !empty( $dados_roteirista ) ) print 'checked="checked"'; ?> /> Curriculo do Roteirista</label></p>

								<?php $permitir_estreiante = $SAV->get_edital_meta( $id_edital, 'permitir_estreiante' ); ?>
								<p><label><input type="checkbox" name="permitir_estreiante" value="1" tabindex="5" <?php if( !empty( $permitir_estreiante ) ) print 'checked="checked"'; ?> /> Permitir Estreante</label></p>
							</div>
						</div>

						<div class="postbox">
							<h3>Extensões</h3>
							<div class="inside">
								<?php $orcamento_cinema = $SAV->get_edital_meta( $id_edital, 'orcamento_cinema' ); ?>
								<p><label><input type="checkbox" name="orcamento_cinema" value="1" tabindex="5" <?php if( !empty( $orcamento_cinema ) ) print 'checked="checked"'; ?> /> Orçamento Cinematográfico</label></p>

								<?php $limite_orcamento_cinema = $SAV->get_edital_meta( $id_edital, 'limite_orcamento_cinema' ); ?>
								<p><label for="limite_orcamento_cinema">R$: <input type="text" name="limite_orcamento_cinema" id="limite_orcamento_cinema" maxlength="12" size="10" value="<?php print $SAV->mysql_para_moeda( $limite_orcamento_cinema ); ?>" /> <small>orçamento</small></label></p>

								<?php $limite_contrapartida = $SAV->get_edital_meta( $id_edital, 'limite_contrapartida' ); ?>
								<p><label for="limite_contrapartida">R$: <input type="text" name="limite_contrapartida" id="limite_contrapartida" maxlength="12" size="10" value="<?php print $SAV->mysql_para_moeda( $limite_contrapartida ); ?>" /> <small>contrapartida</small></label></p>

								<?php $limite_complementar = $SAV->get_edital_meta( $id_edital, 'limite_complementar' ); ?>
								<p><label for="limite_complementar">R$: <input type="text" name="limite_complementar" id="limite_complementar" maxlength="12" size="10" value="<?php print $SAV->mysql_para_moeda( $limite_complementar ); ?>" /> <small>complementar</small></label></p>

								<?php $producao_cinema  = $SAV->get_edital_meta( $id_edital, 'producao_cinema' ); ?>
								<p><label><input type="checkbox" name="producao_cinema" value="1" tabindex="5" <?php if( !empty( $producao_cinema ) ) print 'checked="checked"'; ?> /> Produção Cinematográfica</label></p>

								<?php $direcao_cinema  = $SAV->get_edital_meta( $id_edital, 'direcao_cinema' ); ?>
								<p><label><input type="checkbox" name="direcao_cinema" value="1" tabindex="5" <?php if( !empty( $direcao_cinema ) ) print 'checked="checked"'; ?> /> Direção Cinematográfica</label></p>

								<?php $roteiro_cinema   = $SAV->get_edital_meta( $id_edital, 'roteiro_cinema' ); ?>
								<p><label><input type="checkbox" name="roteiro_cinema" value="1" tabindex="5" <?php if( !empty( $roteiro_cinema ) ) print 'checked="checked"'; ?> /> Roteiro Cinematográfico</label></p>

								<?php $chamada_convenio   = $SAV->get_edital_meta( $id_edital, 'chamada_convenio' ); ?>
								<p><label><input type="checkbox" name="chamada_convenio" value="1" tabindex="5" <?php if( !empty( $chamada_convenio ) ) print 'checked="checked"'; ?> /> Chamada Convênio</label></p>

							</div>
						</div>

						<div class="postbox">
							<h3>Outras configurações</h3>
							<div class="inside">
								<?php $numero_edital = $SAV->get_edital_meta( $id_edital, 'numero_edital' ); ?>
								<p><label for="numero_edital">Número Edital </br><input type="text" name="numero_edital" id="numero_edital" maxlength="2" size="2" value="<?php print $numero_edital; ?>" /></label></p>
							</div>
							<div class="inside">
								<?php $quantidade_classificados = $SAV->get_edital_meta( $id_edital, 'quantidade_classificados' ); ?>
								<p><label for="quantidade_classificados">Quantidade de Classificados </br><input type="text" name="quantidade_classificados" id="quantidade_classificados" maxlength="2" size="10" value="<?php print $quantidade_classificados; ?>" /> <small>por consultor</small></label></p>
							</div>
							<div class="inside">
								<?php $avaliacao_por_grupo = $SAV->get_edital_meta( $id_edital, 'avaliacao_por_grupo') ?>
								<p><label><input type="checkbox" name="avaliacao_por_grupo" value="1" tabindex="5" <?php if( !empty( $avaliacao_por_grupo ) ) print 'checked="checked"'; ?> /> Avaliação por Grupo</label></p>
							</div>
						</div>

					</div>

					<div id="post-body">

						<div id="post-body-content">
							<div id="titlediv">
								<div id="titlewrap">
									<input type="text" id="title" name="titulo" value="<?php print ( !empty( $edital[ 'titulo' ] ) ) ? $edital[ 'titulo' ] : 'Título'; ?>" tabindex="1" />
								</div>
							</div>

							<div class="postbox">
								<h3>Descrição</h3>
								<div class="inside">
									<p><textarea id="descricao" name="descricao" rows="5" cols="50" tabindex="2" class="widefat"><?php print $edital[ 'descricao' ]; ?></textarea></p>
								</div>
							</div>

							<div class="postbox">
								<h3>Período</h3>
								<div class="inside">
									<p>
										<label for="abertura">Abertura</label><br/>
										<input type="text" id="abertura" class="date" name="abertura" value="<?php print ( !empty( $edital[ 'abertura' ] ) ) ? date( 'd/m/Y', strtotime( $edital[ 'abertura' ] ) ) : date( 'd/m/Y' ); ?>" size="10" maxlength="10" tabindex="3" />
									</p>
									<p>
										<label for="encerramento">Encerramento</label><br />
										<input type="text" id="encerramento" class="date" name="encerramento" value="<?php print ( !empty( $edital[ 'encerramento' ] ) ) ? date( 'd/m/Y', strtotime( $edital[ 'encerramento' ] ) ) : date( 'd/m/Y', strtotime( '+1 month' ) ); ?>" size="10" maxlength="10" tabindex="3" />
									</p>
								</div>
							</div>

							<div class="postbox">
								<h3>Declaração</h3>
								<div class="inside">
									<p><textarea id="declaracao" name="declaracao" rows="5" cols="50" tabindex="3" class="widefat"><?php print $edital[ 'declaracao' ]; ?></textarea></p>
								</div>
							</div>

							<div class="postbox">
								<h3>Critérios de Avaliação</h3>

								<?php $criterios		    = $SAV->get_criterios_avaliacao( $id_edital ); ?>
								<?php $criterio_desempate_1 = $SAV->get_edital_meta( $id_edital, 'criterio_desempate_1' ); ?>
								<?php $criterio_desempate_2 = $SAV->get_edital_meta( $id_edital, 'criterio_desempate_2' ); ?>

								<div class="inside">
									<div class="area">
										<div class="criterios">
											<?php if ( !empty($criterios) ) :?>
											<table width="100%" cellspacing="15px" >
												<th>Critérios</th><th>Desempate 1</th><th>Desempate 2</th><th></th>
												<?php foreach( $criterios as $criterio ) : ++$item; ?>

													<tr class="criterio">
														<input type="hidden" name="criterios[<?php print $item; ?>][id_criterio]" value="<?php print $criterio[ 'id_criterio' ]; ?>" />
														<td>
															<input type="text" id="criterio_<?php print $item; ?>" name="criterios[<?php print $item; ?>][descricao]" value="<?php print $criterio[ 'descricao' ]; ?>" maxlength="100" size="40" />
														</td>
														<td align="center">
															<input type="radio" name="criterio_desempate_1" value="<?php print $criterio[ 'id_criterio' ]; ?>" <?php if( $criterio_desempate_1 == $criterio[ 'id_criterio' ] ) print 'checked="checked"'; ?> />
														</td>
														<td align="center">
															<input type="radio" name="criterio_desempate_2" value="<?php print $criterio[ 'id_criterio' ]; ?>" <?php if( $criterio_desempate_2 == $criterio[ 'id_criterio' ] ) print 'checked="checked"'; ?> />
														</td>
														<td valign="bottom" align="right">
															<span class="trash"><a href="#remover-criterio" title="remover critério" class="remover-criterio">remover critério</a></span>
														</td>
													</tr>

												<?php endforeach; ?>
												</table>
											<?php endif; ?>
										</div>
											<input type="hidden" id="count" name="count" value="<?php print $item; ?>" />
											<table width="100%" cellspacing="15px">
												<tr>
													<td>
														<span><a href="#adicionar-criterio" title="adicionar criterio" class="adicionar-criterio">adicionar critério</a></span>
													</td>
												</tr>
											</table>
									</div>
								</div>
							</div>

							<div class="postbox">
								<h3>Comissão de Seleção</h3>
								<?php $comissao = $SAV->get_edital_meta( $id_edital, 'comissao' ); ?>
								<div class="inside">
									<div class="area">
										<div>
											<table width="100%" cellspacing="15px" class="comissao">
												<?php if ( !empty($comissao) ) :?>
													<?php foreach( $comissao as $consultor ) : ++$i; ?>
														<tr class="consultor">
															<td>
																<label for="consultor_<?php print $i; ?>">Consultor </label>
																<input type="text" id="consultor_<?php print $i; ?>" name="comissao[<?php print $i; ?>][consultor]" value="<?php print $consultor[ 'consultor' ]; ?>" maxlength="11" size="15" class="large" />
															</td>
															<?php $avaliacao_por_grupo = $SAV->get_edital_meta( $id_edital, 'avaliacao_por_grupo'); ?>
															<?php if( !empty( $avaliacao_por_grupo ) ) : ?>
																<td>
																	<label for="consultor_<?php print $i; ?>">Grupo</label>
																	<select name="comissao[<?php print $i; ?>][grupo]">
																		<option value="">selecione</option>
																		<option value="1" <?php if( $consultor['grupo'] == 1 ) print "selected='selected'"; ?>>1</option>
																		<option value="2" <?php if( $consultor['grupo'] == 2 ) print "selected='selected'"; ?>>2</option>
																		<option value="3" <?php if( $consultor['grupo'] == 3 ) print "selected='selected'"; ?>>3</option>
																	</select>
																</td>
															<?php endif; ?>
															<td valign="bottom" align="right">
																<span class="trash"><a href="#remover-consultor" title="remover consultor" class="remover-consultor">remover consultor</a></span>
															</td>
															<?php $cpf_consultor = $consultor[ 'consultor' ]; ?>

															<?php $id_consultor = $wpdb->get_var( $wpdb->prepare("SELECT ID FROM wp_users WHERE user_login = %s", $cpf_consultor ) ); ?>

															<?php $quant_analisadas = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT p.id_proposta) FROM {$wpdb->sav_avaliacao} as p INNER JOIN {$wpdb->sav_propostas} as pe ON p.id_proposta = pe.id_proposta WHERE p.id_consultor = %d AND pe.id_edital = %d ", $id_consultor, $id_edital ) ); ?>

															<td valign="bottom" align="right">
																<?php if( !empty( $quant_analisadas ) ) : ?>
																	<span style="color:#009900">Analisadas: <?php print $quant_analisadas ?></span>
																<?php endif; ?>
															</td>

															<?php $comissao_finalizada = $SAV->get_edital_meta( $id_edital, 'comissao_finalizada' ); ?>
															<td valign="bottom" align="right">
																<?php if(in_array( $cpf_consultor,  $comissao_finalizada ) ) : ?>
																	<span style="color:#009900">Finalizou</span>
																<?php else : ?>
																	<span>Não Finalizou</span>
																<?php endif; ?>
															</td>

														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</table>
										</div>
											<input type="hidden" id="count_consultor" name="count_consultor" value="<?php print $i; ?>" />
											<table width="100%" cellspacing="15px">
												<tr>
													<td>
														<span><a href="#adicionar-consultor" title="adicionar consultor" class="adicionar-consultor">adicionar consultor</a></span>
													</td>
												</tr>
											</table>
									</div>
								</div>
							</div>
							<div class="postbox">
								<h3>Cronograma do Edital</h3>

								<?php $data_portaria_habilitacao 	= $SAV->get_edital_meta( $id_edital, 'data_portaria_habilitacao'); ?>

								<?php $data_inicio_classificacao 	= $SAV->get_edital_meta( $id_edital, 'data_inicio_classificacao' ); ?>
								<?php $data_fim_classificacao 		= $SAV->get_edital_meta( $id_edital, 'data_fim_classificacao' ); ?>
								<?php $data_portaria_classificacao  = $SAV->get_edital_meta( $id_edital, 'data_portaria_classificacao' ); ?>

								<?php $data_portaria_pre_selecao 	= $SAV->get_edital_meta( $id_edital, 'data_portaria_pre_selecao' ); ?>

								<?php $data_portaria_selecao 		= $SAV->get_edital_meta( $id_edital, 'data_portaria_selecao' ); ?>

								<?php $data_inicio_recurso			= $SAV->get_edital_meta( $id_edital, 'data_inicio_recurso' ); ?>
								<?php $data_fim_recurso				= $SAV->get_edital_meta( $id_edital, 'data_fim_recurso' ); ?>

								<?php $status_passivel_recurso		= $SAV->get_edital_meta( $id_edital, 'status_passivel_recurso' ); ?>

								<div class="inside">
									<div class="area">
										<div class="cronograma">
											<table width="100%" cellspacing="15px" class="consultor">
												<tr colspan="3">
													<td>
														<label for="portaria_habilitacao">Portaria Habilitação</label>
														</br>
														<input type="text" id="portaria_habilitacao" class="date" name="cronograma[data_portaria_habilitacao]" value="<?php if( !empty( $data_portaria_habilitacao ) ) print date( 'd/m/Y', strtotime( $data_portaria_habilitacao ) ); ?>" maxlength="10" size="10" class="large" />
													</td>
												</tr>
												<tr>
													<td>
														<label for="inicio_classificacao">Inicio Classificação</label>
														</br>
														<input type="text" id="inicio_classificacao" class="date" name="cronograma[data_inicio_classificacao]" value="<?php if( !empty( $data_inicio_classificacao) ) print date( 'd/m/Y', strtotime( $data_inicio_classificacao) ); ?>" maxlength="10" size="10" class="large" />
													</td>
													<td>
														<label for="fim_classificacao">Fim Classificação</label>
														</br>
														<input type="text" id="fim_classificacao" class="date" name="cronograma[data_fim_classificacao]" value="<?php if( !empty( $data_fim_classificacao ) ) print date( 'd/m/Y', strtotime( $data_fim_classificacao ) ); ?>" maxlength="10" size="10" class="large" />
													</td>
													<td>
														<label for="portaria_classificacao">Portaria Classificação</label>
														</br>
														<input type="text" id="portaria_classificacao" class="date" name="cronograma[data_portaria_classificacao]" value="<?php if( !empty( $data_portaria_classificacao ) ) print date( 'd/m/Y', strtotime( $data_portaria_classificacao ) ); ?>" maxlength="10" size="10" class="large" />
													</td>
												</tr>
												<tr colspan="3">
													<td>
														<label for="portaria_pre_selecao">Portaria pré-seleção</label>
														</br>
														<input type="text" id="portaria_pre_selecao" class="date" name="cronograma[data_portaria_pre_selecao]" value="<?php if( !empty( $data_portaria_pre_selecao ) ) print date( 'd/m/Y', strtotime( $data_portaria_pre_selecao ) ) ?>" maxlength="10" size="10" class="large" />
													</td>
												</tr>
												<tr colspan="3">
													<td>
														<label for="portaria_selecao">Portaria Seleção</label>
														</br>
														<input type="text" id="portaria_selecao" class="date" name="cronograma[data_portaria_selecao]" value="<?php if( !empty( $data_portaria_selecao ) ) print date( 'd/m/Y', strtotime( $data_portaria_selecao ) ); ?>" maxlength="10" size="10" class="large" />
													</td>
												</tr>
												<tr>
													<td>
														<label for="data_inicio_recurso">Início Recurso </label>
														</br>
														<input type="text" id="data_inicio_recurso" class="date" name="cronograma[data_inicio_recurso]" value="<?php if( !empty( $data_inicio_recurso ) ) print date( 'd/m/Y', strtotime( $data_inicio_recurso ) ); ?>" maxlength="10" size="10" class="large" />
													</td>
													<td>
														<label for="data_fim_recurso">Fim Recurso</label>
														</br>
														<input type="text" id="data_fim_recurso" class="date" name="cronograma[data_fim_recurso]" value="<?php  if( !empty( $data_fim_recurso ) ) print date( 'd/m/Y', strtotime( $data_fim_recurso ) ) ; ?>" maxlength="10" size="10" class="large" />
													</td>
													<td>
														<label for="status_passivel_recurso">Status</label>
														</br>
														<?php print $SAV->dropdown_status('status_passivel_recurso', $status_passivel_recurso, true ); ?>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
			</form>
			<?php $this->converter_status( $id_edital ); ?>
			<?php $this->notas_classificados( $id_edital ) ?>
		</div>
		<?php
	}

	/**
	 * dividir proposta por grupo
	 *
	 * @name dividir_proposta_grupo
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-03-21
	 * @updated 2012-03-22
	 * @return mixed
	 */
	function dividir_proposta_grupo( $id_edital )
	{
		if ( empty( $id_edital ) or !current_user_can( 'review_sav_propostas' ))
			return false;

		global $wpdb, $SAV;

		$dividido_por_grupo = $SAV->get_edital_meta( $id_edital, 'dividido_por_grupo' );

		//if( !empty( $dividido_por_grupo ) )
			//return false;

		$proponentes = $wpdb->get_results($wpdb->prepare( "SELECT p.id_proposta, ps.estado FROM {$wpdb->sav_propostas} as p INNER JOIN {$wpdb->users} as po ON p.id_author = po.ID INNER JOIN {$wpdb->sav_dados_geograficos} as ps ON po.user_login = ps.login WHERE p.id_edital = %d GROUP BY p.id_proposta", $id_edital) );

		foreach( $proponentes as $proponente )
		{

			$regiao = $SAV->where_regiao( $proponente->estado );

			switch( $regiao )
			{
				case 'sul':
					$propostas['sul'][] = $proponente->id_proposta;
				break;
				case 'sudeste':
					$propostas['sudeste'][] = $proponente->id_proposta;
				break;
				case 'centro oeste':
					$propostas['centro_oeste'][] = $proponente->id_proposta;
				break;
				case 'nordeste':
					$propostas['nordeste'][] = $proponente->id_proposta;
				break;
				case 'norte':
					$propostas['norte'][] = $proponente->id_proposta;
				break;
				default:
					$propostas['invalido'][] = $proponente->id_proposta;
				break;
			}
		}

		if ( array_key_exists('invalido', $propostas ) )
		{
			return false;
		}
		else
		{
			// array com propostas por regiao
			foreach ( $propostas as $key => $proposta )
			{
				//  array da regiao
				foreach( $proposta as $item )
				{
					// verifica se a proposta já possui grupo
					$proposta_dividida = $SAV->get_proposta_meta( $item, 'grupo' );

					if( empty( $proposta_dividida ) )
					{
						$i++;

						//$SAV->update_proposta_meta( $item, 'grupo', $i);

						if ( $i == 3 )
							$i = 0;
					}
				}
			}

			$SAV->update_edital_meta( $id_edital, 'dividido_por_grupo', true);

			return true;
		}
	}

	/**
	 * Converter status
	 *
	 * @name converter_status
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-07-06
	 * @updated 2012-07-12
	 * @return mixed
	 */
	function converter_status( $id_edital )
	{
		global $SAV;

		?>

		<div class="metabox-holder" style="clear: both; margin-right: 300px;">
			<form method="post">
				<input type="hidden" name="acao" value="converter-status" />
				<input type="hidden" name="id_edital" value="<?php print $id_edital ?>" />
				<div class="postbox">
					<h3>Converter Status</h3>
					<div class="inside">
						<div class="area">
							<div class="cronograma">
								<table width="100%" cellspacing="15px" class="consultor">
									<tr>
										<td>
											<label for="de">Converter de</label>
											</br>
											<?php print $SAV->dropdown_status( 'de', '', true, null ) ?>
										</td>
										<td>
											<label for="para">Para</label>
											</br>
											<?php print $SAV->dropdown_status( 'para', '', true, null ) ?>
										</td>
									</tr>
									<tr>
										<td colspan='2'>
											<label for="observacao">Observação *</label>
											</br>
											<textarea id="observacao" name="observacao" cols="50" rows="3" tabindex="2" maxlength="3000"></textarea>
										</td>
									</tr>
									<tr align="right">
										<td colspan='2'>
											<input type="submit" name="converter" id="converter" class="button-primary" value="converter" tabindex="2" onclick="return confirm( 'Esta ação altera o status das propostas em massa. Tem certeza que deseja continuar? ' );" />
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php
	}


	/**
	 * atualiza em massa o status de uma proposta para outra, registrando o histórico das propostas
	 *
	 * @name    update_conversao_status
	 * @author  Cleber Santos <marcelo.costa@cultura.gov.br>
	 * @since   2012-07-06
	 * @updated 2012-07-06
	 * @return  void
	 */
	function update_conversao_status( $id_edital )
	{
		global $wpdb, $SAV, $user_ID;

		$de   		= $_POST['de'];
		$para 		= $_POST['para'];
		$observacao = htmlspecialchars( stripslashes( $_POST[ 'observacao' ] ) );

		if( empty( $id_edital ) or empty( $de ) or empty( $para ) )
			return false;

		if( $de == $para )
			return false;

		$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_edital = %d AND status = %s", $id_edital, $de ) );

		if( !empty( $propostas ) )
		{
			$atualizado = $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_propostas} SET status = %s WHERE id_edital = %d AND status = %s", $para, $id_edital, $de ) );

			if( $atualizado )
			{
				foreach( $propostas as $proposta )
				{
					$SAV->registrar_historico_proposta( $proposta->id_proposta, null, $observacao, $para );
				}
			}
		}
	}


	/**
	 * exporta as notas dos projetos classificados
	 *
	 * @name    excel_notas_classificacao
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-09-06
	 * updated 	2012-09-06
	 * return 	void
	*/
	function excel_notas_classificacao( $id_edital ) {

		global $SAV, $user_ID, $wpdb;

		if(!current_user_can('administrator') )
			return false;

		// tipo de arquivo
		header('Content-type: application/msexcel');

		// Nome do arquivo
		$filename = "notas_classificacao_edital_" . $id_edital . ".xls";

		// Formato do arquivo
		header("Content-Disposition: attachment; filename={$filename}");

		$criterios = $SAV->get_criterios_avaliacao( $id_edital );

		//$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo FROM {$wpdb->sav_propostas} WHERE status = 'nao_pre_selecionado' AND id_edital = 1 ORDER BY id_proposta" ) );
		$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.id_edital, p.titulo, p.status, pe.id_criterio, SUM(pe.nota) as nota, pe.id_consultor FROM {$wpdb->sav_propostas} as p LEFT JOIN {$wpdb->sav_avaliacao} as pe ON p.id_proposta = pe.id_proposta WHERE p.id_edital = %d AND id_criterio = '' GROUP BY p.id_proposta ORDER BY nota DESC", $id_edital ) );


		foreach ( $propostas as $proposta ) {
			$html .= "<strong>Proposta nº: " . ( $proposta->id_proposta ) . " - Título: " . ( $proposta->titulo ) . "</strong>";

			// zerar array
			unset($notas);

			$html .= "<table class='excel' border=1 cellspacing=0 cellpadding=2 bordercolor='666633'>";
			$html .= 	"<thead>";
			$html .= 		"<th>Critérios</th>";

								$consultores = $SAV->get_consultores_proposta( $proposta->id_proposta );

								foreach( $consultores as $consultor )
								{
									$dados_consultor = get_userdata( $consultor[ 'id_consultor' ] );

			$html .=				"<th>" .  $dados_consultor->user_firstname . "</th>";
								}

			$html .=			"<th>Média Final</th>";

			$html .=	"</thead>";
			$html .= 	"<tbody>";
							$item = 0;
							foreach( $criterios as $criterio)
							{
								$item++;
			$html .= 			"<tr>";
			$html .= 				"<td>";
			$html .= 					"<label for='criterio_". $item . "'>" . $criterio['descricao']. "</label>";
			$html .=				"</td>";

									$notas_por_criterio = 0;
									$i = 0;
									foreach( $consultores as $consultor )
									{
										$i++;

										$avaliacao = $SAV->get_nota_criterio( $criterio['id_criterio'], $proposta->id_proposta, $consultor['id_consultor'] );

										$notas[$consultor['id_consultor']] += $avaliacao['nota'];

										$notas_por_criterio += $avaliacao['nota'];

			$html .=					"<td align='center'>";
			$html .=						$SAV->mysql_para_moeda( $avaliacao['nota'] );
			$html .=					"</td>";
									}
			$html .=				"<td align='center'>";
										$media_por_criterio = ( $notas_por_criterio / $i );
			$html .=					$SAV->mysql_para_moeda( $media_por_criterio );
			$html .=				"</td>";
			$html .=			"</tr>";
							}
			$html .=		"<tr>";
			$html .=			"<td>";
			$html .=				"<label><strong>Total</strong></label>";
			$html .=			"</td>";

								foreach( $consultores as $consultor )
								{
			$html .=				"<td align='center'>";
			$html .=					$SAV->mysql_para_moeda( $notas[$consultor['id_consultor']] );
			$html .=				"</td>";
								}

			$html .=			"<td align='center'>";
			$html .=				$SAV->mysql_para_moeda( array_sum($notas)/$i );
			$html .=			"</td>";
			$html .=		"</tr>";
			$html .= 	"</tbody>";
			$html .= "</table>";

		}

		print ( $html );
		exit();
	}

	/**
	 * botão de impressao
	 *
	 * @name    notas_classificados
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-09-06
	 * @updated 2012-09-06
	 * @return  void
	 */
	function notas_classificados( $id_edital )
	{

		?>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">
						<tr valign="top">
							<td>
								<a href="?page=editais&acao=excel_notas_classificacao&id_edital=<?php print $id_edital; ?>" title="Gerar planilha" class="button-primary" target="blank">Notas classificação</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * gerenciar editais
	 *
	 * @name    gerenciar_editais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-17
	 * @updated 2012-01-03
	 * @return  void
	 */
	function gerenciar_editais()
	{
		global $wpdb, $SAV;

		if( isset( $_REQUEST[ 'acao' ] ) )
		{
			// validar dados
			$edital[ 'id_edital' ]                = $_REQUEST[ 'id_edital' ];

			$edital[ 'titulo' ]                   = $_POST[ 'titulo' ];
			$edital[ 'descricao' ]                = $_POST[ 'descricao' ];
			$edital[ 'declaracao' ]               = $_POST[ 'declaracao' ];

			$edital[ 'pf' ]                       = ( bool ) $_POST[ 'pf' ];
			$edital[ 'pj' ]                       = ( bool ) $_POST[ 'pj' ];
			$edital[ 'edital_para_ong' ]		  = ( bool ) $_POST['edital_para_ong' ];
			$edital[ 'propostas_por_proponente' ] = ( int )  $_POST[ 'propostas_por_proponente' ];

			$edital[ 'dados_produtor' ]           = ( bool ) $_POST[ 'dados_produtor' ];
			$edital[ 'dados_diretor' ]            = ( bool ) $_POST[ 'dados_diretor' ];
			$edital[ 'dados_roteirista' ]         = ( bool ) $_POST[ 'dados_roteirista' ];
			$edital[ 'permitir_estreiante' ]      = ( bool ) $_POST[ 'permitir_estreiante' ];

			$edital[ 'producao_cinema' ]          = ( bool ) $_POST[ 'producao_cinema' ];
			$edital[ 'direcao_cinema' ]           = ( bool ) $_POST[ 'direcao_cinema' ];
			$edital[ 'roteiro_cinema' ]           = ( bool ) $_POST[ 'roteiro_cinema' ];
			$edital[ 'orcamento_cinema' ]         = ( bool ) $_POST[ 'orcamento_cinema' ];
			$edital[ 'limite_orcamento_cinema' ]  = $_POST[ 'limite_orcamento_cinema' ];
			$edital[ 'limite_contrapartida' ]     = $_POST[ 'limite_contrapartida' ];
			$edital[ 'limite_complementar' ]      = $_POST[ 'limite_complementar' ];
			$edital[ 'chamada_convenio' ]		  = $_POST[ 'chamada_convenio' ];

			$edital[ 'numero_edital' ]			  = $_POST['numero_edital' ];
			$edital[ 'quantidade_classificados' ] = $_POST['quantidade_classificados' ];
			$edital[ 'avaliacao_por_grupo' ] 	  = ( bool ) $_POST['avaliacao_por_grupo' ];

			$edital[ 'criterio_desempate_1' ] 	  = ( int ) $_POST[ 'criterio_desempate_1' ];
			$edital[ 'criterio_desempate_2' ] 	  = ( int ) $_POST[ 'criterio_desempate_2' ];

			$edital['criterios']  				  = $_POST[ 'criterios' ];
			$edital['comissao']					  = $_POST[ 'comissao' ];
			$edital['cronograma'] 				  = $_POST[ 'cronograma' ];

			$edital['status_passivel_recurso'] 		  = $_POST[ 'status_passivel_recurso' ];

			// formato da data
			if( preg_match( '/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/', $_POST[ 'abertura' ] ) )
				$edital[ 'abertura' ]        = preg_replace( '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', '$3-$2-$1', $_POST[ 'abertura' ] );

			if( preg_match( '/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/', $_POST[ 'encerramento' ] ) )
				$edital[ 'encerramento' ]    = preg_replace( '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', '$3-$2-$1', $_POST[ 'encerramento' ] );
		}

		// gerenciar dados
		switch( $_REQUEST[ 'acao' ] )
		{
			// adicionar edital
			case 'adicionar-edital' :
			case 'editar-edital' :
				$id_edital = $SAV->update_edital( $edital );

				$SAV->update_edital_meta( $id_edital, 'edital_para_ong', $edital[ 'edital_para_ong' ] );
				$SAV->update_edital_meta( $id_edital, 'propostas_por_proponente', $edital[ 'propostas_por_proponente' ] );
				$SAV->update_edital_meta( $id_edital, 'producao_cinema', $edital[ 'producao_cinema' ] );
				$SAV->update_edital_meta( $id_edital, 'direcao_cinema', $edital[ 'direcao_cinema' ] );
				$SAV->update_edital_meta( $id_edital, 'roteiro_cinema', $edital[ 'roteiro_cinema' ] );

				$SAV->update_edital_meta( $id_edital, 'orcamento_cinema', $edital[ 'orcamento_cinema' ] );
				$SAV->update_edital_meta( $id_edital, 'limite_orcamento_cinema', $SAV->moeda_para_mysql( $edital[ 'limite_orcamento_cinema' ] ) );
				$SAV->update_edital_meta( $id_edital, 'limite_contrapartida', $SAV->moeda_para_mysql( $edital[ 'limite_contrapartida' ] ) );
				$SAV->update_edital_meta( $id_edital, 'limite_complementar', $SAV->moeda_para_mysql( $edital[ 'limite_complementar' ] ) );

				$SAV->update_edital_meta( $id_edital, 'dados_produtor', $edital[ 'dados_produtor' ] );
				$SAV->update_edital_meta( $id_edital, 'dados_diretor', $edital[ 'dados_diretor' ] );
				$SAV->update_edital_meta( $id_edital, 'dados_roteirista', $edital[ 'dados_roteirista' ] );
				$SAV->update_edital_meta( $id_edital, 'permitir_estreiante', $edital[ 'permitir_estreiante' ] );
				$SAV->update_edital_meta( $id_edital, 'chamada_convenio', $edital[ 'chamada_convenio' ] );

				$SAV->update_edital_meta( $id_edital, 'numero_edital', $edital['numero_edital' ] );
				$SAV->update_edital_meta( $id_edital, 'quantidade_classificados', $edital['quantidade_classificados' ] );
				$SAV->update_edital_meta( $id_edital, 'avaliacao_por_grupo', $edital['avaliacao_por_grupo' ] );

				$SAV->update_edital_meta( $id_edital, 'criterio_desempate_1', $edital['criterio_desempate_1' ] );
				$SAV->update_edital_meta( $id_edital, 'criterio_desempate_2', $edital['criterio_desempate_2' ] );

				$SAV->update_edital_meta( $id_edital, 'status_passivel_recurso',  $edital['status_passivel_recurso'] );

				if ( !empty( $edital['avaliacao_por_grupo' ] ) )
					$this->dividir_proposta_grupo( $id_edital );

				$criterios  = $edital['criterios'];
				$comissao   = $edital['comissao'];
				$cronograma = $edital['cronograma'];

				// adicionar/atualizar criterios de avaliacao
				if ( !empty( $criterios ) )
				{
					foreach( $criterios as $criterio)
					{
						$SAV->update_criterio_avaliacao( $criterio, $id_edital );
					}
				}

				// adicionar/atualizar comissao de avaliacao
				if ( !empty( $comissao ) )
				{
					$SAV->update_edital_meta( $id_edital, 'comissao', $comissao);
				}
				else
				{
					$SAV->delete_edital_meta( $id_edital, 'comissao'  );
				}

				foreach($cronograma as $key => $data )
				{
					if( preg_match( '/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/', $data ) )
						$data = preg_replace( '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', '$3-$2-$1', $data );

					$SAV->update_edital_meta( $id_edital, $key , $data);
				}
				wp_redirect( "?page=editais&status=1" ); exit();
			break;

			// deletar edital
			case 'deletar-edital' :
				$SAV->delete_edital( $edital[ 'id_edital' ] );

				wp_redirect( "?page=editais&status=2" ); exit();
			break;
			case 'converter-status' :
				$this->update_conversao_status( $edital[ 'id_edital' ] );
			break;
			case 'excel_notas_classificacao' :
				$this->excel_notas_classificacao( $edital[ 'id_edital' ] );
			break;
		}
	}

	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////
	/**
	 * @name    SAV_Editais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2011-08-17
	 * @return  void
	 */
	function SAV_Editais()
	{
		// menu
		add_action( 'admin_menu', array( &$this, 'menus' ) );

		// gerenciar editais
		add_action( 'init', array( &$this, 'gerenciar_editais' ) );
	}

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

$SAV_Editais = new SAV_Editais();

?>