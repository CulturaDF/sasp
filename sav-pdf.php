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

class SAV_PDF extends FPDF
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////
	var $edital;
	var $proposta;
	var $proponente;
	var $ultima_atualizacao;

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////
	/**
	 * description
	 *
	 * @name    SetProposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-13
	 * @return  void
	 */
	function SetProposta( $proposta )
	{
		$this->proposta = $proposta;
	}

	/**
	 * description
	 *
	 * @name    GetProposta
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-13
	 * @return  void
	 */
	function GetProposta()
	{
		return $this->proposta;
	}

	/**
	 * description
	 *
	 * @name    SetUltimaAtualizacao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-17
	 * @updated 2011-10-17
	 * @return  void
	 */
	function SetUltimaAtualizacao( $data )
	{
		$this->ultima_atualizacao = $data;
	}

	/**
	 * description
	 *
	 * @name    GetUltimaAtualizavao
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-17
	 * @updated 2011-10-17
	 * @return  void
	 */
	function GetUltimaAtualizacao()
	{
		return $this->ultima_atualizacao;
	}

	/**
	 * description
	 *
	 * @name    SetProponente
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-13
	 * @return  void
	 */
	function SetProponente( $proponente )
	{
		$this->proponente = $proponente;
	}

	/**
	 * description
	 *
	 * @name    GetProponente
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-13
	 * @return  void
	 */
	function GetProponente()
	{
		return $this->proponente;
	}

	/**
	 * description
	 *
	 * @name    SetEdital
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-13
	 * @return  void
	 */
	function SetEdital( $edital )
	{
		$this->edital = $edital;
	}

	/**
	 * description
	 *
	 * @name    GetEdital
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-13
	 * @return  void
	 */
	function GetEdital()
	{
		return $this->edital;
	}

	/**
	 * description
	 *
	 * @name    H1
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-14
	 * @return  void
	 */
	function H1( $title, $link = 0 )
	{
		$this->SetFont( 'Arial', 'B', 15 );
		$this->SetTextColor( 50, 100, 150 );

		//$this->Write( 5, utf8_decode( $title ) );
		$this->Cell( 0, 0, utf8_decode( $title ), 0, 0, 'C', 0, $link );

		$this->Ln( 10 );
	}

	/**
	 * description
	 *
	 * @name    H2
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-14
	 * @return  void
	 */
	function H2( $title, $link = 0 )
	{
		$this->SetFont( 'Arial', 'B', 12 );
		$this->SetTextColor( 0, 0, 0 );
		$this->SetFillColor( 245, 245, 245 );

		//$this->Write( 5, utf8_decode( $title ) );
		$this->Cell( 0, 10, utf8_decode( $title ), 0, 0, 'L', 1, $link );

		$this->Ln( 15 );
	}

	/**
	 * description
	 *
	 * @name    H3
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-14
	 * @return  void
	 */
	function H3( $title, $link = 0 )
	{
		$this->SetFont( 'Arial', '', 12 );
		$this->SetTextColor( 0, 0, 0 );

		//$this->Write( 5, utf8_decode( $title ) );
		$this->Cell( 0, 0, utf8_decode( $title ), 0, 0, 'L', 0, $link );

		$this->Ln( 5 );
	}

	/**
	 * description
	 *
	 * @name    h4
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-14
	 * @return  void
	 */
	function H4( $title, $link = 0 )
	{
		$this->SetFont( 'Arial', 'I', 12 );
		$this->SetTextColor( 0, 0, 0 );

		//$this->Write( 5, utf8_decode( $title ) );
		$this->Cell( 0, 0, utf8_decode( $title ), 0, 0, 'L', 0, $link );

		$this->Ln( 5 );
	}

	/**
	 * description
	 *
	 * @name    h5
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-14
	 * @return  void
	 */
	function H5( $title, $link = 0 )
	{
		$this->SetFont( 'Arial', 'B', 10 );
		$this->SetTextColor( 0, 0, 0 );

		//$this->Write( 5, utf8_decode( $title ) );
		$this->Cell( 0, 0, utf8_decode( $title ), 0, 0, 'L', 0, $link );

		$this->Ln( 5 );
	}

	/**
	 * description
	 *
	 * @name    Content
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-10-13
	 * @return  void
	 */
	function Content( $content, $link = 0 )
	{
		$this->SetFont( 'Arial', '', 10 );
		$this->SetTextColor( 0, 0, 0 );
		if( empty($link ) )
			$this->Write( 5, utf8_decode( $content ) );
		else
			$this->Cell( 5, 0, utf8_decode( $content ), 0, 0, 'L', 1, $link );

		$this->Ln( 10 );
	}

	/**
	 * description
	 *
	 * @name    Header
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2012-02-23
	 * @return  void
	 */
	function Header()
	{
    $this->SetY( 15 );

    $this->SetTextColor( 150, 150, 150 );

		$this->SetFont( 'Arial', 'B', 8 );
		$this->Cell( 0, 0, utf8_decode( $this->GetProposta() ), 0, 0, 'L' );

		$this->SetFont( 'Arial', 'i', 8 );
		$this->Cell( 0, 0, utf8_decode( $this->GetUltimaAtualizacao() ), 0, 0, 'R' );

		$this->Ln( 5 );

		$this->SetFont( 'Arial', 'B', 8 );
		$this->Cell( 0, 0, utf8_decode( $this->GetEdital() ), 0, 0, 'L' );

		$this->Ln( 5 );

		$this->SetFont( 'Arial', 'i', 8 );
		$this->Cell( 0, 0, utf8_decode( $this->GetProponente() ), 0, 0, 'L' );

		$this->Ln( 10 );
	}

	/**
	 * description
	 *
	 * @name    Footer
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-10-13
	 * @updated 2011-12-27
	 * @return  void
	 */
	function Footer()
	{
    $this->SetY( -15 );

    $this->SetFont( 'Arial', 'I', 8 );
    $this->SetTextColor( 100, 100, 100 );

		$this->Ln( 10 );

		$this->Cell( 0, 0, $this->PageNo(), 0, 0, 'C' );
		$this->Cell( 0, 0, utf8_decode( 'SAv | Secretaria do Audiovisual - Ministério da Cultura' ), 0, 0, 'R' );
	}

	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

?>
