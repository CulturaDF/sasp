

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
 *
 * Plugin Name: SAv
 * Plugin URI: http://xemele.cultura.gov.br/
 * Description: ...
 * Author: SAv | Ministério da Cultura
 * Version: 12.02.28
 * Author URI: http://marcelomesquita.com/
 */

class SAV
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////
	var $slug  = 'sav';
	var $dir   = '';
	var $url   = '';
	var $error = '';

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////
	/**
	 * adicionar uma mensagen de erro
	 *
	 * @name    update_error
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-23
	 * @updated 2011-09-23
	 * @return  void
	 */
	function update_error( $error )
	{
		if( !is_array( $this->error ) )
			$this->error = array();

		if( empty( $error ) )
			return false;

		if( is_array( $error ) )
			$this->error = array_merge( $this->error, $error );
		else
			array_push( $this->error, $error );
	}

	/**
	 * adicionar as tabelas do plugin no $wpdb
	 *
	 * @name    tables
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2011-12-20
	 * @return  void
	 */
	function tables()
	{
		global $wpdb;

		// proponentes
		$wpdb->sav_dados_empresa       = "{$wpdb->base_prefix}sav_dados_empresa";
		$wpdb->sav_dados_pessoais      = "{$wpdb->base_prefix}sav_dados_pessoais";
		$wpdb->sav_dados_profissionais = "{$wpdb->base_prefix}sav_dados_profissionais";
		$wpdb->sav_dados_contato       = "{$wpdb->base_prefix}sav_dados_contato";
		$wpdb->sav_dados_geograficos   = "{$wpdb->base_prefix}sav_dados_geograficos";

		// experiencias
		$wpdb->sav_experiencias_cinema = "{$wpdb->base_prefix}sav_experiencias_cinema";

		// editais
		$wpdb->sav_editais             = "{$wpdb->base_prefix}sav_editais";
		$wpdb->sav_edital_meta         = "{$wpdb->base_prefix}sav_edital_meta";
		$wpdb->sav_propostas           = "{$wpdb->base_prefix}sav_propostas";
		$wpdb->sav_proposta_meta       = "{$wpdb->base_prefix}sav_proposta_meta";
		$wpdb->sav_orcamentos          = "{$wpdb->base_prefix}sav_orcamentos";
		$wpdb->sav_producao_cinema     = "{$wpdb->base_prefix}sav_producao_cinema";
		$wpdb->sav_direcao_cinema      = "{$wpdb->base_prefix}sav_direcao_cinema";
		$wpdb->sav_roteiro_cinema      = "{$wpdb->base_prefix}sav_roteiro_cinema";
		$wpdb->sav_criterios		   = "{$wpdb->base_prefix}sav_criterios";
		$wpdb->sav_avaliacao		   = "{$wpdb->base_prefix}sav_avaliacao";
		$wpdb->sav_proposta_historico  = "{$wpdb->base_prefix}sav_proposta_historico";

		//convenios
		$wpdb->sav_dados_ong	  	   = "{$wpdb->base_prefix}sav_dados_ong";
		$wpdb->sav_chamada_convenio	   = "{$wpdb->base_prefix}sav_chamada_convenio";

	}

	/**
	 * criar perfis, tabelas e inicializar opções
	 *
	 * @name    install
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2011-08-25
	 * @return  void
	 */
	function install()
	{
		$this->install_tables();
		$this->install_roles_privileges();
	}

	/**
	 * instalar tabelas
	 *
	 * @name    install_tables
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2011-12-26
	 * @return  void
	 */
	function install_tables()
	{
		global $wpdb;

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		// dados empresa
		if( $wpdb->sav_dados_empresa !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_dados_empresa}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_dados_empresa}
				(
					login              VARCHAR( 60 ) NOT NULL,
					nome               VARCHAR( 250 ) NOT NULL,
					cpf_representante  VARCHAR( 60 ) NOT NULL,
					nome_representante VARCHAR( 250 ) NOT NULL,
					ra                 BIGINT NULL,
					natureza		   VARCHAR( 250 ) NULL,

					PRIMARY KEY( login )
				)
			" );
		}

		// dados pessoais
		if( $wpdb->sav_dados_pessoais !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_dados_pessoais}'" ) )
		{
			dbDelta( "
			CREATE TABLE {$wpdb->sav_dados_pessoais}
			(
				login	     	VARCHAR( 60 ) NOT NULL,
				nome			VARCHAR( 250 ) NOT NULL,
				nascimento		DATETIME DEFAULT '0000-00-00' NULL,
				nacionalidade 	VARCHAR( 250 ) NULL,
				naturalidade	VARCHAR( 250 ) NULL,
				rg				VARCHAR( 30  ) NULL,

				PRIMARY KEY( login )
			)
			" );
		}

		// dados profissionais
		if( $wpdb->sav_dados_profissionais !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_dados_profissionais}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_dados_profissionais}
				(
					login     VARCHAR( 60 ) NOT NULL,
					ocupacao  VARCHAR( 250 ) NULL,
					formacao  VARCHAR( 250 ) NULL,
					interesse VARCHAR( 250 ) NULL,
					biografia VARCHAR( 250 ) NULL,

					PRIMARY KEY( login )
				)
			" );
		}

		// dados geograficos
		if( $wpdb->sav_dados_geograficos !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_dados_geograficos}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_dados_geograficos}
				(
					login    VARCHAR( 60 ) NOT NULL,
					pais     VARCHAR( 250 ) NULL,
					estado   VARCHAR( 250 ) NULL,
					cidade   VARCHAR( 250 ) NULL,
					bairro   VARCHAR( 250 ) NULL,
					endereco VARCHAR( 250 ) NULL,
					cep      BIGINT NULL,

					PRIMARY KEY( login )
				)
			" );
		}

		// dados de contato
		if( $wpdb->sav_dados_contato !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_dados_contato}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_dados_contato}
				(
					login        VARCHAR( 60 ) NOT NULL,
					email        VARCHAR( 250 ) NOT NULL,
					site         VARCHAR( 250 ) NOT NULL,
					ddi_telefone INT( 2 ) NULL,
					ddd_telefone INT( 2 ) NULL,
					telefone     INT( 8 ) NULL,
					ddi_celular  INT( 2 ) NULL,
					ddd_celular  INT( 2 ) NULL,
					celular      INT( 8 ) NULL,

					PRIMARY KEY( login )
				)
			" );
		}

		// experiencias cinema
		if( $wpdb->sav_experiencias_cinema !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_experiencias_cinema}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_experiencias_cinema}
				(
					id_experiencia_cinema BIGINT NOT NULL AUTO_INCREMENT,
					login                 VARCHAR( 60 ) NOT NULL,
					titulo                VARCHAR( 250 ) NOT NULL,
					funcao                VARCHAR( 250 ) NOT NULL,
					ano                   INT( 4 ) NOT NULL,
					suporte_captacao      VARCHAR( 30 ) NOT NULL,
					suporte_finalizacao   VARCHAR( 30 ) NOT NULL,
					duracao               INT( 3 ) NOT NULL,
					comprovante           VARCHAR( 250 ) NOT NULL,

					PRIMARY KEY( id_experiencia_cinema )
				)
			" );
		}

		// editais
		if( $wpdb->sav_editais !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_editais}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_editais}
				(
					id_edital    BIGINT NOT NULL AUTO_INCREMENT,
					id_author    BIGINT NOT NULL,
					titulo       VARCHAR( 250 ) NOT NULL,
					descricao    TEXT NULL,
					declaracao   TEXT NULL,
					area         VARCHAR( 30 ) NULL,
					abertura     DATETIME DEFAULT '0000-00-00' NULL,
					encerramento DATETIME DEFAULT '0000-00-00' NULL,
					pf           BOOL NULL,
					pj           BOOL NULL,
					registrado   DATETIME DEFAULT '0000-00-00' NULL,
					atualizado   DATETIME DEFAULT '0000-00-00' NULL,
					status       VARCHAR( 30 ) NULL,

					PRIMARY KEY( id_edital )
				)
			" );
		}

		// edital_meta
		if( $wpdb->sav_edital_meta !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_edital_meta}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_edital_meta}
				(
					id_meta    BIGINT NOT NULL AUTO_INCREMENT,
					id_edital  BIGINT NOT NULL,
					meta_key   VARCHAR( 250 ) NOT NULL,
					meta_value TEXT NOT NULL,

					PRIMARY KEY( id_meta )
				)
			" );
		}

		// propostas
		if( $wpdb->sav_propostas !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_propostas}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_propostas}
				(
					id_proposta        BIGINT NOT NULL AUTO_INCREMENT,
					id_edital          BIGINT NOT NULL,
					id_author          BIGINT NOT NULL,
					titulo             VARCHAR( 250 ) NOT NULL,
					descricao          TEXT NULL,
					contrapartida      TEXT NULL,
					registrado         DATETIME DEFAULT '0000-00-00' NULL,
					atualizado         DATETIME DEFAULT '0000-00-00' NULL,
					status             VARCHAR( 30 ) NULL,

					PRIMARY KEY( id_proposta )
				)
			" );
		}

		// proposta_meta
		if( $wpdb->sav_proposta_meta !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_proposta_meta}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_proposta_meta}
				(
					id_meta     BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta BIGINT NOT NULL,
					meta_key    VARCHAR( 250 ) NOT NULL,
					meta_value  TEXT NOT NULL,

					PRIMARY KEY( id_meta )
				)
			" );
		}

		// producao cinema
		if( $wpdb->sav_producao_cinema !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_producao_cinema}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_producao_cinema}
				(
					id_producao_cinema       BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta              BIGINT NOT NULL,
					plano_producao           TEXT NULL,
					estrategia_producao      TEXT NULL,
					viabilidade_orcamentaria TEXT NULL,

					PRIMARY KEY( id_producao_cinema )
				)
			" );
		}

		// direcao cinema
		if( $wpdb->sav_direcao_cinema !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_direcao_cinema}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_direcao_cinema}
				(
					id_direcao_cinema        BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta              BIGINT NOT NULL,
					plano_direcao            TEXT NULL,
					plano_distribuicao       TEXT NULL,
					suporte_captacao         VARCHAR( 45 ) NULL,
					suporte_finalizacao      VARCHAR( 45 ) NULL,

					PRIMARY KEY( id_direcao_cinema )
				)
			" );
		}

		// roteiro cinema
		if( $wpdb->sav_roteiro_cinema !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_roteiro_cinema}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_roteiro_cinema}
				(
					id_roteiro_cinema BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta       BIGINT NOT NULL,
					plano_roteiro     TEXT NULL,
					personagens       TEXT NULL,
					infantil          BOOL NULL,

					PRIMARY KEY( id_roteiro_cinema )
				)
			" );
		}

		// orcamentos
		if( $wpdb->sav_orcamentos !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_orcamentos}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_orcamentos}
				(
					id_orcamento   BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta    BIGINT NOT NULL,
					etapa          VARCHAR( 45 ) NULL,
					area           VARCHAR( 45 ) NULL,
					item           VARCHAR( 250 ) NULL,
					quantidade     DOUBLE( 10, 2 ) NULL,
					unidade        VARCHAR( 45 ) NULL,
					valor_unitario DOUBLE( 10, 2 ) NULL,
					valor_total    DOUBLE( 10, 2 ) NULL,

					PRIMARY KEY( id_orcamento )
				)
			" );
		}

		// criterios
		if ($wpdb->sav_criterios !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_criterios}'") )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_criterios}
				(
					id_criterio BIGINT NOT NULL AUTO_INCREMENT,
					id_edital 	BIGINT NOT NULL,
					descricao	VARCHAR( 250 ) NULL,

					PRIMARY KEY( id_criterio )
				)
			" );

		}

		// avaliacao
		if ($wpdb->sav_avaliacao !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_avaliacao}'") )
		{
			dbDelta("
				CREATE TABLE {$wpdb->sav_avaliacao}
				(
					id_avaliacao BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta  BIGINT NOT NULL,
					id_criterio  BIGINT NOT NULL,
					id_consultor BIGINT NOT NULL,
					nota         DOUBLE (10,2) NULL,

					PRIMARY KEY ( id_avaliacao )
				)
			");
		}

		// dados ong
		if( $wpdb->sav_dados_ong !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_dados_ong}'" ) )
		{
			dbDelta( "
				CREATE TABLE {$wpdb->sav_dados_ong}
				(
					login         			VARCHAR( 60 ) NOT NULL,
					numero_siconv       	INT( 30 ) NULL,
					objeto_social			TEXT NULL,
					estatuto_social			VARCHAR( 250 ) NULL,
					tempo_atividade 		VARCHAR( 250 ) NULL,
					comprovacao_capacidade  VARCHAR( 250 ) NULL,

					PRIMARY KEY( login )
				)
			" );
		}



		//chamada convenio
		if ($wpdb->sav_chamada_convenio !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_chamada_convenio}'") )
		{
			dbDelta("
				CREATE TABLE {$wpdb->sav_chamada_convenio}
				(
					id_chamada_convenio		BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta    		 	BIGINT NOT NULL,
					macro_politicas 		TEXT NULL,
					objetivos				TEXT NULL,
					justificativa	 	  	TEXT NULL,
					caracteristica_publico	TEXT NULL,
					acessibilidade			TEXT NULL,
					democratizacao_acesso	TEXT NULL,
					cronograma_execucao		VARCHAR( 250 ) NULL,
					outras_informacoes		TEXT NULL,
					metas_resultados		TEXT NULL,
					valor_total				DOUBLE (10,2) NULL,

					PRIMARY KEY ( id_chamada_convenio )
				)
			");
		}

		// proposta historico
		if ($wpdb->sav_proposta_historico !== $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->sav_proposta_historico}'") )
		{
			dbDelta("
				CREATE TABLE {$wpdb->sav_proposta_historico}
				(
					id_historico			BIGINT NOT NULL AUTO_INCREMENT,
					id_proposta    		 	BIGINT NOT NULL,
					id_author    		 	BIGINT NOT NULL,
					acao					VARCHAR( 250 ) NULL,
					observacao		 		TEXT NULL,
					data					DATETIME NULL,
					anexo					TEXT NULL,
					status					VARCHAR( 250 ) NULL,
					mostrar					BOOL NULL,

					PRIMARY KEY ( id_historico)
				)
			");
		}
	}

	/**
	 * install roles and privileges
	 *
	 * @name    install_roles_privileges
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-15
	 * @updated 2012-02-24
	 * @return  void
	 */
	function install_roles_privileges()
	{
		// creating privileges
		$role = get_role( 'administrator' );
			$role->add_cap( 'edit_sav_editais' );
			$role->add_cap( 'delete_sav_editais' );
			$role->add_cap( 'edit_sav_propostas' );
			$role->add_cap( 'delete_sav_propostas' );
			$role->add_cap( 'approve_sav_propostas' );
			$role->add_cap( 'review_sav_propostas' );
			$role->add_cap( 'classifies_sav_propostas' );

		// create specific roles
		// proponente
		add_role(
			'proponente',
			'Proponente',
			array(
				'read'                     => 1,
				'edit_posts'               => 0,
				'delete_posts'             => 0,
				'upload_files'             => 0,
				'publish_posts'            => 0,
				'edit_published_posts'     => 0,
				'delete_published_posts'   => 0,
				'edit_sav_editais'         => 0,
				'delete_sav_editais'       => 0,
				'edit_sav_propostas'       => 1,
				'delete_sav_propostas'     => 0,
				'approve_sav_propostas'    => 0,
				'review_sav_propostas'     => 0,
				'classifies_sav_propostas' => 0,
				'level_0'                  => 1,
				'level_1'                  => 1,
				'level_2'                  => 1,
			)
		);

		// consultor
		add_role(
			'consultor',
			'Consultor',
			array(
				'read'                      => 1,
				'edit_posts'                => 0,
				'delete_posts'              => 0,
				'upload_files'              => 0,
				'publish_posts'             => 0,
				'edit_published_posts'      => 0,
				'delete_published_posts'    => 0,
				'edit_sav_editais'          => 0,
				'delete_sav_editais'        => 0,
				'edit_sav_propostas'        => 1,
				'delete_sav_propostas'      => 0,
				'approve_sav_propostas'     => 1,
				'review_sav_propostas'      => 0,
				'classifies_sav_propostas'  => 1,
				'level_0'                   => 1,
				'level_1'                   => 1,
				'level_2'                   => 1,
			)
		);

		// analista
		add_role(
			'analista',
			'Analista',
			array(
				'read'                     => 1,
				'edit_posts'               => 1,
				'delete_posts'             => 1,
				'upload_files'             => 1,
				'publish_posts'            => 1,
				'edit_published_posts'     => 1,
				'delete_published_posts'   => 1,
				'edit_sav_editais'         => 0,
				'delete_sav_editais'       => 1,
				'edit_sav_propostas'       => 1,
				'delete_sav_propostas'     => 1,
				'approve_sav_propostas'    => 1,
				'review_sav_propostas'     => 1,
				'classifies_sav_propostas' => 0,
				'level_0'                  => 1,
				'level_1'                  => 1,
				'level_2'                  => 1,
			)
		);
	}

	/**
	 * delete roles
	 *
	 * @name    uninstall
	 * @author  Marcelo Mesquita <stallefish@gmail.com>
	 * @since   2011-08-09
	 * @updated 2011-08-09
	 * @return  void
	 */
	function uninstall()
	{
		remove_role( 'proponente' );
		remove_role( 'consultor' );
		remove_role( 'analista' );
	}

	/**
	 * limpar texto
	 *
	 * @name    limpar_texto
	 * @author  Marcelo Mesquita <stallefish@gmail.com>
	 * @since   2011-11-01
	 * @updated 2012-02-10
	 * @return  void
	 */
	function limpar_texto( $texto )
	{
		$texto = htmlspecialchars( stripslashes( $texto ), ENT_NOQUOTES );

		$texto = str_replace( "\r\n", "\n", $texto );
		$texto = str_replace( "'", '"', $texto );
		$texto = str_replace( "’", "'", $texto );
		$texto = str_replace( "‘", "'", $texto );
		$texto = str_replace( "”", '"', $texto );
		$texto = str_replace( "“", '"', $texto );
		$texto = str_replace( "–", '-', $texto );
		$texto = str_replace( "…", '.', $texto );

		return $texto;
	}

	/**
	 * update proponente
	 *
	 * @name    update_proponente
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  void
	 */
	function update_proponente( $proponente )
	{
		global $wpdb;

		if( !empty( $proponente[ 'empresa' ] ) )
		{
			$proponente[ 'empresa' ][ 'login' ] = $proponente[ 'login' ];
			$this->update_dados_empresa( $proponente[ 'empresa' ] );
		}

		if( !empty( $proponente[ 'pessoal' ] ) )
		{
			$proponente[ 'pessoal' ][ 'login' ] = $proponente[ 'login' ];
			$this->update_dados_pessoais( $proponente[ 'pessoal' ] );
		}

		if( !empty( $proponente[ 'profissional' ] ) )
		{
			$proponente[ 'profissional' ][ 'login' ] = $proponente[ 'login' ];
			$this->update_dados_profissionais( $proponente[ 'profissional' ] );
		}

		if( !empty( $proponente[ 'contato' ] ) )
		{
			$proponente[ 'contato' ][ 'login' ] = $proponente[ 'login' ];
			$this->update_dados_contato( $proponente[ 'contato' ] );
		}

		if( !empty( $proponente[ 'geografico' ] ) )
		{
			$proponente[ 'geografico' ][ 'login' ] = $proponente[ 'login' ];
			$this->update_dados_geograficos( $proponente[ 'geografico' ] );
		}
	}

	/**
	 * get proponente
	 *
	 * @name    get_proponente
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_proponente( $login )
	{
		$proponente[ 'login' ]        = $login;
		$proponente[ 'empresa' ]      = $this->get_dados_empresa( $login );
		$proponente[ 'pessoal' ]      = $this->get_dados_pessoais( $login );
		$proponente[ 'profissional' ] = $this->get_dados_profissionais( $login );
		$proponente[ 'contato' ]      = $this->get_dados_contato( $login );
		$proponente[ 'geografico' ]   = $this->get_dados_geograficos( $login );

		return $proponente;
	}

	/**
	 * update dados empresa
	 *
	 * @name    update_dados_empresa
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-26
	 * @updated 2011-08-26
	 * @return  void
	 */
	function update_dados_empresa( $proponente )
	{
		global $wpdb;

		$login = $wpdb->get_var( $wpdb->prepare( "SELECT login FROM {$wpdb->sav_dados_empresa} WHERE login = %s LIMIT 1", $proponente[ 'login' ] ) );

		if( empty( $login ) )
		{
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_dados_empresa} ( login, nome, cpf_representante, nome_representante, ra, natureza ) VALUES ( %s, %s, %s, %s, %d, %s )", $proponente[ 'login' ], $proponente[ 'nome' ], $proponente[ 'cpf_representante' ], $proponente[ 'nome_representante' ], $proponente[ 'ra' ],  $proponente[ 'natureza' ] ) );
		}
		else
		{
			$proponente_atual = $this->get_dados_empresa( $login );

			// atualizar apenas os dados informados
			if( !empty( $proponente_atual ) )
				$proponente = array_merge( $proponente_atual, $proponente );

			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_dados_empresa} SET nome = %s, nome_representante = %s, ra = %d, natureza = %s WHERE login = %s", $proponente[ 'nome' ], $proponente[ 'nome_representante' ], $proponente[ 'ra' ],  $proponente[ 'natureza' ], $proponente[ 'login' ] ) );
		}
	}

	/**
	 * get dados empresa
	 *
	 * @name    get_dados_empresa
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-26
	 * @updated 2011-08-26
	 * @return  mixed
	 */
	function get_dados_empresa( $login )
	{
		global $wpdb;

		$proponente = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_dados_empresa} WHERE login = %s LIMIT 1", $login ) );

		// transformar o objeto em array
		$proponente = get_object_vars( $proponente );

		return $proponente;
	}

	/**
	 * update dados pessoais
	 *
	 * @name    update_dados_pessoais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  void
	 */
	function update_dados_pessoais( $proponente )
	{
		global $wpdb;

		$login = $wpdb->get_var( $wpdb->prepare( "SELECT login FROM {$wpdb->sav_dados_pessoais} WHERE login = %s LIMIT 1", $proponente[ 'login' ] ) );

		if( empty( $login ) )
		{
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_dados_pessoais} ( login, nome, nascimento, nacionalidade, naturalidade, rg ) VALUES ( %s, %s, %s, %s, %s, %s )", $proponente[ 'login' ], $proponente[ 'nome' ], $proponente[ 'nascimento' ], $proponente[ 'nacionalidade' ], $proponente[ 'naturalidade' ], $proponente[ 'rg' ] ) );
		}
		else
		{
			$proponente_atual = $this->get_dados_pessoais( $login );

			// atualizar apenas os dados informados
			if( !empty( $proponente_atual ) )
				$proponente = array_merge( $proponente_atual, $proponente );

			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_dados_pessoais} SET nome = %s, nascimento = %s, nacionalidade = %s, naturalidade = %s, rg = %s WHERE login = %s", $proponente[ 'nome' ], $proponente[ 'nascimento' ], $proponente[ 'nacionalidade' ], $proponente[ 'naturalidade' ], $proponente[ 'rg' ], $proponente[ 'login' ] ) );
		}
	}

	/**
	 * get dados pessoais
	 *
	 * @name    get_dados_pessoais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_dados_pessoais( $login )
	{
		global $wpdb;

		$proponente = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_dados_pessoais} WHERE login = %s LIMIT 1", $login ) );

		// transformar o objeto em array
		$proponente = get_object_vars( $proponente );

		return $proponente;
	}

	/**
	 * update dados profissionais
	 *
	 * @name    update_dados_profissionais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  void
	 */
	function update_dados_profissionais( $proponente )
	{
		global $wpdb;

		$login = $wpdb->get_var( $wpdb->prepare( "SELECT login FROM {$wpdb->sav_dados_profissionais} WHERE login = %s LIMIT 1", $proponente[ 'login' ] ) );

		if( empty( $login ) )
		{
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_dados_profissionais} ( login, ocupacao, formacao, interesse, biografia ) VALUES ( %s, %s, %s, %s, %s )", $proponente[ 'login' ], $proponente[ 'ocupacao' ], $proponente[ 'formacao' ], $proponente[ 'interesse' ], $proponente[ 'biografia' ] ) );
		}
		else
		{
			$proponente_atual = $this->get_dados_profissionais( $login );

			// atualizar apenas os dados informados
			if( !empty( $proponente_atual ) )
				$proponente = array_merge( $proponente_atual, $proponente );

			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_dados_profissionais} SET ocupacao = %s, formacao = %s, interesse = %s, biografia = %s WHERE login = %s", $proponente[ 'ocupacao' ], $proponente[ 'formacao' ], $proponente[ 'interesse' ], $proponente[ 'biografia' ], $proponente[ 'login' ] ) );
		}
	}

	/**
	 * get dados profissionais
	 *
	 * @name    get_dados_profissionais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_dados_profissionais( $login )
	{
		global $wpdb;

		$proponente = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_dados_profissionais} WHERE login = %s LIMIT 1", $login ) );

		// transformar o objeto em array
		$proponente = get_object_vars( $proponente );

		return $proponente;
	}

	/**
	 * update dados de contato
	 *
	 * @name    update_dados_contato
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-09-30
	 * @return  void
	 */
	function update_dados_contato( $proponente )
	{
		global $wpdb;

		$login = $wpdb->get_var( $wpdb->prepare( "SELECT login FROM {$wpdb->sav_dados_contato} WHERE login = %s LIMIT 1", $proponente[ 'login' ] ) );

		if( empty( $login ) )
		{
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_dados_contato} ( login, email, site, ddi_telefone, ddd_telefone, telefone, ddi_celular, ddd_celular, celular ) VALUES ( %s, %s, %s, %d, %d, %s, %d, %d, %s )", $proponente[ 'login' ], $proponente[ 'email' ], $proponente[ 'site' ], $proponente[ 'ddi_telefone' ], $proponente[ 'ddd_telefone' ], $proponente[ 'telefone' ], $proponente[ 'ddi_celular' ], $proponente[ 'ddd_celular' ], $proponente[ 'celular' ] ) );
		}
		else
		{
			$proponente_atual = $this->get_dados_contato( $login );

			// atualizar apenas os dados informados
			if( !empty( $proponente_atual ) )
				$proponente = array_merge( $proponente_atual, $proponente );

			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_dados_contato} SET email = %s, site = %s, ddi_telefone = %d, ddd_telefone = %d, telefone = %s, ddi_celular = %d, ddd_celular = %d, celular = %s WHERE login = %s", $proponente[ 'email' ], $proponente[ 'site' ], $proponente[ 'ddi_telefone' ], $proponente[ 'ddd_telefone' ], $proponente[ 'telefone' ], $proponente[ 'ddi_celular' ], $proponente[ 'ddd_celular' ], $proponente[ 'celular' ], $proponente[ 'login' ] ) );
		}
	}

	/**
	 * get dados de contato
	 *
	 * @name    get_dados_contato
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_dados_contato( $login )
	{
		global $wpdb;

		$proponente = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_dados_contato} WHERE login = %s LIMIT 1", $login ) );

		// transformar o objeto em array
		$proponente = get_object_vars( $proponente );

		return $proponente;
	}

	/**
	 * update dados geograficos
	 *
	 * @name    update_dados_geograficos
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  void
	 */
	function update_dados_geograficos( $proponente )
	{
		global $wpdb;

		$login = $wpdb->get_var( $wpdb->prepare( "SELECT login FROM {$wpdb->sav_dados_geograficos} WHERE login = %s LIMIT 1", $proponente[ 'login' ] ) );

		if( empty( $login ) )
		{
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_dados_geograficos} ( login, pais, estado, cidade, bairro, endereco, cep ) VALUES ( %s, %s, %s, %s, %s, %s, %d )", $proponente[ 'login' ], $proponente[ 'pais' ], $proponente[ 'estado' ], $proponente[ 'cidade' ], $proponente[ 'bairro' ], $proponente[ 'endereco' ], $proponente[ 'cep' ] ) );
		}
		else
		{
			$proponente_atual = $this->get_dados_geograficos( $login );

			// atualizar apenas os dados informados
			if( !empty( $proponente_atual ) )
				$proponente = array_merge( $proponente_atual, $proponente );

			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_dados_geograficos} SET pais = %s, estado = %s, cidade = %s, bairro = %s, endereco = %s, cep = %d WHERE login = %s", $proponente[ 'pais' ], $proponente[ 'estado' ], $proponente[ 'cidade' ], $proponente[ 'bairro' ], $proponente[ 'endereco' ], $proponente[ 'cep' ], $proponente[ 'login' ] ) );
		}
	}

	/**
	 * get dados geograficos
	 *
	 * @name    get_dados_geograficos
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-09-22
	 * @return  mixed
	 */
	function get_dados_geograficos( $login )
	{
		global $wpdb;

		$proponente = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_dados_geograficos} WHERE login = %s LIMIT 1", $login ) );

		// transformar o objeto em array
		$proponente = get_object_vars( $proponente );

		return $proponente;
	}

	/**
	 * update edital
	 *
	 * @name    update_edital
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-12-23
	 * @return  void
	 */
	function update_edital( $edital )
	{
		if( !current_user_can( 'edit_sav_editais' ) )
			return false;

		global $wpdb, $user_ID;

		$id_edital = $wpdb->get_var( $wpdb->prepare( "SELECT id_edital FROM {$wpdb->sav_editais} WHERE id_edital = %d LIMIT 1", $edital[ 'id_edital' ] ) );

		if( empty( $id_edital ) )
		{
			if( $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_editais} ( id_author, titulo, descricao, declaracao, area, abertura, encerramento, pf, pj, registrado, status ) VALUES ( %d, %s, %s, %s, %s, %s, %s, %d, %d, %s, 'publico' )", $user_ID, $edital[ 'titulo' ], $edital[ 'descricao' ], $edital[ 'declaracao' ], $edital[ 'area' ], $edital[ 'abertura' ], $edital[ 'encerramento' ], $edital[ 'pf' ], $edital[ 'pj' ], date( 'Y-m-d H:i:s' ) ) ) )
				return $wpdb->insert_id;
		}
		else
		{
			if( $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_editais} SET titulo = %s, descricao = %s, declaracao = %s, area = %s, abertura = %s, encerramento = %s, pf = %d, pj = %d, atualizado = %s WHERE id_edital = %d", $edital[ 'titulo' ], $edital[ 'descricao' ], $edital[ 'declaracao' ], $edital[ 'area' ], $edital[ 'abertura' ], $edital[ 'encerramento' ], $edital[ 'pf' ], $edital[ 'pj' ], date( 'Y-m-d H:i:s' ), $edital[ 'id_edital' ] ) ) )
				return $edital[ 'id_edital' ];
		}

		return false;
	}

	/**
	 * delete edital
	 *
	 * @name    delete_edital
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-22
	 * @updated 2011-10-31
	 * @return  void
	 */
	function delete_edital( $id_edital )
	{
		if( !current_user_can( 'delete_sav_editais' ) )
			return false;

		global $wpdb;

		if( !empty( $id_edital ) )
		{
			if( $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_editais} SET status = 'lixo' WHERE id_edital = %d", $id_edital ) ) )
				return true;
		}

		return false;
	}

	/**
	 * get edital
	 *
	 * @name    get_edital
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_edital( $id_edital )
	{
		global $wpdb;

		$edital = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_editais} WHERE id_edital = %d LIMIT 1", $id_edital ) );

		// transformar o objeto em array
		$edital = get_object_vars( $edital );

		return $edital;
	}

	/**
	 * update edital meta
	 *
	 * @name    update_edital_meta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  void
	 */
	function update_edital_meta( $id_edital, $meta_name, $meta_value )
	{
		if( !current_user_can( 'approve_sav_propostas' ) )
			return false;

		global $wpdb;

		if( !is_serialized( $meta_value ) )
			$meta_value = maybe_serialize( $meta_value );

		$id_meta = $wpdb->get_var( $wpdb->prepare( "SELECT id_meta FROM {$wpdb->sav_edital_meta} WHERE id_edital = %d AND meta_key = %s LIMIT 1", $id_edital, $meta_name ) );

		if( !empty( $id_meta) )
			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_edital_meta} SET meta_value = %s WHERE id_meta = %d", $meta_value, $id_meta ) );
		else
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_edital_meta} ( id_edital, meta_key, meta_value ) VALUES ( %d, %s, %s )", $id_edital, $meta_name, $meta_value ) );
	}

	/**
	 * get edital meta
	 *
	 * @name    get_edital_meta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_edital_meta( $id_edital, $meta_name )
	{
		global $wpdb;

		$meta_value = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM {$wpdb->sav_edital_meta} WHERE id_edital = %d AND meta_key = %s LIMIT 1", $id_edital, $meta_name ) );

		if( is_serialized( $meta_value ) )
			$meta_value = maybe_unserialize( $meta_value );

		return $meta_value;
	}

	/**
	 * delete edital meta
	 *
	 * @name    delete_edital_meta
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-27
	 * @updated 2012-02-27
	 * @return  void
	 */
	function delete_edital_meta( $id_edital, $meta_name ) {

		global $wpdb;

		if ( empty($id_edital) or empty($meta_name) )
			return false;

		$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->sav_edital_meta} WHERE id_edital = %d AND meta_key = %s", $id_edital, $meta_name  ) );

	}

	/**
	 * update proposta
	 *
	 * @name    update_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-12-19
	 * @return  void
	 */
	function update_proposta( $proposta )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb, $user_ID;

		$id_proposta = $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d LIMIT 1", $proposta[ 'id_proposta' ] ) );

		if( empty( $id_proposta ) )
		{
			if( $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_propostas} ( id_edital, id_author, titulo, descricao, contrapartida, registrado, status ) VALUES ( %d, %d, %s, %s, %s, %s, %s )", $proposta[ 'id_edital' ], $user_ID, $proposta[ 'titulo' ], $proposta[ 'descricao' ], $proposta[ 'contrapartida' ], date( 'Y-m-d H:i:s' ), $proposta[ 'status' ] ) ) )
			{
				$id_proposta = $wpdb->insert_id;

				// registrar histórico
				if( !empty( $id_proposta ) )
					$this->registrar_historico_proposta( $id_proposta, 'Início', 'Proposta Iniciada no Sistema' );

				return $id_proposta;
			}
		}
		else
		{
			if( $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_propostas} SET titulo = %s, descricao = %s, contrapartida = %s, atualizado = %s, status = %s WHERE id_proposta = %d", $proposta[ 'titulo' ], $proposta[ 'descricao' ], $proposta[ 'contrapartida' ], date( 'Y-m-d H:i:s' ), $proposta[ 'status' ], $proposta[ 'id_proposta' ] ) ) )
			return $proposta[ 'id_proposta' ];
		}

		return false;
	}

	/**
	 * delete proposta
	 *
	 * @name    delete_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-31
	 * @updated 2011-10-31
	 * @return  void
	 */
	function delete_proposta( $id_proposta )
	{
		if( !current_user_can( 'delete_sav_propostas' ) )
			return false;

		global $wpdb;

		if( !empty( $id_proposta ) )
		{
			if( $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_propostas} SET status = 'lixo' WHERE id_proposta = %d", $id_proposta ) ) )
				return true;
		}

		return false;
	}

	/**
	 * get proposta
	 *
	 * @name    get_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_proposta( $id_proposta )
	{
		global $wpdb;

		$proposta = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_propostas} WHERE id_proposta = %d LIMIT 1", $id_proposta ) );

		// transformar o objeto em array
		$proposta = get_object_vars( $proposta );

		return $proposta;
	}

	/**
	 * update proposta meta
	 *
	 * @name    update_proposta_meta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-23
	 * @updated 2011-08-23
	 * @return  void
	 */
	function update_proposta_meta( $id_proposta, $meta_name, $meta_value )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		if( !is_serialized( $meta_value ) )
			$meta_value = maybe_serialize( $meta_value );

		$id_meta = $wpdb->get_var( $wpdb->prepare( "SELECT id_meta FROM {$wpdb->sav_proposta_meta} WHERE id_proposta = %d AND meta_key = %s LIMIT 1", $id_proposta, $meta_name ) );

		if( !empty( $id_meta ) )
			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_proposta_meta} SET meta_value = %s WHERE id_meta = %d", $meta_value, $id_meta ) );
		else
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_proposta_meta} ( id_proposta, meta_key, meta_value ) VALUES ( %d, %s, %s )", $id_proposta, $meta_name, $meta_value ) );
	}

	/**
	 * get proposta meta
	 *
	 * @name    get_proposta_meta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-23
	 * @updated 2011-08-23
	 * @return  mixed
	 */
	function get_proposta_meta( $id_proposta, $meta_name )
	{
		global $wpdb;

		$meta_value = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM {$wpdb->sav_proposta_meta} WHERE id_proposta = %d AND meta_key = %s LIMIT 1", $id_proposta, $meta_name ) );

		if( is_serialized( $meta_value ) )
			$meta_value = maybe_unserialize( $meta_value );

		return $meta_value;
	}

	/**
	 * update producao cinema
	 *
	 * @name    update_producao_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-10-28
	 * @return  void
	 */
	function update_producao_cinema( $producao )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		$id_proposta = $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d LIMIT 1", $producao[ 'id_proposta' ] ) );

		if( empty( $id_proposta ) )
			return false;

		$id_producao = $wpdb->get_var( $wpdb->prepare( "SELECT id_producao_cinema FROM {$wpdb->sav_producao_cinema} WHERE id_proposta = %d LIMIT 1", $producao[ 'id_proposta' ] ) );

		if( empty( $id_producao ) )
		{
			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_producao_cinema} ( id_proposta, plano_producao, estrategia_producao, viabilidade_orcamentaria ) VALUES ( %d, %s, %s, %s )", $producao[ 'id_proposta' ], $producao[ 'plano_producao' ], $producao[ 'estrategia_producao' ], $producao[ 'viabilidade_orcamentaria' ] ) );

			return $wpdb->insert_id;
		}
		else
		{
			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_producao_cinema} SET plano_producao = %s, estrategia_producao = %s, viabilidade_orcamentaria = %s WHERE id_proposta = %d", $producao[ 'plano_producao' ], $producao[ 'estrategia_producao' ], $producao[ 'viabilidade_orcamentaria' ], $producao[ 'id_proposta' ] ) );
		}
	}

	/**
	 * get producao cinema
	 *
	 * @name    get_producao_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2011-08-25
	 * @return  mixed
	 */
	function get_producao_cinema( $id_proposta )
	{
		global $wpdb;

		$producao = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_producao_cinema} WHERE id_proposta = %d LIMIT 1", $id_proposta ) );

		// transformar o objeto em array
		$producao = get_object_vars( $producao );

		return $producao;
	}

	/**
	 * update direcao cinema
	 *
	 * @name    update_direcao_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-20
	 * @updated 2011-12-26
	 * @return  void
	 */
	function update_direcao_cinema( $direcao )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		$id_proposta = $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d LIMIT 1", $direcao[ 'id_proposta' ] ) );

		if( empty( $id_proposta ) )
			return false;

		$id_direcao = $wpdb->get_var( $wpdb->prepare( "SELECT id_direcao_cinema FROM {$wpdb->sav_direcao_cinema} WHERE id_proposta = %d LIMIT 1", $direcao[ 'id_proposta' ] ) );

		if( empty( $id_direcao ) )
		{
			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_direcao_cinema} ( id_proposta, plano_direcao, plano_distribuicao, suporte_captacao, suporte_finalizacao ) VALUES ( %d, %s, %s, %s, %s )", $direcao[ 'id_proposta' ], $direcao[ 'plano_direcao' ], $direcao[ 'plano_distribuicao' ], $direcao[ 'suporte_captacao' ], $direcao[ 'suporte_finalizacao' ] ) );

			return $wpdb->insert_id;
		}
		else
		{
			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_direcao_cinema} SET plano_direcao = %s, plano_distribuicao = %s, suporte_captacao = %s, suporte_finalizacao = %s WHERE id_proposta = %d", $direcao[ 'plano_direcao' ], $direcao[ 'plano_distribuicao' ], $direcao[ 'suporte_captacao' ], $direcao[ 'suporte_finalizacao' ], $direcao[ 'id_proposta' ] ) );
		}
	}

	/**
	 * get direcao cinema
	 *
	 * @name    get_direcao_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-20
	 * @updated 2011-12-20
	 * @return  mixed
	 */
	function get_direcao_cinema( $id_proposta )
	{
		global $wpdb;

		$producao = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_direcao_cinema} WHERE id_proposta = %d LIMIT 1", $id_proposta ) );

		// transformar o objeto em array
		$producao = get_object_vars( $producao );

		return $producao;
	}

	/**
	 * update roteiro cinema
	 *
	 * @name    update_roteiro_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-23
	 * @updated 2011-09-26
	 * @return  void
	 */
	function update_roteiro_cinema( $roteiro )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		$id_proposta = $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d LIMIT 1", $roteiro[ 'id_proposta' ] ) );

		if( empty( $id_proposta ) )
			return false;

		$id_roteiro = $wpdb->get_var( $wpdb->prepare( "SELECT id_roteiro_cinema FROM {$wpdb->sav_roteiro_cinema} WHERE id_proposta = %d LIMIT 1", $roteiro[ 'id_proposta' ] ) );

		if( empty( $id_roteiro ) )
		{
			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_roteiro_cinema} ( id_proposta, plano_roteiro, personagens, infantil ) VALUES ( %d, %s, %s, %d )", $roteiro[ 'id_proposta' ], $roteiro[ 'plano_roteiro' ], $roteiro[ 'personagens' ], $roteiro[ 'infantil' ] ) );

			return $wpdb->insert_id;
		}
		else
		{
			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_roteiro_cinema} SET plano_roteiro = %s, personagens = %s, infantil = %d WHERE id_proposta = %d", $roteiro[ 'plano_roteiro' ], $roteiro[ 'personagens' ], $roteiro[ 'infantil' ], $roteiro[ 'id_proposta' ] ) );
		}
	}

	/**
	 * get roteiro cinema
	 *
	 * @name    get_roteiro_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-23
	 * @updated 2011-09-23
	 * @return  mixed
	 */
	function get_roteiro_cinema( $id_proposta )
	{
		global $wpdb;

		$roteiro = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_roteiro_cinema} WHERE id_proposta = %d LIMIT 1", $id_proposta ) );

		// transformar o objeto em array
		$roteiro = get_object_vars( $roteiro );

		return $roteiro;
	}

	/**
	 * update experiencia cinema
	 *
	 * @name    update_experiencia_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-05
	 * @updated 2011-09-05
	 * @return  void
	 */
	function update_experiencia_cinema( $experiencia )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		$id_experiencia = $wpdb->get_var( $wpdb->prepare( "SELECT id_experiencia_cinema FROM {$wpdb->sav_experiencias_cinema} WHERE id_experiencia_cinema = %d LIMIT 1", $experiencia[ 'id_experiencia_cinema' ] ) );

		if( empty( $id_experiencia ) )
		{
			// não salvar caso não tenha um título
			if( empty( $experiencia[ 'titulo' ] ) )
				return false;

			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_experiencias_cinema} ( login, titulo, funcao, ano, suporte_captacao, suporte_finalizacao, duracao, comprovante ) VALUES ( %s, %s, %s, %d, %s, %s, %d, %s )", $experiencia[ 'login' ], $experiencia[ 'titulo' ], $experiencia[ 'funcao' ], $experiencia[ 'ano' ], $experiencia[ 'suporte_captacao' ], $experiencia[ 'suporte_finalizacao' ], $experiencia[ 'duracao' ], $experiencia[ 'comprovante' ] ) );
		}
		else
		{
			// apagar caso não tenha um título
			if( empty( $experiencia[ 'titulo' ] ) )
			{
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->sav_experiencias_cinema} WHERE id_experiencia_cinema = %d", $experiencia[ 'id_experiencia_cinema' ] ) );
			}
			else
			{
				$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_experiencias_cinema} SET titulo = %s, funcao = %s, ano = %d, suporte_captacao = %s, suporte_finalizacao = %s, duracao = %d, comprovante = %s WHERE id_experiencia_cinema = %d", $experiencia[ 'titulo' ], $experiencia[ 'funcao' ], $experiencia[ 'ano' ], $experiencia[ 'suporte_captacao' ], $experiencia[ 'suporte_finalizacao' ], $experiencia[ 'duracao' ], $experiencia[ 'comprovante' ], $experiencia[ 'id_experiencia_cinema' ] ) );
			}
		}
	}

	/**
	 * update experiencias cinema
	 *
	 * @name    update_experiencias_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-29
	 * @updated 2011-09-05
	 * @return  void
	 */
	function update_experiencias_cinema( $experiencias )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		foreach( $experiencias as $experiencia )
		{
			$this->update_experiencia_cinema( $experiencia );
		}
	}

	/**
	 * get experiencias cinema
	 *
	 * @name    get_experiencias_cinema
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-29
	 * @updated 2011-08-29
	 * @return  mixed
	 */
	function get_experiencias_cinema( $login )
	{
		global $wpdb;

		$object_experiencias = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_experiencias_cinema} WHERE login = %s", $login ) );

		// transformar o objeto em array
		foreach( $object_experiencias as $experiencia )
		{
			$experiencias[ ++$e ] = get_object_vars( $experiencia );
		}

		return $experiencias;
	}

	/**
	 * update dados ong
	 *
	 * @name    update_dados_ong
	 * @author  cleber.santos <cleber.santos@cultura.gov.br>
	 * @since   2012-04-25
	 * @updated 2012-04-25
	 * @return  void
	 */
	function update_dados_ong( $proponente )
	{
		global $wpdb;


		$login = $wpdb->get_var( $wpdb->prepare( "SELECT login FROM {$wpdb->sav_dados_ong} WHERE login = %s LIMIT 1", $proponente[ 'login' ] ) );

		if( empty( $login ) )
		{
			return $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_dados_ong} ( login, numero_siconv, objeto_social, estatuto_social, tempo_atividade, comprovacao_capacidade) VALUES ( %s, %s, %s, %s, %d, %s )", $proponente[ 'login' ], $proponente[ 'numero_siconv' ], $proponente[ 'objeto_social' ], $proponente[ 'estatuto_social' ], $proponente[ 'tempo_atividade' ], $proponente[ 'comprovacao_capacidade' ] ) );
		}
		else
		{
			$proponente_atual = $this->get_dados_ong( $login );

			// atualizar apenas os dados informados
			if( !empty( $proponente_atual ) )
				$proponente = array_merge( $proponente_atual, $proponente );

			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_dados_ong} SET numero_siconv = %s, objeto_social = %s, estatuto_social = %s, tempo_atividade = %s, comprovacao_capacidade = %s WHERE login = %s", $proponente[ 'numero_siconv' ], $proponente[ 'objeto_social' ], $proponente[ 'estatuto_social' ], $proponente[ 'tempo_atividade' ], $proponente[ 'comprovacao_capacidade' ], $proponente[ 'login' ] ) );
		}
	}

	/**
	 * get dados ong
	 *
	 * @name    get_dados_ong
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2012-04-25
	 * @updated 2012-04-25
	 * @return  mixed
	 */
	function get_dados_ong( $login )
	{
		global $wpdb;

		$proponente = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_dados_ong} WHERE login = %s LIMIT 1", $login ) );


		// transformar o objeto em array
		$proponente = get_object_vars( $proponente );


		return $proponente;

	}

	/**
	 * update chamada convenio
	 *
	 * @name    update_chamada_convenio
	 * @author  cleber.santos <cleber.santos@cultura.gov.br>
	 * @since   2012-04-26
	 * @updated 2012-04-26
	 * @return  void
	 */

	function update_chamada_convenio( $convenio )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		$id_proposta = $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d LIMIT 1", $convenio[ 'id_proposta' ] ) );

		if( empty( $id_proposta ) )
			return false;

		$id_chamada_convenio = $wpdb->get_var( $wpdb->prepare( "SELECT id_chamada_convenio FROM {$wpdb->sav_chamada_convenio} WHERE id_proposta = %d LIMIT 1", $convenio[ 'id_proposta' ] ) );

		if( empty( $id_chamada_convenio ) )
		{
			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_chamada_convenio} ( id_proposta, macro_politicas, objetivos, justificativa, caracteristica_publico, acessibilidade, democratizacao_acesso, cronograma_execucao, metas_resultados, outras_informacoes, valor_total ) VALUES ( %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )", $convenio[ 'id_proposta' ], $convenio[ 'macro_politicas' ], $convenio[ 'objetivos' ], $convenio[ 'justificativa' ], $convenio[ 'caracteristica_publico' ], $convenio[ 'acessibilidade' ], $convenio[ 'democratizacao_acesso' ], $convenio[ 'cronograma_execucao' ], $convenio[ 'metas_resultados' ], $convenio[ 'outras_informacoes' ], $convenio[ 'valor_total' ] ) );
			return $wpdb->insert_id;
		}
		else
		{
			return $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_chamada_convenio} SET  macro_politicas = %s, objetivos = %s, justificativa = %s, caracteristica_publico = %s, acessibilidade = %s, democratizacao_acesso = %s, cronograma_execucao = %s, metas_resultados = %s, outras_informacoes = %s, valor_total = %s WHERE id_proposta = %d", $convenio[ 'macro_politicas' ], $convenio[ 'objetivos' ], $convenio[ 'justificativa' ], $convenio[ 'caracteristica_publico' ], $convenio[ 'acessibilidade' ], $convenio[ 'democratizacao_acesso' ], $convenio[ 'cronograma_execucao' ], $convenio[ 'metas_resultados' ], $convenio[ 'outras_informacoes' ], $convenio[ 'valor_total' ], $convenio[ 'id_proposta' ] ) );
		}

	}

	/**
	 * get chamada convenio
	 *
	 * @name    get_chamada_convenio
	 * @author  cleber.santos <cleber.santos@cultura.gov.br>
	 * @since   2012-04-26
	 * @updated 2012-04-26
	 * @return  void
	 */

	function get_chamada_convenio( $id_proposta )
	{
		global $wpdb;

		$convenio = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_chamada_convenio} WHERE id_proposta = %d LIMIT 1", $id_proposta ) );

		// transformar o objeto em array
		$convenio = get_object_vars( $convenio );

		return $convenio;
	}

	/**
	 * update historico da proposta
	 *
	 * @name    registrar_historico_proposta
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-06-19
	 * @updated 2012-06-19
	 * @return  void
	 */
	function registrar_historico_proposta( $id_proposta, $acao = null, $observacao = null,  $status = null, $anexo = null, $mostrar = true )
	{
		global $wpdb, $user_ID;

		$historico['id_proposta'] 	= $id_proposta;
		$historico['id_author']		= $user_ID;
		$historico['acao'] 		  	= $acao;
		$historico['observacao']  	= $observacao;
		$historico['data'] 		  	= date( 'Y-m-d H:i:s' );
		$historico['anexo'] 	  	= $anexo;
		$historico['status'] 	  	= $status;
		$historico['mostrar'] 	  	= $mostrar;

		$where_status = '';

		// não deixar registrar histórico do mesmo status
		if( !empty( $historico[ 'status' ] ) )
		{
			$where_status = "or ( id_proposta = {$historico['id_proposta']} and status = '{$historico['status']}' )";

			// registrar o tipo de ação de acordo com o status
			if( empty( $historico[ 'acao' ] ) )
			{
				switch( $historico[ 'status' ] )
				{
					case 'parcial':
						$historico[ 'acao' ]       = 'Proposta Iniciada';
						$historico[ 'observacao' ] = 'Proposta iniciada no Sistema';
					break;
					case 'completo':
						$historico[ 'acao' ] = 'Inscrito';
					break;
					case 'habilitado':
						$historico[ 'acao' ] = 'Habilitado';
					break;
					case 'inabilitado':
						$historico[ 'acao' ] = 'Inabilitado';
					break;
					case 'classificado':
						$historico[ 'acao' ] = 'Classificado';
					break;
					case 'nao_classificado':
						$historico[ 'acao' ] = 'Não Classificado';
					break;
					case 'pre_selecionado':
						$historico[ 'acao' ] = 'Pré-Selecionado';
					break;
					case 'nao_pre_selecionado':
						$historico[ 'acao' ] = 'Não pré-selecionado';
					break;
					case 'nao_selecionado':
						$historico[ 'acao' ] = 'Não selecionado';
					break;
					case 'lista_de_reserva':
						$historico[ 'acao' ] = 'Lista de Reserva';
					break;
					case 'selecionado':
						$historico[ 'acao' ] = 'Selecionado';
					break;
					default:
						$historico[ 'acao' ] = $historico[ 'status' ];
					break;
				}
			}
		}

		$id_historico = $wpdb->get_var( $wpdb->prepare( "SELECT id_historico FROM {$wpdb->sav_proposta_historico} WHERE id_historico = %d {$where_status} LIMIT 1", $historico[ 'id_historico' ] ) );

		if( empty( $id_historico ) )
		{
			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_proposta_historico} ( id_proposta, id_author, acao, observacao, data, anexo, status, mostrar ) VALUES ( %d, %d, %s, %s, %s, %s, %s, %s )", $historico[ 'id_proposta' ], $historico[ 'id_author' ], $historico[ 'acao' ], $historico[ 'observacao' ], $historico[ 'data' ], $historico[ 'anexo' ], $historico[ 'status' ], $historico[ 'mostrar' ] ) );
		}
		else
		{
			$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_proposta_historico} SET id_author = %d, acao = %s, observacao = %s, data = %s, anexo = %s, status = %s, mostrar = %d WHERE id_historico = %d", $historico[ 'id_author' ], $historico[ 'acao' ], $historico[ 'observacao' ], $historico[ 'data' ], $historico[ 'anexo' ], $historico[ 'status' ], $historico[ 'mostrar' ], $id_historico  ) );
		}
	}

	/**
	 * get proposta historico
	 *
	 * @name    get_proposta_historico
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-06-19
	 * @updated 2012-06-19
	 * @return  mixed
	 */
	function get_proposta_historico( $id_proposta, $id_historico = null )
	{
		global $wpdb;
		$where_id_historico = "";

		if( !empty( $id_historico ) )
			$where_id_historico = " AND id_historico = {$id_historico}";

		$object_historico = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_proposta_historico} WHERE id_proposta = %d {$where_id_historico} ", $id_proposta ) );

		// transformar o objeto em array
		foreach( $object_historico as $individual_historico)
		{
			$historico[ ++$e ] = get_object_vars( $individual_historico );
		}

		return $historico;
	}

	/**
	 * update critérios de avaliação
	 *
	 * @name    update_criterio_avaliacao
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-01-06
	 * @updated 2012-01-06
	 * @return  void
	 */
	function update_criterio_avaliacao( $criterio, $id_edital )
	{
		if( !current_user_can( 'approve_sav_propostas' ) )
			return false;

		global $wpdb;

		$id_criterio = $wpdb->get_var( $wpdb->prepare( "SELECT id_criterio FROM {$wpdb->sav_criterios} WHERE id_criterio = %d LIMIT 1", $criterio[ 'id_criterio' ] ) );

		if( empty( $id_criterio ) )
		{
			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_criterios} ( id_edital, descricao ) VALUES ( %d, %s )", $id_edital, $criterio[ 'descricao' ] ) );
		}
		else
		{
			// apagar caso não tenha descricao
			if( empty( $criterio[ 'descricao' ] ) )
			{
				//$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->sav_criterios} WHERE id_criterio = %d", $criterio[ 'id_criterio' ] ) );
			}
			else
			{
				$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_criterios} SET  descricao = %s WHERE id_criterio = %d", $criterio[ 'descricao' ], $criterio[ 'id_criterio' ] ) );
			}
		}
	}

	/**
	 * get critérios de avaliação
	 *
	 * @name    get_criterios_avaliacao
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-06
	 * @updated 2012-02-06
	 * @return  mixed
	 */
	function get_criterios_avaliacao( $id_edital )
	{
		global $wpdb;

		$object_criterios = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_criterios} WHERE id_edital= %s", $id_edital ) );

		// transformar o objeto em array
		foreach( $object_criterios as $criterio )
		{
			$criterios[ ++$e ] = get_object_vars( $criterio );
		}

		return $criterios;
	}

	/**
	 * get nota e id_avaliacao da proposta através do id do consultor
	 *
	 * @name    get_nota_criterio
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-08
	 * @updated 2012-02-08
	 * @return  mixed
	 */
	function get_nota_criterio( $id_criterio = null, $id_proposta, $id_consultor )
	{
		if( empty($id_proposta) or empty($id_consultor) )
			return false;

		global $wpdb;

		$nota = $wpdb->get_row( $wpdb->prepare( "SELECT nota, id_avaliacao FROM {$wpdb->sav_avaliacao} WHERE id_criterio = %d AND id_proposta = %d AND id_consultor = %d LIMIT 1", $id_criterio, $id_proposta, $id_consultor ) );

		// transformar o objeto em array
		$avaliacao = get_object_vars( $nota );

		if ( !empty( $avaliacao ) )
			return $avaliacao;
		else
			return false;
	}

	/**
	 * calcula o valor minimo da nota de classificação
	 *
	 * @name    get_nota_minima
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-29
	 * @updated 2012-02-29
	 * @return  mixed
	 */
	function get_nota_minima( $id_edital )
	{
		$qnt_criterios = count( $this->get_criterios_avaliacao( $id_edital ) );

		$valor_minimo = ( int ) ceil( ($qnt_criterios * 10) * 0.7 );

		return $valor_minimo;
	}

	/**
	 * verifica se existe alguma proposta sem avaliacao por consultor
	 *
	 * @name    propostas_sem_avaliacao
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-03-07
	 * @updated 2012-03-07
	 * @return  mixed
	 */
	function propostas_sem_avaliacao( $id_edital )
	{
		global $wpdb, $user_ID, $user_login;

		if( !current_user_can( 'classifies_sav_propostas' ) )
			return false;

		// verifica se o edital é divido por grupo
		$avaliacao_por_grupo = $this->get_edital_meta( $id_edital, 'avaliacao_por_grupo');

		if( !empty( $avaliacao_por_grupo) )
		{
			$comissao = $this->get_edital_meta( $id_edital, 'comissao' );

			// busca o grupo do consultor
			foreach ( $comissao as $consultor)
			{
				if( $consultor['consultor'] == $user_login )
					$where_grupo = " AND meta_key = 'grupo' and meta_value = " . $consultor['grupo'];
			}
		}

		$propostas = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT p.id_proposta FROM {$wpdb->sav_propostas} as p INNER JOIN {$wpdb->sav_proposta_meta} as po ON p.id_proposta = po.id_proposta WHERE ( p.status = 'habilitado' OR p.status = 'classificado' OR p.status = 'selecionado' ) AND p.id_edital = %d {$where_grupo} ", $id_edital ) );
		foreach( $propostas as $proposta )
		{
			$avaliacao_proposta = $this->get_nota_criterio( null, $proposta->id_proposta, $user_ID );

			if( empty( $avaliacao_proposta ) )
			{
				return true;
			}
		}
		return false;
	}


	/**
	 * get consultores do edital
	 *
	 * @name    get_consultores_edital
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2013-04-02
	 * @updated 2013-04-02
	 * @return  mixed
	 */
	function get_consultores_edital( $id_edital )
	{
		if( empty( $id_edital) )
			return false;

		global $SAV, $wpdb;

		$comissao = $this->get_edital_meta($id_edital, 'comissao');

		foreach( $comissao as $consultor )
		{
			$consultores[] = $wpdb->get_row( $wpdb->prepare( "SELECT ID, display_name FROM {$wpdb->users} WHERE user_login = %s LIMIT 1", $consultor['consultor'] ) );
		}

		return $consultores;
	}


	/**
	 * get os consultores que realizam avaliacao na proposta
	 *
	 * @name    get_consultores_proposta
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-17
	 * @updated 2012-02-24
	 * @return  mixed
	 */
	function get_consultores_proposta( $id_proposta )
	{
		if( empty($id_proposta) )
			return false;

		global $wpdb;

		$object_consultores = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_avaliacao} WHERE id_proposta = %d GROUP BY id_consultor", $id_proposta ) );

		// transformar o objeto em array
		foreach( $object_consultores as $consultor )
		{
			$consultores[++$e] = get_object_vars( $consultor );

		}
		return $consultores;
	}

	/**
	 * get propostas com as maiores notas de classificacao por consultor
	 *
	 * @name    get_classificacao_por_consultor
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-17
	 * @updated 2012-02-24
	 * @return  mixed
	 */
	function get_classificacao_por_consultor($id_consultor, $id_edital, $count = false )
	{
		if( empty($id_consultor) or empty($id_edital) )
			return false;

		global $wpdb;

		$nota_minima = $this->get_nota_minima( $id_edital );

		// se o edital for igual a 1 não terá limite de 7 projetos para classificacao, depois alterar se o campo estiver em branco não tem limite
		if( !$id_edital == 1)
		{
			$quantidade_propostas_por_consultor = $this->get_edital_meta( $id_edital, 'quantidade_classificados' );
			$where_limit = "LIMIT ". $quantidade_propostas_por_consultor;
		}

		// criterios de desempate
		$criterio_desempate_1 = $this->get_edital_meta( $id_edital, 'criterio_desempate_1' );
		$criterio_desempate_2 = $this->get_edital_meta( $id_edital, 'criterio_desempate_2' );

		if( $count )
		{
			$classificados_consultor = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT p.id_proposta) FROM  {$wpdb->sav_propostas} AS p INNER JOIN  {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d {$where_limit}", $id_consultor, $id_edital) );
			//$classificados_consultor = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(p.id_proposta) FROM  {$wpdb->sav_propostas} AS p INNER JOIN  {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d AND po.nota >= %d ORDER BY po.nota DESC {$where_limit}", $id_consultor, $id_edital, $nota_minima) );

			if( !$id_edital == 1)
			{
				if( $classificados_consultor > $quantidade_propostas_por_consultor )
					$classificados_consultor = $quantidade_propostas_por_consultor;
			}
		}
		else {
			$classificados_consultor = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.titulo, p.id_author, p.id_edital, p.status, po.id_consultor, po.nota FROM {$wpdb->sav_propostas} AS p INNER JOIN {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pe ON p.id_proposta = pe.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pa ON p.id_proposta = pa.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d AND po.id_criterio = '' AND pe.id_criterio = %d AND pa.id_criterio = %d GROUP BY p.id_proposta ORDER BY po.nota DESC, pe.nota DESC, pa.nota DESC, p.id_proposta ASC $where_limit", $id_consultor, $id_edital, $criterio_desempate_1, $criterio_desempate_2 ) );
			//$classificados_consultor = $wpdb->get_results( $wpdb->prepare( "SELECT p.id_proposta, p.titulo, p.id_author, p.id_edital, p.status, po.id_consultor, po.nota FROM {$wpdb->sav_propostas} AS p INNER JOIN {$wpdb->sav_avaliacao} AS po ON p.id_proposta = po.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pe ON p.id_proposta = pe.id_proposta INNER JOIN {$wpdb->sav_avaliacao} AS pa ON p.id_proposta = pa.id_proposta WHERE po.id_consultor = %d AND p.id_edital = %d AND po.nota >= %d AND po.id_criterio = '' AND pe.id_criterio = %d AND pa.id_criterio = %d GROUP BY p.id_proposta ORDER BY po.nota DESC, pe.nota DESC, pa.nota DESC, p.id_proposta ASC $where_limit", $id_consultor, $id_edital, $nota_minima, $criterio_desempate_1, $criterio_desempate_2 ) );
		}
		return $classificados_consultor;

	}

	/**
	 * get todas propostas classificadas por edital
	 *
	 * @name    get_classificacao_por_edital
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-03-01
	 * @updated 2012-03-01
	 * @return  mixed
	 */
	function get_classificacao_por_edital( $id_edital )
	{
		if ( empty( $id_edital ) )
			return false;

		global $wpdb;

		$hoje						 = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
		$data_portaria_classificacao = $this->get_edital_meta($id_edital, 'data_portaria_classificacao');

		// para verificar se essa função já rodou alguma vez
		$fase_classificacao = $this->get_edital_meta($id_edital, 'fase_classificacao');

		// busca os consultores que já realizaram avaliacoes
		$comissao = $wpdb->get_results( $wpdb->prepare( "SELECT id_consultor FROM {$wpdb->sav_avaliacao} as p INNER JOIN {$wpdb->sav_criterios} as po ON p.id_criterio = po.id_criterio WHERE po.id_edital= %d GROUP BY p.id_consultor ORDER BY p.id_consultor DESC", $id_edital ) );

		if ( empty( $comissao ) )
			return false;

		foreach( $comissao as $consultor)
		{
			$propostas_classificadas = $this->get_classificacao_por_consultor( $consultor->id_consultor, $id_edital );

			if( !empty( $propostas_classificadas )  )
			{
				foreach( $propostas_classificadas as $classificadas )
				{
					// retirar propostas duplicadas
					if( !in_array( $classificadas->id_proposta, $id_propostas ) )
					{
						$propostas[] 	= $classificadas;
						$id_propostas[] = $classificadas->id_proposta;
					}

					// atualizar o status das propostas classificadas que não foram atualizadas pelo consultor
					if( empty($fase_classificacao ) )
					{
						if ( $hoje >= $data_portaria_classificacao and !empty( $data_portaria_classificacao )  )
						{
							// atualiza o status da proposta para classificado
							//$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_propostas} SET status = 'classificado' WHERE id_proposta = %d", $classificadas->id_proposta ) );

							// altera a fase de classificacao para não atualizar novamente
							//$this->update_edital_meta($id_edital, 'fase_classificacao', true);
						}
					}
				}
			}
		}

		return (object) $propostas;

	}

	/**
	 * update orcamento
	 *
	 * @name    update_orcamento
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-31
	 * @updated 2011-10-31
	 * @return  void
	 */
	function update_orcamento( $orcamento )
	{
		if( !current_user_can( 'edit_sav_propostas' ) )
			return false;

		global $wpdb;

		$id_orcamento = $wpdb->get_var( $wpdb->prepare( "SELECT id_orcamento FROM {$wpdb->sav_orcamentos} WHERE id_orcamento = %d LIMIT 1", $orcamento[ 'id_orcamento' ] ) );

		if( empty( $id_orcamento ) )
		{
			// não salvar caso não tenha um item
			if( empty( $orcamento[ 'item' ] ) )
				return false;

			$wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->sav_orcamentos} ( id_proposta, etapa, area, item, quantidade, unidade, valor_unitario, valor_total ) VALUES ( %d, %s, %s, %s, %s, %s, %s, %s )", $orcamento[ 'id_proposta' ], $orcamento[ 'etapa' ], $orcamento[ 'area' ], $orcamento[ 'item' ], $orcamento[ 'quantidade' ], $orcamento[ 'unidade' ], $orcamento[ 'valor_unitario' ], $orcamento[ 'valor_total' ] ) );
		}
		else
		{
			// apagar caso não tenha um título
			if( empty( $orcamento[ 'item' ] ) )
			{
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->sav_orcamentos} WHERE id_orcamento = %d", $orcamento[ 'id_orcamento' ] ) );
			}
			else
			{
				$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->sav_orcamentos} SET item = %s, quantidade = %s, unidade = %s, valor_unitario = %s, valor_total = %s WHERE id_orcamento = %d", $orcamento[ 'item' ], $orcamento[ 'quantidade' ], $orcamento[ 'unidade' ], $orcamento[ 'valor_unitario' ], $orcamento[ 'valor_total' ], $orcamento[ 'id_orcamento' ] ) );
			}
		}
	}

	/**
	 * get orcamentos
	 *
	 * @name    get_orcamentos
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-31
	 * @updated 2011-09-05
	 * @return  mixed
	 */
	function get_orcamentos( $id_proposta, $etapa = '', $area = '' )
	{
		global $wpdb;

		if( !empty( $etapa ) AND !empty( $area ) )
		{
			$object_orcamentos = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_orcamentos} WHERE id_proposta = %d AND etapa = %s AND area = %s", $id_proposta, $etapa, $area ) );
		}
		elseif( !empty( $etapa ) )
		{
			$object_orcamentos = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_orcamentos} WHERE id_proposta = %d AND etapa = %s", $id_proposta, $etapa ) );
		}
		else
		{
			$object_orcamentos = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->sav_orcamentos} WHERE id_proposta = %d", $id_proposta ) );
		}

		// transformar o objeto em array
		foreach( $object_orcamentos as $orcamento )
		{
			$orcamentos[ ++$e ] = get_object_vars( $orcamento );
		}

		return $orcamentos;
	}


	/**
	 * upload anexo
	 *
	 * @name    upload_anexo
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-29
	 * @updated 2012-07-11
	 * @return  mixed
	 */
	function upload_anexo( $key, $name = '', $size = 1100000 )
	{
		if( empty( $_FILES[ $key ][ 'tmp_name' ] ) )
			return false;

		// verificar se o arquivo está no formato correto
		if( 'application/pdf' != $_FILES[ $key ][ 'type' ] )
		{
			$this->update_error( "O arquivo {$name} deve ser no formato portable document file (.pdf)" );

			return false;
		}

		// verificar se o arquivo está no tamanho correto
		if( $size < $_FILES[ $key ][ 'size' ] )
		{
			$this->update_error( "O arquivo {$name} excedeu o tamanho limite" );

			return false;
		}

		// retira os caracteres especiais
		$new_name = sanitize_key( $_FILES[ $key ][ 'name' ] );

		$new_name = str_replace( "pdf","-" . wp_generate_password( 7, false ) . ".pdf", $new_name );

		// fazer o upload do arquivo
		$anexo = wp_upload_bits( $new_name , null, file_get_contents( $_FILES[ $key ][ 'tmp_name' ] ) );

		if( empty( $anexo[ 'error' ] ) )
			return $anexo;
		else
			$this->update_error( $anexo[ 'error' ] );

		return false;
	}

	/**
	 * upload anexo da proposta
	 *
	 * @name    upload_anexo_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-25
	 * @updated 2012-01-05
	 * @return  mixed
	 */
	function upload_anexo_proposta( $id_proposta, $key, $name = '', $size = 1000000 )
	{
		// salvar no banco
		if( $anexo = $this->upload_anexo( $key, $name, $size ) )
			return $this->update_proposta_meta( $id_proposta, $key, $anexo );

		return false;
	}

	/**
	 * verificar se o edital $id_edital ainda está aberto
	 *
	 * @name    edital_aberto
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-24
	 * @updated 2011-10-31
	 * @return  bool
	 */
	function is_edital_aberto( $id_edital )
	{
		global $wpdb;

		//$hoje = date( 'Y-m-d' );
		$hoje = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );

		// verificar se o edital está aberto
		$edital = $wpdb->get_var( $wpdb->prepare( "SELECT id_edital FROM {$wpdb->sav_editais} WHERE id_edital = %d AND status <> 'lixo' AND abertura <= %s AND encerramento >= %s", $id_edital, $hoje, $hoje ) );

		if( empty( $edital ) )
			return false;
		else
			return true;
	}

	/**
	 * verifica se a proposta ainda está aberta
	 *
	 * @name    is_proposta_aberta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-08
	 * @updated 2011-10-31
	 * @return  void
	 */
	function is_proposta_aberta( $id_proposta )
	{
		global $wpdb;

		// verificar se essa proposta já foi publicada
		if( $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d AND status = 'parcial'", $id_proposta ) ) )
			return true;

		return false;
	}

	/**
	 * verifica se a proposta está finalizada
	 *
	 * @name    is_proposta_finalizada
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2012-02-23
	 * @updated 2012-02-23
	 * @return  void
	 */
	function is_proposta_finalizada( $id_proposta )
	{
		global $wpdb;

		// verificar se essa proposta já foi publicada
		if( $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d AND status = 'completo'", $id_proposta ) ) )
			return true;

		return false;
	}

	/**
	 * retorna o autor da proposta
	 *
	 * @name    autor_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-06
	 * @updated 2011-09-08
	 * @return  void
	 */
	function is_autor_proposta( $id_user, $id_proposta )
	{
		global $wpdb, $user_ID;

		if( empty( $id_user ) )
			$id_user = $user_ID;

		// verificar se esse usuário é o dono dessa proposta
		if( $wpdb->get_var( $wpdb->prepare( "SELECT id_proposta FROM {$wpdb->sav_propostas} WHERE id_proposta = %d AND id_author = %d", $id_proposta, $id_user ) ) )
			return true;

		return false;
	}

	/**
	 * verifica se o usuário ainda pode cadastrar novas propostas no edital $edital
	 *
	 * @name    autor_pode_cadastrar_nova_proposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-20
	 * @updated 2011-10-26
	 * @return  void
	 */
	function proponente_pode_cadastrar_nova_proposta( $id_edital, $id_author )
	{
		global $wpdb, $SAV;

		$propostas_por_proponente = $SAV->get_edital_meta( $id_edital, 'propostas_por_proponente' );
		$quantidade_propostas     = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( * ) FROM {$wpdb->sav_propostas} WHERE id_edital = %d AND id_author = %d", $id_edital, $id_author ) );

		if( empty( $propostas_por_proponente ) or $propostas_por_proponente > $quantidade_propostas )
			return true;

		return false;
	}

	/**
	 * check if the current user is pessoa fisica
	 *
	 * @name    is_pessoa_fisica
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-12
	 * @updated 2011-08-25
	 * @return  bool
	 */
	function is_pessoa_fisica( $login = null )
	{
		global $user_login;

		$Validator = new Validator();

		if( empty( $login ) )
			$login = $user_login;

		if( $Validator->validate( $login, 'login', 'required=1&cpf=1' ) )
			return true;

		return false;
	}

	/**
	 * check if the current user is pessoa juridica
	 *
	 * @name    is_pessoa_juridica
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-12
	 * @updated 2011-08-25
	 * @return  bool
	 */
	function is_pessoa_juridica( $login = null )
	{
		global $user_login;

		$Validator = new Validator();

		if( empty( $login ) )
			$login = $user_login;

		if( $Validator->validate( $login, 'login', 'required=1&cnpj=1' ) )
			return true;

		return false;
	}

	/**
	 * check if the current user is ong
	 *
	 * @name    is_user_ong
	 * @author  Cleber Santos <cleber.sants@cultura.gov.br>
	 * @since   2012-05-04
	 * @updated 2011-05-04
	 * @return  bool
	 */
	function is_user_ong( $login = null )
	{
		global $user_login;

		if( empty( $login ) )
			$login = $user_login;

		$verifica_empresa = $this->get_dados_empresa( $login );
			// retirar o cpf
		if ( $verifica_empresa['natureza'] == 1 or $verifica_empresa['natureza'] == 2 or $login == '49447718604' )
			return true;

		return false;
	}

	/**
	 * verificar se o $id_edital é para pessoa fisica
	 * criei esta função por que os proponentes de pessoas juridicas estavam cadastrando projetos
	 * em editais de pessoas físicas
	 *
	 * @name    edital para pessoa fisica
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-01-19
	 * @updated 2012-01-19
	 * @return  bool
	 */
	function is_edital_pessoa_fisica( $id_edital )
	{
		global $wpdb;

		$tipo_edital = $wpdb->get_var( $wpdb->prepare("SELECT pf FROM {$wpdb->sav_editais} WHERE id_edital = %d AND status <> 'lixo'", $id_edital));
		if ( empty( $tipo_edital ) )
			return false;
		else
			return true;
	}

	/**
	 * verificar se o edital $id_edital e para pessoa juridica
	 * criei esta função por que os proponentes de pessoas fisicas estavam cadastrando projetos
	 * em editais de pessoas jurídicas
	 *
	 * @name    edital para pessoa juridica
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-01-19
	 * @updated 2012-01-19
	 * @return  bool
	 */
	function is_edital_pessoa_juridica( $id_edital )
	{
		global $wpdb, $user_login;

		$tipo_edital = $wpdb->get_var( $wpdb->prepare("SELECT pj FROM {$wpdb->sav_editais} WHERE id_edital = %d AND status <> 'lixo'", $id_edital));
		if ( empty( $tipo_edital ) )
			return false;
		else
			return true;
	}

	/**
	 * converte do modelo de moeda (R$) para mysql
	 *
	 * @name    moeda_para_mysql
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-09
	 * @updated 2011-09-09
	 * @return  String
	 */
	function moeda_para_mysql( $valor )
	{
		$valor = str_replace( '.', '', $valor );
		$valor = str_replace( ',', '.', $valor );

		return $valor;
	}

	/**
	 * converte de mysql para o modelo de moeda (R$)
	 *
	 * @name    mysql_para_moeda
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-09
	 * @updated 2011-12-21
	 * @return  String
	 */
	function mysql_para_moeda( $valor )
	{
		//$valor = str_replace( '.', ',', $valor );
		$valor = number_format( $valor, 2, ',', '.' );

		return $valor;
	}

	/**
	 * show a menu dropdown from the states
	 *
	 * @name    dropdown_states
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2012-03-19
	 * @updated 2012-03-21
	 * @return  string
	 */
	function dropdown_states( $name, $selected, $all = false, $extra = null )
	{
		$states	= array(
			'AC' => 'Acre',
			'AL' => 'Alagoas',
			'AM' => 'Amazonas',
			'AP' => 'Amapá',
			'BA' => 'Bahia',
			'CE' => 'Ceará',
			'DF' => 'Distrito Federal',
			'ES' => 'Espírito Santo',
			'GO' => 'Goiás',
			'MA' => 'Maranhão',
			'MG' => 'Minas Gerais',
			'MS' => 'Mato Grosso do Sul',
			'MT' => 'Mato Grosso',
			'PA' => 'Pará',
			'PB' => 'Paraíba',
			'PE' => 'Pernambuco',
			'PI' => 'Piauí',
			'PR' => 'Paraná',
			'RJ' => 'Rio de Janeiro',
			'RN' => 'Rio Grande do Norte',
			'RO' => 'Rondônia',
			'RR' => 'Roraima',
			'RS' => 'Rio Grande do Sul',
			'SC' => 'Santa Catarina',
			'SE' => 'Sergipe',
			'SP' => 'São Paulo',
			'TO' => 'Tocantins'
		);

		$output	= "<select id='{$name}' name='{$name}' {$extra}>";

		if( $all )
			$output .= "<option value=''>selecione</option>";

		foreach( $states as $acronym => $state )
		{
			if( $acronym == $selected )
				$$acronym = 'selected="selected"';

			$output .= "<option value='{$acronym}' {$$acronym}>{$state}</option>";
		}

		$output .= "</select>";

		return $output;
	}

	/**
	 * Recebe o status e retorna o que tem que ser apresentado
	 *
	 * @name    show_mask_status
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-07
	 * @updated 2013-03-07
	 * @return  string
	 */
	function show_mask_status( $status )
	{
		switch ($status)
		{
			case 'parcial':
				$mask = 'Em andamento';
				break;
			case 'completo':
				$mask = 'Inscrito';
					break;
			case 'habilitado':
				$mask = 'Habilitado';
				break;
			case 'inabilitado':
				$mask = 'Inabilitado';
				break;
			case 'classificado':
				$mask = 'Classificado';
				break;
			case 'nao_classificado':
				$mask= 'Não classificado';
				break;
			case 'pre_selecionado':
				$mask= 'Pré-selecionado';
				break;
			case 'nao_pre_selecionado':
				$mask= 'Não Pré-Selecionado';
				break;
			case 'selecionado':
				$mask= 'Selecionado';
				break;
			case 'nao_selecionado':
				$mask= 'Não selecionado';
				break;
			case 'lista_de_reserva':
				$mask = 'Lista de Reserva';
				break;
			default:
				$mask = $status;
			break;
		}

		return $mask;
	}

		/**
	 * Recebe o status da proposta e o perfil do usuário e retorna de acordo com
	 * a permissão e data do edital
	 * @name    show_status_proposta
	 * @author  Cleber Santos<cleber.santos@cultura.gov.br>
	 * @since   2013-03-07
	 * @updated 2013-03-07
	 * @return  string
	 */
	function show_status_role( $id_edital, $status )
	{
		$hoje						  = gmdate( 'Y-m-d', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
		$edital 					  = $this->get_edital( $id_edital );

		$data_portaria_habilitacao 	  = $this->get_edital_meta( $id_edital, 'data_portaria_habilitacao');
		//$data_fim_recurso_habilitacao = $SAV->get_edital_meta( $proposta->id_edital, 'data_fim_recurso_habilitacao');
		$data_portaria_classificacao  = $this->get_edital_meta( $id_edital, 'data_portaria_classificacao');
		$data_portaria_pre_selecao 	  = $this->get_edital_meta( $id_edital, 'data_portaria_selecao');
		$data_portaria_selecao 		  = $this->get_edital_meta( $id_edital, 'data_portaria_selecao');

		// se for analista ou consultor
		if( current_user_can( 'approve_sav_propostas') )
		{
			if( $status == 'parcial')
			{
				if( $hoje > $edital['encerramento'] )
					$situacao = "Não finalizado";
				else
					$situacao = $this->show_mask_status( $status );
			}else
				$situacao = $this->show_mask_status( $status );
		}

		// se for proponente
		if( !current_user_can( 'approve_sav_propostas' ) )
		{
			switch( $status)
			{
				case 'parcial' :
					if( $hoje > $edital['encerramento'] )
						$situacao = "Não finalizado";
					else
						$situacao = $this->show_mask_status( $status );
					break;
				case 'completo' :
					$situacao = $this->show_mask_status( $status );
					break;
				case 'habilitado' :
				case 'inabilitado' :
					if( $hoje >= $data_portaria_habilitacao and !empty( $data_portaria_habilitacao )  )
						$situacao = $this->show_mask_status( $status );
					else
						$situacao = $this->show_mask_status( 'completo' );
					break;
				case 'classificado' :
				case 'nao_classificado' :
					if( $hoje >= $data_portaria_classificacao  and !empty( $data_portaria_classificacao  )  )
						$situacao = $this->show_mask_status( $status );
					else
						$situacao = $this->show_mask_status( 'habilitado' );
					break;
				case 'pre_selecionado' :
				case 'nao_pre_selecionado' :
					if( $hoje >= $data_portaria_pre_selecao or empty( $data_portaria_pre_selecao )  )
						$situacao = $this->show_mask_status( $status );
					else
						$situacao = $this->show_mask_status( 'classificado' );
					break;
				case 'selecionado':
				case 'nao_selecionado':
				case 'lista_de_reserva':
					if( $hoje >= $data_portaria_selecao or empty( $data_portaria_selecao )  )
						$situacao = $this->show_mask_status( $status );
					else
						if( !empty( $data_portaria_pre_selecao ) )
							$situacao = $this->show_mask_status( 'pre_selecionado' );
						else
							$situacao = $this->show_mask_status( 'classificado' );
					break;
				default:
					$situacao = $this->show_mask_status( $status );
			}
		}
		return $situacao;
	}


	/**
	 * show a menu dropdown from the status
	 *
	 * @name    dropdown_status
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2012-07-11
	 * @updated 2012-07-11
	 * @return  string
	 */
	function dropdown_status( $name, $selected, $all = false, $extra = null )
	{
		$status	= array(
			'parcial'	   	 	  => 'parcial',
			'completo'	   	 	  => 'inscrito',
			'habilitado'	   	  => 'Habilitado',
			'inabilitado'	   	  => 'Inabilitado',
			'classificado'	   	  => 'Classificado',
			'nao_classificado'	  => 'Não classificado',
			'pre_selecionado'	  => 'Pré-selecionado',
			'nao_pre_selecionado' => 'Não Pré-Selecionado',
			'selecionado'	  	  => 'Selecionado',
			'nao_selecionado'	  => 'Não selecionado',
			'lista_de_reserva' 	  => 'Lista de Reserva',
		);

		$output	= "<select id='{$name}' name='{$name}' {$extra}>";

		if( $all )
			$output .= "<option value=''>selecione</option>";

		foreach( $status as $acronym => $individual_status )
		{
			if( $acronym == $selected )
				$$acronym = 'selected="selected"';

			$output .= "<option value='{$acronym}' {$$acronym}>{$individual_status}</option>";
		}

		$output .= "</select>";

		return $output;
	}

	/**
	 * retorna região de acordo com o estado
	 *
	 * @name    where_regiao
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-07-11
	 * @updated 2012-07-11
	 * @return  string
	 */
	function where_regiao( $estado )
	{
		if( empty( $estado ) )
			return false;

		switch( $estado )
		{
			case 'PR':
			case 'SC':
			case 'RS':
				$regiao = 'sul';
			break;
			case 'ES':
			case 'MG':
			case 'RJ':
			case 'SP':
				$regiao = 'sudeste';
			break;
			case 'DF':
			case 'GO':
			case 'MT':
			case 'MS':
				$regiao = 'centro oeste';
			break;
			case 'AL':
			case 'BA':
			case 'CE':
			case 'MA':
			case 'PB':
			case 'PE':
			case 'PI':
			case 'RN':
			case 'SE':
				$regiao = 'nordeste';
			break;
			case 'AC':
			case 'AM':
			case 'AP':
			case 'PA':
			case 'RO':
			case 'RR':
			case 'TO':
				$regiao = 'norte';
			break;
			default:
				$regiao = 'invalido';
			break;
		}
		return $regiao;
	}

	/**
	 * show a checkbox menu from the interesses
	 *
	 * @name    checkbox_interesses
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-26
	 * @updated 2011-11-29
	 * @return  string
	 */
	function checkbox_interesses( $name, $selected )
	{
		$interesses = array(
			'Animacao' => 'Animação',
			'Cinema'   => 'Cinema',
			'TV'       => 'Televisão',
			'Games'    => 'Games',
			'Radio'    => 'Rádio',
			'Internet' => 'Internet',
			'Novas'    => 'Novas Mídias',
		);

		foreach( $interesses as $key => $area )
		{
			$item++;

			if( in_array( $key, $selected ) )
				$$key = 'checked="checked"';

			$output .= "<label class='checkbox'><input type='checkbox' name='{$name}[{$item}]' value='{$key}' {$$key}> {$area}</label><br />";
		}

		return $output;
	}

	/**
	 * mostrar mensagem
	 *
	 * @name    mostrar_mensagem
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2012-02-17
	 * @updated 2012-02-17
	 * @return  string
	 */
	function mostrar_mensagem()
	{
		?>

			<div class="updated">
				<p>...</p>
			</div>

		<?php
	}

	/**
	 * contagem regressiva
	 *
	 * @name    contagem_regressiva
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2012-02-10
	 * @updated 2012-02-17
	 * @return  string
	 */
	function contagem_regressiva()
	{
		global $wpdb;

		$prazo = $wpdb->get_var( $wpdb->prepare( "SELECT encerramento FROM {$wpdb->sav_editais} WHERE id_edital = 1", $id_edital ) );

		$agora = time() + ( get_option( 'gmt_offset' ) * 3600 );
		$prazo = strtotime( $prazo ) + 24 * 3600;

		$sobra = $prazo - $agora;

		?>

			<p id="cronometro" class="alignright"></p>

			<script language="JavaScript">
				var segundos = new Number();

				var segundos = <?php print $sobra; ?>;

				function contagem_regressiva()
				{
					if( ( segundos - 1 ) >= 0 )
					{
						segundos = segundos - 1;

						if( segundos > 86400 )
						{
							dias = Math.round( segundos / 86400 );
							cronometro.innerText = dias + ' dias para o encerramento dos editais!';
						}
						else if( segundos > 3600 )
						{
							horas = Math.round( segundos / 3600 );
							cronometro.innerText = horas + ' horas para o encerramento dos editais!';
						}
						else if( segundos > 60 )
						{
							minutos = Math.round( segundos / 60 );
							cronometro.innerText = minutos + ' minutos para o encerramento editais!';
						}
						else if( segundos > 0 )
						{
							cronometro.innerText = segundos + ' segundos para o encerramento editais!';
						}
						else
						{
							cronometro.innerText = 'editais encerrados!';
						}

						setTimeout( 'contagem_regressiva()', 1000 );
					}
				}

				contagem_regressiva();
			</script>

		<?php
	}

	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////
	/**
	 * @name    SAV
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2012-02-17
	 * @return  void
	 */
	function SAV()
	{
		// define plugin url
		$this->url = WP_PLUGIN_URL . '/' . $this->slug;

		// define plugin dir
		$this->dir = WP_PLUGIN_DIR . '/' . $this->slug;

		// define plugin tables
		$this->tables();

		// update plugin tables
		//$this->install_tables();

		//$this->uninstall();

		// instala os privilégios
		$this->install_roles_privileges();

		// load languages
		load_plugin_textdomain( $this->slug, '', 'lang' );

		// install o plugin
		register_activation_hook( __FILE__, array( &$this, 'install' ) );

		// uninstall plugin
		register_deactivation_hook( __FILE__, array( &$this, 'uninstall' ) );

		// contagem regressiva
		//add_action( 'admin_notices', array( &$this, 'mostrar_mensagem' ) );

		// includes
		require( "{$this->dir}/inc/validator.php" );
		require( "{$this->dir}/inc/fpdf/fpdf.php" );

		// extensions
		require( "{$this->dir}/sav-proponentes.php" );
		require( "{$this->dir}/sav-editais.php" );
		require( "{$this->dir}/sav-propostas.php" );
		require( "{$this->dir}/sav-engenho.php" );
		require( "{$this->dir}/sav-pdf.php" );
		require( "{$this->dir}/sav-relatorios.php" );
		require( "{$this->dir}/inc/sav-ajax.php" );

		// widgets
		require( "{$this->dir}/sav-widget.php" );
	}

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

$SAV = new SAV();

?>