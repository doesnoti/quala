<?php
// ************* Remove default Posts type since no blog *************

// Remove side menu
add_action( 'admin_menu', 'quala_remove_posts' );
function quala_remove_posts() {
    remove_menu_page( 'edit.php' );
}

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'quala_remove_posts_menu_bar', 999 );
function quala_remove_posts_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}

// Remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'quala_remove_draft_widget', 999 );
function quala_remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}