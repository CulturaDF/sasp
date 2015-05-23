jQuery( function() {

	// ATRIBUTES ////////////////////////////////////////////////////////////////////////////////////
	var item        = 0;
	var experiencia = 0;

	// METHODS //////////////////////////////////////////////////////////////////////////////////////
	/**
	 * mostrar/ocultar compo de upload quando o arquivo já tiver sido informado
	 *
	 * @name    mb_strlen
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-31
	 * @updated 2011-31-31
	 * @return  void
	 */
	function mb_strlen( str )
	{
		var len = 0;

		for( var i = 0; i < str.length; i++ ) {
			len += str.charCodeAt( i ) < 0 || str.charCodeAt( i ) > 255 ? 2 : 1;
		}

		return len;
	}

	/**
	 * mostrar/ocultar compo de upload quando o arquivo já tiver sido informado
	 *
	 * @name    show_hide
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-23
	 * @updated 2011-08-31
	 * @return  void
	 */
	function show_hide()
	{
		jQuery( '#sav-editais .show-hide' ).each( function() {
			if( 'checked' == jQuery( this ).attr( 'checked' ) )
				jQuery( '#' + jQuery( this ).val() ).fadeOut();
			else
				jQuery( '#' + jQuery( this ).val() ).fadeIn();
		} );
	}

	/**
	 * ocultar/mostrar compo de upload quando o arquivo já tiver sido informado
	 *
	 * @name    hide_show
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-08-31
	 * @updated 2011-09-01
	 * @return  void
	 */
	function hide_show()
	{
		jQuery( '#sav-editais .hide-show' ).each( function() {
			if( 'checked' == jQuery( this ).attr( 'checked' ) )
				jQuery( '#' + jQuery( this ).val() ).fadeIn();
			else
				jQuery( '#' + jQuery( this ).val() ).fadeOut();
		} );
	}

	/**
	 * converte do modelo de moeda (R$) para mysql
	 *
	 * @name    moeda_para_mysql
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-13
	 * @updated 2011-12-27
	 * @return  String
	 */
	function moeda_para_mysql( valor )
	{
		if( !valor )
			valor = '0';

		valor = valor.replace( /\./g, '' );
		valor = valor.replace( /\,/g, '.' );
		valor = parseFloat( valor );
		valor = valor.toFixed( 2 );

		if( isNaN( valor ) )
			valor = 0;

		return valor;
	}

	/**
	 * converte do modelo de mysql para moeda (R$)
	 *
	 * @name    mysql_para_moeda
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-13
	 * @updated 2011-12-27
	 * @return  String
	 */
	function mysql_para_moeda( valor )
	{
		if( isNaN( valor ) )
			valor = 0;

		valor = parseFloat( valor );
		valor = valor.toFixed( 2 );
		valor = valor.replace( /\./g, ',' );

		return valor;
	}

	/**
	 * adicionar experiencia
	 *
	 * @name    item_experiencia
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-02
	 * @updated 2011-12-26
	 * @return  void
	 */
	function item_experiencia( count )
	{
		var odd;

		if( 0 == ( count % 2 ) )
			odd = 'odd';

		output = '<table width="100%" cellspacing="15px" id="experiencia_' + count + '" class="experiencia ' + odd + '">'
					 + '<tr valign="top">'
					 + '<td colspan="2">'
					 + '<label for="experiencia_titulo_' + count + '">Título da Obra *</label>'
					 + '<input type="text" id="experiencia_titulo_' + count + '" name="experiencias[' + count + '][titulo]" maxlength="100" tabindex="' + count + '0" class="large" />'
					 + '</td>'
					 + '<td>'
					 + '<label for="experiencia_duracao_' + count + '">Duração (min) *</label>'
					 + '<input type="text" id="experiencia_duracao_' + count + '" name="experiencias[' + count + '][duracao]" maxlength="3" size="10" tabindex="' + count + '1" />'
					 + '</td>'
					 + '<td width="40%">'
					 + '<label for="experiencia_comprovante_' + count + '">Comprovante da Obra *</label>'
					 + '<input type="file" id="experiencia_comprovante_' + count + '" name="experiencia_comprovante_' + count + '" tabindex="' + count + '2" /><br />'
					 + '<small>apenas arquivos no formato .pdf com no máximo 1MB</small>'
					 + '</td>'
					 + '</tr>'
					 + '<tr valign="top">'
					 + '<td colspan="3">'
					 + '<select id="experiencia_funcao' + count + '" name="experiencias[' + count + '][funcao]" tabindex="' + count + '3">'
					 + '<option value="">Função</option>'
					 + '<option value="Artista">Artista</option>'
					 + '<option value="Assitente de Direção">Assistente de Direção</option>'
					 + '<option value="Assitente de Produção">Assitente de Produção</option>'
					 + '<option value="Diretor">Diretor</option>'
					 + '<option value="Diretor de Produção">Diretor de Produção</option>'
					 + '<option value="Intervalação">Intervalação</option>'
					 + '<option value="Produtor">Produtor</option>'
					 + '<option value="Produtor Executivo">Produtor Executivo</option>'
					 + '<option value="StoryBoard">StoryBoard</option>'
					 + '<option value="Roteirista">Roteirista</option>'
					 + '<option value="Outros">Outros</option>'
					 + '</select> * '
					 + '<select id="experiencia_ano_' + count + '" name="experiencias[' + count + '][ano]" tabindex="' + count + '4">'
					 + '<option value="">Ano</option>'
					 + '<option value="2011">2011</option>'
					 + '<option value="2010">2010</option>'
					 + '<option value="2009">2009</option>'
					 + '<option value="2008">2008</option>'
					 + '<option value="2007">2007</option>'
					 + '<option value="2006">2006</option>'
					 + '<option value="2005">2005</option>'
					 + '<option value="2004">2004</option>'
					 + '<option value="2003">2003</option>'
					 + '<option value="2002">2002</option>'
					 + '<option value="2001">2001</option>'
					 + '<option value="2000">2000</option>'
					 + '<option value="1999">1999</option>'
					 + '<option value="1998">1998</option>'
					 + '<option value="1997">1997</option>'
					 + '<option value="1996">1996</option>'
					 + '<option value="1995">1995</option>'
					 + '<option value="1994">1994</option>'
					 + '<option value="1993">1993</option>'
					 + '<option value="1992">1992</option>'
					 + '<option value="1991">1991</option>'
					 + '<option value="1990">1990</option>'
					 + '<option value="1900">Anterior</option>'
					 + '</select> * '
					 + '<select id="experiencia_suporte_finalizacao_' + count + '" name="experiencias[' + count + '][suporte_finalizacao]" tabindex="' + count + '5">'
					 + '<option value="">Suporte Finalização</option>'
					 + '<option value="2k">2k</option>'
					 + '<option value="4k">4k</option>'
					 + '<option value="16 mm">16 mm</option>'
					 + '<option value="35 mm">35 mm</option>'
					 + '<option value="HDCAM">HDCAM</option>'
					 + '<option value="HDCAM SR">HDCAM SR</option>'
					 + '<option value="XDCAM">XDCAM</option>'
					 + '<option value="XDCAM EX">XDCAM EX</option>'
					 + '<option value="DVCPRO HD">DVCPRO</option>'
					 + '<option value="HDV">HDV</option>'
					 + '<option value="Beta Cam">Beta Cam</option>'
					 + '<option value="Beta Digital">Beta Digital</option>'
					 + '<option value="Outros">Outros</option>'
					 + '</select> * '
					 + '</td>'
					 + '<td valign="bottom" align="right">'
					 + '<span class="trash"><a href="#remover-obra" title="remover obra" class="remover-obra">remover obra</a></span>'
					 + '</td>'
					 + '</tr>'
					 + '</table>';

		return output;
	}

	/**
	 * item criterio
	 *
	 * @name    item_criterio
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-06
	 * @updated 2012-02-06
	 * @return  void
	 */
	function item_criterio( count )
	{
		output =  '<tr class="criterio">'
				+ '<td>'
				+ '<input type="text" id="criterio_' + count + '" name="criterios[' + count + '][descricao]" value="" maxlength="100" size="40" />'
				+ '</td>'
				+ '<td align="center">'
				+ '<input type="radio" name="criterio_desempate_1" value="" />'
				+ '</td>'
				+ '<td align="center">'
				+ '<input type="radio" name="criterio_desempate_2" value="" />'
				+ '</td>'
				+ '<td valign="bottom" align="right">'
				+ '<span class="trash"><a href="#remover-criterio" title="remover critério" class="remover-criterio">remover criterio</a></span>'
				+ '</td>'
				+ '</tr>';
		return output;
	}

	/**
	 * item consultor
	 *
	 * @name    item_consultor
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-06
	 * @updated 2012-02-06
	 * @return  void
	 */
	function item_consultor( count_consultor, avaliacao_por_grupo )
	{
		output = '<tr class="consultor">'
				+ '<td>'
				+ '<label for="consultor_' + count_consultor + '">Consultor </label>'
				+ '<input type="text" id="consultor_' + count_consultor + '" name="comissao[' + count_consultor + '][consultor]" value="" maxlength="11" size="15" class="large" />'
				+ '</td>';
		if ( avaliacao_por_grupo == 'checked' )
		{
			output += '<td>'
					+ '<label for="consultor_' + count_consultor + '">Grupo</label>'
					+ '<select name="comissao['+ count_consultor + '][grupo]">'
					+ '<option value="">selecione</option>'
					+ '<option value="1">1</option>'
					+ '<option value="2">2</option>'
					+ '<option value="3">3</option>'
					+ '</select>'
					+ '</td>';
		}
		output +='<td valign="bottom" align="right">'
				+ '<span class="trash"><a href="#remover-consultor" title="remover consultor" class="remover-consultor">remover consultor</a></span>'
				+ '</td>'
				+ '</tr>';
		return output;
	}

	/**
	 * adicionar item de orcamento
	 *
	 * @name    item_orcamento
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-02
	 * @updated 2011-10-31
	 * @return  void
	 */
	function item_orcamento( count, etapa, area )
	{
		var odd;

		if( 0 == ( count % 2 ) )
			odd = 'odd';

		output =  '<input type="hidden" name="orcamentos[' + count + '][etapa]" value="' + etapa + '" />'
					 + '<input type="hidden" name="orcamentos[' + count + '][area]" value="' + area + '" />'
					 + '<div class="item">'
					 + '<table width="100%" cellspacing="15px" id="orcamento_' + count + '" class="' + odd + '">'
					 + '<tr valign="top">'
					 + '<td>'
					 + '<label for="orcamento_item_' + count + '">Item *</label>'
					 + '<input type="text" id="orcamento_item_' + count + '" class="orcamento_item" name="orcamentos[' + count + '][item]" maxlength="100" tabindex="' + count + '0" class="large" />'
					 + '</td>'
					 + '<td>'
					 + '<label for="orcamento_quantidade_' + count + '">Quantidade *</label>'
					 + '<input type="text" id="orcamento_quantidade_' + count + '" class="orcamento_quantidade" name="orcamentos[' + count + '][quantidade]" maxlength="10" size="10" tabindex="' + count + '1" />'
					 + '</td>'
					 + '<td>'
					 + '<label for="orcamento_unidade_' + count + '">Unidade *</label>'
					 + '<input type="text" id="orcamento_unidade_' + count + '" class="orcamento_unidade" name="orcamentos[' + count + '][unidade]" maxlength="45" size="10" tabindex="' + count + '2" />'
					 + '</td>'
					 + '<td>'
					 + '<label for="orcamento_valor_unitario_' + count + '">Valor Unitário (R$) *</label>'
					 + '<input type="text" id="orcamento_valor_unitario_' + count + '" class="orcamento_valor_unitario" name="orcamentos[' + count + '][valor_unitario]" maxlength="10" size="10" tabindex="' + count + '3" />'
					 + '</td>'
					 + '<td align="right">'
					 + '<label for="orcamento_valor_total_' + count + '">Valor Total (R$) *</label>'
					 + '<input type="text" id="orcamento_valor_total_' + count + '" class="orcamento_valor_total" name="orcamentos[' + count + '][valor_total]" maxlength="10" size="10" tabindex="' + count + '4" readonly="readonly" />'
					 + '</td>'
					 + '</tr>'
					 + '<tr>'
					 + '<td colspan="5" valign="bottom" align="right">'
					 + '<span class="trash"><a href="#remover-item" title="remover item" class="remover-item">remover item</a></span>'
					 + '</td>'
					 + '</tr>'
					 + '</table>'
					 + '</div>';

		return output;
	}

	/**
	 * calcular o orcamento
	 *
	 * @name    calcular_orcamento
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-09-14
	 * @updated 2011-12-20
	 * @return  void
	 */
	function calcular_orcamento()
	{
		var quantidade                    = 0;
		var valor_unitario                = 0;
		var valor_total                   = 0;
		var area_total                    = 0;
		var etapa_subtotal                = 0;
		var etapa_total                   = 0;
		var tributos                      = 0;
		var projeto_total                 = 0;
		var concurso_total                = 0;
		var valor_recursos_complementares = 0;
		var valor_contrapartida           = 0;
		var limite_projeto                = 0;
		var limite_contrapartida          = 0;

		// calcula o total de cada etapa
		jQuery( '#sav-editais .etapa' ).each( function() {
			etapa_subtotal = 0;
			etapa_total    = 0;
			tributos       = 0;

			// calcula o total de cada area
			jQuery( this ).find( '.area' ).each( function() {
				area_total = 0;

				// calcula o total de cada item
				jQuery( this ).find( '.item' ).each( function() {
					quantidade      = parseInt( jQuery( this ).find( '.orcamento_quantidade' ).val() );
					valor_unitario  = moeda_para_mysql( jQuery( this ).find( '.orcamento_valor_unitario' ).val() );

					if( isNaN( quantidade ) )
						quantidade = 0;

					valor_total     = eval( quantidade * valor_unitario );

					area_total += eval( valor_total );

					// preencher campos
					jQuery( this ).find( '.orcamento_quantidade' ).val( quantidade );
					jQuery( this ).find( '.orcamento_valor_unitario' ).val( mysql_para_moeda( valor_unitario ) );
					jQuery( this ).find( '.orcamento_valor_total' ).val( mysql_para_moeda( valor_total ) );
				} );

				etapa_subtotal += eval( area_total );

				// preencher campos
				jQuery( this ).find( '.area_total' ).val( mysql_para_moeda( area_total ) );
			} );

			tributos = moeda_para_mysql( jQuery( this ).find( '.etapa_tributos' ).val() );

			etapa_total += eval( etapa_subtotal );
			etapa_total += eval( tributos );

			projeto_total += etapa_total;


			// preencher campos
			jQuery( this ).find( '.etapa_subtotal' ).val( mysql_para_moeda( etapa_subtotal ) );
			jQuery( this ).find( '.etapa_tributos' ).val( mysql_para_moeda( tributos ) );
			jQuery( this ).find( '.etapa_total' ).val( mysql_para_moeda( etapa_total ) );
		} );

		valor_contrapartida = moeda_para_mysql( jQuery( '#contra_total' ).val() );
		valor_recursos_complementares = moeda_para_mysql( jQuery( '#sav-editais .orcamento_recurso_complementar' ).val() );

		limite_projeto = moeda_para_mysql( jQuery( '#limite_projeto' ).html() );
		//limite_contrapartida = (projeto_total - valor_contrapartida )* 0.2;
		limite_contrapartida = ( projeto_total - valor_contrapartida )* 0.25;

		projeto_total += eval( valor_recursos_complementares );

		concurso_total += eval( projeto_total );
		concurso_total -= eval( valor_contrapartida );
		concurso_total -= eval( valor_recursos_complementares );

		jQuery( '#pre_producao_total' ).val( jQuery( '#pre_total' ).val() );
		jQuery( '#producao_total' ).val( jQuery( '#pro_total' ).val() );
		jQuery( '#pos_producao_total' ).val( jQuery( '#pos_total' ).val() );

		jQuery( '#sav-editais .projeto_total' ).val( mysql_para_moeda( projeto_total ) );

		jQuery( '#sav-editais .contrapartida_total' ).val( jQuery( '#contra_total' ).val() );

		jQuery( '#limite_contrapartida' ).html( mysql_para_moeda( limite_contrapartida ) );

		jQuery( '#sav-editais .orcamento_recurso_complementar, #sav-editais .recurso_complementar' ).val( mysql_para_moeda( valor_recursos_complementares ) );

		jQuery( '#sav-editais .concurso_total' ).val( mysql_para_moeda( concurso_total ) );

		if( projeto_total > limite_projeto )
			jQuery( '#sav-editais .projeto_total' ).addClass( 'problema' );
		else
			jQuery( '#sav-editais .projeto_total' ).removeClass( 'problema' );

		if( valor_contrapartida < limite_contrapartida )
			jQuery( '#sav-editais .contrapartida_total' ).addClass( 'problema' );
		else
			jQuery( '#sav-editais .contrapartida_total' ).removeClass( 'problema' );
	}

	/**
	 * calcular a nota final da avaliacao do consultor
	 *
	 * @name    calcula_nota_final
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2012-02-14
	 * @updated 2012-02-14
	 * @return  void
	 */
	function calcular_nota_final(){

		var valor_unitario	= 0;
		var valor_total    	= 0;
		var valor_minimo 	= 0;
		var valor_maximo	= 0;
		var i 				= 0;

		// calcula a nota de cada criterio
		jQuery( '#sav-editais' ).find( '.criterio' ).each( function(e) {
			valor_unitario  = moeda_para_mysql( jQuery( this ).find( '.nota_consultor' ).val() );

			//contador
			i++;

			// mostra mensagem caso o usuário coloque uma nota maior que 10
			if( valor_unitario > 10 ) {
				jQuery( 'tr' ).remove('.erro_nota_' + e);
				jQuery( this ).after('<tr class="erro_nota_' + e + '"><td colspan="3" align="center" style="color:#cc0000; width: 300px;"><strong>A nota não pode ser maior que 10</strong></td></tr>');
				jQuery( this ).find( '.nota_consultor' ).val('');
				jQuery( this ).find( '.nota_consultor' ).focus();
			}else
			{
				jQuery( 'tr' ).remove('.erro_nota_' + e);
			}

			valor_total += eval ( valor_unitario );

		} );

		valor_maximo = eval( i * 10 );
		valor_minimo = eval( valor_maximo * 0.7 );

		// verifica se o valor total é maior que 70% do máximo de pontos possíveis
		if ( valor_total < valor_minimo && valor_total != 0) {
			jQuery( 'tr' ).remove('.pontuacao_minima');
			jQuery( '.criterios' ).find( '.nota_final' ).after('<tr class="pontuacao_minima"><td colspan="3" align="center" style="color:#CC992B; width: 100%;"><strong>Esta proposta não atingiu a pontuação mínima na sua avaliação.</strong></td></tr>' );
		}else
		{
			jQuery( 'tr' ).remove('.pontuacao_minima');
		}
		// preenche o campo
		jQuery( '#sav-editais' ).find( '.nota_final' ).val( mysql_para_moeda( valor_total ) );
	}

	/**
	 * controla opções do relatório
	 *
	 * @name    controlar_formulario_relatorio
	 * @author  Cleber Santos <cleber.santos@cultura.gov.br>
	 * @since   2013-03-15
	 * @updated 2013-03-15
	 * @return  void
	 */
	function controlar_formulario_relatorio(){
		// desativa inicialmente os campos
		jQuery('#grupo').attr('disabled','disabled');
		jQuery('#consultor').attr('disabled','disabled');

		// qualquer ação que tiver no select
		jQuery("select").change(function(e) {

			// se não selecionar edital manter desativado
			if( jQuery("#edital option:selected").val()=='' ) {
				jQuery('#consultor').attr('disabled','disabled');
			}else {
				jQuery('#consultor').removeAttr('disabled');
			}

			// se o edital for por grupo ativar a seleção de grupo
			if( jQuery("select option:selected").hasClass('is_group') )
				jQuery('#grupo').removeAttr('disabled');
			else
				jQuery('#grupo').attr('disabled','disabled');

		});

	}


	// CONSTRUCTOR //////////////////////////////////////////////////////////////////////////////////
	show_hide();
	hide_show();
	calcular_orcamento();
	calcular_nota_final();
	controlar_formulario_relatorio();

	// filtra o campo de upload sempre que o checkbox for alterado
	jQuery( '#sav-editais .show-hide' ).change( function() {
		show_hide();
	} );

	// filtra o campo de orcamento sempre que o checkbox for alterado
	jQuery( '#sav-editais .hide-show' ).change( function() {
		hide_show();
	} );


	// mostra os critérios de avaliação
	jQuery( '#sav-editais .adicionar-criterio' ).live( 'click', function() {
		count = jQuery( 'input[ name = count ]' ).val();

		count = ++count;

		//jQuery( this ).parents( '.area' ).children( '.criterios' ).append( item_criterio( count ) );
		jQuery( '.criterio' ).parent().append( item_criterio( count ) );

		jQuery( 'input[ name = count ]' ).val( count );


		return false;
	} );

	// remove os os critérios de avaliação
	jQuery( '#sav-editais .remover-criterio' ).live( 'click', function() {

		jQuery( this ).parents( '.criterio' ).remove();
		return false;
	} );

	// mostra consultor da comissão de seleção
	jQuery( '#sav-editais .adicionar-consultor' ).live( 'click', function() {
		count_consultor = jQuery( 'input[ name = count_consultor ]' ).val();
		avaliacao_por_grupo = jQuery( 'input[ name = avaliacao_por_grupo ]' ).attr('checked');

		count_consultor = ++count_consultor;

		//jQuery( this ).parents( '.area' ).children( '.comissao' ).children('.consultor').append( item_consultor( count_consultor , avaliacao_por_grupo) );

		jQuery( '.comissao' ).append( item_consultor( count_consultor , avaliacao_por_grupo) );

		jQuery( 'input[ name = count_consultor ]' ).val( count_consultor );

		return false;
	} );

	// remove os os critérios de avaliação
	jQuery( '#sav-editais .remover-consultor' ).live( 'click', function() {

		jQuery( this ).parents( '.consultor' ).remove();
		return false;
	} );

	// atualiza a nota final
	jQuery( '#sav-editais .nota_consultor' ).live( 'blur', function() {
		calcular_nota_final();
	} );

	jQuery( 'select#natureza' ).change( function() {
		var valor = jQuery(this).val();

		if(valor == 1 | valor == 2 )
			jQuery( '.convenio').fadeIn();
		else
			jQuery( '.convenio' ).fadeOut();

	});

	// mostra os registros de experiencia
	jQuery( '#sav-editais .adicionar-obra' ).live( 'click', function() {
		count = jQuery( 'input[ name = count ]' ).val();

		count = ++count;

		jQuery( this ).parents( '.area' ).children( '.experiencias' ).append( item_experiencia( count ) );

		jQuery( 'input[ name = count ]' ).val( count );

		return false;
	} );

	jQuery( '#sav-editais .remover-obra' ).live( 'click', function() {
		jQuery( this ).parents( '.experiencia' ).remove();

		calcular_orcamento();

		return false;
	} );

	// mostra os registros de orçamento
	jQuery( '#sav-editais .adicionar-item' ).live( 'click', function() {
		etapa = jQuery( this ).attr( 'etapa' );
		area  = jQuery( this ).attr( 'area' );
		count = jQuery( 'input[ name = count ]' ).val();

		count = ++count;

		jQuery( this ).parents( '.area' ).find( '.itens' ).append( item_orcamento( count, etapa, area ) );

		jQuery( 'input[ name = count ]' ).val( count );

		return false;
	} );

	jQuery( '#sav-editais .remover-item' ).live( 'click', function() {
		jQuery( this ).parents( '.item' ).remove();

		return false;
	} );

	// atualiza os valores totais de cada item
	jQuery( '#sav-editais .orcamento_valor_unitario, #sav-editais .orcamento_quantidade, #sav-editais .etapa_tributos, #sav-editais .orcamento_recurso_complementar' ).live( 'blur', function() {
		calcular_orcamento();
	} );

	// mostra as mensagens de atualização e erro
	jQuery( '.alert' ).dialog( {
		'dialogClass'   : 'wp-dialog',
		'autoLoad'      : true,
		'modal'         : true,
		'closeOnEscape' : true,
		'width'         : 400,
		'height'        : 200
	} );

	// mostra as caixas de dúvidas
	jQuery( '.duvida' ).click( function() {
		var target = jQuery( this ).attr( 'href' );

		jQuery( target ).dialog( {
			'dialogClass'   : 'wp-dialog',
			'modal'         : true,
			'closeOnEscape' : true,
			'width'         : 400,
			'height'        : 200
		} );

		return false;
	} );

	// limita a quantidade de caracteres
	jQuery( '#sav-editais .limit-chars' ).each( function() {
		var limit       = jQuery( this ).attr( 'maxlength' );
		var text        = jQuery( this ).val();
		var text_length = mb_strlen( text );

		jQuery( this ).after( '<div class="limit-chars-counter">( ' + ( limit - text_length ) + ' )</div>' );

		jQuery( this ).keyup( function() {
			var text        = jQuery( this ).val();
			var text_length = mb_strlen( text );

			if( text_length > limit )
			{
				jQuery( this ).siblings( '.limit-chars-counter' ).html( '(<strong style="color:#ff0;">' + limit + '</strong>)' );
				jQuery( this ).val( text.substr( 0, limit ) );

				return false;
			}
			else
			{
				jQuery( this ).siblings( '.limit-chars-counter' ).html( '( ' + ( limit - text_length ) + ' )' );

				return true;
			}
		} );
	} );

	// atualiza os dados do profissional sempre que o cpf for alterado
	jQuery( '#sav-editais #login_profissional' ).focusout( function() {
		jQuery( 'form#inscricao' ).submit();
	} );

	// adiciona mascara nos campos de data
	jQuery(function($){

		 jQuery('.date').mask('11/11/1111');
		 jQuery('.cep').mask('11111111');
		 jQuery('.cpf').mask('11111111111111');
		 jQuery('.phone').mask('111111111');
	 });


	//var str = "<foo>bar</foo>";
	//alert(str.replace(/<[^>]+>/g, ""));

	// salvar automaticamente a cada cinco minutos
	//setTimeout( "jQuery( 'form.#inscricao' ).submit()", 360000 );

	//jQuery("a").replaceAll("p");
	//$("a[href^='www.cultura']").attr('href', function (i, attr) {
	//	return attr.replace(
	//		/^(w\/site\/)(location)\/([^/]*)\//
	//		, '$1event?$2=$3'
	//	);
	//});


	//jQuery("a").each(function() {
	//
	//	//var text = jQuery(this).text();
	//	alert(jQuery(this).text());
	//	//text = text.replace(/[www]/, /[www2]/);
	//
	//	//jQuery(this).text(text);
	//});

	jQuery("a").each(function() {
		this.setAttribute("href", this.getAttribute("href").replace(/www\.cultura/, "www2\.cultura"));
	});

} );

