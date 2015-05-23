<?php

/**
 * Copyright (c) 2011 Ministério da Cultura
 *
 * Written by
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

class SAV_Propostas
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////
	var $passos;

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////
	/**
	 * load styles
	 *
	 * @name    admin_styles
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-19
	 * @updated 2011-09-12
	 * @return  void
	 */
	function admin_styles()
	{
		global $SAV;

		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_style( 'sav-editais', "{$SAV->url}/css/sav-editais.css" );
	}

	/**
	 * load scripts
	 *
	 * @name    admin_scripts
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-23
	 * @updated 2012-07-19
	 * @return  void
	 */
	function admin_scripts()
	{
		global $SAV;

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		//wp_enqueue_script( 'maskedinput-1.3.min', "{$SAV->url}/js/maskedinput-1.3.min.js", array( 'jquery' ) );
		wp_enqueue_script( 'jquery-mask', "{$SAV->url}/js/jquery-mask.js", array( 'jquery' ) );
		wp_enqueue_script( 'sav-editais', "{$SAV->url}/js/sav-editais.js", array( 'jquery' ) );

	}

	/**
	 * create the administrative menus
	 *
	 * @name    menu
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2012-06-29
	 * @return  void
	 */
	function menus()
	{
		$propostas          = add_submenu_page( 'editais', 'Propostas', 'Propostas', 'edit_sav_propostas', 'propostas', array( &$this, 'mostrar_propostas' ) );
		$adicionar_proposta = add_submenu_page( 'editais', 'Adicionar Proposta', 'Adicionar Proposta', 'edit_sav_propostas', 'formulario-proposta', array( &$this, 'formulario_proposta' ) );

		add_action( "admin_print_styles-{$adicionar_proposta}", array( &$this, 'admin_styles' ) );
		add_action( "admin_print_scripts-{$adicionar_proposta}", array( &$this, 'admin_scripts' ) );
	}

	/**
	 * mostrar as propostas
	 *
	 * @name    mostrar_propostas
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-18
	 * @updated 2012-07-20
	 * @return  void
	 */
	function mostrar_propostas()
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		// filtros
		$id_edital                        = ( int ) $_REQUEST[ 'id_edital' ];
		$status                           = $_REQUEST[ 'status' ];

		// buscar
		$select_value                     = $_REQUEST[ 'select_value' ];
		$search_input                     = $_REQUEST[ 'search_input' ];

		// paginacao
		$propostas_por_pagina             = ( int ) 20;

		$pagina_proposta                  = ( int ) $_REQUEST[ 'paged' ];
		$paginas_proposta                 = 1;

		if( empty( $pagina_proposta ) )
			$pagina_proposta              = 1;

		$proposta_inicial                 = 1;

		if( !empty( $id_edital ) )
			$where_edital = "AND id_edital = {$id_edital}";

		if( current_user_can( 'analista' ) or current_user_can( 'administrator' ) )
		{
			$quantidade_propostas          		    	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status <> 'lixo' {$where_edital}" ) );

			$quantidade_propostas_parciais          	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'parcial' {$where_edital}" ) );
			$quantidade_propostas_completas        		= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'completo' {$where_edital}" ) );
			$quantidade_propostas_habilitadas       	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'habilitado' {$where_edital}" ) );
			$quantidade_propostas_inabilitadas       	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'inabilitado' {$where_edital}" ) );
			$quantidade_propostas_classificadas     	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'classificado' {$where_edital}" ) );
			$quantidade_propostas_nao_classificadas		= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'nao_classificado' {$where_edital}" ) );
			$quantidade_propostas_nao_pre_selecionadas  = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'nao_pre_selecionado' {$where_edital}" ) );
			$quantidade_propostas_pre_selecionadas  	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'pre_selecionado' {$where_edital}" ) );
			$quantidade_propostas_selecionadas      	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'selecionado' {$where_edital}" ) );
			$quantidade_propostas_lista_reserva 		= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'lista_de_reserva' {$where_edital}" ) );
			$quantidade_propostas_nao_selecionadas  	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'nao_selecionado' {$where_edital}" ) );
			$quantidade_propostas_lixo              	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'lixo' {$where_edital}" ) );

			if( current_user_can( 'review_sav_propostas' ) )
			{
				// divisão das propostas por grupo
				$divisao_por_grupo = $wpdb->get_results( $wpdb->prepare( "SELECT meta_value FROM {$wpdb->sav_edital_meta} WHERE meta_key = 'avaliacao_por_grupo' AND meta_value <> '' {$where_edital} ") );
			}

			//  listar quantidade de recursos
			$quantidade_propostas_recursos_solicitado = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} as po INNER JOIN {$wpdb->sav_proposta_meta} as p ON po.id_proposta = p.id_proposta WHERE p.meta_key = 'status_recurso' {$where_edital}") );

			// verificar se há propostas com o status de classificado
			$verifica_classificados = $quantidade_propostas_classificadas;

			if( empty( $quantidade_propostas_classificadas ) )
			{
				// verifica se há alguma proposta classificada parcialmente neste edital
				$propostas_classificadas = $SAV->get_classificacao_por_edital( $id_edital );

				// conta quantas propostas classificadas parcialmente
				if( !empty( $propostas_classificadas ) )
					$quantidade_propostas_classificadas = count( (array) $propostas_classificadas );
			}

			if( empty( $status ) )
				$quantidade_propostas_status  = $quantidade_propostas;
			elseif( $status == 'recurso')
				$quantidade_propostas_status = $quantidade_propostas_recursos_solicitado;
			else
				$quantidade_propostas_status  = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = %s {$where_edital}", $status ) );
			$paginas_proposta                 = ( int ) ceil( $quantidade_propostas_status / $propostas_por_pagina );
			$proposta_inicial                 = ( int ) $propostas_por_pagina * ( $pagina_proposta - 1 );

			if( empty( $status ) )
			{
				$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE status <> 'lixo' {$where_edital} ORDER BY id_proposta DESC LIMIT %d, %d", $proposta_inicial, $propostas_por_pagina ) );
			}
			elseif( empty( $verifica_classificados ) and $status == 'classificado' and !empty($id_edital) )
			{
				// busca as propostas classificadas parcialmente por edital
				$propostas_classificadas = $SAV->get_classificacao_por_edital( $id_edital );

				if( !empty( $propostas_classificadas) )
				{
					$propostas = $propostas_classificadas;

					// converte objeto em array e conta quantas propostas
					$quantidade_propostas_classificadas = count( (array) $propostas);
					$quantidade_propostas_status = $quantidade_propostas_classificadas;
				}
			}
			elseif( $status == 'recurso' )
			{
				$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT po.id_proposta, po.id_edital, po.id_author, po.titulo, po.descricao, p.meta_value as status FROM {$wpdb->sav_propostas} as po INNER JOIN {$wpdb->sav_proposta_meta} as p ON po.id_proposta = p.id_proposta WHERE p.meta_key = 'status_recurso' {$where_edital} ORDER BY po.id_proposta DESC LIMIT %d, %d", $proposta_inicial, $propostas_por_pagina ) );
			}
			else
			{
				$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE status = %s {$where_edital} ORDER BY id_proposta DESC LIMIT %d, %d", $status, $proposta_inicial, $propostas_por_pagina ) );
			}
		}
		elseif( current_user_can( 'classifies_sav_propostas' )  and !current_user_can( 'administrator' ) )
		{
			// verifica qual o edital que o consultor participa
			$id_edital = $wpdb->get_var( $wpdb->prepare( "SELECT id_edital FROM {$wpdb->sav_edital_meta} WHERE meta_key = 'comissao' AND meta_value LIKE %s", "%" . $user_login . "%") );

			if( !empty($id_edital) )
			{
				// verifica se o edital é divido por grupo
				$avaliacao_por_grupo = $SAV->get_edital_meta( $id_edital, 'avaliacao_por_grupo');

				if ( !empty( $avaliacao_por_grupo ) )
				{
					$comissao = $SAV->get_edital_meta( $id_edital, 'comissao' );

					// busca o grupo do consultor
					foreach ( $comissao as $consultor)
					{
						if( $consultor['consultor'] == $user_login )
							$where_grupo = " AND meta_key = 'grupo' and meta_value = " . $consultor['grupo'];
					}
				}

				if( !empty( $where_grupo ) or empty( $avaliacao_por_grupo) )
				{
					$where_edital = "AND id_edital = {$id_edital}";

					$quantidade_propostas 			 	   = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( DISTINCT p.id_proposta ) FROM {$wpdb->sav_propostas} as p INNER JOIN {$wpdb->sav_proposta_meta} as po ON p.id_proposta = po.id_proposta WHERE ( p.status <> 'inabilitado' AND p.status <> 'parcial' AND p.status<>'completo' AND p.status<>'lixo' ) AND p.id_edital = %d {$where_grupo} ", $id_edital ) );
					$quantidade_minhas_propostas	       = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status <> 'lixo' and id_edital <> %d ORDER BY id_proposta", $user_ID, $id_edital ) );
					$quantidade_propostas_pre_selecionadas = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'pre_selecionado' {$where_edital}" ) );
					$quantidade_propostas_selecionadas     = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = 'selecionado' {$where_edital}" ) );

					// busca as propostas com maiores notas de acordo com o consultor
					$quantidade_meus_classificados 		= $SAV->get_classificacao_por_consultor( $user_ID, $id_edital, true );

					// verifica os membros que finalizaram avaliação da etapa de classificação
					$comissao_finalizada 			  	= $SAV->get_edital_meta( $id_edital, 'comissao_finalizada' );

					// se este membro tiver finalizado a inscrição poderá visualizar todos os projetos classificados pelos outros consultores
					if( in_array( $user_login,  $comissao_finalizada ) )
						$quantidade_propostas_classificadas    	= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status <> 'habilitado' and status <> 'inabilitado' AND status <> 'lixo' AND status <> 'nao_classificado' {$where_edital}" ) );

					if( $status == 'meus_classificados' )
						$propostas = $SAV->get_classificacao_por_consultor( $user_ID, $id_edital );
					else
					{
						if( empty( $status ) )
							$quantidade_propostas_status  = $quantidade_propostas;
						else
							$quantidade_propostas_status  = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = %s AND id_edital = %d ",  $status, $id_edital ) );
						$paginas_proposta                 = ( int ) ceil( $quantidade_propostas_status / $propostas_por_pagina );
						$proposta_inicial                 = ( int ) $propostas_por_pagina * ( $pagina_proposta - 1 );

						if ( empty($status) )
							$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.id_edital, p.id_author, p.titulo, p.descricao, p.status FROM {$wpdb->sav_propostas} as p INNER JOIN {$wpdb->sav_proposta_meta} as po ON p.id_proposta = po.id_proposta WHERE ( p.status = 'habilitado' OR p.status = 'classificado' OR p.status = 'nao_classificado' OR p.status = 'nao_selecionado' OR p.status = 'lista_de_reserva' OR p.status = 'pre_selecionado' OR p.status = 'selecionado' ) AND p.id_edital = %d {$where_grupo} GROUP BY p.id_proposta ORDER BY p.id_proposta DESC LIMIT %d, %d", $id_edital, $proposta_inicial, $propostas_por_pagina ) );
						else
							$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE status = %s AND id_edital = %d ORDER BY id_proposta DESC LIMIT %d, %d", $status, $id_edital, $proposta_inicial, $propostas_por_pagina ) );
					}
				}
			}

			// verifica se o consultor possui proposta em algum edital
			$quantidade_minhas_propostas = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status <> 'lixo' ORDER BY id_proposta", $user_ID ) );

			if( !empty($quantidade_minhas_propostas ) )
			{
				if( $status == 'minhas_propostas' )
					$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status <> 'lixo' ORDER BY id_proposta DESC", $user_ID ) );
			}
		}
		else
		{
			$quantidade_propostas              = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status <> 'lixo'", $user_ID ) );
			$quantidade_propostas_parciais     = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status = 'parcial' {$where_edital}", $user_ID ) );
			$quantidade_propostas_completas    = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status = 'completo' {$where_edital}", $user_ID ) );
			$quantidade_propostas_habilitadas  = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status = 'habilitado' {$where_edital}", $user_ID ) );
			$quantidade_propostas_inabilitadas = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status = 'inabilitado' {$where_edital}", $user_ID ) );
			$quantidade_propostas_lixo         = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status = 'lixo' {$where_edital}", $user_ID ) );

			if( empty( $status ) )
				$quantidade_propostas_status    = $quantidade_propostas;
			else
				$quantidade_propostas_status    = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE status = %s {$where_edital}", $status ) );

			$paginas_proposta                 = ( int ) ceil( $quantidade_propostas_status / $propostas_por_pagina );
			$proposta_inicial                 = ( int ) $propostas_por_pagina * ( $pagina_proposta - 1 );

			if( empty( $status ) )
			{
				$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status <> 'lixo' {$where_edital} ORDER BY id_proposta DESC LIMIT %d, %d", $user_ID, $proposta_inicial, $propostas_por_pagina ) );
			}
			else
			{
				$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE id_author = %d AND status = %s {$where_edital} ORDER BY id_proposta DESC LIMIT %d, %d", $user_ID, $status, $proposta_inicial, $propostas_por_pagina ) );
			}
		}

		$data_portaria_classificacao = $SAV->get_edital_meta( $id_edital, 'data_portaria_classificacao');
		$hoje						 = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );

		// campo buscar
		if ( current_user_can( 'approve_sav_propostas' ) )
		{
			if( $select_value == 'id_proposta' and !empty( $search_input ) )
			{
				// Não deixar que os consultores vejam as propostas dos outros grupos até a data da portaria de classificação
				if ( current_user_can( 'classifies_sav_propostas' ) and !current_user_can('administrator') and $hoje < $data_portaria_classificacao )
					$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.id_edital, p.id_author, p.titulo, p.descricao, p.status FROM {$wpdb->sav_propostas} as p INNER JOIN {$wpdb->sav_proposta_meta} as po ON p.id_proposta = po.id_proposta WHERE ( p.status = 'habilitado' OR p.status = 'classificado' OR p.status = 'nao_classificado' OR p.status = 'nao_selecionado' OR p.status = 'lista_de_reserva' OR p.status = 'pre_selecionado' OR p.status = 'selecionado' ) AND p.id_edital = %d AND p.id_proposta = %d {$where_grupo} GROUP BY p.id_proposta ORDER BY p.id_proposta DESC LIMIT %d, %d", $id_edital, $search_input, $proposta_inicial, $propostas_por_pagina ) );
				else
					$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE id_proposta = %s {$where_edital} ORDER BY id_proposta DESC LIMIT %d, %d", $search_input, $proposta_inicial, $propostas_por_pagina ) );
			}
			elseif( $select_value == 'login' and !empty( $search_input ) )
			{
				$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, descricao, status FROM {$wpdb->sav_propostas} WHERE id_author = ( SELECT ID FROM {$wpdb->users} WHERE user_login = %s {$where_edital} ) ORDER BY id_proposta DESC LIMIT %d, %d", $search_input, $proposta_inicial, $propostas_por_pagina ) );
			}
			elseif( $select_value == 'classificadas_consultor' and !empty( $search_input ) )
			{
				// verifica qual o edital que o consultor participa
				$id_edital = $wpdb->get_var( $wpdb->prepare( "SELECT id_edital FROM {$wpdb->sav_edital_meta} WHERE meta_key = 'comissao' AND meta_value LIKE %s", "%" . $search_input . "%") );

				// pega o id do consultor pelo cpf
				$id_consultor = $wpdb->get_var( $wpdb->prepare("SELECT ID FROM wp_users WHERE user_login = %s", $search_input ) );

				// busca as propostas com maiores notas de acordo com o consultor pesquisado
				$propostas = $SAV->get_classificacao_por_consultor( $id_consultor, $id_edital );
			}
			elseif( $select_value == 'avaliadas_consultor' and !empty( $search_input ) )
			{
				// verifica qual o edital que o consultor participa
				$id_edital = $wpdb->get_var( $wpdb->prepare( "SELECT id_edital FROM {$wpdb->sav_edital_meta} WHERE meta_key = 'comissao' AND meta_value LIKE %s", "%" . $search_input . "%") );

				// pega o id do consultor pelo cpf
				$id_consultor = $wpdb->get_var( $wpdb->prepare("SELECT ID FROM wp_users WHERE user_login = %s", $search_input ) );

				$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT  po.id_proposta, po.id_edital, po.id_author , po.titulo, po.descricao, po.status FROM {$wpdb->sav_propostas} po INNER JOIN {$wpdb->sav_avaliacao} as p ON po.id_proposta = p.id_proposta WHERE p.id_consultor = %s GROUP BY po.id_proposta ORDER BY id_proposta DESC LIMIT %d, %d", $id_consultor, $proposta_inicial, $propostas_por_pagina ) );
			}

			$quantidade_propostas_status = count( $propostas );
		}

		//busca o número do edital
		$numero_edital   = $SAV->get_edital_meta( $id_edital, 'numero_edital' );

		if( empty( $numero_edital ) )
			$numero_edital = $id_edital;

		$chamada_convenio = $SAV->get_edital_meta( $id_edital, 'chamada_convenio' );

		if( $chamada_convenio )
			$titulo_fomento = 'Chamamento';
		else
			$titulo_fomento = 'Edital';

		?>
			<div class="wrap">

				<h2>Propostas <?php if( !empty( $numero_edital ) ) print " do {$titulo_fomento} nº {$numero_edital} "; ?></h2>

				<form action="admin.php" method="GET">
					<input type="hidden" name="page" value="propostas" />

					<?php if( current_user_can( 'approve_sav_propostas' ) ) : ?>
						<form action="admin.php" method="GET">
							<p class="search-box">
								<label class="screen-reader-text" for="search_input">Pesquisar</label>
								<input type="text" id="search_input" name="search_input" value="">
								<select name="select_value">
									<option value="id_proposta" selected="selected">Nº Proposta</option>
									<?php if( !current_user_can( 'classifies_sav_propostas' ) or current_user_can( 'administrator' ) ) : ?>
										<option value="login">CPF/CNPJ</option>
										<option value="classificadas_consultor">CPF consultor - Classificadas</option>
										<option value="avaliadas_consultor">CPF consultor - Avaliadas</option>
									<?php endif; ?>
								</select>
								<input type="submit" name="" id="search-submit" class="button-secondary" value="Pesquisar Proposta">
							</p>
						</form>
					<?php endif; ?>

					<?php if( '1' == $_GET[ 'sussa' ] ) : ?>
						<div id="message" class="updated below-h2">
							<p>Proposta cadastrada!</p>
						</div>
					<?php endif; ?>
					<?php if( '2' == $_GET[ 'sussa' ] ) : ?>
						<div id="message" class="updated below-h2">
							<p>Sua avaliação foi finalizada com sucesso! Não é mais possível realizar alterações nas notas das propostas!</p>
							<p><strong>Salve a planilha com as propostas classificadas e envie para o e-mail: </strong><a href="mailto:concurso.sav@cultura.gov.br">concurso.sav@cultura.gov.br</a></p>
						</div>
					<?php endif; ?>

					<div class="subsubsub">

						<?php if( !empty( $quantidade_propostas ) ) : ?><a href="admin.php?page=propostas&id_edital=<?php print $id_edital; ?>" title="Todas" class="<?php if( '' == $status ) print 'current'; ?>"><?php echo(current_user_can( 'classifies_sav_propostas' ) and !current_user_can('administrator') )? 'Propostas para análise' : 'Todas'; ?> <span class="count">( <?php print $quantidade_propostas; ?> )</span></a><?php endif; ?>

						<?php if( current_user_can( 'approve_sav_propostas' ) or current_user_can( 'proponente' ) ) :  ?>
							<?php if( !empty( $quantidade_propostas_parciais ) ) : ?><a href="admin.php?page=propostas&status=parcial&id_edital=<?php print $id_edital; ?>" title="Em Andamento" class="<?php if( 'parcial' == $status ) print 'current'; ?>">Em Andamento <span class="count">( <?php print $quantidade_propostas_parciais; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_completas ) ) : ?><a href="admin.php?page=propostas&status=completo&id_edital=<?php print $id_edital; ?>" title="Inscritos" class="<?php if( 'completo' == $status ) print 'current'; ?>">Inscritos <span class="count">( <?php print $quantidade_propostas_completas; ?> )</span></a><?php endif; ?>
						<?php endif; ?>

						<?php if( current_user_can( 'approve_sav_propostas' )  ) : ?>
							<?php if( !empty( $quantidade_propostas_habilitadas ) ) : ?><a href="admin.php?page=propostas&status=habilitado&id_edital=<?php print $id_edital; ?>" title="Habilitadas" class="<?php if( 'habilitado' == $status ) print 'current'; ?>">Habilitadas <span class="count">( <?php print $quantidade_propostas_habilitadas; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_inabilitadas ) ) : ?><a href="admin.php?page=propostas&status=inabilitado&id_edital=<?php print $id_edital; ?>" title="Inabilitadas" class="<?php if( 'inabilitado' == $status ) print 'current'; ?>">Inabilitadas <span class="count">( <?php print $quantidade_propostas_inabilitadas; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_recursos_solicitado ) ) : ?><a href="admin.php?page=propostas&status=recurso&id_edital=<?php print $id_edital; ?>" title="Recursos solicitados" class="<?php if( 'recurso' == $status ) print 'current'; ?>">Recursos <span class="count">( <?php print $quantidade_propostas_recursos_solicitado; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_classificadas ) ) : ?><a href="admin.php?page=propostas&status=classificado&id_edital=<?php print $id_edital; ?>" title="Classificadas" class="<?php if( 'classificado' == $status ) print 'current'; ?>"><?php echo(current_user_can( 'classifies_sav_propostas' ) and !current_user_can('administrator') )? 'Classificados pela comissão' : 'Classificados'; ?> <span class="count">( <?php print $quantidade_propostas_classificadas; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_nao_classificadas ) ) : ?><a href="admin.php?page=propostas&status=nao_classificado&id_edital=<?php print $id_edital; ?>" title="Não classificadas" class="<?php if( 'nao_classificado' == $status ) print 'current'; ?>">Não Classificados <span class="count">( <?php print $quantidade_propostas_nao_classificadas; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_pre_selecionadas ) ) : ?><a href="admin.php?page=propostas&status=pre_selecionado&id_edital=<?php print $id_edital; ?>" title="Pré-Selecionados" class="<?php if( 'pre_selecionado' == $status ) print 'current'; ?>">Pré-Selecionadas <span class="count">( <?php print $quantidade_propostas_pre_selecionadas; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_nao_pre_selecionadas ) ) : ?><a href="admin.php?page=propostas&status=nao_pre_selecionado&id_edital=<?php print $id_edital; ?>" title="Não Pré-Selecionados" class="<?php if( 'nao_pre_selecionado' == $status ) print 'current'; ?>">Não Pré-Selecionadas <span class="count">( <?php print $quantidade_propostas_nao_pre_selecionadas; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_selecionadas ) ) : ?><a href="admin.php?page=propostas&status=selecionado&id_edital=<?php print $id_edital; ?>" title="Selecionados" class="<?php if( 'selecionado' == $status ) print 'current'; ?>">Selecionadas <span class="count">( <?php print $quantidade_propostas_selecionadas; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_lista_reserva ) ) : ?><a href="admin.php?page=propostas&status=lista_de_reserva&id_edital=<?php print $id_edital; ?>" title="Lista de reserva" class="<?php if( 'lista_de_reserva' == $status ) print 'current'; ?>">Lista de reserva <span class="count">( <?php print $quantidade_propostas_lista_reserva; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_propostas_nao_selecionadas ) ) : ?><a href="admin.php?page=propostas&status=nao_selecionado&id_edital=<?php print $id_edital; ?>" title="Não Selecionados" class="<?php if( 'nao_selecionado' == $status ) print 'current'; ?>">Não Selecionadas <span class="count">( <?php print $quantidade_propostas_nao_selecionadas; ?> )</span></a><?php endif; ?>
						<?php endif; ?>

						<?php if( current_user_can( 'classifies_sav_propostas' ) ) : ?>
							<?php if( !empty( $quantidade_meus_classificados ) ) : ?><a href="admin.php?page=propostas&status=meus_classificados&id_edital=<?php print $id_edital; ?>" title="Meus Classificados" class="<?php if( 'meus_classificados' == $status ) print 'current'; ?>"><?php print !$id_edital==1 ? "Meus Classificados":"Propostas Avaliadas"; ?> <span class="count">( <?php print $quantidade_meus_classificados; ?> )</span></a><?php endif; ?>
							<?php if( !empty( $quantidade_minhas_propostas ) ) : ?><a href="admin.php?page=propostas&status=minhas_propostas&id_edital=<?php print $id_edital; ?>" title="Minhas Propostas" class="<?php if( 'minhas_propostas' == $status ) print 'current'; ?>">Minhas Propostas <span class="count">( <?php print $quantidade_minhas_propostas; ?> )</span></a><?php endif; ?>
						<?php endif; ?>

						<?php if( current_user_can( 'delete_sav_propostas' ) ) : ?>
							<?php if( !empty( $quantidade_propostas_lixo ) ) : ?><a href="admin.php?page=propostas&status=lixo&id_edital=<?php print $id_edital; ?>" title="Lixo" class="<?php if( 'lixo' == $status ) print 'current'; ?>">Lixo <span class="count">( <?php print $quantidade_propostas_lixo; ?> )</span></a><?php endif; ?>
						<?php endif; ?>

					</div>

					<div class="tablenav top">
						<div class="tablenav-pages">
							<span class="displaying-num"><?php print $quantidade_propostas_status; ?> propostas</span>
							<?php if( $paginas_proposta > 1 ) : ?>
								<span class="pagination-links">
									<a class="first-page <?php if( 1 == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a primeira página" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>">«</a>
									<a class="prev-page <?php if( 1 == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a página anterior" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>&paged=<?php print ( $pagina_proposta - 1 ); ?>">‹</a>
									<span class="paging-input"><input class="current-page" title="Página atual" type="text" name="paged" value="<?php print $pagina_proposta; ?>" size="4"> de <span class="total-pages"><?php print $paginas_proposta; ?></span></span>
									<a class="next-page <?php if( $paginas_proposta == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a próxima página" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>&paged=<?php print ( $pagina_proposta + 1 ); ?>">›</a>
									<a class="last-page <?php if( $paginas_proposta == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a última página" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>&paged=<?php print $paginas_proposta; ?>">»</a>
								</span>
							<?php endif; ?>
						</div>
					</div>
					<form id="propostas" method="post">
						<table class="wp-list-table widefat" cellspacing="0">
							<thead>
								<tr>
									<th>Nº</th>
									<th>Título</th>
									<th>Autor</th>
									<th><?php print ( !$SAV->is_user_ong() ) ? "Edital" : "Chamamento"; ?></th>
									<th>Status</th>
									<?php if( current_user_can( 'review_sav_propostas' ) and !empty( $divisao_por_grupo ) ) print "<th>Grupo</th>"; ?>
									<?php if( current_user_can( 'classifies_sav_propostas' ) ) print "<th>Nota</th>"; ?>

								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Nº</th>
									<th>Título</th>
									<th>Autor</th>
									<th><?php print ( !$SAV->is_user_ong() ) ? "Edital" : "Chamamento"; ?></th>
									<th>Status</th>
									<?php if( current_user_can( 'review_sav_propostas' ) and !empty( $divisao_por_grupo ) ) print "<th>Grupo</th>"; ?>
									<?php if( current_user_can( 'classifies_sav_propostas' ) ) print "<th>Nota</th>"; ?>
								</tr>
							</tfoot>
							<tbody>
								<?php if( !empty( $propostas ) ) : ?>
									<?php foreach( $propostas as $proposta ) : ++$item ?>
										<?php
											$user						  = get_userdata( $proposta->id_author );
											$hoje						  = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
											$edital 					  = $SAV->get_edital( $proposta->id_edital );
											//$data_portaria_habilitacao 	  = $SAV->get_edital_meta( $proposta->id_edital, 'data_portaria_habilitacao');
											//$data_fim_recurso_habilitacao = $SAV->get_edital_meta( $proposta->id_edital, 'data_fim_recurso_habilitacao');
											//$data_portaria_classificacao  = $SAV->get_edital_meta( $proposta->id_edital, 'data_portaria_classificacao');
											//$data_portaria_pre_selecao 	  = $SAV->get_edital_meta( $proposta->id_edital, 'data_portaria_selecao');
											//$data_portaria_selecao 		  = $SAV->get_edital_meta( $proposta->id_edital, 'data_portaria_selecao');

											$data_inicio_recurso		  = $SAV->get_edital_meta( $proposta->id_edital, 'data_inicio_recurso' );
											$data_fim_recurso			  = $SAV->get_edital_meta( $proposta->id_edital, 'data_fim_recurso' );
											$status_passivel_recurso	  = $SAV->get_edital_meta( $proposta->id_edital, 'status_passivel_recurso' );

										?>
										<tr valign="top" <?php if( true ) : ?>class="alternate"<?php endif; ?>>
											<th><?php print $proposta->id_proposta; ?></th>
											<td>
												<strong><a href="?page=formulario-proposta&id_edital=<?php print $proposta->id_edital; ?>&id_proposta=<?php print $proposta->id_proposta; ?>" title="Editar: <?php print $proposta->titulo; ?>"><?php print $proposta->titulo; ?></a></strong>
												<div class="row-actions">
													<?php if( $status == 'lixo' ) : ?>
														<?php if( current_user_can( 'delete_sav_propostas' ) ) : ?>
															<span><a href="?page=propostas&acao=restaurar_proposta&id_proposta=<?php print $proposta->id_proposta; ?>" title="Restaurar: <?php print $proposta->titulo; ?>">restaurar</a></span>
														<?php endif; ?>
													<?php else : ?>
														<?php $separador = true; ?>
														<?php if( current_user_can( 'edit_sav_propostas' ) and $SAV->is_autor_proposta( $user_ID, $proposta->id_proposta ) ) : ?>
															<?php ( $separador ) ? $separador = false : print '|'; ?>
															<span><a href="?page=formulario-proposta&id_edital=<?php print $proposta->id_edital; ?>&id_proposta=<?php print $proposta->id_proposta; ?>" title="Editar: <?php print $proposta->titulo; ?>">editar</a></span>
														<?php endif; ?>
														<?php if( current_user_can( 'edit_sav_propostas' ) and $SAV->is_autor_proposta( $user_ID, $proposta->id_proposta ) and ( $proposta->status == $status_passivel_recurso and $hoje >= $data_inicio_recurso and $hoje <= $data_fim_recurso ) ) : ?>
															<?php ( $separador ) ? $separador = false : print '|'; ?>
															<span class="trash"><a href="?page=formulario-proposta&id_edital=<?php print $proposta->id_edital; ?>&id_proposta=<?php print $proposta->id_proposta; ?>&#recurso" title="Solicitar recurso: <?php print $proposta->titulo; ?>">solicitar recurso</a></span>
														<?php endif; ?>
														<?php if( current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $proposta->id_proposta )) : ?>
															<?php ( $separador ) ? $separador = false : print '|'; ?>
															<span><a href="?page=formulario-proposta&id_edital=<?php print $proposta->id_edital; ?>&id_proposta=<?php print $proposta->id_proposta; ?>" title="Avaliar: <?php print $proposta->titulo; ?>"  target="_blank">avaliar</a></span>
														<?php endif; ?>
														<?php if( current_user_can( 'delete_sav_propostas' ) ) : ?>
															<?php ( $separador ) ? $separador = false : print '|'; ?>
															<span class="trash"><a href="?page=propostas&acao=deletar_proposta&id_proposta=<?php print $proposta->id_proposta; ?>" title="Apagar: <?php print $proposta->titulo; ?>" onclick="return confirm( 'tem certeza que deseja apagar essa proposta?' );">apagar</a></span>
														<?php endif; ?>
													<?php endif; ?>
												</div>
											</td>
											<td><?php print $user->display_name; ?></td>
											<td><?php print $edital[ 'titulo' ]; ?></td>
											<td>
												<?php
													print $SAV->show_status_role($proposta->id_edital, $proposta->status );
												?>
											</td>

											<?php if (!empty( $divisao_por_grupo ) ) : ?>
												<td>
													<?php $avaliacao_por_grupo = $SAV->get_edital_meta( $proposta->id_edital, 'avaliacao_por_grupo'); ?>
													<?php if( !empty( $avaliacao_por_grupo) and $proposta->status == 'habilitado' ) : ?>
														<?php $grupo = $SAV->get_proposta_meta( $proposta->id_proposta, 'grupo' ); ?>
														<input type="hidden" name="acao" value="salvar_grupos" />
														<input type="hidden" name="divisao[<?php print $item; ?>][id_proposta]" value="<?php print $proposta->id_proposta; ?>"/>
														<select name="divisao[<?php print $item; ?>][grupo]">
															<option value=""></option>
															<option value="1" <?php if( $grupo == 1 ) print "selected='selected'"; ?>>1</option>
															<option value="2" <?php if( $grupo == 2 ) print "selected='selected'"; ?>>2</option>
															<option value="3" <?php if( $grupo == 3 ) print "selected='selected'"; ?>>3</option>
														</select>
													<?php endif; ?>
												</td>
											<?php endif; ?>
											<?php if( current_user_can( 'classifies_sav_propostas' ) ) : ?>
												<td>
													<?php $avaliacao_proposta = $SAV->get_nota_criterio( null, $proposta->id_proposta, $user_ID ); ?>
													<?php print $avaliacao_proposta['nota']; ?>
												</td>
											<?php endif; ?>

										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr>
										<td colspan="5">Nenhuma Proposta</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
						<?php if( current_user_can( 'review_sav_propostas' ) and !empty( $divisao_por_grupo ) ) : ?>
							<div class="tablenav bottom">
								<div class="alignright actions">
									<input type="submit" name="salvar_grupo" id="salvar_grupo" class="button-secondary" value="Salvar Grupo" />
								</div>
							</div>
						<?php endif; ?>

					</form>

					<div class="tablenav bottom">
						<div class="tablenav-pages">
							<span class="displaying-num"><?php print $quantidade_propostas_status; ?> propostas</span>
							<?php if( $paginas_proposta > 1 ) : ?>
								<span class="pagination-links">
									<a class="first-page <?php if( 1 == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a primeira página" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>">«</a>
									<a class="prev-page <?php if( 1 == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a página anterior" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>&paged=<?php print ( $pagina_proposta - 1 ); ?>">‹</a>
									<span class="paging-input"><input class="current-page" title="Página atual" type="text" name="paged" value="<?php print $pagina_proposta; ?>" size="4"> de <span class="total-pages"><?php print $paginas_proposta; ?></span></span>
									<a class="next-page <?php if( $paginas_proposta == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a próxima página" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>&paged=<?php print ( $pagina_proposta + 1 ); ?>">›</a>
									<a class="last-page <?php if( $paginas_proposta == $pagina_proposta ) print 'disabled'; ?>" title="Ir para a última página" href="admin.php?page=propostas&status=<?php print $status; ?>&id_edital=<?php print $id_edital; ?>&paged=<?php print $paginas_proposta; ?>">»</a>
								</span>
							<?php endif; ?>
						</div>
					</div>
					<?php if( current_user_can( 'approve_sav_propostas' ) ) { $this->formulario_relatorio( $id_edital, $status ); } ?>
					<?php if( current_user_can( 'classifies_sav_propostas' ) ) { $this->finalizar_avaliacao( $id_edital, $user_ID ); } ?>
				</form>

			</div>
		<?php
	}

	/**
	 * definir em que passo do cadastro o usuário está
	 *
	 * @name    acertar_passo
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-23
	 * @updated 2011-12-23
	 * @return  string
	 */
	function acertar_passo( $id_edital, $id_proposta )
	{
		global $SAV;

		// verificar quais modulos estao ativos para esse edital
		$dados_diretor    = $SAV->get_edital_meta( $id_edital, 'dados_diretor' );
		$dados_produtor   = $SAV->get_edital_meta( $id_edital, 'dados_produtor' );
		$dados_roteirista = $SAV->get_edital_meta( $id_edital, 'dados_roteirista' );
		$orcamento        = $SAV->get_edital_meta( $id_edital, 'orcamento_cinema' );

		// montar o esquema de navegacao
		$this->passos[ 'dados_concorrente' ] = 'Dados Concorrente';

		$this->passos[ 'dados_gerais' ] = 'Dados Gerais';

		if( !empty( $dados_produtor ) )
			$this->passos[ 'dados_produtor' ] = 'Curriculo do Produtor';

		if( !empty( $dados_diretor ) )
			$this->passos[ 'dados_diretor' ] = 'Curriculo do Diretor';

		if( !empty( $dados_roteirista ) )
			$this->passos[ 'dados_roteirista' ] = 'Curriculo do Roteirista';

		if( !empty( $orcamento ) )
			$this->passos[ 'orcamento' ] = 'Orçamento';

		$this->passos[ 'declaracao' ] = 'Declaração';
	}

	/**
	 * numero do protocolo
	 *
	 * @name    protocolo
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-27
	 * @updated 2011-12-27
	 * @return  void
	 */
	function protocolo( $id_edital, $id_proposta )
	{
		global $wpdb, $SAV;

		$ano_edital  = $wpdb->get_var( $wpdb->prepare( "SELECT YEAR( registrado ) FROM {$wpdb->sav_editais} WHERE id_edital = %d LIMIT 1", $id_edital ) );
		$ano_edital  = $ano_edital - 2000;

		//$id_edital   = str_pad( $id_edital, 2, '0', STR_PAD_LEFT );
		$id_proposta = str_pad( $id_proposta, 4, '0', STR_PAD_LEFT );

		$numero_edital = $SAV->get_edital_meta( $id_edital, 'numero_edital' );

		if( !empty( $numero_edital ) )
			$numero_edital = str_pad( $numero_edital, 2, '0', STR_PAD_LEFT );
		else
			$numero_edital = str_pad( $id_edital, 2, '0', STR_PAD_LEFT );

		return "{$ano_edital}{$numero_edital} {$id_proposta}";
	}

	/**
	 * formulario proposta
	 *
	 * @name    formulario_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-18
	 * @updated 2011-12-29
	 * @return  void
	 */
	function formulario_proposta()
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		$id_edital        = ( int ) $_REQUEST[ 'id_edital' ];
		$id_proposta      = ( int ) $_REQUEST[ 'id_proposta' ];

		$passo            = $_REQUEST[ 'passo' ];

		$edital           = $SAV->get_edital( $id_edital );

		$proposta         = $SAV->get_proposta( $id_proposta );

		$empresa		  = $SAV->get_dados_empresa( $user_login );

		$edital_ong       = $SAV->get_edital_meta( $id_edital, 'edital_para_ong' );

		if( !empty( $id_proposta ) and !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		?>
			<div id="sav-editais" class="wrap">
				<?php if( empty( $id_proposta ) AND !$SAV->is_edital_aberto( $id_edital ) ) : ?>
					<div class="updated">
						<p>A proposta deve estar associada a um <?php print ( !$SAV->is_user_ong() ) ?  "edital" : "chamamento"; ?> aberto!</p>
					</div>
				<?php elseif( empty( $id_proposta ) AND !$SAV->proponente_pode_cadastrar_nova_proposta( $id_edital, $user_ID ) ) : ?>
					<div class="updated">
						<p>Você já excedeu a quantidade de propostas permitida! Para verificar suas propostas, acesso "Fomento > Propostas".</p>
					</div>
				<?php elseif(!$SAV->is_edital_pessoa_juridica( $id_edital ) and $SAV->is_pessoa_juridica( $user_login) and !current_user_can( 'approve_sav_propostas' ) and ('parcial' == $proposta[ 'status' ] or empty( $proposta[ 'id_proposta' ] ) ) )  : ?>
					<div class="updated">
						<p>Esta ação não é autorizada! Para saber mais entre em contato no email: concurso.sav@cultura.gov.br, coloque no assunto: Informação Sistema  - Número da inscrição</p>
					</div>
				<?php elseif( $SAV->is_pessoa_juridica($user_login) and !($empresa[ 'natureza' ] == 1 or $empresa[ 'natureza' ] == 2) and !empty( $edital_ong ) ) :?>
					<div class="updated">
						<p>Chamamento autorizado apenas para ONGs e OSCIP</p>
						<p>Se você ainda não definiu no sistema a natureza da sua empresa, acesse o <a href="http://www.cultura.gov.br/audiovisual/fomento/cadastro-pessoa-juridica/" title="formulário de cadastro">formulário de cadastro</a>.</p>
					</div>
				<?php elseif( !$SAV->is_edital_pessoa_fisica( $id_edital ) and $SAV->is_pessoa_fisica( $user_login ) and !current_user_can( 'approve_sav_propostas' ) and ( 'parcial' == $proposta[ 'status' ] or empty( $proposta[ 'id_proposta' ] ) ) ) : ?>
					<div class="updated">
						<p>Esta ação não é autorizada! Para saber mais entre em contato no email: concurso.sav@cultura.gov.br, coloque no assunto: Informação Sistema  - Número da inscrição</p>
					</div>
				<?php else : ?>
					<h2><?php print $edital[ 'titulo' ]; ?></h2>
					<?php if( !$SAV->is_edital_aberto( $id_edital ) AND $SAV->is_autor_proposta( $user_ID, $id_proposta ) ) : ?>
						<div class="updated">
							<p>Esse edital está encerrado!</p>
						</div>
					<?php endif; ?>
					<?php
						$user 			   = get_userdata( $proposta["id_author"] );
						$dados_geograficos = $SAV->get_dados_geograficos( $user->user_login );
						$regiao 		   = $SAV->where_regiao( $dados_geograficos['estado'] );
					?>

					<?php if( !empty( $proposta[ 'id_proposta' ] ) ) : ?>
						<h3>Proposta nº <?php print $this->protocolo( $id_edital, $proposta[ 'id_proposta' ] ); ?> - Região: <?php print strtoupper( $regiao ); ?></h3>
					<?php else : ?>
						<h3>Adicionar Nova Proposta</h3>
						<div class="updated">
							<p><strong>Atenção:</strong></p>
							<p>Você pode salvar a sua proposta a qualquer momento e continuar a inscrição em outro momento através da opção "Fomento > Propostas" no menu!</p>
							<p>No caso de dúvida no preenchimento dos campos, clique no ícone <img src="<?php print WP_PLUGIN_URL; ?>/sav/img/icon/interrogacao.png" alt="?" /> para obter mais informações!</p>
						</div>
					<?php endif; ?>

					<?php if( !empty( $SAV->error ) ) : ?>
						<div class="error">
							<p><strong>Atenção:</strong></p>
							<ol>
								<?php foreach( $SAV->error as $error ) : ?>
									<li><?php print $error; ?></li>
								<?php endforeach; ?>
							</ol>
						</div>
					<?php else : ?>
						<?php if( '1' == $_GET[ 'sussa' ] ) : ?>
							<div class="updated">
								<p><strong>Proposta atualizada!</strong></p>
							</div>
						<?php endif; ?>
						<?php if( '2' == $_GET[ 'sussa' ] ) : ?>
							<div class="updated">
								<p><strong>Seu recurso foi enviado, em breve será respondido. Acompanhe o recurso no Histórico da sua proposta</strong></p>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php $this->mostrar_passos( $id_edital, $id_proposta, $passo ); ?>

					<?php
						switch( $passo )
						{
							case 'dados_concorrente' :
								$this->formulario_proposta_dados_concorrente( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
								break;
							case 'dados_gerais' :
								$this->formulario_proposta_dados_gerais( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
							break;
							case 'dados_produtor' :
								//$this->formulario_proposta_dados_produtor( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
								$this->formulario_proposta_dados_profissional( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ], 'Produtor' );
							break;
							case 'dados_diretor' :
								//$this->formulario_proposta_dados_diretor( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
								$this->formulario_proposta_dados_profissional( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ], 'Diretor' );
							break;
							case 'dados_roteirista' :
								//$this->formulario_proposta_dados_roteirista( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
								$this->formulario_proposta_dados_profissional( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ], 'Roteirista' );
							break;
							case 'orcamento' :
								$this->formulario_proposta_orcamento( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
							break;
							case 'declaracao' :
								$this->formulario_proposta_declaracao( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
							break;
							default :
								$this->formulario_proposta_dados_concorrente( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] );
							break;
						}
					?>

					<?php if( 'parcial' != $proposta[ 'status' ] ) $this->formulario_proposta_historico( $edital['id_edital'], $proposta[ 'id_proposta' ] ); ?>
					<?php if( 'parcial' != $proposta[ 'status' ] ) $this->formulario_avaliacao( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] ); ?>
					<?php if( 'parcial' != $proposta[ 'status' ] ) $this->formulario_recurso( $edital[ 'id_edital' ], $proposta[ 'id_proposta' ] ); ?>
					<?php if( 'parcial' != $proposta[ 'status' ] ) $this->montar_formulario_classificacao( $edital['id_edital'], $proposta[ 'id_proposta' ], $user_ID ); ?>

				<?php endif; ?>
			</div>
		<?php
	}

	/**
	 * mostrar em que passo do cadastro o usuário está
	 *
	 * @name    mostrar_passos
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-23
	 * @updated 2011-12-28
	 * @return  string
	 */
	function mostrar_passos( $id_edital, $id_proposta, $passo )
	{
		global $SAV;

		if( empty( $passo ) )
			//$passo = 'dados_gerais';
			$passo = 'dados_concorrente';
		?>

			<?php if( is_array( $this->passos ) ) : ?>
				<ol class="passos">
					<?php foreach( $this->passos as $key => $titulo ) : ?>
						<li>
							<?php if( empty( $id_proposta ) ) : ?>
								<?php print $titulo; ?>
							<?php else : ?>
								<a href="<?php print "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$key}"; ?>" title="<?php print $titulo; ?>"><?php print $titulo; ?></a>
							<?php endif; ?>
							<br />
							<?php if( $key == $passo ) print '<small>você está aqui</small>'; ?>
						</li>
					<?php endforeach; ?>
				</ol>
			<?php endif; ?>

		<?php
	}

	/**
	 * redirecionar para o próximo passo
	 *
	 * @name    proximo_passo
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-23
	 * @updated 2011-12-23
	 * @return  string
	 */
	function proximo_passo( $passo )
	{
		// pegar apenas as chaves do array
		$passos = array_keys( $this->passos );

		$passo_atual = array_search( $passo, $passos );

		if( ( count( $passos ) - 1 ) !== $passo_atual )
			return $passos[ $passo_atual + 1 ];

		return $passo;
	}

	/**
	 * redirecionar para o passo anterior
	 *
	 * @name    passo_anterior
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-23
	 * @updated 2011-12-23
	 * @return  string
	 */
	function passo_anterior( $passo )
	{
		// pegar apenas as chaves do array
		$passos = array_keys( $this->passos );

		$passo_atual = array_search( $passo, $passos );

		if( 0 !== $passo_atual )
			return $passos[ $passo_atual - 1 ];

		return $passo;
	}

	/**
	 * botões de navegação
	 *
	 * @name    formulario_botoes_navegacao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-08
	 * @updated 2011-12-22
	 * @return  void
	 */
	function formulario_botoes_navegacao( $id_edital, $passo )
	{
		// pegar apenas as chaves do array
		$passos = array_keys( $this->passos );

		?>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">
						<tr valign="top">
							<td>
								<?php if( ( count( $passos ) - 1 ) == array_search( $passo, $passos ) ) : ?>
									<button type="submit" name="publish" id="publish" class="button-primary" tabindex="1000" onclick="return confirm( 'Depois de finalizada, sua proposta não poderá sofrer alteração, tem certeza que deseja enviar?' );">Enviar Proposta</button>
								<?php else : ?>
									<button type="submit" name="publish" id="publish" class="button-primary" tabindex="1000">Salvar</button>
								<?php endif; ?>
							</td>
							<td align="right">
								<?php if( 0 !== array_search( $passo, $passos ) and ( count( $passos ) - 1 ) !== array_search( $passo, $passos ) ) : ?>
									<button type="submit" name="prev" id="prev" value="1" class="button-secondary" tabindex="1000">&laquo; Anterior</button>
								<?php endif; ?>
								<?php if( ( count( $passos ) - 1 ) !== array_search( $passo, $passos ) ) : ?>
									<button type="submit" name="next" id="next" value="1" class="button-secondary" tabindex="1000">Próximo &raquo;</button>
								<?php endif; ?>
							</td>
						</tr>
					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * formulario mostrar histórico da proposta
	 *
	 * @name    formulario_proposta_historico
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-06-19
	 * @updated 2012-06-19
	 * @return  void
	 */
	function formulario_proposta_historico( $id_edital, $id_proposta )
	{
		global $SAV, $user_ID;

		if( empty( $id_edital ) or empty( $id_proposta ) )
			return false;

		if( current_user_can( 'classifies_sav_propostas') and !current_user_can( 'administrator' ) )
			return false;

		if( $SAV->is_autor_proposta( $user_ID, $id_proposta) )
			return false;

		$proposta = $SAV->get_proposta( $id_proposta );

		if( 'parcial' == $proposta->status or 'lixo' == $proposta->status )
			return false;

		$hoje						  = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
		$data_portaria_habilitacao 	  = $SAV->get_edital_meta( $id_edital, 'data_portaria_habilitacao');
		$data_portaria_classificacao  = $SAV->get_edital_meta( $id_edital, 'data_portaria_classificacao');
		$data_portaria_pre_selecao 	  = $SAV->get_edital_meta( $id_edital, 'data_portaria_pre_selecao');
		$data_portaria_selecao 		  = $SAV->get_edital_meta( $id_edital, 'data_portaria_selecao');
		$historico 					  = $SAV->get_proposta_historico( $id_proposta );

		// se não tiver historico, mostrar dados antigos do sistema
		if( empty( $historico ) )
		{
			$motivo_indeferimento = $SAV->get_proposta_meta( $id_proposta, 'observacoes' );
			if( !empty( $motivo_indeferimento ) )
			{
				// registrado em
				$historico[0]['data']	    = $proposta['registrado'];;
				$historico[0]['id_author']  = $proposta['id_author'];
				$historico[0]['observacao'] = 'Proposta iniciada no sistema';
				$historico[0]['acao']	    = 'Início';

				// última atualização pelo proponente
				$historico[1]['data']	    = $proposta['atualizado'];;
				$historico[1]['id_author']  = $proposta['id_author'];
				$historico[1]['observacao'] = 'Projeto inscrito no edital';
				$historico[1]['acao']	    = 'Inscrito';


				//motivo do indeferimento
				$historico[2]['data']	    = $SAV->get_proposta_meta( $id_proposta, 'data_avaliacao' );
				$historico[2]['id_author']  = $SAV->get_proposta_meta( $id_proposta, 'avaliador' );
				$historico[2]['observacao'] = $motivo_indeferimento;
				$historico[2]['acao']	    = 'Inabilitado';
			}

			$recurso = $SAV->get_proposta_meta( $id_proposta, 'solicitacao_recurso_inabilitado' );
			if( !empty( $recurso ) )
			{
				// recurso
				$historico[3]['data']	    = $SAV->get_proposta_meta( $id_proposta, 'data_solicitacao_recurso_inabilitado' );
				$historico[3]['id_author']  = $proposta['id_author'];
				$historico[3]['observacao'] = $recurso;
				$historico[3]['acao']	    = 'Recurso solicitado';

				// resposta do recurso
				$historico[4]['data']	    = $SAV->get_proposta_meta( $id_proposta, 'data_resposta_recurso_inabilitado' );
				$historico[4]['id_author']  = $SAV->get_proposta_meta( $id_proposta, 'avaliador_recurso' );
				$historico[4]['observacao'] = $SAV->get_proposta_meta( $id_proposta, 'resposta_recurso_inabilitado' );
				$historico[4]['acao']	    = 'Recurso '. $SAV->get_proposta_meta( $id_proposta, 'status_recurso' );
			}
		}

		if( empty( $historico ) )
			return false;

		?>

		<h4>Histórico da Proposta</h4>

		<div class="postbox" id="avaliacao-projeto">
			<div class="inside">
				<table width="100%" cellspacing="15px">
					<tr valign="top" align="left">
						<th>Data/Hora</th>
						<th>Usuário</th>
						<th>Status</th>
						<th>Observação</th>
					</tr>
					<?php foreach( $historico as $individual_historico) : ?>
						<?php
							$responsavel = get_userdata( $individual_historico['id_author'] );
							$visivel	 = true;

							if( $SAV->is_autor_proposta( $user_ID, $id_proposta) )
							{
								switch( $individual_historico['status'] )
								{
									case 'habilitado':
									case 'inabilitado':
										if( $hoje < $data_portaria_habilitacao )
											$visivel = false;
									break;
									case 'classificado':
									case 'nao_classificado':
										if( $hoje < $data_portaria_classificacao )
											$visivel = false;
									break;
									case 'pre_selecionado':
									case 'nao_pre_selecionado':
										if( $hoje < $data_portaria_pre_selecao )
											$visivel = false;
									break;
									case 'selecionado':
									case 'nao_selecionado':
									case 'lista_de_reserva':
										if( $hoje < $data_portaria_selecao )
											$visivel = false;
									break;
									default:
										$visivel = true;
									break;
								}
							}
						?>

						<?php if( $visivel ) : ?>
							<tr valign="top" align="left">
								<td width="10%">
									<?php print date( 'd\/m\/Y H:i', strtotime( $individual_historico['data']  ) + ( get_option( 'gmt_offset' ) * 3600 ) ); ?>
								</td>
								<td width="20%">
									<?php if( $SAV->is_autor_proposta( $user_ID, $id_proposta) ) : ?>
										<?php if( $SAV->is_autor_proposta( $individual_historico['id_author'], $id_proposta) ) : ?>
											<?php print $responsavel->display_name; ?>
										<?php else: ?>
											<span>Secretaria do Audiovisual</span>
										<?php endif; ?>
									<?php else: ?>
										<?php print $responsavel->display_name; ?>
									<?php endif; ?>
								</td>
								<td>
									<?php print $individual_historico['acao'] ?>
								</td>
								<td align="justify">
									<?php print nl2br($individual_historico['observacao']); ?>

									<?php if( !empty( $individual_historico['anexo'] ) ) : ?>
										<span class="descri3ption"></br>Arquivo anexado: <em><a href="<?php print $individual_historico['anexo']; ?>" title="baixar anexo" target="_blank"><?php print basename( $individual_historico['anexo'] ); ?></a></em></span>
									<?php endif; ?>
								</td>
							</tr>
						<?php endif; ?>
					<?php endforeach ?>
				</table>
			</div>
		</div>

	<?php
	}

	/**
	 * formulario de avaliação
	 *
	 * @name    formulario_avaliacao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-19
	 * @updated 2012-07-05
	 * @return  void
	 */
	function formulario_avaliacao( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID;

		$passo          	          = $_REQUEST[ 'passo' ];
		$proposta       	          = $SAV->get_proposta( $id_proposta );
		$observacoes    			  = $SAV->get_proposta_meta( $id_proposta, 'observacoes' );
		$avaliador      			  = $SAV->get_proposta_meta( $id_proposta, 'avaliador' );
		$analista   				  = get_userdata( $avaliador );
		$data_avaliacao 			  = $SAV->get_proposta_meta( $id_proposta, 'data_avaliacao' );

		//$hoje   					  = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );

		if( !current_user_can( 'approve_sav_propostas' ) )
			return false;

		if( current_user_can( 'classifies_sav_propostas' ) and !current_user_can('administrator') )
			return false;

		if( !current_user_can( 'review_sav_propostas' ) and 'completo' != $proposta[ 'status' ]   )
			$readonly = true;

		?>
			<form id="avaliacao" method="post">
				<input type="hidden" name="acao" value="salvar_avaliacao" />
				<input type="hidden" name="id_edital" value="<?php print $id_edital; ?>" />
				<input type="hidden" name="id_proposta" value="<?php print $id_proposta; ?>" />

				<h4>Avaliação do Projeto</h4>

				<div class="postbox" id="avaliacao-projeto">
					<div class="inside">
						<table width="100%" cellspacing="15px">

							<?php if( 'parcial' != $proposta[ 'status' ] and 'completo' != $proposta[ 'status' ]  or 'declaracao' == $passo  ) : ?>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="avaliacao">Status do Projeto *</label>
									</td>
									<td>
										<label style="color:#009900;"><input type="radio" name="avaliacao" value="habilitado" <?php if( 'habilitado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Habilitado</label>
										<label style="color:#990000;"><input type="radio" name="avaliacao" value="inabilitado" <?php if( 'inabilitado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Inabilitado</label>
									</td>
									<td>
										<label style="color:#123884;"><input type="radio" name="avaliacao" value="classificado" <?php if( 'classificado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Classificado</label>
										<label style="color:#990000;"><input type="radio" name="avaliacao" value="nao_classificado" <?php if( 'nao_classificado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Não classificado</label>
									</td>
									<td>
										<label style="color:#27005C;"><input type="radio" name="avaliacao" value="pre_selecionado" <?php if( 'pre_selecionado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Pré-Selecionado</label>
										<label style="color:#990000;"><input type="radio" name="avaliacao" value="nao_pre_selecionado" <?php if( 'nao_pre_selecionado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Não Pré-Selecionado</label>
									</td>
									<td>
										<label style="color:#1C0140;"><input type="radio" name="avaliacao" value="selecionado" <?php if( 'selecionado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Selecionado</label>
										<label style="color:#990000;"><input type="radio" name="avaliacao" value="lista_de_reserva" <?php if( 'lista_de_reserva' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Lista de Reserva</label>
										<label style="color:#990000;"><input type="radio" name="avaliacao" value="nao_selecionado" <?php if( 'nao_selecionado' == $proposta[ 'status' ] ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Não selecionado</label>
									</td>
								</tr>
							<?php endif; ?>

							<tr valign="top">
									<td align="right">
										<label for="observacoes">Observações *</label>
										<p class="description">máximo de 3000 caracteres</p>
									</td>
									<td colspan="4">
										<textarea id="observacoes" name="observacoes" cols="50" rows="5" tabindex="2" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $observacoes; ?></textarea>
									</td>
							</tr>
							<tr valign="top">
								<td colspan="5" align="right">

									<?php if( !empty( $data_avaliacao ) and !empty( $avaliador ) and current_user_can('approve_sav_propostas') ) : ?>
										<small>analisado em <?php print date( 'd\/m\/Y H:i', strtotime( $data_avaliacao ) + ( get_option( 'gmt_offset' ) * 3600 ) ); ?> por <strong><?php print $analista->display_name; ?></small>
									<?php endif; ?>

									<?php if( !$readonly ) : ?>
										<?php if( 'declaracao' !== $passo ) : ?>
											<button type="submit" name="avaliar" class="button-primary" tabindex="1000">Salvar</button>
										<?php else : ?>
											<button type="submit" name="avaliar" class="button-primary" tabindex="1000" onclick="return confirm( 'tem certeza que deseja avaliar essa proposta?' );">Avaliar</button>
										<?php endif; ?>
									<?php endif; ?>
								</td>
							</tr>

						</table>
					</div>
				</div>

			</form>
		<?php
	}

	/**
	 * salvar avaliação
	 *
	 * @name    salvar_avaliacao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-20
	 * @updated 2012-02-24
	 * @return  void
	 */
	function salvar_avaliacao( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'approve_sav_propostas' ) )
			return false;

		// verificar se a proposta está finalizada
		if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_proposta_finalizada( $id_proposta ) )
			return false;

		$avaliacao   = $_POST[ 'avaliacao' ];

		$observacoes = htmlspecialchars( stripslashes( $_POST[ 'observacoes' ] ) );

		if( !empty( $avaliacao ) )
		{
			$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_propostas} SET status = %s WHERE id_proposta = %d", $avaliacao, $id_proposta ) );

			$SAV->registrar_historico_proposta( $id_proposta, null, $observacoes, $avaliacao );
		}

		$SAV->update_proposta_meta( $id_proposta, 'observacoes', $observacoes );
		$SAV->update_proposta_meta( $id_proposta, 'avaliador', $user_ID );
		$SAV->update_proposta_meta( $id_proposta, 'data_avaliacao', date( 'Y-m-d H:i:s' ) );
	}

	/**
	 * solicitação e resposta recurso
	 *
	 * @name    formulario_recurso
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-03-08
	 * @updated 2012-03-08
	 * @return  void
	 */
	function formulario_recurso( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID;

		if( !current_user_can( 'review_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		$proposta		      	      = $SAV->get_proposta( $id_proposta );

		$hoje 						  = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );

		$data_inicio_recurso 	      = $SAV->get_edital_meta( $id_edital, 'data_inicio_recurso');
		$data_fim_recurso 			  = $SAV->get_edital_meta( $id_edital, 'data_fim_recurso');
		$status_passivel_recurso	  = $SAV->get_edital_meta( $id_edital, 'status_passivel_recurso');

		$status_recurso				  = $SAV->get_proposta_meta( $id_proposta, 'status_recurso' );
		$recurso_direito_resposta	  = $SAV->get_proposta_meta( $id_proposta, 'recurso_direito_resposta' );
		$recurso_anexar_arquivo   	  = $SAV->get_proposta_meta( $id_proposta, 'recurso_anexar_arquivo' );

		if( $proposta['status'] != 'inabilitado' and $proposta['status'] != 'nao_classificado' and $proposta['status'] != 'nao_pre_selecionado' and $proposta['status'] != 'nao_selecionado' and $proposta['status'] != 'lista_de_reserva' )
			return false;

		if( $SAV->is_autor_proposta( $user_ID, $id_proposta ) and empty( $recurso_direito_resposta ) )
		{
			if( $hoje < $data_inicio_recurso or $hoje > $data_fim_recurso  )
				return false;

			// verifica se a proposta está no status passível de recurso
			if( $proposta['status'] != $status_passivel_recurso )
				return false;

			// verifica se já foi enviado recurso para este status
			$verifica_status = $wpdb->get_var( $wpdb->prepare( "SELECT status FROM {$wpdb->sav_proposta_historico} WHERE id_proposta = %d AND id_author = %d  AND status = %s ORDER BY id_historico DESC LIMIT 1 ", $id_proposta, $proposta['id_author'], 'recurso_' . $status_passivel_recurso ) );

			if( !empty( $verifica_status ) )
				return false;
		}

		if( current_user_can( 'review_sav_propostas' ) )
		{
			// verifica se o concorrente já solicitou recurso
			$verifica_recurso = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->sav_proposta_historico} WHERE id_proposta = %d AND id_author = %d AND acao = %s", $id_proposta, $proposta['id_author'], 'Recurso' ) );

			if( empty( $verifica_recurso ) )
				return true;
		}

		?>
			<form id="recurso" method="post" enctype="multipart/form-data">
				<input type="hidden" name="acao" value="salvar_solicitacao_recurso" />
				<input type="hidden" name="id_edital" value="<?php print $id_edital; ?>" />
				<input type="hidden" name="id_proposta" value="<?php print $id_proposta; ?>" />
				<input type="hidden" name="status" value="<?php print $proposta['status']; ?>" />

				<?php if( $SAV->is_autor_proposta( $user_ID, $id_proposta ) ) : ?>
					<h4>Solicitação de Recurso<span class="description"> - O recurso deverá ser apenas uma contestação, com motivo plausível, contra o Motivo do Indeferimento.</span></h4>
				<?php else : ?>
					<h4>Resposta para Recurso</h4>
				<?php endif; ?>

				<div class="postbox">
					<div class="inside">
						<table width="100%" cellspacing="15px">

							<?php if( $SAV->is_autor_proposta( $user_ID, $id_proposta ) ) : ?>
								<input type="hidden" name="recurso_direito_resposta" value="<?php print $recurso_direito_resposta; ?>" />
								<input type="hidden" name="recurso_anexar_arquivo" value="<?php print $recurso_anexar_arquivo; ?>" />

								<tr valign="top">
									<td align="right" width="30%">
										<label for="recurso">Interposição de recurso *</label>
										<p class="description">máximo de 3000 caracteres</p>
									</td>
									<td colspan="3">
										<textarea id="recurso" name="recurso" cols="50" rows="5" tabindex="2" maxlength="3000" class="limit-chars"></textarea>
									</td>
								</tr>

								<?php if( $recurso_anexar_arquivo ) : ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="anexo_recurso">Anexo</label>
										</td>
										<td colspan="3">
											<input type="file" id="anexo_recurso" name="anexo_recurso" tabindex="1" />
											<p class="description">apenas arquivos no formato .pdf com no máximo 2MB</p>
										</td>
									</tr>
								<?php endif; ?>

								<tr valign="top">
									<td colspan="4" align="right">
										<small>Prazo para envio de recurso até: <strong><?php print date( 'd/m/Y', strtotime( $data_fim_recurso ) ); ?></strong></small>
										<button type="submit" name="avaliar" class="button-primary" tabindex="1000" onclick="return confirm( 'Depois de enviado não será possível editar o recurso, tem certeza que deseja enviar?' );">Enviar</button>
									</td>
								</tr>
							<?php endif; ?>

							<?php if( current_user_can('approve_sav_propostas') ) : ?>

								<?php $readonly = ( current_user_can( 'review_sav_propostas' ) ) ?  false : true  ?>

								<tr valign="top">
									<td align="right" width="30%">
										<label for="avaliacao">Status recurso </label>
									</td>
									<td colspan="3">
										<label style="color:#009900;"><input type="radio" name="status_recurso" value="deferido" <?php if( 'deferido' == $status_recurso ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Deferido</label>
										<label style="color:#990000;"><input type="radio" name="status_recurso" value="indeferido" <?php if( 'indeferido' == $status_recurso ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Indeferido</label>
										<label style="color:#340000;"><input type="radio" name="status_recurso" value="aguardando" <?php if( 'aguardando' == $status_recurso ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Aguardando documentação comprobatória</label>
									</td>
								</tr>
								<tr valign="top">
									<td align="right">
										<label for="resposta_recurso">Resposta* </label>
										<p class="description">máximo de 3000 caracteres</p>
									</td>
									<td colspan="3">
										<textarea id="resposta_recurso" name="resposta_recurso" cols="50" rows="5" tabindex="2" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $resposta_recurso; ?></textarea>
									</td>
								</tr>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="avaliacao">Configuração</label>
									</td>
									<td colspan="3">
										<label><input type="checkbox" name="recurso_direito_resposta" value="true" tabindex="2" <?php if( $recurso_direito_resposta ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Direito a resposta?</label>
										<label><input type="checkbox" name="recurso_anexar_arquivo" value="true" tabindex="2" <?php if( $recurso_anexar_arquivo ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Pode anexar arquivo?</label>
									</td>
								</tr>
								<tr valign="top">
									<?php if( !$readonly ) : ?>
										<td colspan="4" align="right">
											<button type="submit" name="avaliar" class="button-primary" tabindex="1000" onclick="return confirm( 'tem certeza que deseja enviar a resposta do recurso?' );">Enviar</button>
										</td>
									<?php endif; ?>
								</tr>
							<?php endif; ?>

						</table>
					</div>
				</div>
			</form>
		<?php
	}

	/**
	 * salvar solicitacao e resposta de recurso
	 *
	 * @name    salvar_solicitacao_recurso
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-03-08
	 * @updated 2012-06-22
	 * @return  void
	 */
	function salvar_solicitacao_recurso( $id_edital, $id_proposta )
	{
		global $SAV, $user_ID, $wpdb;

		if( !current_user_can( 'review_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		$passo            		  = $_REQUEST[ 'passo' ];
		$status_da_proposta  	  = $_POST['status'];

		// concorrente
		//$recurso_concorrente 	  = htmlspecialchars( stripslashes( $_POST[ 'recurso' ] ) );

		// avaliador
		$resposta_recurso   	  = htmlspecialchars( stripslashes( $_POST[ 'resposta_recurso' ] ) );
		$recurso_direito_resposta = $_POST[ 'recurso_direito_resposta' ];
		$recurso_anexar_arquivo   = $_POST[ 'recurso_anexar_arquivo' ];

		$status_do_recurso  	  = $_POST[ 'status_recurso' ];

		if( $SAV->is_autor_proposta( $user_ID, $id_proposta ) )
		{
			$Validator = new Validator();

			$recurso_concorrente = $Validator->validate( $_POST[ 'recurso' ], 'Recurso', 'required=1&max_length=3000' );

			if( !empty( $recurso_anexar_arquivo ) )
			{
				//  anexo
				$anexo_recurso = $SAV->upload_anexo( 'anexo_recurso', 'Anexo: Cronograma de Execução' );

				if( !empty( $anexo_recurso ) )
					$anexo = $anexo_recurso['url'];

				$Validator->validate( $anexo, 'Anexo: Recurso', 'required=1' );
			}

			$SAV->error = $Validator->error();

			if( !empty( $SAV->error ) )
				return false;

			if( empty( $recurso_direito_resposta ) )
				$status = 'recurso_' . $status_da_proposta;
			else
				$status = '';

			$SAV->registrar_historico_proposta( $id_proposta, 'Recurso', $recurso_concorrente, $status, $anexo );

			// status do recurso
			$SAV->update_proposta_meta( $id_proposta, 'status_recurso', 'recurso solicitado' );

			// zerar as configurações
			$SAV->update_proposta_meta( $id_proposta, 'recurso_direito_resposta', false );
			$SAV->update_proposta_meta( $id_proposta, 'recurso_anexar_arquivo', false );

			// atualizar página
			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$passo}&sussa=2" ); exit();
		}
		elseif( current_user_can( 'review_sav_propostas' ) and !empty( $resposta_recurso ) and !empty( $status_do_recurso ) )
		{
			$status = 'resposta_' . $status_da_proposta . '_recurso_' . $status_do_recurso;

			// registrar historico
			$SAV->registrar_historico_proposta( $id_proposta, 'Recurso ' . $status_do_recurso, $resposta_recurso, $status );

			// status do recurso
			$SAV->update_proposta_meta( $id_proposta, 'status_recurso', $status_do_recurso );

			//configurações
			$SAV->update_proposta_meta( $id_proposta, 'recurso_direito_resposta',  $recurso_direito_resposta );
			$SAV->update_proposta_meta( $id_proposta, 'recurso_anexar_arquivo', $recurso_anexar_arquivo);

			// atualizar página
			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$passo}&sussa=1" ); exit();
		}
	}

	/**
	 * botão para reclassificar proposta da categoria estreante para não estreante e vice-versa
	 *
	 * @name salvar_categoria_reclassificacao
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-03-15
	 * @updated 2012-03-15
	 * @return void
	 */
	function salvar_categoria_reclassificacao( $id_edital, $id_proposta )
	{
		global $SAV;
		$alterado = false;

		if( !current_user_can( 'review_sav_propostas' ) or empty( $id_proposta ) or empty( $id_edital ) )
			return false;

		$categoria_diretor = $SAV->get_proposta_meta( $id_proposta, 'categoria_diretor'  );

		if( 'Estreante' == $categoria_diretor )
			$alterado = $SAV->update_proposta_meta( $id_proposta, 'categoria_diretor', 'Não Estreante' );
		elseif( 'Não Estreante' == $categoria_diretor )
			$alterado = $SAV->update_proposta_meta( $id_proposta, 'categoria_diretor', 'Estreante' );

		if( $alterado )
			$SAV->update_proposta_meta( $id_proposta, 'categoria_reclassificada', true );

		wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo='dados_diretor'&sussa=1" ); exit();
	}

	/**
	 * salvar divisão por grupo proposta (manualmente)
	 *
	 * @name salvar_grupos
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-03-20
	 * @updated 2012-03-20
	 * @return void
	 */
	function salvar_grupos()
	{
		global $SAV;

		if( !current_user_can( 'review_sav_propostas' ) )
			return false;

		$divisao = $_POST['divisao'];

		foreach( $divisao as $grupo )
		{
			if( !empty( $grupo['grupo'] ) )
				$SAV->update_proposta_meta( $grupo['id_proposta'], 'grupo', $grupo['grupo'] );
		}
	}

	/**
	 * fomulario de avaliacão dos consultores
	 *
	 * @name formulario_avaliacao_consultor
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-07
	 * @updated 2012-03-22
	 * @return void
	 */
	function formulario_avaliacao_consultor( $id_edital, $id_proposta, $id_consultor = null, $i)
	{
		global $SAV, $user_ID, $user_login, $wpdb;

		$consultor				   = get_userdata( $user_ID );
		$criterios				   = $SAV->get_criterios_avaliacao( $id_edital );
		$hoje 					   = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
		$data_inicio_classificacao = $SAV->get_edital_meta($id_edital, 'data_inicio_classificacao');
		$data_fim_classificacao    = $SAV->get_edital_meta($id_edital, 'data_fim_classificacao');
		$observacao_consultor	   = $SAV->get_proposta_meta($id_proposta, 'observacao_consultor_' . $user_ID);
		$readonly 				   = false;

		// busca os consultores que já finalizaram classificação
		$comissao_finalizada = $SAV->get_edital_meta( $id_edital, 'comissao_finalizada' );

		// busca o edital que este consultor está registrado
		$edital_consultor = $wpdb->get_var( $wpdb->prepare( "SELECT id_edital FROM {$wpdb->sav_edital_meta} WHERE meta_key = 'comissao' AND meta_value LIKE %s", "%" . $user_login . "%") );

		// verifica se este edital é o mesmo que o consultor está registrado
		if ( $id_edital !== $edital_consultor )
			return false;

		// verifica se as data estão preenchidas
		if( empty( $data_inicio_classificacao ) or empty( $data_fim_classificacao ) )
			return false;

		// verifica o inicio do período de classificacao
		if( $hoje < $data_inicio_classificacao )
			return false;

		// verifica o fim do período de classificação e se a classificacao já foi concluída por este consultor
		if( $hoje > $data_fim_classificacao or in_array( $user_login,  $comissao_finalizada ) )
			$readonly = true;

		if ( empty( $criterios ) )
			return false;

		$verificar_avaliacao = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->sav_avaliacao} WHERE id_proposta = %d and id_consultor = %d GROUP BY id_consultor", $id_proposta, $user_ID ) );

		//if ( !empty( $criterios ) ) :

		?>
			<form id="avaliacao_consultor" method="post" class="float_box">
				<input type="hidden" name="acao" value="salvar_avaliacao_consultor" />
				<h4>Avaliação Comissão de Seleção <span class="description">Avaliador: <?php print $consultor->user_firstname ?></span></h3>
				<div class="postbox">
					<table width="100%" cellspacing="15px" class="criterios">

						<?php if( !$readonly or (!empty($verificar_avaliacao ) and $readonly ) ) : ?>

							<?php foreach( $criterios as $criterio) : $item++ ?>
								<?php $avaliacao = $SAV->get_nota_criterio( $criterio['id_criterio'], $id_proposta, $id_consultor ); ?>
								<input type="hidden" name="avaliacao_consultor[<?php print $item; ?>][id_criterio]" value="<?php print $criterio['id_criterio'] ?>"/>
								<input type="hidden" name="avaliacao_consultor[<?php print $item; ?>][id_avaliacao]" value="<?php if( $avaliacao ) print $avaliacao['id_avaliacao']; ?>"/>
								<tr class="criterio">
									<td align="left" width="30%">
										<label for="criterio_<?php print $item; ?>"><?php print $criterio['descricao']; ?></label>
									</td>
									<td>
										<input type="text" id="criterio_<?php print $item; ?>" class="nota_consultor" name="avaliacao_consultor[<?php print $item; ?>][nota]" value="<?php if( $avaliacao ) print $SAV->mysql_para_moeda( $avaliacao['nota'] ); ?>" size="5" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
							<?php endforeach; ?>

							<tr valign="top">
								<td align="right" widht="30%" >
									<label for="nota_final"><strong>Nota final</strong></label>
								</td>
								<td align="left" colspan="3">
									<input type="text" class="nota_final" name="avaliacao_valor_total" size="5" readonly="readonly" />
								</td>
							</tr>

						<?php endif; ?>

						<tr valign="top">
							<td align="right" width="30%">
								<label for="observacao_consultor">Observação avaliador</label>
								<p class="description">Utilize este campo para fazer anotações sobre o projeto</p>
								<p class="description">máximo de 3000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="observacao_consultor" name="observacao_consultor" cols="50" rows="5" tabindex="2" maxlength="3000" class="limit-chars"><?php print $observacao_consultor; ?></textarea>
							</td>
						</tr>
						<tr valign="top">
							<td align="center" colspan="3" >
								<button type="submit" name="avaliar_proposta" class="button-primary" ><?php print( !$readonly ) ? "Salvar" : "Salvar observação"; ?></button>
							</td>
						</tr>
					</table>
				</div>
			</form>
		<?php // endif;
	}

	/**
	 * salvar avaliacão feita pelos consultores
	 *
	 * @name salvar_avaliacao_consultor
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-07
	 * @updated 2012-02-07
	 * @return void
	 */

	function salvar_avaliacao_consultor( $id_edital, $id_proposta )
	{
		if ( !current_user_can( 'classifies_sav_propostas' ) )
			return false;

		global $wpdb, $user_ID, $SAV, $user_login;

		$hoje 					   = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
		$data_inicio_classificacao = $SAV->get_edital_meta($id_edital, 'data_inicio_classificacao');
		$data_fim_classificacao    = $SAV->get_edital_meta($id_edital, 'data_fim_classificacao');
		$avaliacao_consultor 	   = $_POST['avaliacao_consultor'];
		$observacao_consultor	   = $_POST['observacao_consultor'];
		$passo           	  	   = $_REQUEST[ 'passo' ];
		$readonly				   = false;

		// busca os consultores que já finalizaram classificação
		$comissao_finalizada = $SAV->get_edital_meta( $id_edital, 'comissao_finalizada' );

		// verifica o fim do período de classificação e se a classificacao já foi concluída por este consultor
		if( $hoje > $data_fim_classificacao or in_array( $user_login,  $comissao_finalizada ) )
			$readonly = true;

		if ( !empty($avaliacao_consultor) and !$readonly)
		{
			// salva as notas de cada critério
			foreach( $avaliacao_consultor as $avaliacao )
			{
				$avaliacao['nota'] = $SAV->moeda_para_mysql( $avaliacao['nota'] );
				$nota_total += $avaliacao['nota'];

				if ( !empty( $avaliacao['id_avaliacao'] ) )
				{
					$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_avaliacao} SET nota = %s WHERE id_avaliacao = %d AND id_proposta = %d AND id_criterio = %d AND id_consultor = %d ", $avaliacao['nota'], $avaliacao['id_avaliacao'], $id_proposta, $avaliacao['id_criterio'], $user_ID ) );
				}
				else
				{
					$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_avaliacao} ( id_proposta, id_criterio, id_consultor, nota) VALUES (  %d, %d, %d, %d )", $id_proposta, $avaliacao['id_criterio'], $user_ID, $avaliacao['nota'] ) );
				}
			}

			//salva nota total
			$id_avaliacao_nota = $wpdb->get_var( $wpdb->prepare( "SELECT id_avaliacao FROM {$wpdb->sav_avaliacao} WHERE id_criterio = '' AND id_proposta = %d AND id_consultor = %d LIMIT 1", $id_proposta, $user_ID ) );

			if ( !empty($id_avaliacao_nota) )
			{
				$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_avaliacao} SET nota = %s WHERE id_avaliacao = %d AND id_proposta = %d AND id_criterio = '' AND id_consultor = %d ", $nota_total, $id_avaliacao_nota, $id_proposta, $user_ID ) );
			}
			else
			{
				$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_avaliacao} ( id_proposta, id_criterio, id_consultor, nota) VALUES (  %d, '', %d, %d )", $id_proposta, $user_ID, $nota_total) );
			}
		}
		//salva a observacao
		$SAV->update_proposta_meta( $id_proposta, 'observacao_consultor_' . $user_ID, $observacao_consultor);

		// atualizar página
		wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$passo}&sussa=1" ); exit();
	}

	/**
	 * Mostrar avaliacoes realizadas na proposta
	 *
	 * @name  mostrar_notas_classificacao
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-24
	 * @updated 2012-02-24
	 * @return void
	 */
	function mostrar_notas_classificacao( $id_proposta, $id_edital ) {

		global $SAV, $user_ID;

		$criterios 					 = $SAV->get_criterios_avaliacao( $id_edital );
		$consultores 				 = $SAV->get_consultores_proposta( $id_proposta );
		$autor_proposta			     = $SAV->is_autor_proposta( $user_ID, $id_proposta );
		$hoje  		  				 = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
		$data_portaria_classificacao = $SAV->get_edital_meta($id_edital, 'data_portaria_classificacao');

		// verifica se existe critérios ou se algum consultor já avaliou esta proposta
		if ( empty( $criterios ) or empty( $consultores ) )
			return false;

		// verifica se é o autor da proposta e se pode ver as nota de classificacao
		if(  $autor_proposta and ($hoje < $data_portaria_classificacao or empty($data_portaria_classificacao ) ) )
			return false;

		?>
		<form id="mostrar_notas_classificacao" method="post">
				<input type="hidden" name="acao" value="salvar_avaliacao_consultor" />

				<h4>Etapa de Classificação: <?php echo ( $autor_proposta ) ? "Avaliação desta proposta": "Avaliações desta proposta";  ?></h3>
				<div class="postbox">
					<table <?php echo( $autor_proposta ) ? "width='600px'" :"width='100%'";  ?>cellspacing="10px" class="criterios">
						<thead>
							<th>Critérios</th>
							<?php if(!$autor_proposta) : ?>
								<?php foreach( $consultores as $consultor ) : ?>
									<?php $dados_consultor = get_userdata( $consultor[ 'id_consultor' ] ); ?>
									<th><?php print $dados_consultor->user_firstname ?></th>

								<?php endforeach; ?>
							<?php endif; ?>
							<th><?php echo($autor_proposta) ? "Nota Final": "Média Final";  ?></th>
						</thead>
						<tbody>
							<?php foreach( $criterios as $criterio) : $item++ ?>
								<tr>
									<td>
										<label for="criterio_<?php print $item; ?>"><?php print $criterio['descricao']; ?></label>
									</td>
									<?php $notas_por_criterio = 0; ?>
									<?php $i = 0; ?>
									<?php foreach( $consultores as $consultor ) : $i++ ?>
										<?php $avaliacao = $SAV->get_nota_criterio( $criterio['id_criterio'], $id_proposta, $consultor['id_consultor'] ); ?>
										<?php $notas[$consultor['id_consultor']] += $avaliacao['nota']; ?>
										<?php $notas_por_criterio += $avaliacao['nota']; ?>

										<?php if(!$autor_proposta) : ?>
											<td align="center">
												<input type="text" name="nota_criterio"value="<?php print $SAV->mysql_para_moeda( $avaliacao['nota'] ); ?>" size="5" disabled="disabled" />
											</td>
										<?php endif; ?>
									<?php endforeach; ?>
									<td align="center">
										<?php $media_por_criterio = ( $notas_por_criterio / $i ); ?>
										<input type="text" name="media_por_criterio" value="<?php print $SAV->mysql_para_moeda( $media_por_criterio ); ?>" size="5" disabled="disabled" />
									</td>
								</tr>
							<?php endforeach; ?>
							<tr>
								<td>
									<label><strong>Total</strong></label>
								</td>
								<?php if(!$autor_proposta) : ?>
									<?php foreach( $consultores as $consultor ) : ?>
										<td align="center">
											<input type="text" value="<?php print $SAV->mysql_para_moeda( $notas[$consultor['id_consultor']] ); ?>" size="5" disabled="disabled" />
										</td>
									<?php endforeach; ?>
								<?php endif; ?>

								<td align="center">
									<input type="text" name="media_total_do_projeto" value="<?php print $SAV->mysql_para_moeda( array_sum($notas)/$i ); ?>" size="5" disabled="disabled" />
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		<?php
	}


	/**
	 * Mostra o formulário dde classificação de acordo com o tipo de usuário
	 *
	 * @name  montar_formulario_classificacao
	 * @author Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-07
	 * @updated 2012-02-25
	 * @return void
	 */
	function montar_formulario_classificacao( $id_edital, $id_proposta, $id_usuario ) {

		global $SAV;

		$autor_proposta = $SAV->is_autor_proposta( $id_usuario, $id_proposta );

		// mostrar todas as avaliacoes realizadas na proposta
		if  ( current_user_can( 'analista' ) or current_user_can( 'administrator' )  )
		{
			$this->mostrar_notas_classificacao( $id_proposta, $id_edital );
		}

		// mostra apenas o formulário de avaliação de acordo com o id do usuário
		if ( current_user_can( 'classifies_sav_propostas' ) and !current_user_can( 'administrator' ) and !$autor_proposta)
		{
			$this->formulario_avaliacao_consultor( $id_edital, $id_proposta, $id_usuario );
		}
	}

	/**
	 * botão finalizar avaliacao
	 *
	 * @name    finalizar_avaliacao
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2011-03-05
	 * @updated 2012-03-05
	 * @return  mixed
	 */
	function finalizar_avaliacao( $id_edital, $id_usuario)
	{
		global $SAV, $user_login;

		if (empty($id_edital) or empty($id_usuario) )
			return false;

		if( !current_user_can( 'classifies_sav_propostas' ) or current_user_can('administrator') )
			return false;

		// busca array com os consultores que finalizaram avaliacoes
		$comissao_finalizada = $SAV->get_edital_meta( $id_edital, 'comissao_finalizada' );

		// verifica se a classificacao já foi realizada por este consultor
		if( in_array( $user_login,  $comissao_finalizada ) )
			return false;

		if ( $SAV->propostas_sem_avaliacao( $id_edital ) )
			return false;

		?>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">
						<tr valign="top">
							<td>
								<a href="?page=propostas&acao=finalizar_avaliacao_consultor&id_edital=<?php print $id_edital; ?>&status=meus_classificados&sussa=2" title="Finalizar Avaliação" class="button-primary" onclick="return confirm( 'Tem certeza que deseja finalizar as avaliações das propostas?' );">Finalizar Avaliação</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * finalizar avaliacao consultor
	 *
	 * @name    finalizar_avaliacao_consultor
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2011-03-05
	 * @updated 2012-03-05
	 * @return  mixed
	 */
	function finalizar_avaliacao_consultor( $id_edital )
	{

		global $wpdb, $SAV, $user_ID, $user_login;

		$atualizado = false;

		if( !current_user_can( 'classifies_sav_propostas' ) )
			return false;

		// busca array com os consultores que fazem parte deste edital
		$comissao_finalizada = $SAV->get_edital_meta( $id_edital, 'comissao' );

		// verifica se esse consultor faz parte dessa comissão
		if( !in_array( $user_login,  $comissao_finalizada ) )
			return false;

		// busca array com os consultores que finalizaram avaliacoes
		$comissao_finalizada = $SAV->get_edital_meta( $id_edital, 'comissao_finalizada' );

		// verifica se a classificacao já foi realizada por este consultor
		if( in_array( $user_login,  $comissao_finalizada ) )
			return false;

		// pega as propostas com maiores notas que foram analisadas pelo consultor
		$propostas_classificadas = $SAV->get_classificacao_por_consultor( $user_ID, $id_edital );

		if( empty( $propostas_classificadas )  )
			return false;

		// atualizar o status das propostas para classificado
		foreach( $propostas_classificadas as $classificadas )
		{
			$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_propostas} SET status = 'classificado' WHERE id_proposta = %d AND ( status = 'habilitado' OR status = 'classificado' OR status = 'nao_classificado' ) ", $classificadas->id_proposta ) );
			$atualizado = true;
		}

		// verifica se a proposta foi atualizada e adiciona o cpf do consultor no array da comissao que já finalizou a classificacao
		if ( $atualizado )
		{
			$consultor = ( (array) $user_login );

			if( empty( $comissao_finalizada ) )
			{
				$comissao = $consultor;
			}
			else
			{
				$comissao = array_merge( $comissao_finalizada, $consultor );
			}
			$SAV->update_edital_meta( $id_edital, 'comissao_finalizada', $comissao );
		}
	}

	/**
	 * botão de impressao
	 *
	 * @name    formulario_impressao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2012-02-23
	 * @return  void
	 */
	function formulario_impressao( $id_edital, $id_proposta )
	{
		global $SAV, $user_ID;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		?>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">
						<tr valign="top">
							<td>
								<a href="?page=propostas&acao=pdf_proposta&id_edital=<?php print $id_edital; ?>&id_proposta=<?php print $id_proposta; ?>" title="Visualizar Proposta" class="button-primary" target="_blank">Visualizar Proposta</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * formulario proposta dados concorrente
	 *
	 * @name    formulario_proposta_dados_concorrente
	 * @author 	Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-04-24
	 * @updated 2012-04-24
	 * @return  void
	 */

	function formulario_proposta_dados_concorrente( $id_edital, $id_proposta = 0 )
	{
		global $SAV, $wpdb, $user_ID;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se é uma proposta nova
		if( empty( $id_proposta ) )
		{
			$id_author = $user_ID;
		}
		else
		{
			// verificar se o usuário tem permissão para ver essa proposta
			if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se o usuário tem permissão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				$readonly = true;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				$readonly = true;

			$proposta = $SAV->get_proposta( $id_proposta );
			$id_author = $proposta['id_author'];
		}

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		if( $readonly )
			$disabled = 'disabled="disabled"';

		$naturezas = array(
			'1' => 'Organização Não Governamental Sem Fins Lucrativos de Direito Privado, de Natureza Cultural',
			'2' => 'Organização da Sociedade Civil de Interesse Público de Natureza Cultural - OSCIP',
			'3' => 'Entidade de Direito Público Federal - Administração Direta',
			'4' => 'Entidade de Direito Público Federal - Administração Indireta',
			'5' => 'Entidade de Direito Público Estadual - Administração Direta',
			'6' => 'Entidade de Direito Público Estadual - Administração Indireta',
			'7' => 'Entidade de Direito Público Municipal - Administração Direta',
			'8' => 'Entidade de Direito Público Municipal - Administração Indireta',
			'9' => 'Empresa Privada Com Fins Lucrativos',
		);

		$proponente = get_userdata( $id_author );

		$dados_empresa       = $SAV->get_dados_empresa( $proponente->user_login );
		$dados_pessoais      = $SAV->get_dados_pessoais( $proponente->user_login );
		$dados_contato       = $SAV->get_dados_contato( $proponente->user_login );
		$dados_geograficos   = $SAV->get_dados_geograficos( $proponente->user_login );
		$dados_profissionais = $SAV->get_dados_profissionais( $proponente->user_login );
		$dados_ong 			 = $SAV->get_dados_ong( $proponente->user_login );
		//$edital_ong = $SAV->get_edital_meta( $id_edital, 'edital_para_ong' );

		$nao_mostrar_para_comissao = ( ( !current_user_can( 'classifies_sav_propostas' ) or current_user_can( 'administrator' ) ) or $SAV->is_autor_proposta( $user_ID, $id_proposta ) );
	?>
		<form id="dados_concorrente" method="post" enctype="multipart/form-data">
			<input type="hidden" name="acao" value="salvar_proposta_dados_concorrente" />
			<input type="hidden" name="id_edital" value="<?php print $id_edital; ?>" />
			<input type="hidden" name="id_proposta" value="<?php print $id_proposta; ?>" />
			<input type="hidden" name="user" value="<?php print $user_ID; ?>" />
			<div class="metabox-holder">

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'dados_concorrente' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

				<?php if( $SAV->is_pessoa_juridica( $proponente->user_login ) ) : ?>
					<h4>Identificação do Concorrente</h4>
					<div class="postbox">
						<div class="inside">
							<table width="100%" cellspacing="15px">
								<tr valign="top">
									<td align="right" width="30%">
										<label for="razao_social">Razão Social * </label>
									</td>
									<td colspan="3">
										<input type="text" id="razao_social" name="razao_social" value="<?php print $dados_empresa[ 'nome' ]; ?>" size="50" maxlength="150" tabindex="1" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
								<?php if ( $nao_mostrar_para_comissao ) : ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="cnpj">CNPJ * </label>
										</td>
										<td colspan="3">
											<input type="text" id="cnpj" name="cnpj" value="<?php print $dados_empresa[ 'login' ]; ?>" maxlength="14" size="15" tabindex="1" readonly="readonly" />
										</td>
									</tr>
								<?php endif; ?>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="nome_representante">Representante Legal * </label>
									</td>
									<td colspan="3">
										<input type="text" id="nome_representante" name="nome_representante" value="<?php print $dados_empresa[ 'nome_representante' ]; ?>" size="50" maxlength="100" tabindex="1" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
								<?php if ( $nao_mostrar_para_comissao ) : ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="cpf_representante">CPF do Representante * </label>
										</td>
										<td colspan="3">
											<input type="text" id="cpf_representante" name="cpf_representante" value="<?php print $dados_empresa[ 'cpf_representante' ]; ?>" maxlength="14" size="15" tabindex="1" readonly="readonly" />
										</td>
									</tr>
								<?php endif; ?>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="natureza">Natureza da Entidade *</label>
									</td>
									<td colspan="3">
										<select id="natureza" name="natureza" tabindex="1" disabled="disabled">
											<option value="" >Selecione</option>
											<?php foreach( $naturezas as $key => $natureza ) : ?>
												<option value="<?php print $key ?>" <?php if( $dados_empresa['natureza'] == $key ) print 'selected = "selected"'; ?>><?php print $natureza; ?></option>
											<?php endforeach; ?>
										</select>
									</td>
								</tr>
							</table>
						</div>
					</div>
				<?php endif; ?>

				<?php if( $SAV->is_pessoa_fisica( $proponente->user_login ) ) : ?>
					<h4>Identificação do Concorrente</h4>
					<div class="postbox">
						<div class="inside">
							<table width="100%" cellspacing="15px">
								<tr valign="top">
									<td align="right" width="30%">
										<label for="nome">Nome completo * </label>
									</td>
									<td colspan="3">
										<input type="text" id="nome" name="nome" value="<?php print $dados_pessoais[ 'nome' ]; ?>" size="50" maxlength="150" tabindex="1" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
								<?php if ( $nao_mostrar_para_comissao ) : ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="cpf">CPF * </label>
										</td>
										<td width="200px">
											<input type="text" id="cpf" name="cpf" value="<?php print $dados_pessoais[ 'login' ]; ?>" maxlength="11" size="15" tabindex="1" readonly="readonly" />
										</td>
										<td align="right" width="100px">
											<label for="rg">RG/ORG EXP * </label>
										</td>
										<td>
											<input type="text" id="rg" name="rg" value="<?php print $dados_pessoais[ 'rg' ]; ?>" maxlength="15" size="15" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
										</td>
									</tr>
								<?php endif; ?>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="nascimento">Nascimento * </label>
									</td>
									<td width="200px">
										<input type="text" id="nascimento" name="nascimento" class="date" value="<?php if( $dados_pessoais['nascimento'] != '0000-00-00 00:00:00' ) print date( 'd/m/Y', strtotime( $dados_pessoais[ 'nascimento' ] ) ); ?>" maxlength="10" size="15" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
									<td align="right" width="100px">
										<label for="naturalidade">Naturalidade * </label>
									</td>
									<td>
										<?php print $SAV->dropdown_states( 'naturalidade', $dados_pessoais[ 'naturalidade' ], true,  'tabindex="1" ' . $disabled ); ?>
									</td>
								</tr>

							</table>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $nao_mostrar_para_comissao ) : ?>
					<h4>Contato</h4>
					<div class="postbox">
						<div class="inside">
							<table width="100%" cellspacing="15px">
								<tr valign="top">
									<td align="right" width="30%">
										<label for="email">E-mail * </label>
									</td>
									<td colspan="3">
										<input type="text" id="email" name="email" value="<?php print $dados_contato[ 'email' ]; ?>" size="50" maxlength="100" tabindex="1" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="ddd_telefone">Telefone: *</label>
									</td>
									<td width="200px">
										<input type="text" id="ddd_telefone" name="ddd_telefone" value="<?php print $dados_contato[ 'ddd_telefone' ]; ?>" size="2" tabindex="1" maxlength="2" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
										<input type="text" id="telefone" class="phone" name="telefone" value="<?php print $dados_contato[ 'telefone' ]; ?>" size="12" tabindex="1" maxlength="9" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
									<td align="right" width="100px;">
										<label for="ddd_celular">Celular:</label>
									</td>
									<td>
										<input type="text" id="ddd_celular" name="ddd_celular" value="<?php print $dados_contato[ 'ddd_celular' ]; ?>" size="2" tabindex="1" maxlength="2" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
										<input type="text" id="celular" class="phone" name="celular" value="<?php print $dados_contato[ 'celular' ]; ?>" size="12" tabindex="1" maxlength="9" <?php if( $readonly ) print 'disabled="disabled"'; ?>/>
									</td>
								</tr>

							</table>
						</div>
					</div>
				<?php endif; ?>

				<h4>Localização</h4>
				<div class="postbox">
					<div class="inside">
						<table width="100%" cellspacing="15px">
							<?php if ( $nao_mostrar_para_comissao ) : ?>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="endereco">Endereço * </label>
									</td>
									<td colspan="3">
										<input type="text" id="endereco" name="endereco" value="<?php print $dados_geograficos[ 'endereco' ]; ?>" size="50" maxlength="100" tabindex="1" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="bairro">Bairro *</label>
									</td>
									<td width="200px">
										<input type="text" id="bairro" name="bairro" value="<?php print $dados_geograficos[ 'bairro' ]; ?>" maxlength="50" size="15" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
									<td align="right" width="100px">
										<label for="cep">CEP * </label>
									</td>
									<td>
										<input type="text" id="cep" name="cep" class="cep" value="<?php print $dados_geograficos[ 'cep' ]; ?>" maxlength="8" size="15" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
							<?php endif; ?>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="cidade">Cidade *</label>
								</td>
								<td width="200px">
									<input type="text" id="cidade" name="cidade" value="<?php print $dados_geograficos[ 'cidade' ]; ?>" maxlength="50" size="15" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
								</td>
								<td align="right" width="100px">
									<label for="estado">UF * </label>
								</td>
								<td>
									<?php $extra = ( $disabled ) ? $disabled : 'tabindex="1"'; ?>
									<?php print $SAV->dropdown_states( 'estado', $dados_geograficos[ 'estado' ], true, $extra); ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<?php if ( $dados_empresa['natureza'] != 1 and $dados_empresa['natureza'] != 2 ) :?>
					<h4>Dados profissionais</h4>
					<div class="postbox">
						<div class="inside">
							<table width="100%" cellspacing="15px">
								<tr valign="top">
									<td align="right" width="30%">
										<label for="formacao">Especialização/Formação </label>
									</td>
									<td width="200px">
										<input type="text" id="formacao" name="formacao" value="<?php print $dados_profissionais['formacao']; ?>" maxlength="100" size="40" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
									<td align="right" width="100px">
										<label for="ocupacao">Área de Atuação </label>
									</td>
									<td>
										<input type="text" id="ocupacao" name="ocupacao" value="<?php print $dados_profissionais['ocupacao']; ?>" maxlength="100" size="40" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>
								<tr valign="top">
									<td align="right" width="30%">
										<label for="biografia">Biografia </label>
									</td>
									<td colspan="3">
										<textarea id="biografia" name="biografia" cols="50" rows="5" tabindex="1" maxlength="250" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $dados_profissionais['biografia']; ?></textarea>
									</td>
								</tr>
							</table>
						</div>
					</div>
				<?php endif ?>

				<?php if( $SAV->is_pessoa_juridica( $proponente->user_login ) ) : ?>
					<?php if ($dados_empresa['natureza'] == 1 or $dados_empresa['natureza'] == 2 ) :?>
						<h4 class="convenio">Informações complementares </h4>
						<div class="postbox convenio">
							<div class="inside">
								<table width="100%" cellspacing="15px">
									<tr valign="top">
										<td align="right" width="30%">
											<label for="numero_siconv">Número de Cadastro da entidade no Siconv *<a href="#duvida_numero_siconv" class="duvida">?</a></label>
											<div id="duvida_numero_siconv" title="Número de Cadastro da entidade no Siconv" class="hidden">
												<p>Informe o número do documento usado para identificação no SICONV. Exemplo: CNPJ, CPF do Representante, etc... </p>
											</div>
										</td>
										<td colspan="3">
											<input type="text" id="numero_siconv" name="numero_siconv" value="<?php print $dados_ong['numero_siconv']; ?>" maxlength="30" size="30" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
										</td>
									</tr>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="objeto_social">Objeto Social *</label>
										</td>
										<td colspan="3">
											<textarea id="objeto_social" name="objeto_social" cols="50" rows="5" tabindex="1" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $dados_ong['objeto_social']; ?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="estatuto_social">Estatuto Social *</label>
										</td>
										<td colspan="3">
											<?php if( !empty( $dados_ong['estatuto_social'] ) ) : ?>
												<input type="checkbox" id="check_estatuto_social" name="check_estatuto_social" value="estatuto_social" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<em><a href="<?php print $dados_ong['estatuto_social']; ?>" title="baixar anexo" target="_blank"><?php print basename( $dados_ong['estatuto_social'] ); ?></a></em>
											<?php endif; ?>

											<?php if( !$readonly ) : ?>
												<input type="file" id="estatuto_social" name="estatuto_social" tabindex="1" />
												<p class="description">apenas arquivos no formato .pdf com no máximo 2MB</p>
											<?php endif; ?>
										</td>
									</tr>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="tempo_atividade">Tempo Atividade *</label>
											<p class="description">tempo de atividade e comprovação de ter a instituição desenvolvido aitividades, nos últimos 3(três) anos, referentes a matéria do objeto da proposta apresentada</p>
										</td>
										<td colspan="3">
											<?php if( !empty( $dados_ong['tempo_atividade'] ) ) : ?>
												<input type="checkbox" id="check_tempo_atividade" name="check_tempo_atividade" value="tempo_atividade" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<em><a href="<?php print $dados_ong['tempo_atividade']; ?>" title="baixar anexo" target="_blank"><?php print basename( $dados_ong['tempo_atividade'] ); ?></a></em>
											<?php endif; ?>

											<?php if( !$readonly ) : ?>
												<input type="file" id="tempo_atividade" name="tempo_atividade" tabindex="1" />
												<p class="description">apenas arquivos no formato .pdf com no máximo 2MB</p>
											<?php endif; ?>

										</td>
									</tr>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="comprovacao_capacidade">Comprovação de capacidade *</label>
											<p class="description">comprovação de capacidade gerencial, operancional e técnica e ainda qualificação profissional da equipe</p>
										</td>
										<td colspan="3">
											<?php if( !empty( $dados_ong['comprovacao_capacidade']) ) : ?>
												<input type="checkbox" id="check_comprovacao_capacidade" name="check_comprovacao_capacidade" value="comprovacao_capacidade" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<em><a href="<?php print $dados_ong['comprovacao_capacidade']; ?>" title="baixar anexo" target="_blank"><?php print basename( $dados_ong['comprovacao_capacidade'] ); ?></a></em>
											<?php endif; ?>

											<?php if( !$readonly ) : ?>
												<input type="file" id="comprovacao_capacidade" name="comprovacao_capacidade" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<p class="description">apenas arquivos no formato .pdf com no máximo 2MB</p>
											<?php endif; ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'dados_concorrente' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

			</div>
		</form>

	<?php
	}

	/**
	 * salvar proposta dados concorrente
	 *
	 * @name    salvar_proposta_dados_concorrente
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br> and Marcelo Mesquita<marcelo.costa@cultura.gov.br>
	 * @since   2012-04-25
	 * @updated 2012-04-25
	 * @return  void
	 */
	function salvar_proposta_dados_concorrente( $user_id, $id_edital, $id_proposta = 0 )
	{
		global $wpdb, $SAV, $user_login;

		// verifica se o usuário que está salvando o perfil
		$user = get_userdata( $user_id );

		if( $user_login !== $user->user_login )
			return false;

		// verificar se é uma proposta nova
		if( !empty( $id_proposta ) )
		{
			// verificar se o usuário tem permissão para ver essa proposta
			if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se o usuário tem permissão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				$readonly = true;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				$readonly = true;

			$proposta = $SAV->get_proposta( $id_proposta );
			$id_author = $proposta['id_author'];
		}

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// validar os dados apenas após salvar a proposta
		$validar = true;

		$Validator = new Validator();

		// validate data
		if( $SAV->is_pessoa_juridica( $user->user_login ) )
		{
			$dados_empresa[ 'login' ]              = $user->user_login;
			$dados_empresa[ 'nome' ]               = $Validator->validate( $_POST[ 'razao_social' ],	   'Razão social',		   'required=1&max_length=150' );
			$dados_empresa[ 'ra' ]                 = $Validator->validate( $_POST[ 'ra' ],                 'Registro Ancine',      'required=0&max_length=15' );
			$dados_empresa[ 'cpf_representante' ]  = $Validator->validate( $_POST[ 'cpf_representante' ],  'CPF do Representante', 'required=1&cpf=1' );
			$dados_empresa[ 'nome_representante' ] = $Validator->validate( $_POST[ 'nome_representante' ], 'Representante Legal',  'required=1&max_length=100' );
			//$dados_empresa[ 'natureza' ]		   = $Validator->validate( $_POST[ 'natureza' ], 		   'Natureza da Entidade', 'required=1&max_length=100' );

			$nicename 	  = sanitize_title( $dados_empresa[ 'nome' ] );
			$display_name = $dados_empresa[ 'nome' ];

			$verifica_empresa = $SAV->get_dados_empresa( $user_login );

			if ($verifica_empresa['natureza'] == 1 or $verifica_empresa['natureza'] == 2 )
			{
				$dados_ong['login']					= $user->user_login;
				$dados_ong['numero_siconv']			= $Validator->validate( $_POST[ 'numero_siconv' ],	   'Número Siconv',		   'required=1&max_length=30' );
				$dados_ong['objeto_social']			= $Validator->validate( $_POST[ 'objeto_social' ], 	   'Objeto Social',  	   'required=1&max_length=3000' );

				//  anexo: estatuto social
				if( $anexo_estatuto = $SAV->upload_anexo( 'estatuto_social', 'Anexo: Estatuto Social', 2100000 ) )
				{
					$dados_ong['estatuto_social'] = $anexo_estatuto['url'];
				}
				elseif( "estatuto_social" != $_POST["check_estatuto_social"] )
				{
					$dados_ong['estatuto_social'] = "";
					$Validator->validate( $dados_ong['estatuto_social'], 		'Anexo: Estatuto Social', 			'required=1' );
				}

				// anexo: tempo de atividade
				if( $anexo_atividade = $SAV->upload_anexo( 'tempo_atividade', 'Anexo: Tempo Atividade', 2100000 ) )
				{
					$dados_ong['tempo_atividade'] =  $anexo_atividade['url'];
				}
				elseif( "tempo_atividade" != $_POST["check_tempo_atividade"] )
				{
					$dados_ong['tempo_atividade'] = "";
					$Validator->validate( $dados_ong['tempo_atividade'], 		'Anexo: Tempo Atividade', 			'required=1' );
				}

				// anexo: comprovacao de capacidade
				if( $anexo_capacidade = $SAV->upload_anexo( 'comprovacao_capacidade', 'Anexo: Comprovação de Capacidade', 2100000 ) )
				{
					$dados_ong['comprovacao_capacidade'] =  $anexo_capacidade['url'];
				}
				elseif( "comprovacao_capacidade" != $_POST["check_comprovacao_capacidade"] )
				{
					$dados_ong['comprovacao_capacidade'] = "";
					$Validator->validate( $dados_ong['comprovacao_capacidade'], 'Anexo: Comprovação de Capacidade', 'required=1' );
				}
			}
		}

		if( $SAV->is_pessoa_fisica( $user->user_login ) )
		{
			$dados_pessoais[ 'login' ]             = $user->user_login;
			$dados_pessoais[ 'nome' ]              = $Validator->validate( $_POST[ 'nome' ] , 			   'Nome', 			'required=1&max_length=150' );
			$dados_pessoais[ 'rg' ]                = $Validator->validate( $_POST[ 'rg' ],                 'RG',            'required=1&max_length=15&numeric=0'  );
			$dados_pessoais[ 'nascimento' ]        = $Validator->validate( $_POST[ 'nascimento' ],         'Nascimento',    'required=1&max_length=100' );
			$dados_pessoais[ 'naturalidade' ]      = $Validator->validate( $_POST[ 'naturalidade' ],       'Naturalidade',  'required=1&max_length=100' );
			$dados_pessoais[ 'nacionalidade' ]     = $Validator->validate( $_POST[ 'nacionalidade' ],      'Nacionalidade', 'required=0&max_length=100' );

			// formato da data
			if( preg_match( '/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/', $_POST[ 'nascimento' ] ) )
				$dados_pessoais[ 'nascimento' ]        = preg_replace( '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', '$3-$2-$1', $_POST[ 'nascimento' ] );

			$nicename 	  = sanitize_title( $dados_pessoais[ 'nome' ] );
			$display_name = $dados_pessoais[ 'nome' ];
		}

		$dados_contato[ 'login' ]                = $user->user_login;
		$dados_contato[ 'site' ]                 = $user->user_url;
		$dados_contato[ 'email' ]                = $Validator->validate( $_POST[ 'email' ],     	     'E-mail',       		 'required=1&max_length=100&email=1' );
		$dados_contato[ 'ddd_telefone' ]         = $Validator->validate( $_POST[ 'ddd_telefone' ],       'DDD Telefone',         'required=1&length=2&numeric=1' );
		$dados_contato[ 'telefone' ]             = $Validator->validate( $_POST[ 'telefone' ],           'Telefone',             'required=1&max_length=10' );
		$dados_contato[ 'ddd_celular' ]          = $Validator->validate( $_POST[ 'ddd_celular' ],        'DDD Celular',          'required=0&length=2&numeric=1' );
		$dados_contato[ 'celular' ]              = $Validator->validate( $_POST[ 'celular' ],            'Celular',              'required=0&max_length=10' );

		$dados_geograficos[ 'login' ]            = $user->user_login;
		$dados_geograficos[ 'endereco' ]         = $Validator->validate( $_POST[ 'endereco' ],           'Endereço',             'required=1&max_length=100' );
		$dados_geograficos[ 'bairro' ]           = $Validator->validate( $_POST[ 'bairro' ],             'Bairro',               'required=1&max_length=100' );
		$dados_geograficos[ 'cep' ]              = $Validator->validate( $_POST[ 'cep' ],                'CEP',                  'required=1&length=8&numeric=1' );
		$dados_geograficos[ 'cidade' ]           = $Validator->validate( $_POST[ 'cidade' ],             'Cidade',               'required=1&max_length=100' );
		$dados_geograficos[ 'estado' ]           = $Validator->validate( $_POST[ 'estado' ],             'UF',                   'required=1&max_length=20' );
		//$dados_geograficos[ 'pais' ]             = $Validator->validate( $_POST[ 'pais' ],               'País',                 'required=0&max_length=100' );
		//$dados_geograficos[ 'pais' ]    		 = 'Brasil';

		if ( $dados_empresa['natureza'] != 1 and $dados_empresa['natureza'] != 2 )
		{
			$dados_profissionais[ 'login' ]          = $user->user_login;
			$dados_profissionais[ 'formacao' ]       = $Validator->validate( $_POST[ 'formacao' ],           'Formação',             'required=0&max_length=100' );
			$dados_profissionais[ 'ocupacao' ]       = $Validator->validate( $_POST[ 'ocupacao' ],           'Ocupação',             'required=0&max_length=100' );
			$dados_profissionais[ 'interesse' ]      = $Validator->validate( $_POST[ 'interesse' ],          'Interesse',            'required=0&max_length=100' );
			$dados_profissionais[ 'biografia' ]      = $Validator->validate( $_POST[ 'biografia' ],          'Biografia',            'required=0&max_length=250' );
		}

		$SAV->error = $Validator->error();

		// update user_nicename
		$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->users} SET user_nicename = %s, display_name = %s, user_email = %s WHERE ID = %d LIMIT 1", $nicename, $display_name, $dados_contato[ 'email' ], $user_id ) );

		// update first name
		update_user_meta( $user_id, first_name, $display_name );

		//salvar dados pessoa física
		if( $SAV->is_pessoa_fisica( $user->user_login ) )
			$SAV->update_dados_pessoais( $dados_pessoais );

		//salvar dados pessoa jurídica
		if( $SAV->is_pessoa_juridica( $user->user_login ) )
		{
			$SAV->update_dados_empresa( $dados_empresa );

			//verifca se a natureza da empresa é ong
			if ($verifica_empresa['natureza'] == 1 or $verifica_empresa['natureza'] == 2 )
			{
				$SAV->update_dados_ong( $dados_ong );
			}
		}

		$SAV->update_dados_contato( $dados_contato );
		$SAV->update_dados_geograficos( $dados_geograficos );
		$SAV->update_dados_profissionais( $dados_profissionais );

		// ir para o próximo passo
		if( isset( $_POST[ 'next' ] ) and $validar )
		{
			// se tiver algum erro, não vá para a próxima página
			if( !empty( $SAV->error ) )
				return false;

			$proximo = $this->proximo_passo( "dados_concorrente" );

			if( !empty($id_proposta) )
			{
				wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$proximo}&sussa=1" ); exit();
			}
			else
			{
				wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&passo={$proximo}&sussa=1" ); exit();
			}
		}

		//atualiza a página
		if( !empty($id_proposta) )
		{
			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&sussa=1" ); exit();
		}
		else
		{
			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&sussa=1" ); exit();
		}

	}



	/**
	 * formulario proposta dados gerais
	 *
	 * @name    formulario_proposta_dados_gerais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-18
	 * @updated 2012-02-10
	 * @return  void
	 */
	function formulario_proposta_dados_gerais( $id_edital, $id_proposta = 0 )
	{
		global $SAV, $wpdb, $user_ID;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se é uma proposta nova
		if( !empty( $id_proposta ) )
		{
			// verificar se o usuário tem permissão para ver essa proposta
			if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se o usuário tem permissão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				$readonly = true;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				$readonly = true;
		}

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// verificar se a proposta já existe
		if( !empty( $id_proposta ) )
			$proposta = $SAV->get_proposta( $id_proposta );

		$roteiro_cinema   = $SAV->get_edital_meta( $id_edital, 'roteiro_cinema' );
		$direcao_cinema   = $SAV->get_edital_meta( $id_edital, 'direcao_cinema' );
		$producao_cinema  = $SAV->get_edital_meta( $id_edital, 'producao_cinema' );
		$chamada_convenio = $SAV->get_edital_meta( $id_edital, 'chamada_convenio' );

		?>

		<form id="inscricao" method="post" enctype="multipart/form-data">
			<input type="hidden" name="acao" value="salvar_proposta_dados_gerais" />
			<input type="hidden" name="id_edital" value="<?php print $id_edital; ?>" />
			<input type="hidden" name="id_proposta" value="<?php print $id_proposta; ?>" />
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
			<div class="metabox-holder">

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'dados_gerais' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

				<h4>Dados do Projeto</h4>
				<div class="postbox">
					<div class="inside">
						<table width="100%" cellspacing="15px">

							<tr valign="top">
								<td align="right" width="30%">
									<label for="titulo">Título da Proposta *</label>
								</td>
								<td colspan="3">
									<input type="text" id="titulo" name="titulo" value='<?php print $proposta[ "titulo" ]; ?>' size="50" maxlength="100" tabindex="1" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
								</td>
							</tr>
							<?php if( $chamada_convenio ) : ?>
								<tr valign="top">
									<td align="right">
										<label for="descricao">Síntese do Projeto *</label>
										<p class="description">máximo de 600 caracteres</p>
									</td>
									<td colspan="3">
										<textarea id="descricao" name="descricao" cols="50" rows="5" tabindex="1" maxlength="600" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $proposta[ 'descricao' ]; ?></textarea>
									</td>
								</tr>
							<?php elseif( !$roteiro_cinema ) : ?>
								<tr valign="top">
									<td align="right">
										<label for="descricao">Resumo do Argumento *<a href="#duvida_resumo_argumento" class="duvida">?</a></label>
										<div id="duvida_resumo_argumento" title="Resumo do Argumento" class="hidden">
											<p>Texto articulado dramaturgicamente que expresse o tema ou o enredo do filme, com base em adaptação literária ou não; </p>
										</div>
										<p class="description">máximo de 600 caracteres</p>
									</td>
									<td colspan="3">
										<textarea id="descricao" name="descricao" cols="50" rows="5" tabindex="1" maxlength="600" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $proposta[ 'descricao' ]; ?></textarea>
									</td>
								</tr>
							<?php else : ?>
								<tr valign="top">
									<td align="right">
										<label for="descricao">Sinopse * <a href="#duvida_sinopse" class="duvida">?</a></label>
										<div id="duvida_sinopse" title="Sinopse" class="hidden">
											<p>Texto articulado dramaturgicamente que expresse o tema ou o enredo do filme, com base em adaptação literária ou não; </p>
										</div>
										<p class="description">máximo de 3000 caracteres</p>
									</td>
									<td colspan="3">
										<textarea id="descricao" name="descricao" cols="50" rows="5" tabindex="1" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $proposta[ 'descricao' ]; ?></textarea>
									</td>
								</tr>
							<?php endif; ?>

							<?php if( !$chamada_convenio ) : ?>

								<?php $limite_contrapartida = $SAV->get_edital_meta( $id_edital, 'limite_contrapartida' ); ?>
								<?php $limite_projeto_total = $SAV->get_edital_meta( $id_edital, 'limite_orcamento_cinema' ); ?>

								<tr valign="top">
									<td align="right">
										<label for="contrapartida">Descrição da Contrapartida * <a href="#duvida_contrapartida" class="duvida">?</a></label>
										<div id="duvida_contrapartida" title="Contrapartida" class="hidden">
											<p>Recursos financeiros ou bens e serviços economicamente mensuráveis equivalente a 20% (vinte por cento) do valor total do projeto conforme definido no art. 12 do Decreto no. 5.761/2006.</p>
											<p>Exemplo: se o valor total da sua proposta for R$ <?php print $SAV->mysql_para_moeda( $limite_projeto_total ); ?>, o valor mínimo da contrapartida será de R$ <?php print $SAV->mysql_para_moeda( $limite_contrapartida ); ?>.</p>
											<p>Para mais informações, consulte as <a href="http://www.cultura.gov.br/audiovisual/fomento/perguntas-frequentes/" target="_blank">perguntas frequentes</a>.</p>
										</div>
										<p class="description">máximo de 3000 caracteres</p>
									</td>
									<td colspan="3">
										<textarea id="contrapartida" name="contrapartida" cols="50" rows="5" tabindex="2" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $proposta[ 'contrapartida' ]; ?></textarea>
									</td>
								</tr>
							<?php endif; ?>

						</table>
					</div>
				</div>

				<?php if( $producao_cinema ) $this->formulario_proposta_dados_producao( $id_edital, $id_proposta ); ?>

				<?php if( $direcao_cinema ) $this->formulario_proposta_dados_direcao( $id_edital, $id_proposta ); ?>

				<?php if( $roteiro_cinema ) $this->formulario_proposta_dados_roteiro( $id_edital, $id_proposta ); ?>

				<?php if( $chamada_convenio) $this->formulario_proposta_chamada_convenio( $id_edital, $id_proposta ); ?>

				<?php if( !$chamada_convenio) : //não mostrar dados complementares e anexos se for chamada_convenio ?>
					<h4>Dados Complementares</h4>
					<div class="postbox">
						<div class="inside">
							<table width="100%" cellspacing="15px">

								<?php if( $direcao_cinema ) : ?>
									<?php $genero = $SAV->get_proposta_meta( $id_proposta, 'genero' ); ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="genero">Gênero: *</label>
										</td>
										<td colspan="3">
											<label><input type="radio" id="genero" name="genero" value="Ficção" <?php if( 'Ficção' == $genero ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Ficção</label>
											<label><input type="radio" id="genero" name="genero" value="Documentário" <?php if( 'Documentário' == $genero ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Documentário</label>
											<label><input type="radio" id="genero" name="genero" value="Animação" <?php if( 'Animação' == $genero ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Animação</label>
										</td>
									</tr>
								<?php endif; ?>

								<?php if( $producao_cinema ) : ?>
									<?php $animacao = $SAV->get_proposta_meta( $id_proposta, 'animacao' ); ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="animacao">Utiliza Técnicas de Animação:</label>
										</td>
										<td colspan="3">
											<label><input type="radio" id="animacao" name="animacao" value="Uso Parcial de Animação" <?php if( 'Uso Parcial de Animação' == $animacao ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Uso Parcial de Animação</label>
											<label><input type="radio" id="animacao" name="animacao" value="Uso Total de Animação" <?php if( 'Uso Total de Animação' == $animacao ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Uso Total de Animação</label>
										</td>
									</tr>
								<?php endif; ?>

								<?php if( !$roteiro_cinema ) : ?>
									<?php $distribuicao = $SAV->get_proposta_meta( $id_proposta, 'distribuicao' ); ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="distribuicao">Distribuição: *</label>
										</td>
										<td colspan="3">
											<label><input type="checkbox" id="distribuicao" name="distribuicao[]" value="Cinema" <?php if( in_array( 'Cinema', $distribuicao ) ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Cinema</label>
											<label><input type="checkbox" id="distribuicao" name="distribuicao[]" value="Televisão" <?php if( in_array( 'Televisão', $distribuicao ) ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> TV</label>
											<label><input type="checkbox" id="distribuicao" name="distribuicao[]" value="Internet" <?php if(  in_array( 'Internet', $distribuicao ) ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Internet</label>
											<label><input type="checkbox" id="distribuicao" name="distribuicao[]" value="Cinecluve" <?php if(  in_array( 'Cinecluve', $distribuicao ) ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Cineclube</label>
											<label><input type="checkbox" id="distribuicao" name="distribuicao[]" value="Outros" <?php if(  in_array( 'Outros', $distribuicao ) ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Outros</label>
										</td>
									</tr>
								<?php endif; ?>

								<?php if( $roteiro_cinema ) : ?>
									<?php $infantil = $SAV->get_proposta_meta( $id_proposta, 'infantil' ); ?>
									<tr valign="top">
										<td align="right" width="30%">
											<label for="infantil">Temática:</label>
										</td>
										<td colspan="3">
											<label><input type="checkbox" id="infantil" name="infantil" value="Infantil" <?php if( 'Infantil' == $infantil ) print 'checked="checked"'; ?> tabindex="8" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Infantil</label>
										</td>
									</tr>
								<?php endif; ?>
							</table>
						</div>
					</div>

					<h4>Anexos</h4>

					<div class="postbox">
						<div class="inside">
							<table width="100%" cellspacing="15px">

								<tr valign="top">
									<td align="right" width="30%">
										<label for="anexo_roteiro">Roteiro ou Argumento *</label>
										<p class="description">apenas arquivos no formato .pdf com no máximo 1MB</p>
									</td>
									<td colspan="3">
										<?php $roteiro = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_roteiro' ); ?>
										<?php if( !empty( $roteiro ) ) : ?>
											<input type="checkbox" value="anexo_roteiro" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
											<em><a href="<?php print $roteiro[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $roteiro[ 'url' ] ); ?></a></em>
										<?php endif; ?>

										<?php if( !$readonly ) : ?>
											<input type="file" id="anexo_roteiro" name="anexo_roteiro" tabindex="9" />
										<?php endif; ?>
									</td>
								</tr>

								<?php if( !$roteiro_cinema ) : ?>
									<tr valign="top">
										<td align="right">
											<label for="anexo_direitos_filmagem">Cessão de Direitos de Filmagem *</label>
											<p class="description">apenas arquivos no formato .pdf com no máximo 1MB</p>
										</td>
										<td colspan="3">
											<?php $direitos_filmagem = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_direitos_filmagem' ); ?>
											<?php if( !empty( $direitos_filmagem ) ) : ?>
												<input type="checkbox" value="anexo_direitos_filmagem" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<em><a href="<?php print $direitos_filmagem[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $direitos_filmagem[ 'url' ] ); ?></a></em>
											<?php endif; ?>

											<?php if( !$readonly ) : ?>
												<input type="file" id="anexo_direitos_filmagem" name="anexo_direitos_filmagem" tabindex="9" />
											<?php endif; ?>
										</td>
									</tr>
								<?php endif; ?>

								<tr valign="top">
									<td align="right">
										<label for="anexo_direitos_adaptacao">Cessão de Direitos de Adaptação (se necessário)</label>
										<p class="description">apenas arquivos no formato .pdf com no máximo 1MB</p>
									</td>
									<td colspan="3">
										<?php $direitos_adaptacao = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_direitos_adaptacao' ); ?>
										<?php if( !empty( $direitos_adaptacao ) ) : ?>
											<input type="checkbox" value="anexo_direitos_adaptacao" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
											<em><a href="<?php print $direitos_adaptacao[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $direitos_adaptacao[ 'url' ] ); ?></a></em>
										<?php endif; ?>

										<?php if( !$readonly ) : ?>
											<input type="file" id="anexo_direitos_adaptacao" name="anexo_direitos_adaptacao" tabindex="9" />
										<?php endif; ?>
									</td>
								</tr>

								<?php if( !$roteiro_cinema ) : ?>
									<tr valign="top">
										<td align="right">
											<label for="anexo_storyboard">StoryBoard (se animação)</label>
											<p class="description">apenas arquivos no formato .pdf com no máximo 5MB</p>
										</td>
										<td colspan="3">
											<?php $storyboard = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_storyboard' ); ?>
											<?php if( !empty( $storyboard ) ) : ?>
												<input type="checkbox" value="anexo_storyboard" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<em><a href="<?php print $storyboard[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $storyboard[ 'url' ] ); ?></a></em>
											<?php endif; ?>

											<?php if( !$readonly ) : ?>
												<input type="file" id="anexo_storyboard" name="anexo_storyboard" tabindex="9" />
											<?php endif; ?>
										</td>
									</tr>

									<tr valign="top">
										<td align="right">
											<label for="anexo_pesquisa">Pesquisa sobre o tema (se documentário)</label>
											<p class="description">apenas arquivos no formato .pdf com no máximo 1MB</p>
										</td>
										<td colspan="3">
											<?php $pesquisa = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_pesquisa' ); ?>
											<?php if( !empty( $pesquisa ) ) : ?>
												<input type="checkbox" value="anexo_pesquisa" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<em><a href="<?php print $pesquisa[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $pesquisa[ 'url' ] ); ?></a></em>
											<?php endif; ?>

											<?php if( !$readonly ) : ?>
												<input type="file" id="anexo_pesquisa" name="anexo_pesquisa" tabindex="9" />
											<?php endif; ?>
										</td>
									</tr>
								<?php endif; ?>

								<tr valign="top">
									<td align="right">
										<label for="anexo_registro_fbn">Certificado (ou Protocolo) de Registro na FBN *</label>
										<p class="description">apenas arquivos no formato .pdf com no máximo 1MB</p>
									</td>
									<td colspan="3">
										<?php $registro_fbn = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_registro_fbn' ); ?>
										<?php if( !empty( $registro_fbn ) ) : ?>
											<input type="hidden" name="registro_fbn" value="<?php print $registro_fbn; ?>" />
											<input type="checkbox" value="anexo_registro_fbn" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
											<em><a href="<?php print $registro_fbn[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $registro_fbn[ 'url' ] ); ?></a></em>
										<?php endif; ?>

										<?php if( !$readonly ) : ?>
											<input type="file" id="anexo_registro_fbn" name="anexo_registro_fbn" tabindex="9" />
										<?php endif; ?>
									</td>
								</tr>

								<?php if( '2' == $id_edital OR '5' == $id_edital) : ?>
									<tr valign="top">
										<td align="right">
											<label for="anexo_orcamento">Orçamento (opcional)</label>
											<p class="description">apenas arquivos no formato .pdf com no máximo 1MB</p>
										</td>
										<td colspan="3">
											<?php $anexo_orcamento = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_orcamento' ); ?>
											<?php if( !empty( $anexo_orcamento ) ) : ?>
												<input type="checkbox" value="anexo_orcamento" class="show-hide" checked="checked" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<em><a href="<?php print $anexo_orcamento[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $anexo_orcamento[ 'url' ] ); ?></a></em>
											<?php endif; ?>

											<?php if( !$readonly ) : ?>
												<input type="file" id="anexo_orcamento" name="anexo_orcamento" tabindex="10" />
											<?php endif; ?>
										</td>
									</tr>
								<?php endif; ?>

							</table>
						</div>
					</div>
				<?php endif; ?>

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'dados_gerais' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

			</div>
		</form>
		<?php
	}

	/**
	 * salvar proposta dados gerais
	 *
	 * @name    salvar_proposta_dados_gerais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-22
	 * @updated 2012-02-15
	 * @return  void
	 */
	function salvar_proposta_dados_gerais( $id_edital, $id_proposta = 0 )
	{
		global $SAV, $wpdb, $user_ID;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se é uma proposta nova
		if( !empty( $id_proposta ) )
		{
			// verificar se o usuário tem permisão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				return false;

			// validar os dados apenas após salvar a proposta
			$validar = true;
		}

		$Validator = new Validator();

		// verificar extensões
		$roteiro_cinema   = $SAV->get_edital_meta( $id_edital, 'roteiro_cinema' );
		$direcao_cinema   = $SAV->get_edital_meta( $id_edital, 'direcao_cinema' );
		$producao_cinema  = $SAV->get_edital_meta( $id_edital, 'producao_cinema' );
		$chamada_convenio = $SAV->get_edital_meta( $id_edital, 'chamada_convenio' );

		// validar dodos
		$proposta[ 'id_edital' ]     = $id_edital;
		$proposta[ 'id_proposta' ]   = $id_proposta;
		$proposta[ 'titulo' ]        = $Validator->validate( $SAV->limpar_texto( $_POST[ 'titulo' ] ), 'Nome do Projeto', 'required=1&max_length=100' );
		if ( !$chamada_convenio )
			$proposta[ 'contrapartida' ] = $Validator->validate( $SAV->limpar_texto( $_POST[ 'contrapartida' ] ), 'Descrição Contrapartida', 'required=1&max_length=3000' );
		$proposta[ 'status' ]        = 'parcial';

		if( $chamada_convenio )
		{
			$proposta[ 'descricao' ]   = $Validator->validate( $SAV->limpar_texto( $_POST[ 'descricao' ] ), 'Síntese do Projeto', 'required=1&max_length=3000' );
		}
		elseif( !$roteiro_cinema )
		{
			$proposta[ 'descricao' ]   = $Validator->validate( $SAV->limpar_texto( $_POST[ 'descricao' ] ), 'Resumo do Argumento', 'required=1&max_length=600' );

			$distribuicao              = $_POST[ 'distribuicao' ];
		}
		else
		{
			$proposta[ 'descricao' ]   = $Validator->validate( $SAV->limpar_texto( $_POST[ 'descricao' ] ), 'Sinopse', 'required=1&max_length=3000' );
		}

		if( $roteiro_cinema )
			$infantil                  = $Validator->validate( $_POST[ 'infantil' ], 'Temática', 'required=0&max_length=100' );

		if( $producao_cinema )
			$animacao                  = $Validator->validate( $_POST[ 'animacao' ], 'Técnicas de Animação', 'required=0&max_length=100' );

		if( $direcao_cinema )
			$genero                    = $Validator->validate( $_POST[ 'genero' ], 'Genero', 'required=1&max_length=100' );

		// se for uma proposta nova, verificar se o usuário já não excedeu o limite de propostas
		if( empty( $proposta[ 'id_proposta' ] ) and !$SAV->proponente_pode_cadastrar_nova_proposta( $id_edital, $user_ID ) )
			return false;

		// adicionar/atualizar proposta
		$id_proposta = $SAV->update_proposta( $proposta );

		// encerrar cadastro caso a proposta não tenha sido retornada
		if( empty( $id_proposta ) )
		  return false;

		// adicionar/atualizar producao
		if( $producao_cinema )
			$this->salvar_proposta_dados_producao( $id_edital, $id_proposta );

		// adicionar/atualizar direcao
		if( $direcao_cinema )
			$this->salvar_proposta_dados_direcao( $id_edital, $id_proposta );

		// adicionar/atualizar roteiro
		if( $roteiro_cinema )
			$this->salvar_proposta_dados_roteiro( $id_edital, $id_proposta );

		// adicionar/atualizar chamada_convenio
		if( $chamada_convenio )
			$this->salvar_proposta_chamada_convenio( $id_edital, $id_proposta );

		if( !$chamada_convenio )
		{
			// adicionar/atualizar dados complementares
			$SAV->update_proposta_meta( $id_proposta, 'genero', $genero );
			$SAV->update_proposta_meta( $id_proposta, 'animacao', $animacao );
			$SAV->update_proposta_meta( $id_proposta, 'distribuicao', $distribuicao );
			$SAV->update_proposta_meta( $id_proposta, 'infantil', $infantil );

			// subir anexos
			$SAV->upload_anexo_proposta( $id_proposta, 'anexo_roteiro', 'Anexo: Roteiro ou Argumento' );
			$SAV->upload_anexo_proposta( $id_proposta, 'anexo_direitos_filmagem', 'Anexo: Direitos de Filmagem' );
			$SAV->upload_anexo_proposta( $id_proposta, 'anexo_direitos_adaptacao', 'Anexo: Direitos de Adaptação' );
			$SAV->upload_anexo_proposta( $id_proposta, 'anexo_storyboard', 'Anexo: StoryBoard', 5100000 );
			$SAV->upload_anexo_proposta( $id_proposta, 'anexo_pesquisa', 'Anexo: Pesquisa Sobre o Tema' );
			$SAV->upload_anexo_proposta( $id_proposta, 'anexo_registro_fbn', 'Anexo: Registro FBN' );
			$SAV->upload_anexo_proposta( $id_proposta, 'anexo_orcamento', 'Anexo: Orçamento' );

			// buscar anexos
			$anexo_roteiro            = $SAV->get_proposta_meta( $id_proposta, 'anexo_roteiro' );
			$anexo_direitos_filmagem  = $SAV->get_proposta_meta( $id_proposta, 'anexo_direitos_filmagem' );
			$anexo_direitos_adaptacao = $SAV->get_proposta_meta( $id_proposta, 'anexo_direitos_adaptacao' );
			$anexo_storyboard         = $SAV->get_proposta_meta( $id_proposta, 'anexo_storyboard' );
			$anexo_pesquisa           = $SAV->get_proposta_meta( $id_proposta, 'anexo_pesquisa' );
			$anexo_registro_fbn       = $SAV->get_proposta_meta( $id_proposta, 'anexo_registro_fbn' );
			$anexo_orcamento          = $SAV->get_proposta_meta( $id_proposta, 'anexo_orcamento' );

			// validar apenas os anexos salvos (caso o proponente tenha enviado os anexos anteriormente)
			$Validator->validate( $anexo_roteiro, 'Anexo: Roteiro ou Argumento', 'required=1' );
			$Validator->validate( $anexo_registro_fbn, 'Anexo: Registro na FBN', 'required=1' );

			if( !$roteiro_cinema )
				$Validator->validate( $anexo_direitos_filmagem, 'Anexo: Direitos de Filmagem', 'required=1' );
		}

		// adicionar os erros de validação
		$SAV->update_error( $Validator->error() );

		// ir para o próximo passo
		if( isset( $_POST[ 'next' ] ) and $validar )
		{
			// se tiver algum erro, não vá para a próxima página
			if( !empty( $SAV->error ) )
				return false;

			$proximo = $this->proximo_passo( "dados_gerais" );

			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$proximo}&sussa=1" ); exit();
		}

		// ir para o passo anterior
		if( isset( $_POST[ 'prev' ] ) )
		{
			$anterior = $this->passo_anterior( "dados_gerais" );

			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$anterior}&sussa=1" ); exit();
		}

		// atualizar página
		wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo=dados_gerais&sussa=1" ); exit();
	}

	/**
	 * formulario proposta chamada convenio
	 *
	 * @name    formulario_proposta_chamada_convenio
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-04-26
	 * @updated 2011-04-26
	 * @return  void
	 */
	function formulario_proposta_chamada_convenio( $id_edital, $id_proposta = 0 )
	{
		global $SAV, $wpdb, $user_ID;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se é uma proposta nova
		if( !empty( $id_proposta ) )
		{
			// verificar se o usuário tem permissão para ver essa proposta
			if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se o usuário tem permissão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				$readonly = true;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				$readonly = true;

			$convenio = $SAV->get_chamada_convenio( $id_proposta );
		}

		?>
			<h4>Dados Básicos para Apoio</h4>
			   <div class="postbox">
				   <div class="inside">
					   <table width="100%" cellspacing="15px">
							<tr valign="top">
								<td align="right" width="30%">
									<label for="macro_politicas">Macropolíticas estatégicas vinculadas à proposta * </label>
								</td>

								<?php if( is_serialized( $convenio['macro_politicas']  ) )
									$convenio['macro_politicas'] = maybe_unserialize( $convenio['macro_politicas']  );  ?>

								<td colspan="3">
									<label><input type="checkbox" id="macro_politicas" name="macro_politicas[]" value="inovacao_audiovisual" 		<?php if( in_array( 'inovacao_audiovisual', $convenio['macro_politicas'] ) ) print 'checked="checked"'; ?> tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?>    /> Política de Inovação Audiovisual</label>
									<p><label><input type="checkbox" id="macro_politicas" name="macro_politicas[]" value="desenvolvimento_sustentavel"	<?php if( in_array( 'desenvolvimento_sustentavel', $convenio['macro_politicas']) ) print 'checked="checked"'; ?> tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Política para o Desenvolvimento Sustentável do Setor Audiovisual brasileiro</label></p>
									<p><label><input type="checkbox" id="macro_politicas" name="macro_politicas[]" value="fomento_atividade" 			<?php if( in_array( 'fomento_atividade', $convenio['macro_politicas'] ) ) print 'checked="checked"'; ?> tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?>  /> Política de Fomento às Atividades Audiovisuais Brasileira</label></p>
									<p><label><input type="checkbox" id="macro_politicas" name="macro_politicas[]" value="acervos" 					<?php if( in_array( 'acervos', $convenio['macro_politicas'] ) ) print 'checked="checked"'; ?> tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Política de Preservação, Digitalização, Difusão e Acesso a Acervos Audiovisuais</label></p>
									<p><label><input type="checkbox" id="macro_politicas" name="macro_politicas[]" value="infancia_juventude"			<?php if( in_array( 'infancia_juventude', $convenio['macro_politicas'] ) ) print 'checked="checked"'; ?> tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?>    /> Política Audiovisual para a Infância e a Juventude</label></p>
									<p><label><input type="checkbox" id="macro_politicas" name="macro_politicas[]" value="internacional" 				<?php if( in_array( 'internacional', $convenio['macro_politicas'] ) ) print 'checked="checked"'; ?> tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?>    /> Política Internacional do Audiovisual</label></p>
									<p><label><input type="checkbox" id="macro_politicas" name="macro_politicas[]" value="capacitacao" 				<?php if( in_array( 'capacitacao', $convenio['macro_politicas'] ) ) print 'checked="checked"'; ?> tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?>    /> Política de Formação, Capacitação e Qualificação em todos os níveis dos Integrantes do Setor Audiovisual</label></p>
								</td>
							</tr>

							<tr valign="top">
								<td align="right" width="30%">
									<label for="objetivos">Objetivos * <a href="#duvida_objetivos" class="duvida">?</a></label>
										<div id="duvida_objetivos" title="Objetivos" class="hidden">
											<p>Definir com clareza o que se pretende alcançar com o projeto. </p>
										</div>
									<p class="description">máximo de 2.000 caracteres</p>
								</td>
								<td colspan="3">
									<textarea id="objetivos" name="objetivos" cols="50" rows="5" tabindex="1" maxlength="2000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $convenio[ 'objetivos' ]; ?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="justificativa">Justificativa * <a href="#duvida_justificativa" class="duvida">?</a></label>
										<div id="duvida_justificativa" title="Justificativa" class="hidden">
											<p>Fundamentar a pertinência e relevância do projeto, dando ênfase nos aspectos qualitativos e quantitativos.</p>
										</div>
									<p class="description">máximo de 2.000 caracteres</p>
								</td>
								<td colspan="3">
									<textarea id="justificativa" name="justificativa" cols="50" rows="5" tabindex="1" maxlength="2000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $convenio[ 'justificativa' ]; ?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="caracteristica_publico">Caracterização do público beneficiário e estimativa * <a href="#duvida_caracteristica_publico" class="duvida">?</a></label>
										<div id="duvida_caracteristica_publico" title="Caracterização do público beneficiário " class="hidden">
											<p>Qual público alvo do projeto?</p>
										</div>
									<p class="description">máximo de 1.500 caracteres</p>
								</td>
								<td colspan="3">
									<textarea id="caracteristica_publico" name="caracteristica_publico" cols="50" rows="5" tabindex="1" maxlength="1500" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $convenio[ 'caracteristica_publico' ]; ?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="acessibilidade">Ações de acessibilidade *<a href="#duvida_acessibilidade" class="duvida">?</a></label>
										<div id="duvida_acessibilidade" title="Ações de acessibilidade " class="hidden">
											<p>Intervenções que objetivem priorizar ou facilitar o livre acesso de idosos e pessoas com deficiência ou mobilidade reduzida, de modo a possibilitar-lhes o pleno exercício de seus direitos culturais, por meio da disponibilização ou adaptação de espaços, equipamentos, transporte, comunicação e quaisquer bens ou serviços às suas limitações físicas, sensoriais ou cognitivas de forma segura.</p>
										</div>
									<p class="description">máximo de 1.500 caracteres</p>
								</td>
								<td colspan="3">
									<textarea id="acessibilidade" name="acessibilidade" cols="50" rows="5" tabindex="1" maxlength="1500" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $convenio[ 'acessibilidade' ]; ?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="democratizacao_acesso">Ações de democratizaçao do acesso *<a href="#duvida_democratizacao_acesso" class="duvida">?</a></label>
										<div id="duvida_democratizacao_acesso" title="Ações de democratizaçao do acesso " class="hidden">
											<p>Ações que promovam acesso e fruição de bens, produtos e serviços culturais, bem como ao exercício de atividades profissionais, visando a atenção às camadas da população menos assistidas ou excluídas do exercício de seus direitos culturais por sua condição socioeconômica, etnia, deficiência, gênero, faixa etária, domicílio, ocupação, para cumprimento do disposto no art. 215 da Constituição Federal.</p>
										</div>
									<p class="description">máximo de 1.500 caracteres</p>
								</td>
								<td colspan="3">
									<textarea id="democratizacao_acesso" name="democratizacao_acesso" cols="50" rows="5" tabindex="1" maxlength="1500" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $convenio[ 'democratizacao_acesso' ]; ?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="metas_resultados">Metas e resultados esperados * </label>
									<p class="description">máximo de 2.000 caracteres</p>
								</td>
								<td colspan="3">
									<textarea id="metas_resultados" name="metas_resultados" cols="50" rows="5" tabindex="1" maxlength="2000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $convenio[ 'metas_resultados' ]; ?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="outras_informacoes">Outras Informações </label>
									<p class="description">máximo de 2.000 caracteres</p>
									<p class="description">opcional</p>
								</td>
								<td colspan="3">
									<textarea id="outras_informacoes" name="outras_informacoes" cols="50" rows="5" tabindex="1" maxlength="2000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $convenio[ 'outras_informacoes' ]; ?></textarea>
								</td>
							</tr>
							<tr valign="top">
								<td align="right" width="30%">
									<label for="valor_total">Valor total da proposta R$ * </label>
									<p class="description">inclusive contrapartida</p>
								</td>
								<td colspan="3">
									<input type="text" id="valor_total" name="valor_total" value="<?php print $SAV->mysql_para_moeda( $convenio[ 'valor_total' ] ); ?>" maxlength="14" size="15" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?>  />
								</td>
							</tr>
					   </table>
				   </div>
			   </div>

			   <h4>Anexo</h4>

				<div class="postbox convenio">
					<div class="inside">
						<table width="100%" cellspacing="15px">
							<tr valign="top">
								<td align="right" width="30%">
									<label for="cronograma_execucao">Cronograma de execução * </label>
								</td>
								<td colspan="3">
									<?php if( !empty( $convenio[ 'cronograma_execucao' ] ) ) : ?>
										<input type="checkbox" id="check_cronograma_execucao" name="check_cronograma_execucao" value="cronograma_execucao" class="show-hide" checked="checked" tabindex="3" <?php if( $readonly ) print 'disabled="disabled"';  ?> />
										<em><a href="<?php print $convenio[ 'cronograma_execucao' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $convenio[ 'cronograma_execucao' ] ); ?></a></em>
									<?php endif; ?>

									<?php if( !$readonly ) : ?>
										<input type="file" id="cronograma_execucao" name="cronograma_execucao" tabindex="1" />
										<p class="description">apenas arquivo no formato .pdf com no máximo 1MB</p>
									<?php endif; ?>
								</td>
							</tr>
						</table>
					</div>
				</div>


		<?php
	}

	/**
	 * salvar proposta chamada convenio
	 *
	 * @name    salvar_proposta_chamada_convenio
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-04-26
	 * @updated 2012-04-26
	 * @return  void
	 */
	function salvar_proposta_chamada_convenio( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se o usuário tem permisão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			return false;

		$Validator = new Validator();

		// validar dados
		$convenio['id_proposta']  			= ( int ) $id_proposta;
		$convenio['macro_politicas'] 		= $Validator->validate( $_POST[ 'macro_politicas' ] , 'Macropolíticas estatégicas vinculadas à proposta', 'required=1' );

		if( !is_serialized( $convenio['macro_politicas'] ) )
			$convenio['macro_politicas'] = maybe_serialize( $convenio['macro_politicas'] );

		$convenio['objetivos'] 				= $Validator->validate( $SAV->limpar_texto( $_POST[ 'objetivos' ] ), 'Objetivos', 'required=1&max_length=2000' );
		$convenio['justificativa'] 			= $Validator->validate( $SAV->limpar_texto( $_POST[ 'justificativa' ] ), 'Justificativa', 'required=1&max_length=2000' );
		$convenio['caracteristica_publico'] = $Validator->validate( $SAV->limpar_texto( $_POST[ 'caracteristica_publico' ] ), 'Caracterização do público beneficiário', 'required=1&max_length=1500' );
		$convenio['acessibilidade'] 		= $Validator->validate( $SAV->limpar_texto( $_POST[ 'acessibilidade' ] ), 'Ações de acessibilidade', 'required=1&max_length=1500' );
		$convenio['democratizacao_acesso']  = $Validator->validate( $SAV->limpar_texto( $_POST[ 'democratizacao_acesso' ] ), 'Ações de democratização do acesso', 'required=1&max_length=1500' );
		$convenio['metas_resultados']  		= $Validator->validate( $SAV->limpar_texto( $_POST[ 'metas_resultados' ] ), 'Metas e resultados esperados', 'required=1&max_length=2000' );
		$convenio['outras_informacoes'] 	= $Validator->validate( $SAV->limpar_texto( $_POST[ 'outras_informacoes' ] ), 'Outras informações', 'required=0&max_length=2000' );
		$convenio['valor_total'] 			= $Validator->validate( $SAV->moeda_para_mysql( $_POST[ 'valor_total' ] ), 'Valor total do projeto', 'required=1&max_length=14' );

			$anexo = $SAV->upload_anexo( "experiencia_comprovante_{$index}", "Comprovante da Obra #{$index}" );


		$anexo_cronograma = $SAV->upload_anexo( 'cronograma_execucao', 'Anexo: Cronograma de Execução' );

		//  anexo: cronograma de execução
		if( !empty($anexo_cronograma) )
		{
			$convenio['cronograma_execucao'] = $anexo_cronograma['url'];
		}
		elseif( "cronograma_execucao" != $_POST["check_cronograma_execucao"] )
		{
			$convenio['cronograma_execucao'] = "";
			$Validator->validate( $convenio['cronograma_execucao'], 'Anexo: Cronograma de Execução', 'required=1' );

		}else {
			$convenio['cronograma_execucao'] = $wpdb->get_var( $wpdb->prepare( "SELECT cronograma_execucao FROM {$wpdb->sav_chamada_convenio}  WHERE id_proposta = %d LIMIT 1", $id_proposta ) );
		}

		// adicionar/atualizar chamada_convenio
		$SAV->update_chamada_convenio( $convenio );

		// adicionar mensagens de erro
		$SAV->update_error( $Validator->error() );
	}

	/**
	 * formulario proposta dados producao
	 *
	 * @name    formulario_proposta_dados_producao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-23
	 * @updated 2011-12-22
	 * @return  void
	 */
	function formulario_proposta_dados_producao( $id_edital, $id_proposta = 0 )
	{
		global $SAV, $wpdb, $user_ID;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se é uma proposta nova
		if( !empty( $id_proposta ) )
		{
			// verificar se o usuário tem permissão para ver essa proposta
			if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se o usuário tem permissão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				$readonly = true;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				$readonly = true;
		}

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// verificar se a proposta já existe
		if( !empty( $id_proposta ) )
			$producao = $SAV->get_producao_cinema( $id_proposta );

		?>
			<h4>Proposta de Produção</h4>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">

						<tr valign="top">
							<td align="right" width="30%">
								<label for="plano_producao">Plano de Produção do Filme * <a href="#duvida_plano_de_producao" class="duvida">?</a></label>
								<div id="duvida_plano_de_producao" title="Plano de Produção" class="hidden">
									<p>Definição dos períodos de pré-produção, produção e pósprodução/finalização da obra, que deve ser executável em 365 (trezentos e cinqüenta e cinco) dias;</p>
								</div>
								<p class="description">máximo de 3.000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="plano_producao" name="plano_producao" cols="50" rows="5" tabindex="3" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $producao[ 'plano_producao' ]; ?></textarea>
							</td>
						</tr>

						<tr valign="top">
							<td align="right">
								<label for="viabilidade_orcamentaria">Viabilidade de Execução Orçamentária * <a href="#duvida_viabilidade_orcamentaria" class="duvida">?</a></label>
								<div id="duvida_viabilidade_orcamentaria" title="Viabilidade de Execução Orçamentária" class="hidden">
									<p>Descrever a execução do filme e sua compatibilidade com o orçamento solicitado.  Mostrar como pretende realizar o filme dentro dos limites orçamentários;</p>
								</div>
								<p class="description">máximo de 3.000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="viabilidade_orcamentaria" name="viabilidade_orcamentaria" cols="50" rows="5" tabindex="4" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $producao[ 'viabilidade_orcamentaria' ]; ?></textarea>
							</td>
						</tr>

						<tr valign="top">
							<td align="right">
								<label for="estrategia_producao">Estratégia de Produção *<a href="#duvida_estrategia_producao" class="duvida">?</a></label>
								<div id="duvida_estrategia_producao" title="Estratégia de Produção" class="hidden">
									<p>Descrição da equipe técnica e características do elenco, dentre outras informações consideradas relevantes para o filme;</p>
								</div>
								<p class="description">máximo de 6.000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="estrategia_producao" name="estrategia_producao" cols="50" rows="5" tabindex="5" maxlength="6000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $producao[ 'estrategia_producao' ]; ?></textarea>
							</td>
						</tr>

					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * salvar proposta dados producao
	 *
	 * @name    salvar_proposta_dados_producao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-23
	 * @updated 2011-12-22
	 * @return  void
	 */
	function salvar_proposta_dados_producao( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se o usuário tem permisão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			return false;

		$Validator = new Validator();

		// validar dodos
		$producao[ 'id_proposta' ]              = ( int ) $id_proposta;

		$producao[ 'plano_producao' ]           = $Validator->validate( $SAV->limpar_texto( $_POST[ 'plano_producao' ] ), 'Proposta de Produção do Filmes', 'required=1&max_length=3000' );
		$producao[ 'estrategia_producao' ]      = $Validator->validate( $SAV->limpar_texto( $_POST[ 'estrategia_producao' ] ), 'Estratégia de Produção', 'required=1&max_length=6000' );
		$producao[ 'viabilidade_orcamentaria' ] = $Validator->validate( $SAV->limpar_texto( $_POST[ 'viabilidade_orcamentaria' ] ), 'Viabilidade de Execução Orçamentária', 'required=1&max_length=3000' );;

		// adicionar/atualizar producao
		$SAV->update_producao_cinema( $producao );

		// adicionar mensagens de erro
		$SAV->update_error( $Validator->error() );
	}

	/**
	 * formulario proposta dados direcao
	 *
	 * @name    formulario_proposta_dados_direcao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-20
	 * @updated 2011-12-22
	 * @return  void
	 */
	function formulario_proposta_dados_direcao( $id_edital, $id_proposta = 0 )
	{
		global $SAV, $wpdb, $user_ID;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se é uma proposta nova
		if( !empty( $id_proposta ) )
		{
			// verificar se o usuário tem permissão para ver essa proposta
			if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se o usuário tem permissão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				$readonly = true;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				$readonly = true;
		}

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// verificar se a proposta já existe
		if( !empty( $id_proposta ) )
			$producao = $SAV->get_direcao_cinema( $id_proposta );

		$suportes_captacao = array(
			'Super 16 mm' => 'Super 16 mm',
			'35 mm'       => '35 mm',
			'2k'          => '2k',
			'4k'          => '4k',
			'HDCAM'       => 'HDCAM',
			'HDCAM SR'    => 'HDCAM SR',
			'XDCAM'       => 'XDCAM',
			'XDCAM EX'    => 'XDCAM EX',
			'DVCPRO HD'   => 'DVCPRO HD',
			'HDV'         => 'HDV',
			'AVCHD'       => 'AVCHD',
		);

		$suportes_finalizacao = array(
			'35 mm'       => '35 mm',
			'HDCAM'       => 'HDCAM',
			'HDCAM SR'    => 'HDCAM SR',
		);

		?>

			<h4>Detalhamento Técnico do Filme</h4>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">

						<tr valign="top">
							<td align="right" width="30%">
								<label for="suporte_captacao">Suporte Captação *</label>
							</td>
							<td colspan="3">
								<select id="suporte_captacao" name="suporte_captacao" tabindex="6" <?php if( $readonly ) print 'disabled="disabled"'; ?>>
									<?php foreach( $suportes_captacao as $key => $nome ) : ?>
										<option value="<?php print $key; ?>" <?php if( $producao[ 'suporte_captacao' ] == $key ) print 'selected="selected"'; ?>><?php print $nome; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>

						<tr valign="top">
							<td align="right">
								<label for="suporte_finalizacao">Suporte Finalizacao *</label>
							</td>
							<td>
								<select id="suporte_finalizacao" name="suporte_finalizacao" tabindex="7" <?php if( $readonly ) print 'disabled="disabled"'; ?>>
									<?php foreach( $suportes_finalizacao as $key => $nome ) : ?>
										<option value="<?php print $key; ?>" <?php if( $producao[ 'suporte_finalizacao' ] == $key ) print 'selected="selected"'; ?>><?php print $nome; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>

					</table>
				</div>
			</div>

			<h4>Proposta de Direção</h4>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">

						<tr valign="top">
							<td align="right" width="30%">
								<label for="plano_direcao">Proposta de Direção do Filme * <a href="#duvida_plano_direcao" class="duvida">?</a></label>
								<div id="duvida_plano_direcao" title="Proposta de Direçao do Filme" class="hidden">
									<p>Apresentação dos procedimentos estilísticos pretendidos, a ser redigida pelo Diretor. Descrição de como será a linguagem do filme, fazendo menção aos diversos setores do filme.</p>
									<p>No caso de filmes de animação, a proposta de direção deverá conter, ainda, storyboard(anexo) ou desenhos que definam o estilo da animação a ser adotada no projeto;</p>
									<p>No caso de documentários, a proposta de direção deve incluir a abordagem e/ou ações de pesquisa do tema(anexo), identificação das locações, estilo de filmagem e, quando for o caso, o material de arquivo que será utilizado;</p>
								</div>
								<p class="description">máximo de 6.000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="plano_direcao" name="plano_direcao" cols="50" rows="5" tabindex="8" maxlength="6000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $producao[ 'plano_direcao' ]; ?></textarea>
							</td>
						</tr>

						<tr valign="top">
							<td align="right" width="30%">
								<label for="plano_distribuicao">Proposta de Distribuição * <a href="#duvida_plano_distribuicao" class="duvida">?</a></label>
								<div id="duvida_plano_distribuicao" title="Proposta de Distribuição" class="hidden">
									<p>Como pretende realizar a distribuição do filme. Enumerar as ações pretendidas, o que se levará em conta na escolha do distribuidor, e quais as janelas de exibição que serão utilizadas na distribuição do produto audiovisual.</p>
								</div>
								<p class="description">máximo de 3.000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="plano_distribuicao" name="plano_distribuicao" cols="50" rows="5" tabindex="8" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $producao[ 'plano_distribuicao' ]; ?></textarea>
							</td>
						</tr>

					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * salvar proposta dados direcao
	 *
	 * @name    salvar_proposta_dados_direcao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-20
	 * @updated 2011-12-27
	 * @return  void
	 */
	function salvar_proposta_dados_direcao( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se o usuário tem permisão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			return false;

		$Validator = new Validator();

		// validar dodos
		$producao[ 'id_proposta' ]         = ( int ) $id_proposta;

		$producao[ 'plano_direcao' ]       = $Validator->validate( $SAV->limpar_texto( $_POST[ 'plano_direcao' ] ), 'Proposta de Direção do Filme', 'required=1&max_length=6000' );
		$producao[ 'plano_distribuicao' ]  = $Validator->validate( $SAV->limpar_texto( $_POST[ 'plano_distribuicao' ] ), 'Proposta de Distribuição', 'required=1&max_length=3000' );
		$producao[ 'suporte_captacao' ]    = $Validator->validate( $_POST[ 'suporte_captacao' ], 'Suporte Captação', 'required=1' );
		$producao[ 'suporte_finalizacao' ] = $Validator->validate( $_POST[ 'suporte_finalizacao' ], 'Suporte Finalização', 'required=1' );

		// adicionar/atualizar producao
		$SAV->update_direcao_cinema( $producao );

		// adicionar mensagens de erro
		$SAV->update_error( $Validator->error() );
	}

	/**
	 * formulario proposta dados roteiro
	 *
	 * @name    formulario_proposta_dados_roteiro
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-23
	 * @updated 2011-12-26
	 * @return  void
	 */
	function formulario_proposta_dados_roteiro( $id_edital, $id_proposta = 0 )
	{
		global $SAV, $wpdb, $user_ID;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se é uma proposta nova
		if( !empty( $id_proposta ) )
		{
			// verificar se o usuário tem permissão para ver essa proposta
			if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				return false;

			// verificar se o usuário tem permissão para editar essa proposta
			if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
				$readonly = true;

			// verificar se a proposta ainda está aberta
			if( !$SAV->is_proposta_aberta( $id_proposta ) )
				$readonly = true;
		}

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// verificar se a proposta já existe
		if( !empty( $id_proposta ) )
			$roteiro = $SAV->get_roteiro_cinema( $id_proposta );

		?>
			<h4>Proposta de Roteiro</h4>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">

						<tr valign="top">
							<td align="right" width="30%">
								<label for="plano_roteiro">Proposta do Roteirista * <a href="#duvida_plano_roteiro" class="duvida">?</a></label>
								<div id="duvida_plano_roteiro" title="Proposta do Roteirista" class="hidden">
									<p>Apresentação contendo a visão original do autor motivadora do desenvolvimento do projeto e sua proposta de roteiro;</p>
								</div>
								<p class="description">máximo de 3.000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="plano_roteiro" name="plano_roteiro" cols="50" rows="5" tabindex="3" maxlength="3000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $roteiro[ 'plano_roteiro' ]; ?></textarea>
							</td>
						</tr>

						<tr valign="top">
							<td align="right">
								<label for="personagens">Personagens * <a href="#duvida_personagens" class="duvida">?</a></label>
								<div id="duvida_personagens" title="Personagens" class="hidden">
									<p>Apresentação dos personagens principais, incluindo seu perfil físico e psicológico;</p>
								</div>
								<p class="description">máximo de 6.000 caracteres</p>
							</td>
							<td colspan="3">
								<textarea id="personagens" name="personagens" cols="50" rows="5" tabindex="4" maxlength="6000" class="limit-chars" <?php if( $readonly ) print 'disabled="disabled"'; ?>><?php print $roteiro[ 'personagens' ]; ?></textarea>
							</td>
						</tr>

					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * salvar proposta dados roteiro
	 *
	 * @name    salvar_proposta_dados_roteiro
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-23
	 * @updated 2011-12-27
	 * @return  void
	 */
	function salvar_proposta_dados_roteiro( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se o usuário tem permisão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			return false;

		$Validator = new Validator();

		// validar dodos
		$roteiro[ 'id_proposta' ]   = ( int ) $id_proposta;

		$roteiro[ 'plano_roteiro' ] = $Validator->validate( $SAV->limpar_texto( $_POST[ 'plano_roteiro' ] ), 'Proposta de Roteiro', 'required=1&max_length=3000' );
		$roteiro[ 'personagens' ]   = $Validator->validate( $SAV->limpar_texto( $_POST[ 'personagens' ] ), 'Personagens', 'required=1&max_length=6000' );

		// adicionar/atualizar producao
		$SAV->update_roteiro_cinema( $roteiro );

		// adicionar mensagens de erro
		$SAV->update_error( $Validator->error() );
	}

	/**
	 * formulario proposta dados profissional
	 *
	 * @name    formulario_proposta_dados_profissional
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-20
	 * @updated 2012-02-28
	 * @return  void
	 */
	function formulario_proposta_dados_profissional( $id_edital, $id_proposta, $perfil = 'Produtor', $usar_proponente = false )
	{
		global $SAV, $wpdb, $user_ID;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o usuário tem permissão para ver essa proposta
		if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se o usuário tem permissão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			$readonly = true;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			$readonly = true;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// verificar se a proposta já existe
		$proposta = $SAV->get_proposta( $id_proposta );

		if( empty( $proposta ) )
			return false;

		// caso já tenha um profissional cadastrado, buscar seu cpf
		$profissional_meta = $SAV->get_proposta_meta( $id_proposta, $perfil );

		$profissional = get_userdata( $proposta[ 'id_author' ] );

		// o produtor deve ser o responsavel se for pessoa juridica ou o roteirista deve ser o responsavel
		if( ( 'Produtor' == $perfil and $SAV->is_pessoa_juridica( $profissional->user_login ) ) or 'Roteirista' == $perfil )
		{
			$profissional_meta = $profissional->user_login;

			$usar_proponente = true;
		}

		// buscar os dados desse profissional
		$profissional      = $SAV->get_proponente( $profissional_meta );

		// buscar as experiencias em cinema desse profissional
		$experiencias      = $SAV->get_experiencias_cinema( $profissional_meta );

		$funcoes           = array(
			'Artista'               => 'Artista',
			'Assitente de Direção'  => 'Assistente de Direção',
			'Assitente de Produção' => 'Assitente de Produção',
			'Diretor'               => 'Diretor',
			'Diretor de Produção'   => 'Diretor de Produção',
			'Intervalação'          => 'Intervalação',
			'Produtor'              => 'Produtor',
			'Produtor Executivo'    => 'Produtor Executivo',
			'StoryBoard'            => 'StoryBoard',
			'Roteirista'            => 'Roteirista',
			'Outros'                => 'Outros'
		);

		$suportes      = array(
			'2k'           => '2k',
			'4k'           => '4k',
			'16 mm'        => '16 mm',
			'35 mm'        => '35 mm',
			'HDCAM'        => 'HDCAM',
			'HDCAM SR'     => 'HDCAM SR',
			'XDCAM'        => 'XDCAM',
			'XDCAM EX'     => 'XDCAM EX',
			'DVCPRO HD'    => 'DVCPRO',
			'HDV'          => 'HDV',
			'Beta Cam'     => 'Beta Cam',
			'Beta Digital' => 'Beta Digital',
			'Outros'	   => 'Outros'
		);

		$slug = sanitize_title( $perfil );

		?>

		<form id="inscricao" method="post" enctype="multipart/form-data">
			<input type="hidden" name="acao" value="salvar_proposta_dados_<?php print $slug; ?>" />
			<input type="hidden" name="id_edital" value="<?php print $id_edital; ?>" />
			<input type="hidden" name="id_proposta" value="<?php print $id_proposta; ?>" />
			<input type="hidden" name="perfil" value="<?php print $perfil; ?>" />
			<div class="metabox-holder">

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, "dados_{$slug}" ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

				<h4>Dados do <?php print $perfil; ?></h4>
				<div class="postbox">
					<div class="inside">
						<table width="100%" cellspacing="15px">

							<tr valign="top">
								<td align="right" width="30%">
									<label for="login_profissional"><?php print ( ($perfil == 'Diretor' or ( $SAV->is_edital_pessoa_fisica( $id_edital ) ) ) ) ? "CPF" : "CNPJ" ?> do <?php print $perfil; ?> *</label>
								</td>
								<td colspan="3">
									<input type="text" id="login_profissional" class="cpf" name="login_profissional" value="<?php print $profissional[ 'login' ]; ?>" maxlength="14" size="15" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> <?php if( $usar_proponente ) print 'readonly="readonly"'; ?> />
									<?php if( !$readonly and !$usar_proponente ) : ?>
										<button type="submit" name="verificar_disponibilidade" id="verificar_disponibilidade" class="button-secondary" tabindex="1">Verificar Disponibilidade</button>
									<?php endif; ?>
								</td>
							</tr>

							<?php if( !empty( $profissional[ 'login' ] ) ) : ?>
								<?php $registered_user = get_user_by( 'login', $profissional[ 'login' ] ); // checar se o usuário é registrado ?>
								<?php if( !empty( $registered_user ) ) : ?>
									<tr valign="top">
										<td align="right">
											<label for="nome_profissional">Nome do <?php print $perfil; ?> *</label>
										</td>
										<td colspan="3">
											<input type="text" id="nome_profissional" name="nome_profissional" value="<?php print "{$registered_user->first_name} {$registered_user->last_name}"; ?>" maxlength="100" size="50" class="large" readonly="readonly" />
										</td>
									</tr>

									<tr valign="top">
										<td align="right">
											<label for="email_profissional">E-mail *</label>
										</td>
										<td colspan="3">
											<input type="text" id="email_profissional" name="email_profissional" value="<?php print $registered_user->user_email; ?>" maxlength="100" size="50" class="large" readonly="readonly" />
										</td>
									</tr>

								<?php else : ?>
									<tr valign="top">
										<td align="right">
											<label for="nome_profissional">Nome do <?php print $perfil; ?> *</label>
										</td>
										<td colspan="3">
											<input type="text" id="nome_profissional" name="nome_profissional" value="<?php print $profissional[ 'pessoal' ][ 'nome' ]; ?>" maxlength="100" size="50" tabindex="2" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
										</td>
									</tr>

									<tr valign="top">
										<td align="right">
											<label for="email_profissional">E-mail *</label>
										</td>
										<td colspan="3">
											<input type="text" id="email_profissional" name="email_profissional" value="<?php print $profissional[ 'contato' ][ 'email' ]; ?>" maxlength="100" size="50" tabindex="2" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
										</td>
									</tr>

								<?php endif; ?>

								<tr valign="top">
									<td align="right">
										<label for="formacao_profissional">Formação/Especialização *<a href="#duvida_formacao" class="duvida">?</a></label>
										<div id="duvida_formacao" title="Formação/Especialização" class="hidden">
											<p>No caso de Empresa Produtora deverá informar a sua especialização. Exemplo: Produção Audiovisual, Produção de Animação, Produção de Documentários, etc. </p>
										</div>
									</td>
									<td colspan="3">
										<input type="text" id="formacao_profissional" name="formacao_profissional" value="<?php print $profissional[ 'profissional' ][ 'formacao' ]; ?>" maxlength="100" size="50" tabindex="4" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>

								<tr valign="top">
									<td align="right">
										<label for="ocupacao_profissional">Área de Atuação *<a href="#duvida_area_atuacao" class="duvida">?</a></label>
										<div id="duvida_area_atuacao" title="Área de Atuação" class="hidden">
											<p>Exemplo: Internet, Cinema, Rádio, Animação, Games, Roteiro, Curta, Longa, etc.</p>
										</div>
									</td>
									<td colspan="3">
										<input type="text" id="ocupacao_profissional" name="ocupacao_profissional" value="<?php print $profissional[ 'profissional' ][ 'ocupacao' ]; ?>" maxlength="100" size="50" tabindex="5" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
								</tr>

								<?php if( 'Diretor' == $perfil ) : ?>
									<?php $categoria_diretor = $SAV->get_proposta_meta( $id_proposta, 'categoria_diretor' ); ?>
									<tr valign="top">
										<td align="right">
											<label for="categoria_diretor">Categoria *</label>
										</td>
										<td colspan="2" width="200px">
											<label><input type="radio" id="categoria_diretor" name="categoria_diretor" value="Estreante" tabindex="3" <?php if( 'Estreante' == $categoria_diretor ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Estreante</label>
											<label><input type="radio" id="categoria_diretor" name="categoria_diretor" value="Não Estreante" tabindex="3" <?php if( 'Não Estreante' == $categoria_diretor ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> /> Não Estreante</label>
										</td>
										<td>
											<?php $reclassificado = $SAV->get_proposta_meta( $id_proposta, 'categoria_reclassificada' ); ?>
											<?php if( current_user_can( 'review_sav_propostas' ) ) : ?>
												<p><a href="?page=propostas&acao=salvar_categoria_reclassificacao&id_edital=<?php print $id_edital; ?>&id_proposta=<?php print $id_proposta; ?>" title="Alterar Categoria" class="button-primary" onclick="return confirm( 'tem certeza que deseja alterar a categoria dessa proposta?' );">Alterar Categoria</a></p>
											<?php endif; ?>
											<?php if( $reclassificado ) : ?>
												<div class="problema" style="border: 1px solid; padding-left: 10px;"><p>Categoria alterada após análise da Comissão, tendo em vista que o currículo apresentado pelo diretor não corresponde à categoria por ele indicada.</p></div>
											<?php endif; ?>
										</td>
									</tr>
								<?php endif; ?>

							<?php endif; ?>

						</table>
					</div>
				</div>

				<?php if( !empty( $profissional[ 'login' ] ) ) : ?>
					<h4>Principais Obras Realizadas <span class="description">( até 15 obras )</span></h4>
					<div class="postbox">
						<div class="inside">

							<div class="area">
								<div class="experiencias">
									<?php $odd = true; ?>
									<?php if( !empty( $experiencias ) ) : ?>
										<?php foreach( $experiencias as $experiencia ) : ++$item; ?>
											<input type="hidden" name="experiencias[<?php print $item; ?>][id_experiencia_cinema]" value="<?php print $experiencia[ 'id_experiencia_cinema' ]; ?>" />
											<table width="100%" cellspacing="15px" id="experiencia_<?php print $item; ?>" class="experiencia <?php if( $odd = !$odd ) print 'odd'; ?>">

												<tr valign="top">
													<td colspan="2">
														<label for="experiencia_titulo_<?php print $item; ?>">Título da Obra *</label>
														<input type="text" id="experiencia_titulo_<?php print $item; ?>" name="experiencias[<?php print $item; ?>][titulo]" value="<?php print $experiencia[ 'titulo' ]; ?>" maxlength="100" tabindex="<?php print $item; ?>0" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
													</td>
													<td>
														<label for="experiencia_duracao_<?php print $item; ?>">Duração (min) *</label>
														<input type="text" id="experiencia_duracao_<?php print $item; ?>" name="experiencias[<?php print $item; ?>][duracao]" value="<?php print $experiencia[ 'duracao' ]; ?>" maxlength="3" size="10" tabindex="<?php print $item; ?>1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
													</td>
													<td width="40%">
														<label for="experiencia_comprovante_<?php print $item; ?>">Comprovante da Obra *<a href="#duvida_comprovante_obra" class="duvida">?</a></label>
														<div id="duvida_comprovante_obra" title="Comprovante da Obra" class="hidden">
															<p>As obras relacionadas no currículo do Diretor, Produtor(Produtora) e Roteirista somente serão consideradas quando, comprovadamente, tiverem sido exibidas em circuito de salas de exibição comercial, mostra ou festival de cinema e/ou em canais de televisão.</p>
														</div>
														<?php if( !empty( $experiencia[ 'comprovante' ] ) ) : ?>
															<input type="hidden" name="experiencias[<?php print $item; ?>][comprovante]" value="<?php print $experiencia[ 'comprovante' ]; ?>" />
															<input type="checkbox" value="experiencia_comprovante_<?php print $item; ?>" class="show-hide" checked="checked" />
															<em><a href="<?php print $experiencia[ 'comprovante' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $experiencia[ 'comprovante' ] ); ?></a></em>
														<?php endif; ?>

														<?php if( !$readonly ) : ?>
															<input type="file" id="experiencia_comprovante_<?php print $item; ?>" name="experiencia_comprovante_<?php print $item; ?>" tabindex="<?php print $item; ?>2" />
														<?php endif; ?>

														<br />
														<small>apenas arquivos no formato .pdf com no máximo 1MB</small>
													</td>
												</tr>
												<tr valign="top">
													<td colspan="3">
														<select id="experiencia_funcao<?php print $item; ?>" name="experiencias[<?php print $item; ?>][funcao]" tabindex="<?php print $item; ?>3" <?php if( $readonly ) print 'disabled="disabled"'; ?>>
															<option value="">Função</option>
															<?php foreach( $funcoes as $key => $nome ) : ?>
																<option value="<?php print $key; ?>" <?php if( $experiencia[ 'funcao' ] == $key ) print 'selected="selected"'; ?>><?php print $nome; ?></option>
															<?php endforeach; ?>
														</select> *
														<select id="experiencia_ano_<?php print $item; ?>" name="experiencias[<?php print $item; ?>][ano]" tabindex="<?php print $item; ?>4" <?php if( $readonly ) print 'disabled="disabled"'; ?>>
															<option value="">Ano</option>
															<?php for( $a = 2011; $a >= 1990; $a-- ) : ?>
																<option value="<?php print $a; ?>" <?php if( $experiencia[ 'ano' ] == $a ) print 'selected="selected"'; ?>><?php print $a; ?></option>
															<?php endfor; ?>
															<option value="1900" <?php if( $experiencia[ 'ano' ] == '1900' ) print 'selected="selected"'; ?>>Anterior</option>
														</select> *
														<select id="experiencia_suporte_finalizacao_<?php print $item; ?>" name="experiencias[<?php print $item; ?>][suporte_finalizacao]" tabindex="<?php print $item; ?>5" <?php if( $readonly ) print 'disabled="disabled"'; ?>>
															<option value="">Suporte Finalização</option>
															<?php foreach( $suportes as $key => $nome ) : ?>
																<option value="<?php print $key; ?>" <?php if( $experiencia[ 'suporte_finalizacao' ] == $key ) print 'selected="selected"'; ?>><?php print $nome; ?></option>
															<?php endforeach; ?>
														</select> *
													</td>
													<td valign="bottom" align="right">
													<?php if( !$readonly ) : ?>
														<span class="trash"><a href="#remover-obra" title="remover obra" class="remover-obra">remover obra</a></span>
													<?php endif; ?>
													</td>
												</tr>

											</table>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<input type="hidden" id="count" name="count" value="<?php print $item; ?>" />

								<table width="100%" cellspacing="15px">
									<tr>
										<td colspan="4">
											<?php if( !$readonly ) : ?>
											<span><a href="#adicionar-obra" title="adicionar obra" class="adicionar-obra">adicionar obra</a></span>
											<?php endif; ?>
										</td>
									</tr>
								</table>
							</div>

						</div>
					</div>
				<?php endif; ?>

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, "dados_{$slug}" ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

			</div>
		</form>
		<?php
	}

	/**
	 * salvar proposta dados profissional
	 *
	 * @name    salvar_proposta_dados_profissional
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-20
	 * @updated 2011-12-28
	 * @return  void
	 */
	function salvar_proposta_dados_profissional( $id_edital, $id_proposta, $perfil )
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se o usuário tem permisão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			return false;

		$Validator = new Validator();

		// validar dodos
		// o produtor deve ser o responsavel se for pessoa juridica ou o roteirista deve ser o responsavel
		if( ( 'Produtor' == $perfil and $SAV->is_pessoa_juridica( $profissional->user_login ) ) or 'Roteirista' == $perfil )
		{
			$profissional[ 'login' ]                    = $user_login;

			$usar_proponente = true;
		}
		else
		{
			$profissional[ 'login' ]                    = $_POST[ 'login_profissional' ];
		}

		// se o proponente for diretor, ele deve informar a categoria
		if( 'Diretor' == $perfil )
			$profissional[ 'categoria_diretor' ]        = $Validator->validate( $_POST[ 'categoria_diretor' ], 'Categoria', 'required=1' );

		$profissional[ 'pessoal' ][ 'nome' ]          = $Validator->validate( $_POST[ 'nome_profissional' ], 'Nome', 'required=1&max_length=100' );
		$profissional[ 'contato' ][ 'email' ]         = $Validator->validate( $_POST[ 'email_profissional' ], 'E-mail', 'required=1&email=1&max_length=100' );
		$profissional[ 'profissional' ][ 'formacao' ] = $Validator->validate( $_POST[ 'formacao_profissional' ], 'Formação', 'required=1&max_length=100' );
		$profissional[ 'profissional' ][ 'ocupacao' ] = $Validator->validate( $_POST[ 'ocupacao_profissional' ], 'Área de Atuação', 'required=1&max_length=100' );

		$slug                                         = sanitize_title( $perfil );

		// verificar se o cpf/cnpj é válido
		if( !$SAV->is_pessoa_fisica( $profissional[ 'login' ] ) and !$SAV->is_pessoa_juridica( $profissional[ 'login' ] ) )
		{
			$SAV->update_error( 'Insira um CPF/CNPJ válido!' );

			$SAV->update_proposta_meta( $id_proposta, $slug, null );

			return false;
		}

		// verificar se esse profissional já está envolvido em outro projeto
		if( $SAV->is_pessoa_fisica( $profissional[ 'login' ] ) )
		{
			$profissional_usado = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM {$wpdb->sav_proposta_meta} as pm INNER JOIN {$wpdb->sav_propostas} as p ON ( pm.id_proposta = p.id_proposta ) WHERE p.id_proposta <> %d AND p.id_edital = %d AND meta_value = %s", $id_proposta, $id_edital, $profissional[ 'login' ] ) );

			if( !empty( $profissional_usado ) )
			{
				$SAV->update_error( "Esse {$perfil} já está envolvido em outro projeto!" );

				$SAV->update_proposta_meta( $id_proposta, $slug, null );

				return false;
			}
		}

		// checar se o usuário é registrado
		$registered_user = get_user_by( 'login', $profissional[ 'login' ] );

		// se o usuário for registrado, usar seus dados
		if( !empty( $registered_user ) )
		{
			$profissional[ 'pessoal' ][ 'nome' ] = $registered_user->display_name;
			$profissional[ 'contato' ][ 'email' ] = $registered_user->user_email;
		}

		// não salvar dados vazios
		if( empty( $profissional[ 'pessoal' ][ 'nome' ] ) )
			unset( $profissional[ 'pessoal' ][ 'nome' ] );

		if( empty( $profissional[ 'contato' ][ 'email' ] ) )
			unset( $profissional[ 'contato' ][ 'email' ] );

		if( empty( $profissional[ 'profissional' ][ 'formacao' ] ) )
			unset( $profissional[ 'profissional' ][ 'formacao' ] );

		if( empty( $profissional[ 'profissional' ][ 'ocupacao' ] ) )
			unset( $profissional[ 'profissional' ][ 'ocupacao' ] );

		// relacionar esse usuário a proposta
		$SAV->update_proposta_meta( $id_proposta, $slug, $profissional[ 'login' ] );

		if( 'Diretor' == $perfil )
			$SAV->update_proposta_meta( $id_proposta, 'categoria_diretor', $profissional[ 'categoria_diretor' ] );

		// adicionar/atualizar profissional
		$SAV->update_proponente( $profissional );

		// adicionar/atualizar experiencias
		$experiencias = $_POST[ 'experiencias' ];

		if( !empty( $experiencias ) )
		{
			foreach( $experiencias as $index => $experiencia )
			{
				// validar dados
				$experiencia[ 'login' ]               = $profissional[ 'login' ];

				$experiencia[ 'titulo' ]              = $Validator->validate( $experiencia[ 'titulo' ], "Título da Obra #{$index}", 'required=1&max_length=100' );
				$experiencia[ 'duracao' ]             = $Validator->validate( $experiencia[ 'duracao' ], "Duração #{$index}", 'required=1&numeric=1&max_length=3' );
				$experiencia[ 'funcao' ]              = $Validator->validate( $experiencia[ 'funcao' ], "Função #{$index}", 'required=1' );
				$experiencia[ 'ano' ]                 = $Validator->validate( $experiencia[ 'ano' ], "Ano #{$index}", 'required=1' );
				$experiencia[ 'suporte_finalizacao' ] = $Validator->validate( $experiencia[ 'suporte_finalizacao' ], "Suporte Finalização #{$index}", 'required=1' );

				$anexo = $SAV->upload_anexo( "experiencia_comprovante_{$index}", "Comprovante da Obra #{$index}" );

				if( !empty( $anexo[ 'url' ] ) )
					$experiencia[ 'comprovante' ] = $anexo[ 'url' ];

				$Validator->validate( $experiencia[ 'comprovante' ], "Comprovante #{$index}", 'required=1' );

				$SAV->update_experiencia_cinema( $experiencia );
			}
		}

		// adicionar os erros de validação
		$SAV->update_error( $Validator->error() );

		// ir para o próximo passo
		if( isset( $_POST[ 'next' ] ) )
		{
			// se tiver algum erro, não vá para a próxima página
			if( !empty( $SAV->error ) )
				return false;

			$proximo = $this->proximo_passo( "dados_{$slug}" );

			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$proximo}&sussa=1" ); exit();
		}

		// ir para o passo anterior
		if( isset( $_POST[ 'prev' ] ) )
		{
			$anterior = $this->passo_anterior( "dados_{$slug}" );

			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$anterior}&sussa=1" ); exit();
		}

		// atualizar página
		wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo=dados_{$slug}&sussa=1" ); exit();
	}

	/**
	 * formulario proposta orcamento
	 *
	 * @name    formulario_proposta_orcamento
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-30
	 * @updated 2012-02-23
	 * @return  void
	 */
	function formulario_proposta_orcamento( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o usuário tem permissão para ver essa proposta
		if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se o usuário tem permissão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			$readonly = true;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			$readonly = true;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// verificar se a proposta já existe
		$proposta = $SAV->get_proposta( $id_proposta );

		$limite_projeto_total       = $SAV->get_edital_meta( $id_edital, 'limite_orcamento_cinema' );
		$limite_complementar_total  = $SAV->get_edital_meta( $id_edital, 'limite_complementar' );
		$limite_contrapartida_total = $SAV->get_edital_meta( $id_edital, 'limite_contrapartida' );

		$chamada_convenio 			= $SAV->get_edital_meta( $id_edital, 'chamada_convenio' );

		$limite_concurso_total      = $limite_projeto_total - $limite_complementar_total - $limite_contrapartida_total;

		if( empty( $proposta ) )
			return false;

		if( $chamada_convenio )
		{
			$etapas = array(
				'pre' => array(
					'titulo'   => 'Planejamento',
					'impostos' => '',
					'areas'    => array(
						'equipe'       => array(
							'titulo' => 'Equipe',
							'itens'  => array(),
						),
						'materiais'    => array(
							'titulo' => 'Materiais',
							'itens'  => array(),
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
							'itens'  => array(),
						),
						'outros'       => array(
							'titulo' => 'Outros',
							'itens'  => array(),
						),
					),
				),
				'pro' => array(
					'titulo'   => 'Desenvolvimento/Execução',
					'impostos' => '',
					'areas'    => array(
						'equipe'       => array(
							'titulo' => 'Equipe',
							'itens'  => array(),
						),
						'materiais'    => array(
							'titulo' => 'Materiais',
							'itens'  => array(),
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
							'itens'  => array(),
						),
						'outros'       => array(
							'titulo' => 'Outros',
							'itens'  => array(),
						),
					),
				),
				'pos' => array(
					'titulo'   => 'Finalização',
					'impostos' => '',
					'areas'    => array(
						'equipe'       => array(
							'titulo' => 'Equipe',
							'itens'  => array(),
						),
						'materiais'    => array(
							'titulo' => 'Materiais',
							'itens'  => array(),
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
							'itens'  => array(),
						),
						'outros'       => array(
							'titulo' => 'Outros',
							'itens'  => array(),
						),
					),
				),
				'contra' => array(
					'titulo'      => 'Contrapartida',
					'areas'    => array(
						'equipe'       => array(
							'titulo' => 'Equipe',
							'itens'  => array(),
						),
						'materiais'    => array(
							'titulo' => 'Materiais',
							'itens'  => array(),
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
							'itens'  => array(),
						),
						'outros'       => array(
							'titulo' => 'Outros',
							'itens'  => array(),
						),
					),
				),
			);

		}else
		{
			$etapas = array(
				'pre' => array(
					'titulo'   => 'Pré-Produção',
					'impostos' => '',
					'areas'    => array(
						'equipe'       => array(
							'titulo' => 'Equipe',
							'itens'  => array(),
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
							'itens'  => array(),
						),
						'outros'       => array(
							'titulo' => 'Outros',
							'itens'  => array(),
						),
					),
				),
				'pro' => array(
					'titulo'   => 'Produção',
					'impostos' => '',
					'areas'    => array(
						'equipe'       => array(
							'titulo' => 'Equipe',
							'itens'  => array(),
						),
						'equipamentos' => array(
							'titulo' => 'Equipamentos',
							'itens'  => array(),
						),
						'materiais'    => array(
							'titulo' => 'Materiais',
							'itens'  => array(),
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
							'itens'  => array(),
						),
						'outros'       => array(
							'titulo' => 'Outros',
							'itens'  => array(),
						),
					),
				),
				'pos' => array(
					'titulo'   => 'Pós-Produção',
					'impostos' => '',
					'areas'    => array(
						'equipe'       => array(
							'titulo' => 'Equipe',
							'itens'  => array(),
						),
						'equipamentos' => array(
							'titulo' => 'Equipamentos',
							'itens'  => array(),
						),
						'materiais'    => array(
							'titulo' => 'Materiais',
							'itens'  => array(),
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
							'itens'  => array(),
						),
						'outros'       => array(
							'titulo' => 'Outros',
							'itens'  => array(),
						),
					),
				),
				'contra' => array(
					'titulo'      => 'Contrapartida',
					'areas'       => array(
						'equipe'    => array(
							'titulo'  => 'Equipe',
						),
						'equipamentos' => array(
							'titulo' => 'Equipamentos',
						),
						'materiais'    => array(
							'titulo' => 'Materiais',
						),
						'servicos'     => array(
							'titulo' => 'Serviços',
						),
						'outros'       => array(
							'titulo' => 'Outros',
						),
					),
				),
			);

		}


		?>

		<form id="inscricao" method="post" enctype="multipart/form-data">
			<input type="hidden" name="acao" value="salvar_proposta_orcamento" />
			<input type="hidden" name="id_edital" value="<?php print $id_edital; ?>" />
			<input type="hidden" name="id_proposta" value="<?php print $id_proposta; ?>" />
			<div class="metabox-holder">

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'orcamento' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

				<div id="duvida_equipamentos" title="Equipamentos" class="hidden">
					<p>Só será permitida a alocação de Equipamentos.</p>
				</div>

				<?php foreach( $etapas as $slug_etapa => $etapa ) : ?>
					<h4><?php print $etapa[ 'titulo' ]; ?></h4>
					<div class="postbox etapa">
						<div class="inside">

							<?php $odd = true; ?>
							<?php foreach( $etapa[ 'areas' ] as $slug_area => $area ) : ?>
								<?php $area[ 'itens' ] = $SAV->get_orcamentos( $id_proposta, $etapa[ 'titulo' ], $area[ 'titulo' ] ); ?>
								<table width="100%" cellspacing="15px">
									<tr valign="top" align="left">
										<th>
											<label>
												<input type="checkbox" value="<?php print "{$slug_etapa}_{$slug_area}"; ?>" class="hide-show" <?php if( !empty( $area[ 'itens' ] ) ) print 'checked="checked"'; ?> <?php if( $readonly ) print 'disabled="disabled"'; ?> />
												<?php print $area[ 'titulo' ]; ?>
												<?php if( 'equipamentos' == $slug_area ) : ?>
													<a align="left" href="#duvida_equipamentos" class="duvida">Dúvidas Equipamentos</a>
												<?php endif; ?>
											</label>
										</th>
									</tr>
								</table>

								<div id="<?php print "{$slug_etapa}_{$slug_area}"; ?>" class="area">
									<div class="itens">
										<?php if( !empty( $area[ 'itens' ] ) ) : ?>
											<?php foreach( $area[ 'itens' ] as $orcamento ) : ++$item; ?>
												<input type="hidden" name="orcamentos[<?php print $item; ?>][id_orcamento]" value="<?php print $orcamento[ 'id_orcamento' ]; ?>" />
												<input type="hidden" name="orcamentos[<?php print $item; ?>][etapa]" value="<?php print $etapa[ 'titulo' ]; ?>" />
												<input type="hidden" name="orcamentos[<?php print $item; ?>][area]" value="<?php print $area[ 'titulo' ]; ?>" />
												<div class="item">
													<table width="100%" cellspacing="15px" id="orcamento_<?php print $item; ?>" class="<?php if( $odd = !$odd ) print 'odd'; ?>">
														<tr valign="top">
															<td>
																<label for="orcamento_item_<?php print $item; ?>">Item *</label>
																<input type="text" id="orcamento_item_<?php print $item; ?>" class="orcamento_item" name="orcamentos[<?php print $item; ?>][item]" value="<?php print $orcamento[ 'item' ]; ?>" maxlength="100" tabindex="<?php print $item; ?>0" class="large" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
															</td>
															<td>
																<label for="orcamento_quantidade_<?php print $item; ?>">Quantidade *</label>
																<input type="text" id="orcamento_quantidade_<?php print $item; ?>" class="orcamento_quantidade" name="orcamentos[<?php print $item; ?>][quantidade]" value="<?php print $orcamento[ 'quantidade' ]; ?>" maxlength="10" size="10" tabindex="<?php print $item; ?>1" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
															</td>
															<td>
																<label for="orcamento_unidade_<?php print $item; ?>" >Unidade*</label>
																<input type="text" id="orcamento_unidade_<?php print $o; ?>" class="orcamento_unidade" name="orcamentos[<?php print $item; ?>][unidade]" value="<?php print $orcamento[ 'unidade' ]; ?>" maxlength="45" size="10" tabindex="<?php print $item; ?>2" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
															</td>
															<td>
																<label for="orcamento_valor_unitario_<?php print $item; ?>">Valor Unitário (R$) *</label>
																<input type="text" id="orcamento_valor_unitario_<?php print $item; ?>" class="orcamento_valor_unitario" name="orcamentos[<?php print $item; ?>][valor_unitario]" value="<?php print $SAV->mysql_para_moeda( $orcamento[ 'valor_unitario' ] ); ?>" maxlength="10" size="10" tabindex="<?php print $item; ?>3" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
															</td>
															<td align="right">
																<label for="orcamento_valor_total_<?php print $item; ?>">Valor Total (R$) *</label>
																<input type="text" id="orcamento_valor_total_<?php print $item; ?>" class="orcamento_valor_total" name="orcamentos[<?php print $item; ?>][valor_total]" value="<?php print $SAV->mysql_para_moeda( $orcamento[ 'valor_total' ] ); ?>" maxlength="10" size="10" tabindex="<?php print $item; ?>4" readonly="readonly" />
																<?php $valor_total += $orcamento[ 'valor_total' ] ; ?>
															</td>
														</tr>
														<tr>
															<td colspan="5" valign="bottom" align="right">
																<?php if( !$readonly ) : ?>
																	<span class="trash"><a href="#remover-item" title="remover item" class="remover-item">remover item</a></span>
																<?php endif; ?>
															</td>
														</tr>
													</table>
												</div>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>

									<table width="100%" cellspacing="15px">
										<tr>
											<td>
												<?php if( !$readonly ) : ?>
													<span><a href="#adicionar-item" title="adicionar item" class="adicionar-item" etapa="<?php print $etapa[ 'titulo' ]; ?>" area="<?php print $area[ 'titulo' ]; ?>">adicionar item</a></span>
												<?php endif; ?>
											</td>
											<td align="right">
												<?php $percentual = ( float )( ( $valor_total*100 ) / $SAV->get_proposta_meta( $id_proposta, 'projeto_total' ) ) ?>
												<?php $valor_total = 0; ?>
												<label for="<?php print $slug_area; ?>_total">Total dessa Área (R$) <span class="description percentual"><?php print number_format($percentual, 2); ?>%</span></label>
												<input type="text" id="<?php print $slug_area; ?>_total" class="area_total" name="<?php print $slug_area; ?>_total" maxlength="10" size="10" readonly="readonly" />

											</td>
										</tr>
									</table>
								</div>
							<?php endforeach; ?>

							<table width="100%" cellspacing="15px">
								<tr align="right">
									<td>
										<label for="<?php print $slug_etapa; ?>_subtotal">Sub-Total dessa Etapa (R$) *</label>
										<input type="text" id="<?php print $slug_etapa; ?>_subtotal" class="etapa_subtotal" name="<?php print $slug_etapa; ?>_subtotal" maxlength="10" size="20" tabindex="<?php print $item; ?>4" readonly="readonly" />
									</td>
									<td>
										<?php
											if( $etapa['titulo'] == 'Planejamento' )
												$titulo_etapa = 'Pré-Produção';
											elseif( $etapa['titulo'] == 'Desenvolvimento/Execução'  )
												$titulo_etapa = 'Produção';
											elseif( $etapa['titulo'] == 'Finalização'  )
												$titulo_etapa = 'Pós-Produção';
											else
												$titulo_etapa = $etapa['titulo'];
										?>

										<?php $tributo = $SAV->get_orcamentos( $id_proposta,  $titulo_etapa, 'Tributo' ); ?>
										<input type="hidden" name="<?php print $slug_etapa; ?>_tributos_id" value="<?php print $tributo[ 1 ][ 'id_orcamento' ]; ?>" />
										<label for="<?php print $slug_etapa; ?>_tributos">Tributos (R$) *</label>
										<input type="text" id="<?php print $slug_etapa; ?>_tributos" class="etapa_tributos" name="<?php print $slug_etapa; ?>_tributos" value="<?php print $SAV->mysql_para_moeda( $tributo[ 1 ][ 'valor_unitario' ] ); ?>" maxlength="10" size="20" tabindex="<?php print $item; ?>5" <?php if( $readonly ) print 'disabled="disabled"'; ?> />
									</td>
									<td>
										<label for="<?php print $slug_etapa; ?>_total">Total dessa Etapa (R$) *</label>
										<input type="text" id="<?php print $slug_etapa; ?>_total" class="etapa_total" name="<?php print $slug_etapa; ?>_total" maxlength="10" size="20" tabindex="<?php print $item; ?>6" readonly="readonly" />
									</td>
								</tr>
							</table>

						</div>
					</div>
				<?php endforeach; ?>
				<input type="hidden" id="count" name="count" value="<?php print $item; ?>" />

				<?php if( '0' < $limite_complementar_total ) : ?>
					<h4>Recurso Complementar</h4>
					<div class="postbox">
						<div class="inside">
							<table width="100%" cellspacing="15px">
								<tr valign="top">
									<td width="30%">
										&nbsp;
									</td>
									<td>
										<?php $recurso_complementar = $SAV->get_orcamentos( $id_proposta, 'Recurso Complementar', 'Recurso Complementar' ); ?>
										<input type="hidden" name="orcamento_recurso_complementar_id" value="<?php print $recurso_complementar[ 1 ][ 'id_orcamento' ]; ?>" />
										<label for="orcamento_recurso_complementar">Valor dos Recursos Complementares *</label>
										<input type="text" id="orcamento_recurso_complementar" class="orcamento_recurso_complementar" name="orcamento_recurso_complementar" value="<?php print $SAV->mysql_para_moeda( $recurso_complementar[ 1 ][ 'valor_unitario' ] ); ?>" size="20" maxlength="100" tabindex="500" <?php if( $readonly ) print 'disabled="disabled"'; ?> /><br />
										<small>até <?php print $SAV->mysql_para_moeda( $limite_complementar_total ); ?></small>
									</td>
									<td>
										<label for="anexo_recurso_complementar">Comprovante do Recurso Complementar</label>

										<?php $anexo_recurso_complementar = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_recurso_complementar' ); ?>
										<?php if( !empty( $anexo_recurso_complementar ) ) : ?>
											<input type="checkbox" value="anexo_recurso_complementar" class="show-hide" checked="checked" />
											<em><a href="<?php print $anexo_recurso_complementar[ 'url' ]; ?>" title="baixar anexo" target="_blank"><?php print basename( $anexo_recurso_complementar[ 'url' ] ); ?></a></em>
										<?php endif; ?>

										<?php if( !$readonly ) : ?>
											<input type="file" id="anexo_recurso_complementar" name="anexo_recurso_complementar" tabindex="501" />
										<?php endif; ?>

										<br />
										<small>apenas arquivos no formato .pdf com no máximo 1MB</small>
									</td>
								</tr>
							</table>
						</div>
					</div>
				<?php endif; ?>

				<h4>Resumo do Orçamento</h4>
				<div class="postbox">
					<div class="inside">
						<table width="100%" cellspacing="15px">

							<tr valign="top">
								<th align="right" width="50%">
									<label for="pre_producao_total"><?php print (!$chamada_convenio) ? "Total da Etapa de Pré-Produção" : "Total da Etapa de Planejamento"; ?></label>
								</th>
								<td>
									<input type="text" id="pre_producao_total" class="pre_producao_total" name="pre_producao_total" value="" size="20" tabindex="502" readonly="readonly" />
								</td>
							</tr>

							<tr valign="top">
								<th align="right">
									<label for="producao_total"><?php print (!$chamada_convenio) ? "Total da Etapa de Produção" : "Total da Etapa de Desenvolvimento/Execução"; ?></label>
								</th>
								<td>
									<input type="text" id="producao_total" class="producao_total" name="producao_total" value="" size="20" tabindex="503" readonly="readonly" />
								</td>
							</tr>

							<tr valign="top">
								<th align="right">
									<label for="pos_producao_total"><?php print (!$chamada_convenio) ? "Total da Etapa de Pos-Produção" : "Total da Etapa de Finalização"; ?></label>
								</th>
								<td>
									<input type="text" id="pos_producao_total" class="pos_producao_total" name="pos_producao_total" value="" size="20" tabindex="504" readonly="readonly" />
								</td>
							</tr>

							<tr valign="top">
								<td colspan="2">
									&nbsp;
								</td>
							</tr>

							<?php $projeto_total = $SAV->get_proposta_meta( $id_proposta, 'projeto_total' ); ?>
							<tr valign="top">
								<th align="right">
									<label for="projeto_total">Total do Projeto</label>
								</th>
								<td>
									<input type="text" id="projeto_total" class="projeto_total" name="projeto_total" value="<?php print $SAV->mysql_para_moeda( $projeto_total ); ?>" size="20" tabindex="505" readonly="readonly" /><br />
									<small>até R$ <span id="limite_projeto"><?php print $SAV->mysql_para_moeda( $limite_projeto_total ); ?></span></small>
								</td>
							</tr>

							<?php if( '0' < $limite_complementar_total ) : ?>
								<?php $complementar_total = $SAV->get_proposta_meta( $id_proposta, 'complementar_total' ); ?>
								<tr valign="top">
									<th align="right">
										<label for="recurso_complementar">Recurso Complementar</label>
									</th>
									<td>
										<input type="text" id="recurso_complementar" class="recurso_complementar" name="recurso_complementar" value="<?php print $SAV->mysql_para_moeda( $complementar_total ); ?>" size="20" maxlength="100" tabindex="505" readonly="readonly" /><br />
										<small>até R$ <?php print $SAV->mysql_para_moeda( $limite_complementar_total ); ?></small>
									</td>
								</tr>
							<?php endif; ?>

							<?php $contrapartida_total = $SAV->get_proposta_meta( $id_proposta, 'contrapartida_total' ); ?>
							<tr valign="top">
								<th align="right">
									<label for="contrapartida">Total da Contrapartida</label>
								</th>
								<td>
									<input type="text" id="contrapartida_total" class="contrapartida_total" name="contrapartida_total" value="<?php print $SAV->mysql_para_moeda( $contrapartida_total ); ?>" size="20" maxlength="100" tabindex="505" readonly="readonly" /><br />
									<small>a contrapartida deve ser de no mínimo R$ <span id="limite_contrapartida"><?php print $SAV->mysql_para_moeda( $projeto_total * 0.2 ); ?></span></small>
								</td>
							</tr>

							<?php $concurso_total = $SAV->get_proposta_meta( $id_proposta, 'concurso_total' ); ?>
							<tr valign="top">
								<th align="right">
									<label for="concurso_total"><?php print (!$chamada_convenio) ? "Valor solicitado nesse Edital" : "Valor solicitado nesse Chamamento"; ?></label>
								</th>
								<td>
									<input type="text" id="concurso_total" class="concurso_total" name="concurso_total" value="<?php print $SAV->mysql_para_moeda( $concurso_total ); ?>" size="20" tabindex="506" readonly="readonly" /><br />
									<small>até R$ <?php print $SAV->mysql_para_moeda( $limite_concurso_total ); ?></small>
								</td>
							</tr>

						</table>
					</div>
				</div>

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'orcamento' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

			</div>
		</form>
		<?php
	}

	/**
	 * salvar proposta orcamento
	 *
	 * @name    salvar_proposta_orcamento
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-30
	 * @updated 2012-02-09
	 * @return  void
	 */
	function salvar_proposta_orcamento( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se o usuário tem permisão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			return false;

		$Validator = new Validator();

		// adicionar/atualizar orcamentos
		$orcamentos = $_POST[ 'orcamentos' ];

		if( isset( $_POST[ 'contra_tributos' ] ) )
		{
			$contra_tributos[ 'id_orcamento' ]   = ( int ) $_POST[ 'contra_tributos_id' ];
			$contra_tributos[ 'etapa' ]          = 'Contrapartida';
			$contra_tributos[ 'area' ]           = 'Tributo';
			$contra_tributos[ 'item' ]           = 'Tributo';
			$contra_tributos[ 'quantidade' ]     = 1;
			$contra_tributos[ 'unidade' ]        = 'Tributo';
			$contra_tributos[ 'valor_unitario' ] = $_POST[ 'contra_tributos' ];
		}

		if( isset( $_POST[ 'pre_tributos' ] ) )
		{
			$pre_tributos[ 'id_orcamento' ]   = ( int ) $_POST[ 'pre_tributos_id' ];
			$pre_tributos[ 'etapa' ]          = 'Pré-Produção';
			$pre_tributos[ 'area' ]           = 'Tributo';
			$pre_tributos[ 'item' ]           = 'Tributo';
			$pre_tributos[ 'quantidade' ]     = 1;
			$pre_tributos[ 'unidade' ]        = 'Tributo';
			$pre_tributos[ 'valor_unitario' ] = $_POST[ 'pre_tributos' ];
		}

		if( isset( $_POST[ 'pro_tributos' ] ) )
		{
			$pro_tributos[ 'id_orcamento' ]   = ( int ) $_POST[ 'pro_tributos_id' ];
			$pro_tributos[ 'etapa' ]          = 'Produção';
			$pro_tributos[ 'area' ]           = 'Tributo';
			$pro_tributos[ 'item' ]           = 'Tributo';
			$pro_tributos[ 'quantidade' ]     = 1;
			$pro_tributos[ 'unidade' ]        = 'Tributo';
			$pro_tributos[ 'valor_unitario' ] = $_POST[ 'pro_tributos' ];
		}

		if( isset( $_POST[ 'pos_tributos' ] ) )
		{
			$pos_tributos[ 'id_orcamento' ]   = ( int ) $_POST[ 'pos_tributos_id' ];
			$pos_tributos[ 'etapa' ]          = 'Pós-Produção';
			$pos_tributos[ 'area' ]           = 'Tributo';
			$pos_tributos[ 'item' ]           = 'Tributo';
			$pos_tributos[ 'quantidade' ]     = 1;
			$pos_tributos[ 'unidade' ]        = 'Tributo';
			$pos_tributos[ 'valor_unitario' ] = $_POST[ 'pos_tributos' ];
		}

		if( isset( $_POST[ 'orcamento_recurso_complementar' ] ) )
		{
			$complementos[ 'id_orcamento' ]   = ( int ) $_POST[ 'orcamento_recurso_complementar_id' ];
			$complementos[ 'etapa' ]          = 'Recurso Complementar';
			$complementos[ 'area' ]           = 'Recurso Complementar';
			$complementos[ 'item' ]           = 'Recurso Complementar';
			$complementos[ 'quantidade' ]     = 1;
			$complementos[ 'unidade' ]        = 'Recurso Complementar';
			$complementos[ 'valor_unitario' ] = $_POST[ 'orcamento_recurso_complementar' ];
		}

		$orcamentos[] = $contra_tributos;
		$orcamentos[] = $pre_tributos;
		$orcamentos[] = $pro_tributos;
		$orcamentos[] = $pos_tributos;

		$orcamentos[] = $complementos;

		if( empty( $orcamentos ) )
			return false;

		$projeto_total        = 0;
		$contrapartida_total  = 0;

		$limite_projeto_total       = $SAV->get_edital_meta( $id_edital, 'limite_orcamento_cinema' );
		$limite_complementar_total  = $SAV->get_edital_meta( $id_edital, 'limite_complementar' );
		$limite_contrapartida_total = $SAV->get_edital_meta( $id_edital, 'limite_contrapartida' );

		$limite_concurso_total      = $limite_projeto_total - $limite_complementar_total - $limite_contrapartida_total;

		foreach( $orcamentos as $index => $orcamento )
		{
			$orcamento[ 'id_proposta' ]    = $id_proposta;

			$orcamento[ 'quantidade' ]     = $SAV->moeda_para_mysql( $orcamento[ 'quantidade' ] );
			$orcamento[ 'valor_unitario' ] = $SAV->moeda_para_mysql( $orcamento[ 'valor_unitario' ] );
			$orcamento[ 'valor_total' ]    = $orcamento[ 'quantidade' ] * $orcamento[ 'valor_unitario' ];

			$projeto_total += $orcamento[ 'valor_total' ];

			$SAV->update_orcamento( $orcamento );

			if( 'Contrapartida' == $orcamento[ 'etapa' ] )
				$contrapartida_total += $orcamento[ 'valor_total' ];
		}

		// obter recurso complementar
		$complementar_total = $SAV->moeda_para_mysql( $_POST[ 'orcamento_recurso_complementar' ] );

		// obter contrapartida
		//$contrapartida = ( $projeto_total - $complementar_total ) * 0.2;
		$contrapartida = ( $projeto_total - $complementar_total - $contrapartida_total ) * 20 / 80;

		// obter total do concurso
		$concurso_total = $projeto_total - $complementar_total - $contrapartida_total;

		if( $projeto_total > $limite_projeto_total )
			$SAV->update_error( 'O valor do projeto de sua proposta ultrapassou o limite desse edital: R$ ' . $SAV->mysql_para_moeda( $limite_projeto_total ) );

		if( $concurso_total > $limite_concurso_total )
			$SAV->update_error( 'O valor solicitado de sua proposta ultrapassou o limite desse edital: R$ ' . $SAV->mysql_para_moeda( $limite_concurso_total ) );

		if( $contrapartida_total < $contrapartida )
			$SAV->update_error( 'Sua proposta solicita o valor de R$ ' . $SAV->mysql_para_moeda( $concurso_total ) . ' equivalente a 80% do projeto, é obrigatório uma contrapartida de pelo menos 20% ou seja R$ ' . $SAV->mysql_para_moeda( $contrapartida ) );

		// salvar total do projeto
		$SAV->update_proposta_meta( $id_proposta, 'projeto_total', $projeto_total );

		// salvar recurso complementar
		$SAV->update_proposta_meta( $id_proposta, 'complementar_total', $complementar_total );

		// salvar contrapartida
		$SAV->update_proposta_meta( $id_proposta, 'contrapartida_total', $contrapartida_total );

		// salvar total do concurso
		$SAV->update_proposta_meta( $id_proposta, 'concurso_total', $concurso_total );

		// fazer upload do anexo complementar
		$SAV->upload_anexo_proposta( $id_proposta, 'anexo_recurso_complementar', 'Anexo: Recurso Complementar' );

		// ir para o próximo passo
		if( isset( $_POST[ 'next' ] ) )
		{
			// se tiver algum erro, não vá para a próxima página
			if( !empty( $SAV->error ) )
				return false;

			$proximo = $this->proximo_passo( "orcamento" );

			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$proximo}&sussa=1" ); exit();
		}

		// ir para o passo anterior
		if( isset( $_POST[ 'prev' ] ) )
		{
			$anterior = $this->passo_anterior( "orcamento" );

			wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo={$anterior}&sussa=1" ); exit();
		}

		// atualizar página
		wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo=orcamento&sussa=1" ); exit();
	}

	/**
	 * formulario proposta declaracao
	 *
	 * @name    formulario_proposta_declaracao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-22
	 * @updated 2011-12-27
	 * @return  void
	 */
	function formulario_proposta_declaracao( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		$readonly = false;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o usuário tem permissão para ver essa proposta
		if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se o usuário tem permissão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			$readonly = true;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			$readonly = true;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			$readonly = true;

		// verificar se o edital existe
		$edital = $SAV->get_edital( $id_edital );

		// verificar se a proposta existe
		$proposta = $SAV->get_proposta( $id_proposta );

		if( empty( $proposta ) )
			return false;

		?>

			<?php if( !$readonly ) : ?>
				<div class="updated">
					<p><strong>Atenção:</strong></p>
					<p>Ao clicar em "Enviar a Proposta" ela será enviada para os consultores e você não poderá mais alterá-la.</p>
				</div>
			<?php elseif( $proposta['status'] == 'completo') : ?>
				<div class="updated">
					<p><strong>Atenção:</strong></p>
					<p>Sua proposta foi enviada com sucesso! Seu número de inscrição é: <?php print $this->protocolo( $id_edital, $id_proposta ); ?></p>
					<p>Você pode acompanhar a sua proposta a através da opção "Propostas" no menu!</p>
				</div>
			<?php endif; ?>


		<form id="inscricao" method="post" enctype="multipart/form-data">
			<input type="hidden" name="acao" value="salvar_proposta_declaracao" />
			<input type="hidden" name="id_edital" value="<?php print $id_edital; ?>" />
			<input type="hidden" name="id_proposta" value="<?php print $id_proposta; ?>" />
			<div class="metabox-holder">

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'declaracao' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

				<h4>Declaração</h4>
				<div class="postbox">
					<div class="inside">
						<table width="100%" cellspacing="15px">
							<tr valign="top">
								<th align="left">
									<label for="declaracao"><input type="checkbox" id="declaracao" name="declaracao" value="1" tabindex="1" <?php if( $readonly ) print 'disabled="disabled"'; ?> <?php if( !$SAV->is_proposta_aberta( $id_proposta ) ) print 'checked="checked"'; ?> /> Declaro para os devidos fins que:</label>
								</th>
							</tr>
							<tr>
								<td>
									<div class="declaracao">
										<?php print $edital[ 'declaracao' ]; ?>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<?php if( !$readonly ) : ?>
					<?php $this->formulario_botoes_navegacao( $id_edital, 'declaracao' ); ?>
				<?php else : ?>
					<?php $this->formulario_impressao( $id_edital, $id_proposta ); ?>
				<?php endif; ?>

			</div>
		</form>
		<?php
	}

	/**
	 * salvar proposta declaracao
	 *
	 * @name    salvar_proposta_declaracao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-05
	 * @updated 2012-02-09
	 * @return  void
	 */
	function salvar_proposta_declaracao( $id_edital, $id_proposta )
	{
		global $SAV, $wpdb, $user_ID, $user_login;

		// verificar se o usuário tem permissão para editar propostas
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		// verificar se o edital ainda está aberto
		if( !$SAV->is_edital_aberto( $id_edital ) )
			return false;

		// verificar se o usuário tem permisão para editar essa proposta
		if( !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		// verificar se a proposta ainda está aberta
		if( !$SAV->is_proposta_aberta( $id_proposta ) )
			return false;

		if( 1 != $_POST[ 'declaracao' ] )
		{
			$SAV->update_error( 'Você precisa estar de acordo com os termos da declaração para concluir o cadastro da proposta!' );
		}

		$producao_cinema  = $SAV->get_edital_meta( $id_edital, 'producao_cinema' );
		$direcao_cinema   = $SAV->get_edital_meta( $id_edital, 'direcao_cinema' );
		$roteiro_cinema   = $SAV->get_edital_meta( $id_edital, 'roteiro_cinema' );
		$chamada_convenio = $SAV->get_edital_meta( $id_edital, 'chamada_convenio' );

		$Validator = new Validator();

		// validar dados gerais
		$proposta = $SAV->get_proposta( $id_proposta );

		$Validator->validate( $proposta[ 'titulo' ], '<strong>Dados Gerais</strong> - Nome do Projeto', 'required=1&max_length=100' );

		if( !$chamada_convenio )
			$Validator->validate( $proposta[ 'contrapartida' ], '<strong>Dados Gerais</strong> - Contrapartida', 'required=1&max_length=3000' );

		if( !$roteiro_cinema and !$chamada_convenio )
			$Validator->validate( $proposta[ 'descricao' ], '<strong>Dados Gerais</strong> - Resumo do Argumento', 'required=1&max_length=600' );
		elseif( $chamada_convenio )
			$Validator->validate( $proposta[ 'descricao' ], '<strong>Dados Gerais</strong> - Síntese do Projeto', 'required=1&max_length=3000' );
		else
			$Validator->validate( $proposta[ 'descricao' ], '<strong>Dados Gerais</strong> - Sinopse', 'required=1&max_length=3000' );

		if( !$chamada_convenio)
		{
			// buscar anexos
			$anexo_roteiro            = $SAV->get_proposta_meta( $id_proposta, 'anexo_roteiro' );
			$anexo_direitos_filmagem  = $SAV->get_proposta_meta( $id_proposta, 'anexo_direitos_filmagem' );
			$anexo_registro_fbn       = $SAV->get_proposta_meta( $id_proposta, 'anexo_registro_fbn' );

			// validar apenas os anexos salvos (caso o proponente tenha enviado os anexos anteriormente)
			$Validator->validate( $anexo_roteiro, '<strong>Dados Gerais</strong> - Anexo: Roteiro ou Argumento', 'required=1' );
			$Validator->validate( $anexo_registro_fbn, '<strong>Dados Gerais</strong> - Anexo: Registro na FBN', 'required=1' );

			if( !$roteiro_cinema )
			  $Validator->validate( $anexo_direitos_filmagem, '<strong>Dados Gerais</strong> - Anexo: Direitos de Filmagem', 'required=1' );
		}

		// validar dados da produção (caso seja necessário)
		if( $producao_cinema )
		{
			$producao = $SAV->get_producao_cinema( $id_proposta );

			$Validator->validate( $producao[ 'plano_producao' ], '<strong>Dados Gerais</strong> - Proposta de Produção do Filmes', 'required=1&max_length=3000' );
			$Validator->validate( $producao[ 'estrategia_producao' ], '<strong>Dados Gerais</strong> - Estratégia de Produção', 'required=1&max_length=6000' );
			$Validator->validate( $producao[ 'viabilidade_orcamentaria' ], '<strong>Dados Gerais</strong> - Viabilidade de Execução Orçamentária', 'required=1&max_length=3000' );
		}

		// validar dados da direção (caso seja necessário)
		if( $direcao_cinema )
		{
			$direcao = $SAV->get_direcao_cinema( $id_proposta );

			$Validator->validate( $direcao[ 'plano_direcao' ], '<strong>Dados Gerais</strong> - Proposta de Direção do Filme', 'required=1&max_length=6000' );
			$Validator->validate( $direcao[ 'plano_distribuicao' ], '<strong>Dados Gerais</strong> - Proposta de Distribuição', 'required=1&max_length=3000' );
			$Validator->validate( $direcao[ 'suporte_captacao' ], '<strong>Dados Gerais</strong> - Suporte Captação', 'required=1' );
			$Validator->validate( $direcao[ 'suporte_finalizacao' ], '<strong>Dados Gerais</strong> - Suporte Finalização', 'required=1' );
		}

		// validar dados do roteiro (caso seja necessário)
		if( $roteiro_cinema )
		{
			$roteiro = $SAV->get_roteiro_cinema( $id_proposta );

			$Validator->validate( $roteiro[ 'plano_roteiro' ], '<strong>Dados Gerais</strong> - Proposta do Roteirista', 'required=1&max_length=3000' );
			$Validator->validate( $roteiro[ 'personagens' ], '<strong>Dados Gerais</strong> - Personagens', 'required=1&max_length=6000' );
		}

		if( $chamada_convenio )
		{
			$convenio =  $SAV->get_chamada_convenio( $id_proposta );

			// validar dados
			$Validator->validate( $convenio['macro_politicas']  , '<strong>Dados Gerais</strong> - Macropolíticas estatégicas vinculadas à proposta', 'required=1' );
			$Validator->validate( $convenio['objetivos'], '<strong>Dados Gerais</strong> - Objetivos', 'required=1&max_length=2000' );
			$Validator->validate( $convenio['justificativa'], '<strong>Dados Gerais</strong> - Justificativa', 'required=1&max_length=2000' );
			$Validator->validate( $convenio['caracteristica_publico'], '<strong>Dados Gerais</strong> - Caracterização do público beneficiário', 'required=1&max_length=1500' );
			$Validator->validate( $convenio['acessibilidade'] , '<strong>Dados Gerais</strong> - Ações de acessibilidade', 'required=1&max_length=1500' );
			$Validator->validate( $convenio['democratizacao_acesso'], '<strong>Dados Gerais</strong> - Ações de democratização do acesso', 'required=1&max_length=1500' );
			$Validator->validate( $convenio['metas_resultados'], '<strong>Dados Gerais</strong> - Metas e resultados esperados', 'required=1&max_length=3000' );
			$Validator->validate( $convenio['cronograma_execucao'], '<strong>Dados Gerais</strong> - Anexo: Cronograma de execução', 'required=1&max_length=1500' );
			$Validator->validate( $convenio['outras_informacoes'], '<strong>Dados Gerais</strong> - Outras informações', 'required=0&max_length=2000' );
			$Validator->validate( $convenio['valor_total'] , '<strong>Dados Gerais</strong> - Valor total do projeto', 'required=1&max_length=14' );

		}

		// validar dados do profissional (caso seja necessário)
		$perfis = array( 'produtor' => 'Produtor', 'diretor' => 'Diretor', 'roteirista' => 'Roteirista' ); // continuar

		foreach( $perfis as $slug => $perfil )
		{
			$profissional = $SAV->get_edital_meta( $id_edital, "dados_{$slug}" );

			if( $profissional )
			{
				$profissional_meta = $SAV->get_proposta_meta( $id_proposta, $perfil );

				$profissional = $SAV->get_proponente( $profissional_meta );

				if( !$SAV->is_pessoa_fisica( $profissional_meta ) and !$SAV->is_pessoa_juridica( $profissional_meta ) )
					$SAV->update_error( "<strong>Dados do {$perfil}</strong> - CPF/CNPJ do {$perfil}" );

				$Validator->validate( $profissional[ 'pessoal' ][ 'nome' ], "<strong>Dados do {$perfil}</strong> - Nome do {$perfil}", 'required=1&max_length=100' );
				$Validator->validate( $profissional[ 'contato' ][ 'email' ], "<strong>Dados do {$perfil}</strong> - E-mail", 'required=1&email=1&max_length=100' );
				$Validator->validate( $profissional[ 'profissional' ][ 'formacao' ], "<strong>Dados do {$perfil}</strong> - Formação", 'required=1&max_length=100' );
				$Validator->validate( $profissional[ 'profissional' ][ 'ocupacao' ], "<strong>Dados do {$perfil}</strong> - Área de Atuação", 'required=1&max_length=100' );

				// se o proponente for diretor, ele deve informar a categoria
				if( 'Diretor' == $perfil )
				{
					$categoria_diretor = $SAV->get_proposta_meta( $id_proposta, 'categoria_diretor' );

					$Validator->validate( $categoria_diretor, "<strong>Dados do {$perfil}</strong> - Categoria", 'required=1' );
				}

				// validar experiencias do diretor
				$experiencias = $SAV->get_experiencias_cinema( $profissional_meta );
				$permitir_estreiante = $SAV->get_edital_meta( $id_edital, 'permitir_estreiante' );

				if( empty( $experiencias ) )
				{
					if( !$permitir_estreiante )
						$SAV->update_error( "<strong>Dados do {$perfil}</strong> - Pelo menos uma experiencia deve ser informada!" );
				}
				else
				{
					foreach( $experiencias as $index => $experiencia )
					{
						$Validator->validate( $experiencia[ 'titulo' ], "<strong>Dados do {$perfil}</strong> - Título da Obra #{$index}", 'required=1&max_length=100' );
						$Validator->validate( $experiencia[ 'duracao' ], "<strong>Dados do {$perfil}</strong> - Duração #{$index}", 'required=1&numeric=1&max_length=3' );
						$Validator->validate( $experiencia[ 'funcao' ], "<strong>Dados do {$perfil}</strong> - Função #{$index}", 'required=1' );
						$Validator->validate( $experiencia[ 'ano' ], "<strong>Dados do {$perfil}</strong> - Ano #{$index}", 'required=1' );
						$Validator->validate( $experiencia[ 'suporte_finalizacao' ], "<strong>Dados do {$perfil}</strong> - Suporte Finalização #{$index}", 'required=1' );
						$Validator->validate( $experiencia[ 'comprovante' ], "<strong>Dados do {$perfil}</strong> - Comprovante da Obra #{$index}", 'required=1' );
					}
				}
			}
		}

		//verificar se esse edital tem orçamento
		$orcamento_cinema = $SAV->get_edital_meta( $id_edital, 'orcamento_cinema' );

		if( $orcamento_cinema )
		{
			// validar orcamento
			$projeto_total        = $SAV->get_proposta_meta( $id_proposta, 'projeto_total' );
			$complementar_total   = $SAV->get_proposta_meta( $id_proposta, 'complementar_total' );
			$contrapartida_total  = $SAV->get_proposta_meta( $id_proposta, 'contrapartida_total' );

			$limite_projeto_total       = $SAV->get_edital_meta( $id_edital, 'limite_orcamento_cinema' );
			$limite_complementar_total  = $SAV->get_edital_meta( $id_edital, 'limite_complementar' );
			$limite_contrapartida_total = $SAV->get_edital_meta( $id_edital, 'limite_contrapartida' );

			$concurso_total             = $projeto_total - $complementar_total - $contrapartida_total;
			$limite_concurso_total      = $limite_projeto_total - $limite_complementar_total - $limite_contrapartida_total;

			// obter contrapartida
			//$contrapartida = ( $projeto_total - $complementar_total ) * 0.2;
			$contrapartida = ( $projeto_total - $complementar_total - $contrapartida_total ) * 0.25;

			if( $projeto_total == 0 )
				$SAV->update_error( '<strong>Orçamento</strong> - O Orçamento é de preenchimento obrigatório ' );

			if( $projeto_total > $limite_projeto_total )
				$SAV->update_error( '<strong>Orçamento</strong> - O valor do projeto de sua proposta ultrapassou o limite desse edital: R$ ' . $SAV->mysql_para_moeda( $limite_projeto_total ) );

			if( $concurso_total > $limite_concurso_total )
				$SAV->update_error( '<strong>Orçamento</strong> - O valor do concurso de sua proposta ultrapassou o limite desse edital: R$ ' . $SAV->mysql_para_moeda( $limite_concurso_total ) );

			if( $contrapartida_total < $contrapartida )
				$SAV->update_error( '<strong>Orçamento</strong> - Sua proposta deve ter uma contrapartida de pelo menos: R$ ' . $SAV->mysql_para_moeda( $contrapartida ) );
		}

		$SAV->update_error( $Validator->error() );

		if( !empty( $SAV->error ) )
			return false;

		if( !$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_propostas} SET status = 'completo', atualizado = %s WHERE id_proposta = %d LIMIT 1", date( 'Y-m-d H:i:s' ), $id_proposta ) ) )
			return false;

		// registrar historico
		$SAV->registrar_historico_proposta( $id_proposta, 'Cadastrada', 'Proposta Cadastrada no Edital' );

		// atualizar página
		//wp_redirect( "?page=propostas&status=completo" ); exit();
		wp_redirect( "?page=formulario-proposta&id_edital={$id_edital}&id_proposta={$id_proposta}&passo=declaracao&sussa=1" ); exit();
	}

	/**
	 * pdf proposta
	 *
	 * @name    pdf_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2012-06-21
	 * @return  void
	 */
	function pdf_proposta( $id_edital, $id_proposta )
	{
		global $SAV;

		// verificar se o usuário tem permissão para ver essa proposta
		if( !current_user_can( 'approve_sav_propostas' ) and !$SAV->is_autor_proposta( $user_ID, $id_proposta ) )
			return false;

		$edital                   = $SAV->get_edital( $id_edital );
		$proposta                 = $SAV->get_proposta( $id_proposta );
		$protocolo                = $this->protocolo( $id_edital, $id_proposta );

		if( empty( $proposta ) )
			return false;

		$responsavel              = get_userdata( $proposta[ 'id_author' ] );

		$dados_empresa       = $SAV->get_dados_empresa( $responsavel->user_login );
		$dados_pessoais      = $SAV->get_dados_pessoais( $responsavel->user_login );
		$dados_contato       = $SAV->get_dados_contato( $responsavel->user_login );
		$dados_geograficos   = $SAV->get_dados_geograficos( $responsavel->user_login );
		$dados_profissionais = $SAV->get_dados_profissionais( $responsavel->user_login );
		$dados_ong 			 = $SAV->get_dados_ong( $responsavel->user_login );

		//if( $SAV->is_edital_pessoa_fisica( $id_edital ) );

		$anexo_roteiro            = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_roteiro' );
		$anexo_direitos_filmagem  = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_direitos_filmagem' );
		$anexo_direitos_adaptacao = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_direitos_adaptacao' );
		$anexo_storyboard         = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_storyboard' );
		$anexo_pesquisa           = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_pesquisa' );
		$anexo_registro_fbn       = $SAV->get_proposta_meta( $proposta[ 'id_proposta' ], 'anexo_registro_fbn' );

		$pdf = new SAV_PDF( 'P', 'mm', 'A4' );

		$pdf->SetEdital( $edital[ 'titulo' ] );
		$pdf->SetProposta( "Proposta nº {$protocolo}" );
		$pdf->SetProponente( "{$responsavel->first_name} {$responsavel->last_name} ({$responsavel->user_login})" );
		$pdf->SetUltimaAtualizacao( date( 'd\/m\/Y H:i', strtotime( $proposta[ 'atualizado' ] ) + ( get_option( 'gmt_offset' ) * 3600 ) ) );

		$roteiro_cinema = $SAV->get_edital_meta( $id_edital, 'roteiro_cinema' );
		$direcao_cinema = $SAV->get_edital_meta( $id_edital, 'direcao_cinema' );
		$producao_cinema = $SAV->get_edital_meta( $id_edital, 'producao_cinema' );
		$chamada_convenio = $SAV->get_edital_meta( $id_edital, 'chamada_convenio' );

		// dados gerais
		$pdf->AddPage();

		$pdf->H1( "Proposta nº {$protocolo}" );

		if( current_user_can( 'analista' ) )
		{
			$pdf->H2( "Dados do Concorrente" );

			if( $SAV->is_pessoa_fisica( $responsavel->user_login ) )
			{
				$pdf->H5( "Nome" );
				$pdf->Content( "{$responsavel->first_name} {$responsavel->last_name}" );

				$pdf->H5( "CPF");
				$pdf->Content( $responsavel->user_login );

				$pdf->H5( "RG");
				$pdf->Content( $dados_pessoais['rg'] );

				$pdf->H5( "Nascimento");
				$pdf->Content( date( 'd\/m\/Y', strtotime( $dados_pessoais['nascimento']  ) ) );

				$pdf->H5( "Naturalidade");
				$pdf->Content( $dados_pessoais['naturalidade'] );

			}

			if( $SAV->is_pessoa_juridica( $responsavel->user_login ) )
			{
				$pdf->H5( "Razão Social" );
				$pdf->Content( "{$responsavel->first_name} {$responsavel->last_name}" );

				$pdf->H5( "CNPJ");
				$pdf->Content( $responsavel->user_login );

				$pdf->H5( "Representante Legal");
				$pdf->Content( $dados_empresa['nome_representante'] );

				$pdf->H5( "CPF representante");
				$pdf->Content( $dados_empresa['cpf_representante'] );

				if( !empty( $dados_empresa['ra'] ) )
				{
					$pdf->H5( "Registro Ancine");
					$pdf->Content( $dados_empresa['ra'] );
				}
			}

			$pdf->H2( "Contato" );

			$pdf->H5( "E-mail");
			$pdf->Content( $dados_contato['email'] );

			$pdf->H5( "Telefone / Celular");
			$pdf->Content( "({$dados_contato['ddd_telefone']}) {$dados_contato['telefone']} / ({$dados_contato['ddd_celular']}) {$dados_contato['celular']}");

			$pdf->H2( "Localização" );

			$pdf->H5( "Endereço");
			$pdf->Content( $dados_geograficos['endereco'] );

			$pdf->H5( "Bairro - CEP");
			$pdf->Content( "{$dados_geograficos['bairro']} - {$dados_geograficos['cep']} " );

			$pdf->H5( "Cidade - UF");
			$pdf->Content( "{$dados_geograficos['cidade']} - {$dados_geograficos['estado']} " );

			$pdf->AddPage();
		}

		$pdf->H2( "Dados do Projeto" );

		$pdf->H5( "Nome do Projeto" );
		$pdf->Content( $SAV->limpar_texto($proposta[ 'titulo' ] ) );

		if( $chamada_convenio)
			$pdf->H5( "Síntese do Projeto" );
		elseif( !$roteiro_cinema  )
			$pdf->H5( "Sinopse" );
		else
		  $pdf->H5( "Resumo do Argumento" );

		$pdf->Content( $SAV->limpar_texto($proposta[ 'descricao' ] ) );

		if( !$chamada_convenio)
		{
			$pdf->H5( "Descrição da Contrapartida" );
			$pdf->Content( $SAV->limpar_texto( $proposta[ 'contrapartida' ] ) );
		}

		// dados produção
		if( $producao_cinema )
		{
			$producao = $SAV->get_producao_cinema( $id_proposta );

			$pdf->H2( "Proposta de Produção" );

			$pdf->H5( "Proposta de Produção do Filme" );
			$pdf->Content( $SAV->limpar_texto( $producao[ 'plano_producao' ] ) );

			$pdf->H5( "Viabilidade de Execução Orçamentária" );
			$pdf->Content( $SAV->limpar_texto( $producao[ 'viabilidade_orcamentaria' ] ) );

			$pdf->H5( "Estratégia de Produção" );
			$pdf->Content( $SAV->limpar_texto( $producao[ 'estrategia_producao' ] ) );
		}

		// dados direcao
		if( $direcao_cinema )
		{
			$direcao = $SAV->get_direcao_cinema( $id_proposta );

			$pdf->H2( "Proposta de Direção" );

			$pdf->H2( "Detalhamento Técnico do Filme" );

			$pdf->H5( "Suporte Captação" );
			$pdf->Content( $direcao[ 'suporte_captacao' ] );

			$pdf->H5( "Suporte Finalização" );
			$pdf->Content( $direcao[ 'suporte_finalizacao' ] );

			$pdf->H2( "Proposta de Direção" );

			$pdf->H5( "Proposta de Direção do Filme" );
			$pdf->Content( $SAV->limpar_texto( $direcao[ 'plano_direcao' ] ) );

			$pdf->H5( "Proposta de Distribuição" );
			$pdf->Content( $SAV->limpar_texto( $direcao[ 'plano_distribuicao' ] ) );
		}

		// dados roteiro
		if( $roteiro_cinema )
		{
			$roteiro = $SAV->get_roteiro_cinema( $id_proposta );

			$pdf->H2( "Proposta de Roteiro" );

			$pdf->H5( "Proposta do Roteirista" );
			$pdf->Content( $SAV->limpar_texto( $roteiro[ 'plano_roteiro' ] ) );

			$pdf->H5( "Personagens" );
			$pdf->Content( $SAV->limpar_texto( $roteiro[ 'personagens' ] ) );
		}

		// dados chamada convenio
		if( $chamada_convenio )
		{
			$convenio =  $SAV->get_chamada_convenio( $id_proposta );

			if( is_serialized( $convenio['macro_politicas']  ) )
				$convenio['macro_politicas'] = maybe_unserialize( $convenio['macro_politicas']  );

			$pdf->H2("Dados Básicos para Apoio");

			$pdf->H5( "Macropolíticas estatégicas vinculadas à proposta" );

			if( in_array( 'inovacao_audiovisual', $convenio['macro_politicas'] ) ) $pdf->Content( "Política de Inovação Audiovisual" );
			if( in_array( 'desenvolvimento_sustentavel', $convenio['macro_politicas']) ) $pdf->Content( "Política para o Desenvolvimento Sustentável do Setor Audiovisual Brasileiro" );
			if( in_array( 'fomento_atividade', $convenio['macro_politicas'] ) ) $pdf->Content( "Política de Fomento às Atividades Audiovisuais Brasileira" );
			if( in_array( 'acervos', $convenio['macro_politicas'] ) ) $pdf->Content( "Política de Preservação, Digitalização, Difusão e Acesso a Acervos Audiovisuais" );
			if( in_array( 'infancia_juventude', $convenio['macro_politicas'] ) ) $pdf->Content( "Política Audiovisual para a Infância e a Juventude" );
			if( in_array( 'internacional', $convenio['macro_politicas'] ) ) $pdf->Content( "Política Internacional do Audiovisual");
			if( in_array( 'capacitacao', $convenio['macro_politicas'] ) ) $pdf->Content( "Política de Formação, Capacitação e Qualificação em todos os níveis dos Integrantes do Setor Audiovisual");

			$pdf->H5( "Objetivos" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'objetivos' ] ) );

			$pdf->H5( "Justificativa" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'justificativa' ] ) );

			$pdf->H5( "Caracterização do público beneficiário" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'caracteristica_publico' ] ) );

			$pdf->H5( "Ações de acessbilidade" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'acessibilidade' ] ) );

			$pdf->H5( "Ações de democratização do acesso" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'democratizacao_acesso' ] ) );

			$pdf->H5( "Metas e resultados esperados" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'metas_resultados' ] ) );

			$pdf->H5( "Outras informações" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'outras_informacoes' ] ) );

			$pdf->H5( "Valor total do projeto" );
			$pdf->Content( $SAV->limpar_texto( $convenio[ 'valor_total' ] ) );

			// anexos
			$pdf->H2( "Anexos" );

			$pdf->H5( "Cronograma de Execução" );
			$pdf->Content( $convenio[ 'cronograma_execucao' ], $convenio[ 'cronograma_execucao' ] );

		}

		if(!$chamada_convenio)
		{
			// anexos
			$pdf->H2( "Anexos" );

			$pdf->H5( "Roteiro ou Argumento" );
			$pdf->Content( $anexo_roteiro[ 'url' ], $anexo_roteiro[ 'url' ] );

			$pdf->H5( "Cessão de Direitos de Filmagem" );
			$pdf->Content( $anexo_direitos_filmagem[ 'url' ], $anexo_direitos_filmagem[ 'url' ] );

			$pdf->H5( "Cessão de Direitos de Adaptação" );
			$pdf->Content( $anexo_direitos_adaptacao[ 'url' ], $anexo_direitos_adaptacao[ 'url' ] );

			$pdf->H5( "StoryBoard" );
			$pdf->Content( $anexo_storyboard[ 'url' ], $anexo_storyboard[ 'url' ] );

			$pdf->H5( "Pesquisa Sobre o Tema" );
			$pdf->Content( $anexo_pesquisa[ 'url' ], $anexo_pesquisa[ 'url' ] );

			$pdf->H5( "Certificado de Registro da FBN" );
			$pdf->Content( $anexo_registro_fbn[ 'url' ], $anexo_registro_fbn[ 'url' ] );
		}

		// dados do profissional
		$perfis = array( 'produtor', 'diretor', 'roteirista' );

		foreach( $perfis as $perfil )
		{
			$dados_profissional = $SAV->get_edital_meta( $id_edital, "dados_{$perfil}" );

			if( $dados_profissional )
			{
				$profissional_meta = $SAV->get_proposta_meta( $id_proposta, $perfil );
				$profissional      = $SAV->get_proponente( $profissional_meta );
				$experiencias      = $SAV->get_experiencias_cinema( $profissional_meta );

				$pdf->AddPage();

				$pdf->H2( "Dados do {$perfil}" );

				$pdf->H5( "CPF do {$perfil}" );
				$pdf->Content( $profissional[ 'login' ] );

				$pdf->H5( "Nome do {$perfil}" );
				$pdf->Content( $profissional[ 'pessoal' ][ 'nome' ] );

				$pdf->H5( "E-mail do {$perfil}" );
				$pdf->Content( $profissional[ 'contato' ][ 'email' ] );

				if( 'diretor' == $perfil )
				{
					$categoria_diretor = $SAV->get_proposta_meta( $id_proposta, 'categoria_diretor' );

					$pdf->H5( "Categoria do {$perfil}" );
					$pdf->Content( $categoria_diretor );
				}

				$pdf->H5( "Formação/Especialização do {$perfil}" );
				$pdf->Content( $profissional[ 'profissional' ][ 'formacao' ] );

				$pdf->H5( "Área de Atuação do {$perfil}" );
				$pdf->Content( $profissional[ 'profissional' ][ 'ocupacao' ] );

				$pdf->H2( "Principais Obras Realizadas" );

				$pdf->SetFont( 'Arial', 'B', 10 );

				$pdf->Cell( 70, 0, utf8_decode( 'Título' ), 0, 0, 'L' );
				$pdf->Cell( 20, 0, utf8_decode( 'Duração' ), 0, 0, 'C' );
				$pdf->Cell( 40, 0, utf8_decode( 'Função' ), 0, 0, 'L' );
				$pdf->Cell( 10, 0, utf8_decode( 'Ano' ), 0, 0, 'C' );
				$pdf->Cell( 25, 0, utf8_decode( 'Finalização' ), 0, 0, 'C' );
				$pdf->Cell( 25, 0, utf8_decode( 'Comprovante' ), 0, 0, 'C' );

				$pdf->ln( 7 );

				$odd = true;

				foreach( $experiencias as $experiencia )
				{
					$pdf->SetFont( 'Arial', '', 10 );

					if( $odd = !$odd )
						$pdf->SetFillColor( 245, 245, 245 );
					else
						$pdf->SetFillColor( 255, 255, 255 );

					if( '1900' == $experiencia[ 'ano' ])
						$experiencia[ 'ano' ] = 'Antes';

					$pdf->Cell( 70, 5, utf8_decode( $experiencia[ 'titulo' ] ), 0, 0, 'L', 1 );
					$pdf->Cell( 20, 5, utf8_decode( $experiencia[ 'duracao' ] ), 0, 0, 'C', 1 );
					$pdf->Cell( 40, 5, utf8_decode( $experiencia[ 'funcao' ] ), 0, 0, 'L', 1 );
					$pdf->Cell( 10, 5, utf8_decode( $experiencia[ 'ano' ] ), 0, 0, 'C' , 1);
					$pdf->Cell( 25, 5, utf8_decode( $experiencia[ 'suporte_finalizacao' ] ), 0, 0, 'C', 1 );
					$pdf->Cell( 25, 5, utf8_decode( 'baixar' ), 0, 0, 'C', 1, $experiencia[ 'comprovante' ] );

					$pdf->ln( 5 );
				}
			}
		}

		// orçamento
		$orcamento = $SAV->get_edital_meta( $id_edital, 'orcamento_cinema' );

		if( $orcamento )
		{
			if( $chamada_convenio )
			{
				$etapas = array(
					'pre' => array(
						'titulo'   => 'Planejamento',
						'impostos' => '',
						'areas'    => array(
							'equipe'       => array(
								'titulo' => 'Equipe',
								'itens'  => array(),
							),
							'materiais'    => array(
								'titulo' => 'Materiais',
								'itens'  => array(),
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
								'itens'  => array(),
							),
							'outros'       => array(
								'titulo' => 'Outros',
								'itens'  => array(),
							),
						),
					),
					'pro' => array(
						'titulo'   => 'Desenvolvimento/Execução',
						'impostos' => '',
						'areas'    => array(
							'equipe'       => array(
								'titulo' => 'Equipe',
								'itens'  => array(),
							),
							'materiais'    => array(
								'titulo' => 'Materiais',
								'itens'  => array(),
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
								'itens'  => array(),
							),
							'outros'       => array(
								'titulo' => 'Outros',
								'itens'  => array(),
							),
						),
					),
					'pos' => array(
						'titulo'   => 'Finalização',
						'impostos' => '',
						'areas'    => array(
							'equipe'       => array(
								'titulo' => 'Equipe',
								'itens'  => array(),
							),
							'materiais'    => array(
								'titulo' => 'Materiais',
								'itens'  => array(),
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
								'itens'  => array(),
							),
							'outros'       => array(
								'titulo' => 'Outros',
								'itens'  => array(),
							),
						),
					),
					'contra' => array(
						'titulo'      => 'Contrapartida',
						'areas'    => array(
							'equipe'       => array(
								'titulo' => 'Equipe',
								'itens'  => array(),
							),
							'materiais'    => array(
								'titulo' => 'Materiais',
								'itens'  => array(),
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
								'itens'  => array(),
							),
							'outros'       => array(
								'titulo' => 'Outros',
								'itens'  => array(),
							),
						),
					),
				);

			}else
			{
				$etapas = array(
					'pre' => array(
						'titulo'   => 'Pré-Produção',
						'impostos' => '',
						'areas'    => array(
							'equipe'       => array(
								'titulo' => 'Equipe',
								'itens'  => array(),
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
								'itens'  => array(),
							),
							'outros'       => array(
								'titulo' => 'Outros',
								'itens'  => array(),
							),
						),
					),
					'pro' => array(
						'titulo'   => 'Produção',
						'impostos' => '',
						'areas'    => array(
							'equipe'       => array(
								'titulo' => 'Equipe',
								'itens'  => array(),
							),
							'equipamentos' => array(
								'titulo' => 'Equipamentos',
								'itens'  => array(),
							),
							'materiais'    => array(
								'titulo' => 'Materiais',
								'itens'  => array(),
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
								'itens'  => array(),
							),
							'outros'       => array(
								'titulo' => 'Outros',
								'itens'  => array(),
							),
						),
					),
					'pos' => array(
						'titulo'   => 'Pós-Produção',
						'impostos' => '',
						'areas'    => array(
							'equipe'       => array(
								'titulo' => 'Equipe',
								'itens'  => array(),
							),
							'equipamentos' => array(
								'titulo' => 'Equipamentos',
								'itens'  => array(),
							),
							'materiais'    => array(
								'titulo' => 'Materiais',
								'itens'  => array(),
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
								'itens'  => array(),
							),
							'outros'       => array(
								'titulo' => 'Outros',
								'itens'  => array(),
							),
						),
					),
					'contra' => array(
						'titulo'      => 'Contrapartida',
						'areas'       => array(
							'equipe'    => array(
								'titulo'  => 'Equipe',
							),
							'equipamentos' => array(
								'titulo' => 'Equipamentos',
							),
							'materiais'    => array(
								'titulo' => 'Materiais',
							),
							'servicos'     => array(
								'titulo' => 'Serviços',
							),
							'outros'       => array(
								'titulo' => 'Outros',
							),
						),
					),
				);

			}

			$pdf->AddPage();

			foreach( $etapas as $slug_etapa => $etapa )
			{
				$pdf->H2( "Orçamento {$etapa[ 'titulo' ]}" );

				$etapa_subtotal = 0;
				$etapa_total    = 0;

				foreach( $etapa[ 'areas' ] as $slug_area => $area )
				{
					$pdf->H4( $area[ 'titulo' ] );

					$pdf->SetFont( 'Arial', 'B', 10 );

					$pdf->Cell( 70, 0, utf8_decode( 'Item' ), 0, 0, 'L' );
					$pdf->Cell( 30, 0, utf8_decode( 'Quantidade' ), 0, 0, 'C' );
					$pdf->Cell( 30, 0, utf8_decode( 'Unidade' ), 0, 0, 'C' );
					$pdf->Cell( 30, 0, utf8_decode( 'Valor Unitário (R$)' ), 0, 0, 'C' );
					$pdf->Cell( 30, 0, utf8_decode( 'Valor Total (R$)' ), 0, 0, 'C' );

					$pdf->ln( 7 );

					$area[ 'itens' ] = $SAV->get_orcamentos( $id_proposta, $etapa[ 'titulo' ], $area[ 'titulo' ] );

					$odd        = true;
					$area_total = 0;

					foreach( $area[ 'itens' ] as $orcamento )
					{
						$pdf->SetFont( 'Arial', '', 10 );

						if( $odd = !$odd )
							$pdf->SetFillColor( 245, 245, 245 );
						else
							$pdf->SetFillColor( 255, 255, 255 );

						$pdf->Cell( 70, 5, utf8_decode( $orcamento[ 'item' ] ), 0, 0, 'L', 1 );
						$pdf->Cell( 30, 5, utf8_decode( $orcamento[ 'quantidade' ] ), 0, 0, 'C', 1 );
						$pdf->Cell( 30, 5, utf8_decode( $orcamento[ 'unidade' ] ), 0, 0, 'C', 1 );
						$pdf->Cell( 30, 5, utf8_decode( $SAV->mysql_para_moeda( $orcamento[ 'valor_unitario' ] ) ), 0, 0, 'C', 1 );
						$pdf->Cell( 30, 5, utf8_decode( $SAV->mysql_para_moeda( $orcamento[ 'valor_total' ] ) ), 0, 0, 'C', 1 );

						$area_total += $orcamento[ 'valor_total' ];

						$pdf->ln( 5 );
					}

					$pdf->ln( 5 );

					$pdf->SetFont( 'Arial', 'B', 10 );
					$pdf->Cell(  160, 0, utf8_decode( 'Total dessa Área (R$):' ), 0, 0, 'R' );

					$pdf->SetFont( 'Arial', '', 10 );
					$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $area_total ), 0, 0, 'C' );

					$etapa_subtotal += $area_total;

					$pdf->ln( 10 );
				}

				$pdf->SetFont( 'Arial', 'B', 10 );
				$pdf->Cell(  160, 0, utf8_decode( 'Sub-Total dessa Etapa (R$):' ), 0, 0, 'R' );

				$pdf->SetFont( 'Arial', '', 10 );
				$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $etapa_subtotal ), 0, 0, 'C' );

				$pdf->ln( 10 );

				$pdf->SetFont( 'Arial', 'B', 10 );
				$pdf->Cell(  160, 0, utf8_decode( 'Tributos (R$):' ), 0, 0, 'R' );


				if( $etapa['titulo'] == 'Planejamento' )
					$titulo_etapa = 'Pré-Produção';
				elseif( $etapa['titulo'] == 'Desenvolvimento/Execução'  )
					$titulo_etapa = 'Produção';
				elseif( $etapa['titulo'] == 'Finalização'  )
					$titulo_etapa = 'Pós-Produção';
				else
					$titulo_etapa = $etapa['titulo'];

				$tributo = $SAV->get_orcamentos( $id_proposta, $titulo_etapa, 'Tributo' );

				$pdf->SetFont( 'Arial', '', 10 );
				$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $tributo[ 1 ][ 'valor_unitario' ] ), 0, 0, 'C' );

				$etapa_total = $etapa_subtotal + $tributo[ 1 ][ 'valor_unitario' ];

				$pdf->ln( 10 );

				$pdf->SetFont( 'Arial', 'B', 10 );
				$pdf->Cell(  160, 0, utf8_decode( 'Total dessa Etapa (R$):' ), 0, 0, 'R' );

				$pdf->SetFont( 'Arial', '', 10 );
				$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $etapa_total ), 0, 0, 'C' );

				$pdf->ln( 10 );

				$$slug_etapa = $etapa_total;
			}

			$pdf->H2( "Resumo do Orçamento" );

			$recurso_complementar = $SAV->get_orcamentos( $id_proposta, 'Recurso Complementar', 'Recurso Complementar' );

			$projeto_total        = $contra + $pre + $pro + $pos + $dist + $recurso_complementar[ 1 ][ 'valor_unitario' ];
			$contrapartida_total  = $SAV->get_proposta_meta( $id_proposta, 'contrapartida_total' );
			$concurso_total       = $projeto_total - $contrapartida_total - $recurso_complementar[ 1 ][ 'valor_unitario' ];

			$text_pre_producao = (!$chamada_convenio) ? "Total da Etapa de Pré-Produção (R$):" : "Total da Etapa de Planejamento (R$):";
			$text_producao	   = (!$chamada_convenio) ? "Total da Etapa de Produção (R$):" : "Total da Etapa de Desenvolvimento/Execução (R$):" ;
			$text_pos_producao = (!$chamada_convenio) ? "Total da Etapa de Pós-Produção (R$):" : "Total da Etapa de Finalização (R$):";

			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(  160, 0, utf8_decode( $text_pre_producao ), 0, 0, 'R' );

			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $pre ), 0, 0, 'C' );

			$pdf->ln( 10 );

			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(  160, 0, utf8_decode( $text_producao ), 0, 0, 'R' );

			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $pro ), 0, 0, 'C' );

			$pdf->ln( 10 );

			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(  160, 0, utf8_decode( $text_pos_producao ), 0, 0, 'R' );

			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $pos ), 0, 0, 'C' );

			$pdf->ln( 10 );

			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(  160, 0, utf8_decode( 'Total do Projeto (R$):' ), 0, 0, 'R' );

			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $projeto_total ), 0, 0, 'C' );

			$pdf->ln( 10 );

			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(  160, 0, utf8_decode( 'Total de Contrapartida (R$):' ), 0, 0, 'R' );

			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $contrapartida_total ), 0, 0, 'C' );

			$pdf->ln( 10 );

			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(  160, 0, utf8_decode( 'Recursos Complementares (R$):' ), 0, 0, 'R' );

			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $recurso_complementar[ 1 ][ 'valor_unitario' ] ), 0, 0, 'C' );

			$pdf->ln( 10 );

			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(  160, 0, utf8_decode( 'Total Solicitado (R$):' ), 0, 0, 'R' );

			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell( 30, 0, $SAV->mysql_para_moeda( $concurso_total ), 0, 0, 'C' );

			$pdf->ln( 10 );
		}

		// declaração
		$pdf->AddPage();

		$pdf->H2( "Declaração" );

		$pdf->H5( "Declaro para os devidos fins que:" );
		$pdf->Content( strip_tags( $edital[ 'declaracao' ] ) );

		$pdf->ln( 10 );

		$pdf->Cell( 0, 0, '_________________________________________________', 0, 0, 'C' );

		$pdf->ln( 5 );

		$pdf->Cell( 0, 0, utf8_decode( $responsavel->display_name ), 0, 0, 'C' );

		// md5
		//$pdf->buffer;

		$pdf->Output();

		exit();
	}

	/**
	 * botão de impressao
	 *
	 * @name    formulario_relatorio
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2012-01-31
	 * @return  void
	 */
	function formulario_relatorio( $id_edital, $status)
	{
		global $SAV, $user_login;

		// verificar se o usuário é consultor
		if (current_user_can( 'classifies_sav_propostas' ) and !current_user_can( 'administrator' ))
		{
			// busca array com os consultores que já finalizaram classificação
			$comissao_finalizada = $SAV->get_edital_meta( $id_edital, 'comissao_finalizada' );

			if( !in_array( $user_login, $comissao_finalizada ) or $status != 'meus_classificados' ) {
				return false;
			}
		}

		?>
			<div class="postbox">
				<div class="inside">
					<table width="100%" cellspacing="15px">
						<tr valign="top">
							<td>
								<a href="?page=propostas&acao=excel_propostas&id_edital=<?php print $id_edital; ?>&status=<?php print $status; ?>" title="Salvar planilha" class="button-primary" target="_blank">Salvar planilha</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * exporta todas as propostas para uma planilha do excel
	 *
	 * @name    excel proposta
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-01-31
	 * updated 	2012-01-31
	 * return 	void
	 */

	function excel_propostas($id_edital, $status)
	{
		global $wpdb, $SAV, $user_ID;

		if( !current_user_can( 'approve_sav_propostas' ) )
			return false;

		$roteiro_cinema  = $SAV->get_edital_meta( $id_edital, 'roteiro_cinema' );
		$direcao_cinema  = $SAV->get_edital_meta( $id_edital, 'direcao_cinema' );
		$producao_cinema = $SAV->get_edital_meta( $id_edital, 'producao_cinema' );

		$numero_edital   = $SAV->get_edital_meta( $id_edital, 'numero_edital' );

		if( empty( $numero_edital ) )
			$numero_edital = $id_edital;

		if( !empty( $id_edital ) )
		{
			$where_edital  = " AND id_edital = {$id_edital}";
			$edital		   = $SAV->get_edital( $id_edital );
			$titulo_edital = "Edital nº ". $numero_edital ." - ". $edital[ 'titulo' ];
		}

		if( !empty( $status) )
		{
			$where_status  = " AND status = '{$status}'";
			$titulo_status = " / Status = " . strtoupper( $status );
		}

		// Definindo o tipo de arquivo (Ex: msexcel, msword, pdf...)
		header('Content-type: application/msexcel');

		// Nomeia o arquivo de acordo com a consulta
		$filename = "relatorio_editais_" . $id_edital . "_" . $status . ".xls";

		// Formato do arquivo
		header("Content-Disposition: attachment; filename={$filename}");

		// monta o título
		if( empty( $titulo_edital ) and empty( $titulo_status ) )
			$titulo_tabela = "Relatório Geral - Editais SAV";
		elseif( empty( $titulo_edital ) )
			$titulo_tabela = "Relatório Editais " . $titulo_status;
		else
			$titulo_tabela =  $titulo_edital . $titulo_status;

		if( current_user_can( 'classifies_sav_propostas' ) and !current_user_can( 'administrator' ) )
		{
			$propostas = $SAV->get_classificacao_por_consultor( $user_ID, $id_edital );
		}
		elseif( $status == 'recurso' )
		{
			$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT po.id_proposta, po.id_edital, po.id_author, po.titulo, po.descricao, p.meta_value as status FROM {$wpdb->sav_propostas} as po INNER JOIN {$wpdb->sav_proposta_meta} as p ON po.id_proposta = p.id_proposta WHERE p.meta_key = 'status_recurso' {$where_edital} ORDER BY po.id_proposta DESC" ) );
		}
		else
		{
			$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT id_proposta, id_edital, id_author, titulo, status FROM {$wpdb->sav_propostas} WHERE id_proposta <> '' AND status <> 'lixo' {$where_edital} {$where_status} ORDER BY id_proposta ASC" ) );
			//print ( $wpdb->prepare( "SELECT po.id_proposta, po.id_edital, po.id_author, po.titulo, po.descricao, p.meta_value as status FROM {$wpdb->sav_propostas} as po INNER JOIN {$wpdb->sav_proposta_meta} as p ON po.id_proposta = p.id_proposta WHERE p.meta_key = 'status_recurso' {$where_edital} ORDER BY po.id_proposta DESC" ) );
		}

		if ( !empty( $propostas ) )
		{

			// Montando a tabela
			$html  = "<table border='1px #000'>";
			$html .= "<tr>";
			$html .= "<th colspan=6>". $titulo_tabela ."</th>";
			$html .= "</tr>";
			$html .= "<tr>";
			$html .= "<td>Nº INSCRIÇÃO</td>";
			$html .= "<td>PROJETO</td>";
			$html .= "<td>CONCORRENTE</td>";
			$html .= "<td>UF</td>";
			$html .= "<td>REGIÃO</td>";
			$html .= "<td>Status</td>";

			if( 1 == $id_edital )
			{
				$html .= "<td>DIRETOR</td>";
				$html .= "<td>CATEGORIA</td>";
			}

			if ( $status == 'inabilitado' )
				$html .= "<td>OBSERVAÇÃO</td>";

			if ( $status == 'recurso' )
				$html .= "<td>OBSERVAÇÃO</td>";
			$html .= "</tr>";

			foreach( $propostas as $proposta )
			{
				$user 			   = get_userdata( $proposta->id_author );
				$dados_geograficos = $SAV->get_dados_geograficos( $user->user_login );

				$login_diretor     = $SAV->get_proposta_meta( $proposta->id_proposta, 'diretor' );
				$categoria_diretor = $SAV->get_proposta_meta( $proposta->id_proposta, 'categoria_diretor' );
				$dados_diretor     = $SAV->get_dados_pessoais( $login_diretor );
				$regiao 		   = $SAV->where_regiao( $dados_geograficos['estado'] );

				if( $status == 'inabilitado' )
					$observacao	   = $SAV->get_proposta_meta( $proposta->id_proposta, 'observacoes' );

				if ( $status == 'recurso' )
					$observacao = $SAV->get_proposta_meta( $proposta->id_proposta, 'solicitacao_recurso_inabilitado' );

				$html .= "<tr>";
				$html .= "<td>". $this->protocolo( $proposta->id_edital, $proposta->id_proposta )."</td>";
				$html .= "<td>". $proposta->titulo ."</td>";
				$html .= "<td>". $user->user_firstname ." ". $user->user_lastname ."</td>";
				$html .= "<td>". $dados_geograficos['estado'] ."</td>";
				$html .= "<td>". strtoupper( $regiao ) ."</td>";
				$html .= "<td>". $proposta->status ."</td>";

				if( 1 == $id_edital )
				{
					$html .= "<td>{$dados_diretor[ 'nome' ]}</td>";
					$html .= "<td>{$categoria_diretor}</td>";
				}

				if ( $observacao )
					$html .= "<td>". $observacao ."</td>";
				$html .= "</tr>";
			}

			$html .= "</table>";

			print( $html );
		}
		exit;
	}

	/**
	 * gerenciar propostas
	 *
	 * @name    gerenciar_propostas
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-18
	 * @updated 2011-12-23
	 * @return  void
	 */
	function gerenciar_propostas()
	{
		global $SAV;

		$id_edital   = (int) $_REQUEST[ 'id_edital' ];
		$id_proposta = (int) $_REQUEST[ 'id_proposta' ];
		$user 		 = (int) $_REQUEST[ 'user' ];
		$status = $_REQUEST[ 'status' ];

		$acao        = $_REQUEST[ 'acao' ];

		$this->acertar_passo( $id_edital, $id_proposta );

		// gerenciar dados
		switch( $acao )
		{
			// salvar proposta
			case 'salvar_proposta_dados_concorrente' :
				$this->salvar_proposta_dados_concorrente( $user, $id_edital, $id_proposta);
			break;
			case 'salvar_proposta_dados_gerais' :
				$this->salvar_proposta_dados_gerais( $id_edital, $id_proposta );
			break;
			case 'salvar_proposta_dados_diretor' :
				//$this->salvar_proposta_dados_diretor( $id_edital, $id_proposta );
				$this->salvar_proposta_dados_profissional( $id_edital, $id_proposta, 'Diretor' );
			break;
			case 'salvar_proposta_dados_produtor' :
				//$this->salvar_proposta_dados_produtor( $id_edital, $id_proposta );
				$this->salvar_proposta_dados_profissional( $id_edital, $id_proposta, 'Produtor' );
			break;
			case 'salvar_proposta_dados_roteirista' :
				//$this->salvar_proposta_dados_roteirista( $id_edital, $id_proposta );
				$this->salvar_proposta_dados_profissional( $id_edital, $id_proposta, 'Roteirista' );
			break;
			case 'salvar_proposta_orcamento' :
				$this->salvar_proposta_orcamento( $id_edital, $id_proposta );
			break;
			case 'salvar_proposta_declaracao' :
				$this->salvar_proposta_declaracao( $id_edital, $id_proposta );
			break;
			case 'salvar_avaliacao' :
				$this->salvar_avaliacao( $id_edital, $id_proposta );
			break;
			case 'salvar_categoria_reclassificacao' :
				$this->salvar_categoria_reclassificacao( $id_edital, $id_proposta );
			break;
			case 'salvar_grupos' :
				$this->salvar_grupos( $id_edital, $id_proposta );
			break;
			case 'salvar_solicitacao_recurso' :
				$this->salvar_solicitacao_recurso( $id_edital, $id_proposta );
			break;
			case 'pdf_proposta' :
				$this->pdf_proposta( $id_edital, $id_proposta );
			break;
			case 'excel_propostas' :
				$this->excel_propostas( $id_edital, $status );
			break;
			case 'salvar_avaliacao_consultor' :
				$this->salvar_avaliacao_consultor( $id_edital, $id_proposta);
			break;
			case 'finalizar_avaliacao_consultor' :
				$this->finalizar_avaliacao_consultor( $id_edital );
			break;
			case 'deletar_proposta' :
				$SAV->delete_proposta( $id_proposta );
			break;
		}
	}


	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////
	/**
	 * @name    SAV_Propostas
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-18
	 * @updated 2011-08-18
	 * @return  void
	 */
	function SAV_Propostas()
	{
		// menu
		add_action( 'admin_menu', array( &$this, 'menus' ) );

		// gerenciar editais
		add_action( 'init', array( &$this, 'gerenciar_propostas' ) );

	}

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

$SAV_Propostas = new SAV_Propostas();

?>