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

class Widget_SAV_Editais extends WP_Widget
{
	// ATRIBUTES /////////////////////////////////////////////////////////////////////////////////////

	// METHODS ///////////////////////////////////////////////////////////////////////////////////////
	/**
	 * load widget
	 *
	 * @name    widget
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2011-07-29
	 * @param   array $args - widget structure
	 * @param   array $instance - widget data
	 * @return  void
	 */
	function widget( $args, $instance )
	{
		?>
			<?php print $args[ 'before_widget' ]; ?>
			<?php print $args[ 'before_title' ] . $instance[ 'title' ] . $args[ 'after_title' ]; ?>
			...
			<?php print $args[ 'after_widget' ]; ?>
		<?php
	}

	/**
	 * update data
	 *
	 * @name    update
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2011-07-29
	 * @param   array $new_instance - new values
	 * @param   array $old_instance - old values
	 * @return  array
	 */
	function update( $new_instance, $old_instance )
	{
		return $new_instance;
	}

	/**
	 * widget options form
	 *
	 * @name    form
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2011-07-29
	 * @param   array $instance - widget data
	 * @return  void
	 */
	function form( $instance )
	{
		?>
			<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label>
			<input type="text" id="<?php print $this->get_field_id( 'title' ); ?>" name="<?php print $this->get_field_name( 'title' ); ?>" maxlength="26" value="<?php print $instance[ 'title' ]; ?>" class="widefat" />
			</p>
		<?php
	}

	// CONSTRUCTOR ///////////////////////////////////////////////////////////////////////////////////
	/**
	 * @name    Widget_SAV_Editais
	 * @author  Marcelo Mesquita <marcelo.costa@cultura.gov.br>
	 * @since   2011-07-29
	 * @updated 2011-07-29
	 * @return  void
	 */
	function Widget_SAV_Editais()
	{
		// register widget
		$this->WP_Widget( 'editais', 'SAv Editais' );
	}

	// DESTRUCTOR ////////////////////////////////////////////////////////////////////////////////////

}

// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "Widget_SAV_Editais" );' ) );

?>
