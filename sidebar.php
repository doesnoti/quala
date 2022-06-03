<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quala
 */

if ( ! is_active_sidebar( 'quala_footer_widgets' ) ) {
	return;
}
?>

<div class="footer__links-block">
   <?php dynamic_sidebar( 'quala_footer_widgets' ); ?>
</div>
