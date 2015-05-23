<?php

	function buscar_consultores_ajax(){
		global $SAV, $wpdb, $user_login;

		//get data from our ajax() call
		$id_edital= $_POST['id_edital'];

		$consultores = $SAV->get_consultores_edital( $id_edital );

		$results =  "<option value=''>Todos</option>";

		foreach( $consultores as $consultor ) {
			$results .=  "<option value='" . $consultor->ID . "'> " . strtoupper( $consultor->display_name ) . " </option>";
		}

		die($results);
	}

	// create custom Ajax call for WordPress
	add_action( 'wp_ajax_nopriv_buscar_consultores_ajax', 'buscar_consultores_ajax' );
	add_action( 'wp_ajax_buscar_consultores_ajax', 'buscar_consultores_ajax' );


?>