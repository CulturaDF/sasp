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

class SAV_Proponentes
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////

	/**
	 * formulário para direcionar o cadastro para pf ou pj
	 * shortcode: formulario_direcionar_usuario
	 *
	 * @name    formulario_direcionar_cadsatro
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-05-04
	 * @updated 2012-05-04
	 * @return  mixed
	 */
	function formulario_direcionar_cadastro( $args )
	{

		global $SAV, $user_ID, $user_login;

		extract(
			shortcode_atts(
				array(
					'target'   => get_permalink(),
					'redirect' => get_bloginfo( 'url' ),
				),
				$args
			)
		);

		$output .= '<div class="redirect">';

		$output .= "
			<form class='cadastro' action='{$target}' method='post'>
				<input type='hidden' name='form' value='direcionar_cadastro' />
				<input type='hidden' name='redirect' value='{$redirect}' />
				<table>
					<tr>
						<td><label for='login'>CPF/CNPJ: </label></td>
						<td><input type='text' class='grid-2' id='login' name='login' value='' size='15' maxlength='11' /></td>
					</tr>
					<tr>
						<td colspan='2'><button type='submit'>Cadastrar</button></td>
					</tr>
				</table>
			</form>
		";

		$output .= '</div>';

		return $output;
	}

	/**
	 * direcionar o cadastro
	 *
	 * @name    direcionar_cadastro
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-05-04
	 * @updated 2012-05-04
	 * @return  string
	 */
	function direcionar_cadastro()
	{
		global $wpdb, $user_ID, $user_login, $SAV;

		$Validator = new Validator();

		// check if the user submit the form
		if( isset( $_POST[ 'form' ] ) and 'direcionar_cadastro' == $_POST[ 'form' ] )
		{
			// validate data
			$dados_pessoais[ 'login' ] = $Validator->validate( $_POST[ 'login' ],          'LOGIN',          'required=1&cpf=1' );

			$SAV->error = $Validator->error();

			// check if the fields are correctly filled
			if( empty( $SAV->error ) )
			{
				// redirect user
				wp_redirect( "{$_POST[ 'redirect' ]}?status=1" );

				exit();
			}
		}
	}




	/**
	 * shortcode: formulário para registrar pessoa física
	 *
	 * @name    formulario_pessoa_fisica
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2012-01-09
	 * @return  string
	 */
	function formulario_pessoa_fisica( $args )
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
			$dados_pessoais    = $SAV->get_dados_pessoais( $user_login );
			$dados_contato     = $SAV->get_dados_contato( $user_login );

			$cpf_readonly      = "readonly='readonly'";
		}

		$output .= '<div id="cadastro_pessoa_fisica">';

		// utilizar os dados recem enviados pelo formulário
		if( 'cadastro_pessoa_fisica' == $_POST[ 'form' ] )
		{
			$dados_pessoais[ 'login' ]       = $_POST[ 'cpf' ];
			$dados_pessoais[ 'nome' ]        = $_POST[ 'nome' ];

			$dados_contato[ 'email' ]        = $_POST[ 'email' ];
		}

		// mostrar as mensagens
		if( isset( $_GET[ 'status' ] ) )
		{
			$output .= '<div class="success">';

			switch( $_GET[ 'status' ] )
			{
				case 1:
					$output .= "<p>Bem-vindo ao portal do audiovisual! Você está logado como {$dados_pessoais[ 'nome' ]}</p>";
					$output .= '<p>Para cadastrar propostas, vá para o <a href="http://www.cultura.gov.br/audiovisual/fomento/wp-admin/admin.php?page=editais&status=abertos" title="Sistema de Fomento Audiovisual">Sistema de Fomento Audiovisual</a>.</p>';
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

			$output .= '<ol>';
			$output .= '<h3>Atenção:</h3>';

			foreach( $SAV->error as $error )
				$output .= "<li>{$error}</li>";

      $output .= '</ol>';
			$output .= '</div>';
		}

		$output .= "
			<form class='cadastro' action='{$target}' method='post'>
				<input type='hidden' name='form' value='cadastro_pessoa_fisica' />
				<input type='hidden' name='redirect' value='{$redirect}' />
				<input type='hidden' name='user_id' value='{$user_ID}' />
				<table>
					<tr>
						<td>
							<label for='nome'>Nome Completo: </label>
							<input type='text' class='grid-1 id='nome' name='nome' value='{$dados_pessoais[ 'nome' ]}' maxlength='100' />
							<div class='help'>
								<p>Nome completo conforme consta no RG</p>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for='cpf'>CPF: </label>
							<input type='text' class='grid-2' id='cpf' name='cpf' value='{$dados_pessoais[ 'login' ]}' size='15' maxlength='11' {$cpf_readonly} />
							<div class='help'>
								<p>Informe o CPF númerico (sem caracteres especiais)</p>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for='email'>E-mail: </label>
							<input type='text' class='grid-1' id='email' name='email' value='{$dados_contato[ 'email' ]}' maxlength='100' />
							<div class='help'>
								<p>Informe um e-mail válido. Será utilizado como meio de comunicação</p>
							</div>
						</td>
					</tr>
		";

		if( empty( $user_login ) )
		{
			$output .= "
						<tr>
							<td><label for='cpf'>Definir Senha: </label><input type='password' class='grid-2' id='senha' name='senha' value='' size='15' maxlength='100' {$cpf_readonly} />
								<div class='help'>
									<p>Digite uma senha segura</p>
								</div>
							</td>
						</tr>
			";
		}

		$output .= "
					<tr>
						<td align='center'><p>Todos os campos são obrigatórios</p><button type='submit'>Enviar</button></td>

					</tr>
					<tr>
						<td></td>
					</tr>
					<tr align=center>
						<td><a href='". get_bloginfo( 'url' ) ."/wp-login.php?action=lostpassword' title='recuperar senha'>Recuperar senha</a></td>
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
	 * @since   2011-07-29
	 * @updated 2011-12-28
	 * @return  string
	 */
	function cadastro_pessoa_fisica()
	{
		global $wpdb, $user_ID, $user_login, $SAV;

		$Validator = new Validator();

		// check if the user submit the form
		if( isset( $_POST[ 'form' ] ) and 'cadastro_pessoa_fisica' == $_POST[ 'form' ] )
		{
			// validate data
			$dados_pessoais[ 'login' ]       = $Validator->validate( $_POST[ 'cpf' ],          'CPF',          'required=1&cpf=1' );
			$dados_pessoais[ 'nome' ]        = $Validator->validate( $_POST[ 'nome' ],         'Nome',         'required=1&max_length=100' );

			$dados_contato[ 'email' ]        = $Validator->validate( $_POST[ 'email' ],        'E-mail',       'required=1&max_length=100&email=1' );

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
						'first_name'    => $dados_pessoais[ 'nome' ],
						'display_name'  => $dados_pessoais[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'role'          => 'proponente'
					);

					// update user
					$new_user_id = wp_insert_user( $user );

					if ( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations
					$dados_pessoais[ 'login' ]    = $user_login;
					$dados_contato[ 'login' ]     = $user_login;

					//$SAV->update_dados_pessoais( $dados_pessoais );
					$SAV->update_dados_contato( $dados_contato );

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
						'first_name'    => $dados_pessoais[ 'nome' ],
						'display_name'  => $dados_pessoais[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'role'          => 'proponente'
					);

					// register user
					$new_user_id = wp_insert_user( $user );

					if ( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations
					$dados_contato[ 'login' ]     = $dados_pessoais[ 'login' ];
					$dados_geograficos[ 'login' ] = $dados_pessoais[ 'login' ];

					$SAV->update_dados_pessoais( $dados_pessoais );
					$SAV->update_dados_contato( $dados_contato );
					//$SAV->update_dados_geograficos( $dados_geograficos );

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
	 * @name    formulario_pessoa_juridica
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2012-01-09
	 * @return  string
	 */
	function formulario_pessoa_juridica( $args )
	{
		global $SAV, $user_ID, $user_login;

		if( !empty( $user_login ) )
			$disabled = 'disabled = "disabled"';

		extract(
			shortcode_atts(
				array(
					'target'   => get_permalink(),
					'redirect' => get_permalink(),
				),
				$args
			)
		);

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
			$dados_empresa     = $SAV->get_dados_empresa( $user_login );
			$dados_contato     = $SAV->get_dados_contato( $user_login );

			$cnpj_readonly     = "readonly='readonly'";
		}

		$output .= '<div id="cadastro_pessoa_juridica">';

		// update user_data with the sended data
		if( 'cadastro_pessoa_juridica' == $_POST[ 'form' ] )
		{
			$dados_empresa[ 'login' ]              = $_POST[ 'cnpj' ];
			$dados_empresa[ 'nome' ]               = $_POST[ 'razao_social' ];
			$dados_empresa[ 'nome_representante' ] = $_POST[ 'nome_representante' ];
			$dados_empresa[ 'cpf_representante' ]  = $_POST[ 'cpf_representante' ];
			$dados_empresa[ 'natureza' ]  		   = $_POST[ 'natureza' ];

			$dados_contato[ 'email' ]              = $_POST[ 'email' ];
		}

		if( !empty($dados_empresa['natureza']) )
			$natureza_disabled = 'disabled = "disabled"';

		// show a success message to registered users
		if( isset( $_GET[ 'status' ] ) )
		{
			$output .= '<div class="success">';

			switch( $_GET[ 'status' ] )
			{
				case 1:
					$output .= "<p>Bem-vindo ao portal do audiovisual! Você está logado como {$dados_empresa[ 'nome' ]}</p>";
					$output .= '<p>Para cadastrar propostas, vá para o <a href="http://www.cultura.gov.br/audiovisual/fomento/wp-admin/admin.php?page=editais&status=abertos" title="Sistema de Fomento Audiovisual">Sistema de Fomento Audiovisual</a>.</p>';
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
            $output .= '<ol>';
            $output .='<h3>Atenção:</h3>';

			foreach( $SAV->error as $error )
				$output .= "<li>{$error}</li>";

            $output .= '</ol>';
			$output .= '</div>';
		}

		$output .= "
			<form action='{$target}' method='post' class='cadastro'>
				<input type='hidden' name='form' value='cadastro_pessoa_juridica' />
				<input type='hidden' name='redirect' value='{$redirect}' />
				<input type='hidden' name='user_id' value='{$user_ID}' />
				<table>
					<tr>
						<td>
							<label for='razao_social'>Razão Social: </label>
							<input type='text' class='grid-1' id='razao_social' name='razao_social' value='{$dados_empresa[ 'nome' ]}' maxlength='100' />
							<div class='help'>
								<p>Informe a razão Social da sua empresa/entidade</p>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for='cnpj'>CNPJ: </label>
							<input type='text' class='grid-2' id='cnpj' name='cnpj' value='{$dados_empresa[ 'login' ]}' size='18' maxlength='14' {$cnpj_readonly} />
							<div class='help'>
								<p>Digite o CNPJ da sua empresa sem os caracteres especiais</p>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for='nome_representante'>Representante Legal: </label>
							<input type='text' class='grid-1' id='nome_representante' name='nome_representante' value='{$dados_empresa[ 'nome_representante' ]}' maxlength='100' />
							<div class='help'>
								<p>Digite o nome do representante legal conforme o RG</p>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for='cpf_representante'>CPF do Representante: </label>
							<input type='text' class='grid-2' id='cpf_representante' name='cpf_representante' value='{$dados_empresa[ 'cpf_representante' ]}' size='18' maxlength='11' {$cnpj_readonly}  />
							<div class='help'>
								<p>Digite o cpf númerico, sem caracteres especiais</p>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for='natureza'>Natureza : </label>
							<select id='natureza' name='natureza' {$natureza_disabled}>
								<option value=''>selecione</option>
		";
									foreach( $naturezas as $key => $natureza )
									{
										if( $key ==  $dados_empresa[ 'natureza' ] )
											$selected = 'selected="selected"';
										else
											$selected = "";

										$output .= "<option value='{$key}' {$selected} >{$natureza}</option>";
									}
		$output .= "
							</select>
							<div class='help'>
								<p>Selecione a natureza da sua empresa</p>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for='email'>E-mail: </label>
							<input type='text' class='grid-1' id='email' name='email' value='{$dados_contato[ 'email' ]}' maxlength='100' />
							<div class='help'>
								<p>Informe um e-mail válido. Será utilizado como meio de comunicação</p>
							</div>
						</td>
					</tr>
		";

		if( empty( $user_login ) )
		{
			$output .= "
					<tr>
						<td>
							<label for='senha'>Definir Senha: </label>
							<input type='password' class='grid-2' id='senha' name='senha' value='' size='18' maxlength='100' />
							<div class='help'>
								<p>Digite uma senha segura</p>
							</div>
						</td>
					</tr>
			";
		}

		$output .= "

					<tr>
						<td align='center'><p>Todos os campos são obrigatórios</p><button type='submit' >Enviar</button></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr align='center'>
						<td><a href='". get_bloginfo( 'url' ) ."/wp-login.php?action=lostpassword' title='recuperar senha'>Recuperar senha</a></td>
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
	 * @since   2011-07-29
	 * @updated 2011-12-29
	 * @return  string
	 */
	function cadastro_pessoa_juridica()
	{
		global $wpdb, $user_ID, $user_login, $SAV;

		$Validator = new Validator();

		// check if the user submit the form
		if( isset( $_POST[ 'form' ] ) and 'cadastro_pessoa_juridica' == $_POST[ 'form' ] )
		{
			// validate data
			$dados_empresa[ 'login' ]              = $Validator->validate( $_POST[ 'cnpj' ],               'CNPJ',                 'required=1&cnpj=1' );
			$dados_empresa[ 'nome' ]               = $Validator->validate( $_POST[ 'razao_social' ],       'Razão Social',         'required=1&max_length=100' );
			//$dados_empresa[ 'ra' ]                 = $Validator->validate( $_POST[ 'ra' ],                 'Registro Ancine',      'required=1&max_length=15' );
			$dados_empresa[ 'cpf_representante' ]  = $Validator->validate( $_POST[ 'cpf_representante' ],  'CPF do Representante', 'required=1&cpf=1' );
			$dados_empresa[ 'nome_representante' ] = $Validator->validate( $_POST[ 'nome_representante' ], 'Representante Legal',  'required=1&max_length=100' );

			$verifica_empresa = $SAV->get_dados_empresa( $user_login );

			if( empty( $verifica_empresa['natureza'] ) )
				$dados_empresa[ 'natureza' ] 		   = $Validator->validate( $_POST[ 'natureza' ], 		    'Natureza',  'required=1&max_length=100' );

			$dados_contato[ 'email' ]              = $Validator->validate( $_POST[ 'email' ],              'E-mail',               'required=1&max_length=100&email=1' );

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
						'first_name'    => $dados_empresa[ 'nome' ],
						'display_name'  => $dados_empresa[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'role'          => 'proponente'
					);

					// update user
					$new_user_id = wp_insert_user( $user );

					if( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations
					$dados_contato[ 'login' ]     = $dados_empresa[ 'login' ];
					$dados_geograficos[ 'login' ] = $dados_empresa[ 'login' ];

					$SAV->update_dados_empresa( $dados_empresa );
					$SAV->update_dados_contato( $dados_contato );

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
						'first_name'    => $dados_empresa[ 'nome' ],
						'display_name'  => $dados_empresa[ 'nome' ],
						'user_nicename' => sanitize_title( $dados_pessoais[ 'nome' ] ),
						'role'          => 'proponente'
					);

					// register user
					$new_user_id = wp_insert_user( $user );

					if( is_wp_error( $new_user_id ) )
					{
						$SAV->error[] = $new_user_id->get_error_message();

						return false;
					}

					// fill aditional informations
					$dados_contato[ 'login' ]     = $dados_empresa[ 'login' ];
					$dados_geograficos[ 'login' ] = $dados_empresa[ 'login' ];

					$SAV->update_dados_empresa( $dados_empresa );
					$SAV->update_dados_contato( $dados_contato );
					//$SAV->update_dados_geograficos( $dados_geograficos );

					// send the new user a e-mail
					//$subject  = 'Bem-vindo ao Sistema de Editais da SAv';
					//$message  = '<p>Agora você pode cadastrar suas propostas de editais e blablabla</p>';
					//$message .= "<p>Visite a nossa página e faça o login com seu CNPJ ({$user[ 'user_login' ]}) e senha ({$user[ 'user_pass' ]}).</p>";
					//wp_mail( $user[ 'user_email' ], $subject, $message );
					wp_new_user_notification( $new_user_id, $user[ 'user_pass' ] );

					// signon user
					$creds = array( 'user_login' => $dados_empresa[ 'login' ], 'user_password' => $senha, 'remember' => true );

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

	/**
	 * mostrar dados do perfil sav
	 *
	 * @name    mostrar_perfil_sav
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-29
	 * @updated 2012-01-10
	 * @return  void
	 */
	function mostrar_perfil_sav( $user )
	{
		global $SAV;

		$dados_empresa       = $SAV->get_dados_empresa( $user->user_login );
		$dados_pessoais      = $SAV->get_dados_pessoais( $user->user_login );
		$dados_contato       = $SAV->get_dados_contato( $user->user_login );
		$dados_geograficos   = $SAV->get_dados_geograficos( $user->user_login );
		$dados_profissionais = $SAV->get_dados_profissionais( $user->user_login );

		?>
			<?php if( $SAV->is_pessoa_juridica( $user->user_login ) ) : ?>
				<h3>Dados Empresariais</h3>

				<table class="form-table">

					<tr>
						<th><label for="cnpj">CNPJ</label></th>
						<td>
							<input type="text" name="cnpj" id="cnpj" value="<?php print $dados_empresa[ 'login' ]; ?>" disabled="disabled" /><br />
							<span class="description"></span>
						</td>
					</tr>

					<tr>
						<th><label for="display_name">Razão Social</label></th>
						<td>
							<input type="text" name="nome" id="nome" value="<?php print $dados_empresa[ 'nome' ]; ?>" class="regular-text" disabled="disabled" /><br />
							<span class="description"></span>
						</td>
					</tr>

					<tr>
						<th><label for="cpf_representante">CPF do Representante <span class="description">(obrigatório)</span></label></th>
						<td>
							<input type="text" name="cpf_representante" id="cpf_representante" value="<?php print $dados_empresa[ 'cpf_representante' ]; ?>" /><br />
							<span class="description"></span>
						</td>
					</tr>

					<tr>
						<th><label for="nome_representante">Nome do Representante <span class="description">(obrigatório)</span></label></th>
						<td>
							<input type="text" name="nome_representante" id="nome_representante" value="<?php print $dados_empresa[ 'nome_representante' ]; ?>" class="regular-text" /><br />
							<span class="description"></span>
						</td>
					</tr>

					<tr>
						<th><label for="ra">Registro ANCINE <span class="description">(obrigatório)</span></label></th>
						<td>
							<input type="text" name="ra" id="ra" value="<?php print $dados_empresa[ 'ra' ]; ?>" /><br />
							<span class="description"></span>
						</td>
					</tr>

				</table>
			<?php endif; ?>

			<?php if( $SAV->is_pessoa_fisica( $user->user_login ) ) : ?>
				<h3>Dados Pessoais</h3>

				<table class="form-table">

					<tr>
						<th><label for="cpf">CPF</label></th>
						<td>
							<input type="text" name="cpf" id="cpf" value="<?php print $dados_pessoais[ 'login' ]; ?>" disabled="disabled" /><br />
							<span class="description">não pode ser alterado</span>
						</td>
					</tr>

					<tr>
						<th><label for="display_name">Nome</label></th>
						<td>
							<input type="text" name="nome" id="nome" value="<?php print $dados_pessoais[ 'nome' ]; ?>" class="regular-text" disabled="disabled" /><br />
							<span class="description">o mesmo do cadastro</span>
						</td>
					</tr>

					<?php /* ?>
					<tr>
						<th><label for="nascimento">Nascimento</label></th>
						<td>
							<input type="text" name="nascimento" id="nascimento" value="<?php print $dados_pessoais[ 'nascimento' ]; ?>" /><br />
							<span class="description"></span>
						</td>
					</tr>
					<?php */ ?>

					<tr>
						<th><label for="nacionalidade">Nacionalidade</label></th>
						<td>
							<input type="text" name="nacionalidade" id="nacionalidade" value="<?php print $dados_pessoais[ 'nacionalidade' ]; ?>" class="regular-text" /><br />
							<span class="description"></span>
						</td>
					</tr>

					<tr>
						<th><label for="naturalidade">Naturalidade</label></th>
						<td>
							<input type="text" name="naturalidade" id="naturalidade" value="<?php print $dados_pessoais[ 'naturalidade' ]; ?>" class="regular-text" /><br />
							<span class="description"></span>
						</td>
					</tr>

					<tr>
						<th><label for="rg">Registro Geral <span class="description">(obrigatório)</span></label></th>
						<td>
							<input type="text" name="rg" id="rg" value="<?php print $dados_pessoais[ 'rg' ]; ?>" /><br />
							<span class="description"></span>
						</td>
					</tr>

				</table>
			<?php endif; ?>

			<h3>Dados para Contato</h3>

			<table class="form-table">

				<tr>
					<th><label for="email">E-mail</label></th>
					<td>
						<input type="text" name="email" value="<?php print $dados_contato[ 'email' ]; ?>" class="regular-text" disabled="disabled" /><br />
						<span class="description">o mesmo do cadastro</span>
					</td>
				</tr>

				<tr>
					<th><label for="url">Site</label></th>
					<td>
						<input type="text" name="site" id="site" value="<?php print $dados_contato[ 'site' ]; ?>" class="regular-text" disabled="disabled" /><br />
						<span class="description">o mesmo do cadastro</span>
					</td>
				</tr>

				<tr>
					<th><label for="telefone">Telefone <span class="description">(obrigatório)</span></label></th>
					<td>
						<!--<input type="text" name="ddi_telefone" id="ddi_telefone" value="<?php print $dados_contato[ 'ddi_telefone' ]; ?>" class="small-text" />-->
						<input type="text" name="ddd_telefone" id="ddd_telefone" value="<?php print $dados_contato[ 'ddd_telefone' ]; ?>" class="small-text" />
						<input type="text" name="telefone" id="telefone" value="<?php print $dados_contato[ 'telefone' ]; ?>" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="celular">Celular</label></th>
					<td>
						<!--<input type="text" name="ddi_celular" id="ddi_celular" value="<?php print $dados_contato[ 'ddi_celular' ]; ?>" class="small-text" />-->
						<input type="text" name="ddd_celular" id="ddd_celular" value="<?php print $dados_contato[ 'ddd_celular' ]; ?>" class="small-text" />
						<input type="text" name="celular" id="celular" value="<?php print $dados_contato[ 'celular' ]; ?>" /><br />
						<span class="description"></span>
					</td>
				</tr>

			</table>

			<h3>Dados para Localização</h3>

			<table class="form-table">

				<tr>
					<th><label for="pais">País</label></th>
					<td>
						<input type="text" name="pais" id="pais" value="<?php print $dados_geograficos[ 'pais' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="estado">Estado <span class="description">(obrigatório)</span></label></th>
					<td>
						<input type="text" name="estado" id="estado" value="<?php print $dados_geograficos[ 'estado' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="cidade">Cidade <span class="description">(obrigatório)</span></label></th>
					<td>
						<input type="text" name="cidade" id="cidade" value="<?php print $dados_geograficos[ 'cidade' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="e-mail">Bairro <span class="description">(obrigatório)</span></label></th>
					<td>
						<input type="text" name="bairro" id="bairro" value="<?php print $dados_geograficos[ 'bairro' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="endereco">Endereço <span class="description">(obrigatório)</span></label></th>
					<td>
						<input type="text" name="endereco" id="endereco" value="<?php print $dados_geograficos[ 'endereco' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="cep">CEP <span class="description">(obrigatório)</span></label></th>
					<td>
						<input type="text" name="cep" id="cep" value="<?php print $dados_geograficos[ 'cep' ]; ?>" /><br />
						<span class="description"></span>
					</td>
				</tr>

			</table>

			<?php /* ?>
			<h3>Dados Profissionais</h3>

			<table class="form-table">

				<tr>
					<th><label for="formacao">Formação</label></th>
					<td>
						<input type="text" name="formacao" id="formacao" value="<?php print $dados_profissionais[ 'formacao' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="ocupacao">Área de Atuação</label></th>
					<td>
						<input type="text" name="ocupacao" id="ocupacao" value="<?php print $dados_profissionais[ 'ocupacao' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="interesse">Área de Interesse</label></th>
					<td>
						<input type="text" name="interesse" id="interesse" value="<?php print $dados_profissionais[ 'interesse' ]; ?>" class="regular-text" /><br />
						<span class="description"></span>
					</td>
				</tr>

				<tr>
					<th><label for="biografia">Biografia</label></th>
					<td>
						<textarea name="biografia" id="biografia" rows="5" cols="30"><?php print $dados_profissionais[ 'biografia' ]; ?></textarea><br />
						<span class="description"></span>
					</td>
				</tr>

			</table>
			<?php */ ?>
		<?php
	}

	/**
	 * salvar dados do perfil sav
	 *
	 * @name    salvar_perfil_sav
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-12-29
	 * @updated 2012-02-28
	 * @return  bool
	 */
	function salvar_perfil_sav( $user_id )
	{
		global $wpdb, $SAV, $user_login;

		$user = get_userdata( $user_id );

		if( $user_login !== $user->user_login )
			return false;

		$Validator = new Validator();

		// validate data
		if( $SAV->is_pessoa_fisica( $user->user_login ) )
		{
			$dados_pessoais[ 'login' ]             = $user->user_login;
			$dados_pessoais[ 'nome' ]              = "{$user->first_name} {$user->last_name}";
			$dados_pessoais[ 'rg' ]                = $Validator->validate( $_POST[ 'rg' ],                 'RG',            'required=1&max_length=15' );
			//$dados_pessoais[ 'nascimento' ]        = $Validator->validate( $_POST[ 'nascimento' ],         'Nascimento',    'required=1&max_length=100' );
			$dados_pessoais[ 'naturalidade' ]      = $Validator->validate( $_POST[ 'naturalidade' ],       'Naturalidade',  'required=0&max_length=100' );
			$dados_pessoais[ 'nacionalidade' ]     = $Validator->validate( $_POST[ 'nacionalidade' ],      'Nacionalidade', 'required=0&max_length=100' );

			$nicename = sanitize_title( $dados_pessoais[ 'nome' ] );
		}

		if( $SAV->is_pessoa_juridica( $user->user_login ) )
		{
			$dados_empresa[ 'login' ]              = $user->user_login;
			$dados_empresa[ 'nome' ]               = $user->display_name;
			$dados_empresa[ 'ra' ]                 = $Validator->validate( $_POST[ 'ra' ],                 'Registro Ancine',      'required=1&max_length=15' );
			$dados_empresa[ 'cpf_representante' ]  = $Validator->validate( $_POST[ 'cpf_representante' ],  'CPF do Representante', 'required=1&cpf=1' );
			$dados_empresa[ 'nome_representante' ] = $Validator->validate( $_POST[ 'nome_representante' ], 'Representante Legal',  'required=1&max_length=100' );

			$nicename = sanitize_title( $dados_empresa[ 'nome' ] );
		}

		$dados_contato[ 'login' ]                = $user->user_login;
		$dados_contato[ 'email' ]                = $user->user_email;
		$dados_contato[ 'site' ]                 = $user->user_url;
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
		$dados_geograficos[ 'pais' ]             = $Validator->validate( $_POST[ 'pais' ],               'País',                 'required=0&max_length=100' );

		//$dados_profissionais[ 'login' ]          = $user->user_login;
		//$dados_profissionais[ 'formacao' ]       = $Validator->validate( $_POST[ 'formacao' ],           'Formação',             'required=0&max_length=100' );
		//$dados_profissionais[ 'ocupacao' ]       = $Validator->validate( $_POST[ 'ocupacao' ],           'Ocupação',             'required=0&max_length=100' );
		//$dados_profissionais[ 'interesse' ]      = $Validator->validate( $_POST[ 'interesse' ],          'Interesse',            'required=0&max_length=100' );
		//$dados_profissionais[ 'biografia' ]      = $Validator->validate( $_POST[ 'biografia' ],          'Biografia',            'required=0&max_length=100' );

		$SAV->error = $Validator->error();

		// check if the fields are correctly filled
		if( empty( $SAV->error ) )
		{
			// update user_nicename
			$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->users} SET user_nicename = %s WHERE ID = %d LIMIT 1", $nicename, $user_id ) );

			if( $SAV->is_pessoa_fisica( $user->user_login ) )
				$SAV->update_dados_pessoais( $dados_pessoais );

			if( $SAV->is_pessoa_juridica( $user->user_login ) )
				$SAV->update_dados_empresa( $dados_empresa );

			$SAV->update_dados_contato( $dados_contato );
			$SAV->update_dados_geograficos( $dados_geograficos );
			//$SAV->update_dados_profissionais( $dados_profissionais );
		}
	}

	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////
	/**
	 * @name    SAV_Proponentes
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2012-02-14
	 * @return  void
	 */
	function SAV_Proponentes()
	{
		// shortcodes
		add_shortcode( 'formulario_direcionar_cadastro', array( &$this, 'formulario_direcionar_cadastro' ) );
		add_shortcode( 'formulario_pessoa_fisica', array( &$this, 'formulario_pessoa_fisica' ) );
		add_shortcode( 'formulario_pessoa_juridica', array( &$this, 'formulario_pessoa_juridica' ) );


		// cadastro pessoa fisica
		add_action( 'init', array( &$this, 'direcionar_cadastro' ) );
		add_action( 'init', array( &$this, 'cadastro_pessoa_fisica' ) );
		add_action( 'init', array( &$this, 'cadastro_pessoa_juridica' ) );


		// mostrar campos no perfil
		//add_action( 'show_user_profile', array( &$this, 'mostrar_perfil_sav' ) );
		//add_action( 'edit_user_profile', array( &$this, 'mostrar_perfil_sav' ) );

		// salvar os campos do perfil
		//add_action( 'profile_update', array( &$this, 'salvar_perfil_sav' ) );
	}

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

$SAV_Proponentes = new SAV_Proponentes();

?>