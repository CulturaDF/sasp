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

class SAV_Engenho
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////
	/**
	 * shortcode: formulário para registrar pessoa física
	 *
	 * @name    formulario_pessoa_fisica
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2011-12-22
	 * @return  string
	 */
	function formulario_profissional( $args )
	{
		global $SAV, $user_ID, $user_login;

		extract(
			shortcode_atts(
				array(
					'target'   => get_permalink(),
					'redirect' => get_permalink(),
				),
				$args
			)
		);

		$output .= '<div id="cadastro_pessoa_fisica">';

		// se o usuário já estiver logado
		if( !empty( $user_ID ) )
		{
			// se o usuário não for pessoa física
			if( !$SAV->is_pessoa_fisica() )
			{
				$output .= '<div class="error">';
				$output .= '<p>Esse formulário é destinado apenas a pessoas físicas.</p>';
				$output .= '</div>';

				return $output;
			}

			// carrega os dados do usuário
			$dados_pessoais      = $SAV->get_dados_pessoais( $user_login );
			$dados_contato       = $SAV->get_dados_contato( $user_login );
			$dados_profissionais = $SAV->get_dados_profissionais( $user_login );
			$dados_geograficos   = $SAV->get_dados_geograficos( $user_login );

			$cpf_readonly        = "readonly='readonly'";
		}

		// utilizar os dados recem enviados pelo formulário
		if( 'cadastro_profissional' == $_POST[ 'form' ] )
		{
			$dados_pessoais[ 'login' ]          = $_POST[ 'cpf' ];
			$dados_pessoais[ 'nome' ]           = $_POST[ 'nome' ];

			$dados_geograficos[ 'cidade' ]      = $_POST[ 'cidade' ];
			$dados_geograficos[ 'estado' ]      = $_POST[ 'estado' ];

			$dados_profissionais[ 'ocupacao' ]  = $_POST[ 'ocupacao' ];
			$dados_profissionais[ 'biografia' ] = $_POST[ 'biografia' ];

			$dados_contato[ 'email' ]           = $_POST[ 'email' ];
		}

		// mostrar as mensagens
		if( isset( $_GET[ 'status' ] ) )
		{
			$output .= '<div class="success">';

			switch( $_GET[ 'status' ] )
			{
				case 1:
					$output .= '<p>Usuário cadastrado com sucesso!</p>';
					//$output .= '<p>Seus dados de acesso foram enviados para seu e-mail!</p>';
				break;
				case 3:
					$output .= '<p>Dados atualizados com sucesso!</p>';
				break;
			}

			$output .= '</div>';
		}

		// mostrar os erros
		if( !empty( $SAV->error ) )
		{
			$output .= '<div class="error">';

			foreach( $SAV->error as $error )
				$output .= "<p>{$error}</p>";

			$output .= '</div>';
		}

		$dados_profissionais[ 'interesse' ] = maybe_unserialize( $dados_profissionais[ 'interesse' ] );

		$output .= "
			<form action='{$target}' method='post' class='cadastro'>
				<input type='hidden' name='form' value='cadastro_profissional' />
				<input type='hidden' name='redirect' value='{$redirect}' />
				<input type='hidden' name='user_id' value='{$user_ID}' />
				<table>
					<tr>
						<td><label for='nome'>Nome: *</label></td>
						<td colspan='3'><input type='text' id='nome' name='nome' value='{$dados_pessoais[ 'nome' ]}' maxlength='100' class='text-large' /></td>
					</tr>
		";

		if( empty( $user_login ) )
		{
			$output .= "
						<tr>
							<td><label for='cpf'>Senha: *</label></td>
							<td colspan='3'><input type='password' id='senha' name='senha' value='' size='15' maxlength='100' {$cpf_readonly}' /></td>
						</tr>
			";
		}

		$output .= "
					<tr>
						<td><label for='cpf'>CPF: *</label></td>
						<td colspan='3'><input type='text' id='cpf' name='cpf' value='{$dados_pessoais[ 'login' ]}' size='15' maxlength='11' {$cpf_readonly} /></td>
					</tr>
					<tr>
						<td><label for='email'>E-mail: *</label></td>
						<td colspan='3'><input type='text' id='email' name='email' value='{$dados_contato[ 'email' ]}' maxlength='100' class='text-large' /></td>
					</tr>
					<tr>
						<td><label for='cidade'>Cidade: *</label></td>
						<td><input type='text' id='cidade' name='cidade' value='{$dados_geograficos[ 'cidade' ]}' maxlength='100' /></td>
						<td><label for='estado'>UF: *</label></td>
						<td>" . $SAV->dropdown_states( 'estado', $dados_geograficos[ 'estado' ] ) . "</td>
					</tr>
					<tr>
						<td><label for='site'>Site/Blog:</label></td>
						<td colspan='3'><input type='text' id='site' name='site' value='{$dados_contato[ 'site' ]}' maxlength='100' class='text-large' /></td>
					</tr>
					<tr>
						<td valign='top'><label for='interesse'>Áreas de Interesse: *</label></td>
						<td colspan='3'>
							" . $SAV->checkbox_interesses( 'interesse', $dados_profissionais[ 'interesse' ] ) . "
						</td>
					</tr>
					<tr>
						<td><label for='ocupacao'>Área de Atuação: *</label></td>
						<td colspan='3'><input type='text' id='ocupacao' name='ocupacao' value='{$dados_profissionais[ 'ocupacao' ]}' maxlength='100' class='text-large' /></td>
					</tr>
					<tr valign='top'>
						<td><label for='ocupacao'>Biografia:</label></td>
						<td colspan='3'><textarea id='biografia' name='biografia' cols='70' rows='5' class='text-large'>{$dados_profissionais[ 'biografia' ]}</textarea></td>
					</tr>
					<tr>
						<td colspan='4'><button type='submit'>Enviar</button></td>
					</tr>
				</table>
			</form>
		";

		$output .= "</div>";

		return $output;
	}

	/**
	 * register user by cpf
	 *
	 * @name    cadastro_pessoa_fisica
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-26
	 * @updated 2011-12-22
	 * @return  string
	 */
	function cadastro_profissional()
	{
		global $wpdb, $user_ID, $user_login, $SAV;

		$Validator = new Validator();

		// check if the user submit the form
		if( isset( $_POST[ 'form' ] ) and 'cadastro_profissional' == $_POST[ 'form' ] )
		{
			// validate data
			$dados_pessoais[ 'login' ]          = $Validator->validate( $_POST[ 'cpf' ],          'CPF',          'required=1&cpf=1' );
			$dados_pessoais[ 'nome' ]           = $Validator->validate( $_POST[ 'nome' ],         'Nome',         'required=1&max_length=100' );

			$dados_contato[ 'email' ]           = $Validator->validate( $_POST[ 'email' ],        'E-mail',       'required=1&max_length=100&email=1' );
			$dados_contato[ 'site' ]            = $Validator->validate( $_POST[ 'site' ],         'Site',         'required=0&max_length=100' );

			$dados_geograficos[ 'cidade' ]      = $Validator->validate( $_POST[ 'cidade' ],       'Cidade',       'required=1&max_length=100' );
			$dados_geograficos[ 'estado' ]      = $Validator->validate( $_POST[ 'estado' ],       'Estado',       'required=1&max_length=20' );
			$dados_geograficos[ 'pais' ]        = 'Brasil';

			$dados_profissionais[ 'ocupacao' ]  = $Validator->validate( $_POST[ 'ocupacao' ],     'Ocupação',     'required=1&max_length=100' );
			$dados_profissionais[ 'biografia' ] = $Validator->validate( $_POST[ 'biografia' ],    'Biografia',    'required=1&max_length=10000' );
			$dados_profissionais[ 'interesse' ] = maybe_serialize( $_POST[ 'interesse' ] );

			$SAV->error = $Validator->error();

			// check if the fields are correctly filled
			if( empty( $SAV->error ) )
			{
				// if user is logged, update his data
				if( !empty( $user_ID ) and $user_ID == $_POST[ 'user_id' ] )
				{
					// fill basic informations
					$user = array(
						'ID'            => $user_ID,
						'user_login'    => $user_login,
						'user_email'    => $dados_contato[ 'email' ],
						'user_url'      => $dados_contato[ 'site' ],
						'first_name'    => $dados_pessoais[ 'nome' ],
						'display_name'  => $dados_pessoais[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'description'   => $dados_profissionais[ 'biografia' ],
						'role'          => 'contributor'
					);

					// update user
					$new_user_id = wp_insert_user( $user );

					if ( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations
					$dados_contato[ 'login' ]       = $user_login;
					$dados_profissionais[ 'login' ] = $user_login;
					$dados_geograficos[ 'login' ]   = $user_login;

					$SAV->update_dados_pessoais( $dados_pessoais );
					$SAV->update_dados_contato( $dados_contato );
					$SAV->update_dados_geograficos( $dados_geograficos );
					$SAV->update_dados_profissionais( $dados_profissionais );

					// update user
					wp_redirect( "{$_POST[ 'redirect' ]}?status=3" );

					exit();
				}
				else
				{
					$senha = $Validator->validate( $_POST[ 'senha' ], 'Senha', 'required=1&max_length=100' ); //wp_generate_password()

					$SAV->error = $Validator->error();

					// check if the fields are correctly filled
					if( !empty( $SAV->error ) )
						return false;

					// fill basic informations
					$user = array(
						'user_login'    => $dados_pessoais[ 'login' ],
						'user_pass'     => $senha,
						'user_email'    => $dados_contato[ 'email' ],
						'user_url'      => $dados_contato[ 'site' ],
						'first_name'    => $dados_pessoais[ 'nome' ],
						'display_name'  => $dados_pessoais[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'description'   => $dados_profissionais[ 'biografia' ],
						'role'          => 'contributor'
					);

					// register user
					$new_user_id = wp_insert_user( $user );

					if ( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations

					$dados_contato[ 'login' ]       = $dados_pessoais[ 'login' ];
					$dados_profissionais[ 'login' ] = $dados_pessoais[ 'login' ];
					$dados_geograficos[ 'login' ]   = $dados_pessoais[ 'login' ];

					$SAV->update_dados_pessoais( $dados_pessoais );
					$SAV->update_dados_contato( $dados_contato );
					$SAV->update_dados_geograficos( $dados_geograficos );
					$SAV->update_dados_profissionais( $dados_profissionais );

					// send the new user a e-mail
					//$subject  = 'Bem-vindo ao Sistema de Editais da SAv';
					//$message  = '<p>Agora você pode cadastrar suas propostas de editais e blablabla</p>';
					//$message .= "<p>Visite a nossa página e faça o login com seu CPF ({$user[ 'user_login' ]}) e senha ({$user[ 'user_pass' ]}).</p>";
					//wp_mail( $user[ 'user_email' ], $subject, $message );
					wp_new_user_notification( $new_user_id, $user[ 'user_pass' ] );

					// signon user
					$creds = array( 'user_login' => $dados_pessoais[ 'login' ], 'user_password' => $senha, 'remember' => true );

					$user = wp_signon( $creds, false );

					if( is_wp_error( $user ) )
					{
						$SAV->error[] = $user->get_error_message();

						return false;
					}

					// redirect user
					wp_redirect( "{$_POST[ 'redirect' ]}?status=1" );

					exit();
				}
			}
		}
	}

	/**
	 * shortcode: form for register user by cnpj
	 *
	 * @name    formulario_empresa
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-26
	 * @updated 2011-12-22
	 * @return  string
	 */
	function formulario_empresa( $args )
	{
		global $SAV, $user_ID, $user_login;

		extract(
			shortcode_atts(
				array(
					'target'   => get_permalink(),
					'redirect' => get_permalink(),
				),
				$args
			)
		);

		$output .= '<div id="cadastro_empresa">';

		// if user is logged
		if( !empty( $user_ID ) )
		{
			// in case the user not be a pessoa juridica
			if( !$SAV->is_pessoa_juridica() )
			{
				$output .= '<div class="error">';
				$output .= '<p>Esse formulário é destinado apenas a empresas.</p>';
				$output .= '</div>';

				return $output;
			}

			// load his data
			$dados_empresa       = $SAV->get_dados_empresa( $user_login );
			$dados_contato       = $SAV->get_dados_contato( $user_login );
			$dados_geograficos   = $SAV->get_dados_geograficos( $user_login );
			$dados_profissionais = $SAV->get_dados_profissionais( $user_login );

			$cnpj_readonly     = "readonly='readonly'";
		}

		// update user_data with the sended data
		if( 'cadastro_pessoa_juridica' == $_POST[ 'form' ] )
		{
			$dados_empresa[ 'login' ]              = $_POST[ 'cnpj' ];
			$dados_empresa[ 'nome' ]               = $_POST[ 'razao_social' ];
			$dados_empresa[ 'nome_representante' ] = $_POST[ 'nome_representante' ];
			$dados_empresa[ 'cpf_representante' ]  = $_POST[ 'cpf_representante' ];

			$dados_geograficos[ 'cidade' ]         = $_POST[ 'cidade' ];
			$dados_geograficos[ 'estado' ]         = $_POST[ 'estado' ];

			$dados_contato[ 'email' ]              = $_POST[ 'email' ];
			$dados_contato[ 'site' ]               = $_POST[ 'site' ];

			$dados_profissionais[ 'ocupacao' ]     = $_POST[ 'ocupacao' ];
			$dados_profissionais[ 'interesse' ]    = $_POST[ 'interesse' ];
			$dados_profissionais[ 'biografia' ]    = $_POST[ 'biografia' ];
		}

		// show a success message to registered users
		if( isset( $_GET[ 'status' ] ) )
		{
			$output .= '<div class="success">';

			switch( $_GET[ 'status' ] )
			{
				case 1:
					$output .= '<p>Usuário cadastrado com sucesso!</p>';
					//$output .= '<p>Seus dados de acesso foram enviados para seu e-mail!</p>';
				break;
				case 3:
					$output .= '<p>Dados atualizados com sucesso!</p>';
				break;
			}

			$output .= '</div>';
		}

		// show errors
		if( !empty( $SAV->error ) )
		{
			$output .= '<div class="error">';

			foreach( $SAV->error as $error )
				$output .= "<p>{$error}</p>";

			$output .= '</div>';
		}

		$dados_profissionais[ 'interesse' ] = maybe_unserialize( $dados_profissionais[ 'interesse' ] );

		$output .= "
			<form action='{$target}' method='post' class='cadastro'>
				<input type='hidden' name='form' value='cadastro_empresa' />
				<input type='hidden' name='redirect' value='{$redirect}' />
				<input type='hidden' name='user_id' value='{$user_ID}' />
				<table>
					<tr>
						<td><label for='razao_social'>Razão Social: *</label></td>
						<td colspan='3'><input type='text' id='razao_social' name='razao_social' value='{$dados_empresa[ 'nome' ]}' maxlength='100' class='text-large' /></td>
					</tr>
		";

		if( empty( $user_login ) )
		{
			$output .= "
						<tr>
							<td><label for='cpf'>Senha: *</label></td>
							<td colspan='3'><input type='password' id='senha' name='senha' value='' size='15' maxlength='100' /></td>
						</tr>
			";
		}

		$output .= "
					<tr>
						<td><label for='cnpj'>CNPJ: *</label></td>
						<td colspan='3'><input type='text' id='cnpj' name='cnpj' value='{$dados_empresa[ 'login' ]}' size='15' maxlength='14' {$cnpj_readonly} /></td>
					</tr>
					<tr>
						<td><label for='nome_representante'>Representante Legal: *</label></td>
						<td colspan='3'><input type='text' id='nome_representante' name='nome_representante' value='{$dados_empresa[ 'nome_representante' ]}' maxlength='100' class='text-large' /></td>
					</tr>
					<tr>
						<td><label for='cpf_representante'>CPF do Representante: *</label></td>
						<td colspan='3'><input type='text' id='cpf_representante' name='cpf_representante' value='{$dados_empresa[ 'cpf_representante' ]}' size='15' maxlength='11' {$cnpj_readonly} /></td>
					</tr>
					<tr>
						<td><label for='cidade'>Cidade: *</label></td>
						<td><input type='text' id='cidade' name='cidade' value='{$dados_geograficos[ 'cidade' ]}' maxlength='100' /></td>
						<td><label for='estado'>UF: *</label></td>
						<td>" . $SAV->dropdown_states( 'estado', $dados_geograficos[ 'estado' ] ) . "</td>
					</tr>
					<tr>
						<td><label for='email'>E-mail: *</label></td>
						<td colspan='3'><input type='text' id='email' name='email' value='{$dados_contato[ 'email' ]}' maxlength='100' class='text-large' /></td>
					</tr>
					<tr>
						<td><label for='site'>Site/Blog:</label></td>
						<td colspan='3'><input type='text' id='site' name='site' value='{$dados_contato[ 'site' ]}' maxlength='100' class='text-large' /></td>
					</tr>
					<tr>
						<td valign='top'><label for='interesse'>Áreas de Interesse: *</label></td>
						<td colspan='3'>
							" . $SAV->checkbox_interesses( 'interesse', $dados_profissionais[ 'interesse' ] ) . "
						</td>
					</tr>
					<tr>
						<td><label for='ocupacao'>Área de Atuação: *</label></td>
						<td colspan='3'><input type='text' id='ocupacao' name='ocupacao' value='{$dados_profissionais[ 'ocupacao' ]}' maxlength='100' class='text-large' /></td>
					</tr>
					<tr>
						<td valign='top'><label for='ocupacao'>Biografia:</label></td>
						<td colspan='3'><textarea id='biografia' name='biografia' cols='100' rows='5' class='text-large'>{$dados_profissionais[ 'biografia' ]}</textarea></td>
					</tr>
					<tr>
						<td colspan='4'><button type='submit'>Enviar</button></td>
					</tr>
				</table>
			</form>
		";

		$output .= "</div>";

		return $output;
	}

	/**
	 * register user by cnpj
	 *
	 * @name    cadastro_pessoa_juridica
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-26
	 * @updated 2011-12-22
	 * @return  string
	 */
	function cadastro_empresa()
	{
		global $wpdb, $user_ID, $user_login, $SAV;

		$Validator = new Validator();

		// check if the user submit the form
		if( isset( $_POST[ 'form' ] ) and 'cadastro_empresa' == $_POST[ 'form' ] )
		{
			// validate data
			$dados_empresa[ 'login' ]              = $Validator->validate( $_POST[ 'cnpj' ],               'CNPJ',                 'required=1&cnpj=1' );
			$dados_empresa[ 'nome' ]               = $Validator->validate( $_POST[ 'razao_social' ],       'Razão Social',         'required=1&max_length=100' );
			$dados_empresa[ 'cpf_representante' ]  = $Validator->validate( $_POST[ 'cpf_representante' ],  'CPF do Representante', 'required=1&cpf=1' );
			$dados_empresa[ 'nome_representante' ] = $Validator->validate( $_POST[ 'nome_representante' ], 'Representante Legal',  'required=1&max_length=100' );

			$dados_geograficos[ 'cidade' ]         = $Validator->validate( $_POST[ 'cidade' ],             'Cidade',               'required=1&max_length=100' );
			$dados_geograficos[ 'estado' ]         = $Validator->validate( $_POST[ 'estado' ],             'UF',                   'required=1&max_length=20' );
			$dados_geograficos[ 'pais' ]           = 'Brasil';

			$dados_profissionais[ 'ocupacao' ]     = $Validator->validate( $_POST[ 'ocupacao' ],           'Ocupação',             'required=1&max_length=100' );
			$dados_profissionais[ 'biografia' ]    = $Validator->validate( $_POST[ 'biografia' ],          'Biografia',            'required=1&max_length=10000' );
			$dados_profissionais[ 'interesse' ]    = maybe_serialize( $_POST[ 'interesse' ] );

			$dados_contato[ 'email' ]              = $Validator->validate( $_POST[ 'email' ],              'E-mail',               'required=1&max_length=100&email=1' );
			$dados_contato[ 'site' ]               = $Validator->validate( $_POST[ 'site' ],               'Site/Blog',            'required=0&max_length=100' );

			$SAV->error = $Validator->error();

			// check if the fields are correctly filled
			if( empty( $SAV->error ) )
			{
				// if user is logged, update his data
				if( !empty( $user_ID ) and $user_ID == $_POST[ 'user_id' ] )
				{
					// fill basic informations
					$user = array(
						'ID'            => $user_ID,
						'user_email'    => $dados_contato[ 'email' ],
						'user_url'      => $dados_contato[ 'site' ],
						'first_name'    => $dados_empresa[ 'nome' ],
						'display_name'  => $dados_empresa[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'description'   => $dados_profissionais[ 'biografia' ],
						'role'          => 'contributor'
					);

					// update user
					$new_user_id = wp_insert_user( $user );

					if( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations
					$dados_contato[ 'login' ]       = $dados_empresa[ 'login' ];
					$dados_geograficos[ 'login' ]   = $dados_empresa[ 'login' ];
					$dados_profissionais[ 'login' ] = $dados_empresa[ 'login' ];

					$SAV->update_dados_empresa( $dados_empresa );
					$SAV->update_dados_contato( $dados_contato );
					$SAV->update_dados_geograficos( $dados_geograficos );
					$SAV->update_dados_profissionais( $dados_profissionais );

					// redirect user
					wp_redirect( "{$_POST[ 'redirect' ]}?status=3" ); exit();
				}
				else
				{
					$senha = $Validator->validate( $_POST[ 'senha' ], 'Senha', 'required=1&max_length=100' ); //wp_generate_password()

					$SAV->error = $Validator->error();

					// check if the fields are correctly filled
					if( !empty( $SAV->error ) )
						return false;

					// fill basic informations
					$user = array(
						'user_login'    => $dados_empresa[ 'login' ],
						'user_pass'     => $senha,
						'user_email'    => $dados_contato[ 'email' ],
						'user_url'      => $dados_contato[ 'site' ],
						'first_name'    => $dados_empresa[ 'nome' ],
						'display_name'  => $dados_empresa[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'description'   => $dados_profissionais[ 'biografia' ],
						'role'          => 'contributor'
					);

					// register user
					$new_user_id = wp_insert_user( $user );

					if( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations
					$dados_contato[ 'login' ]       = $dados_empresa[ 'login' ];
					$dados_geograficos[ 'login' ]   = $dados_empresa[ 'login' ];
					$dados_profissionais[ 'login' ] = $dados_empresa[ 'login' ];

					$SAV->update_dados_empresa( $dados_empresa );
					$SAV->update_dados_contato( $dados_contato );
					$SAV->update_dados_geograficos( $dados_geograficos );
					$SAV->update_dados_profissionais( $dados_profissionais );

					// send the new user a e-mail
					//$subject  = 'Bem-vindo ao Sistema de Editais da SAv';
					//$message  = '<p>Agora você pode cadastrar suas propostas de editais e blablabla</p>';
					//$message .= "<p>Visite a nossa página e faça o login com seu CNPJ ({$user[ 'user_login' ]}) e senha ({$user[ 'user_pass' ]}).</p>";
					//wp_mail( $user[ 'user_email' ], $subject, $message );
					wp_new_user_notification( $new_user_id, $user[ 'user_pass' ] );

					// signon user
					$creds = array( 'user_login' => $dados_pessoais[ 'login' ], 'user_password' => $senha, 'remember' => true );

					$user = wp_signon( $creds, false );

					if( is_wp_error( $user ) )
					{
						$SAV->error[] = $user->get_error_message();

						return false;
					}

					// redirect user
					wp_redirect( "{$_POST[ 'redirect' ]}?status=1" ); exit();
				}
			}
		}
	}

	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////
	/**
	 * @name    SAV_Engenho
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-26
	 * @updated 2011-11-29
	 * @return  void
	 */
	function SAV_Engenho()
	{
		// shortcodes
		add_shortcode( 'formulario_profissional', array( &$this, 'formulario_profissional' ) );
		add_shortcode( 'formulario_empresa', array( &$this, 'formulario_empresa' ) );

		// cadastro pessoa fisica
		add_action( 'init', array( &$this, 'cadastro_profissional' ) );
		add_action( 'init', array( &$this, 'cadastro_empresa' ) );
	}

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

$SAV_Engenho = new SAV_Engenho();

?>