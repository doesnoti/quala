<?php
/*
 * Initialise all custom widgets
*/

// register Column_Widget widget
function quala_register_widgets() {
    register_widget( 'Quala_Column_Widget' );
}
add_action( 'widgets_init', 'quala_register_widgets' );