<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quala
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<header class="header">
		<div class="wrapper header__wrapper">
			<div class="header__body">
				<svg class="svg logo header__logo" viewBox="0 0 366 307" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="logo__hexagon" d="M280.59 162.901V54.2989L186.947 0L93.2999 54.2989V162.901L186.947 217.2L280.59 162.901Z" fill="#FFC700"/>
					<path class="svg__stroke" d="M184.274 102.077L181.621 112.978C181.605 113.041 181.605 113.106 181.621 113.169L184.273 123.868C184.317 124.047 184.477 124.172 184.661 124.172H189.569C189.751 124.172 189.911 124.048 189.956 123.872L192.707 113.172C192.723 113.108 192.723 113.04 192.707 112.975L189.955 102.073C189.91 101.896 189.751 101.771 189.567 101.771H187.034H184.663C184.478 101.771 184.318 101.897 184.274 102.077Z" stroke="white" stroke-width="3.7"/>
					<path class="svg__stroke" d="M167.271 70.1589L132.192 116.583C132.08 116.732 132.085 116.94 132.206 117.082L147.184 134.858C147.26 134.948 147.372 135 147.49 135H226.505C226.623 135 226.74 134.948 226.816 134.858L241.794 117.083C241.914 116.94 241.919 116.732 241.806 116.583L206.518 70.1579C206.443 70.0584 206.325 70 206.2 70H167.59C167.465 70 167.347 70.0588 167.271 70.1589Z" stroke="white" stroke-width="4" stroke-linecap="round"/>
					<path class="svg__stroke" d="M252.152 70.1822L245.121 94.455C245.069 94.6346 244.9 94.7542 244.713 94.743L234.945 94.1534C234.828 94.1463 234.72 94.0881 234.649 93.9942L214.231 66.7921C214.161 66.6987 214.135 66.5794 214.161 66.4654L216.29 56.8521C216.331 56.669 216.493 56.5386 216.681 56.5386H241.953C242.079 56.5386 242.198 56.5981 242.273 56.6992L252.088 69.8314C252.163 69.9319 252.187 70.0617 252.152 70.1822Z" stroke="white" stroke-width="3.7"/>
					<path class="svg__stroke" d="M122.258 70.1822L129.289 94.455C129.341 94.6346 129.511 94.7542 129.697 94.743L139.465 94.1534C139.582 94.1463 139.69 94.0881 139.761 93.9942L160.179 66.7921C160.249 66.6987 160.275 66.5794 160.25 66.4654L158.12 56.8521C158.079 56.669 157.917 56.5386 157.73 56.5386H132.457C132.331 56.5386 132.212 56.5981 132.137 56.6992L122.322 69.8314C122.247 69.9319 122.223 70.0617 122.258 70.1822Z" stroke="white" stroke-width="3.7"/>
					<path class="svg__stroke" d="M301.429 263.729L325.877 171.001C325.924 170.825 326.083 170.703 326.264 170.703L339.343 170.703C339.525 170.703 339.684 170.825 339.73 171.001L364.161 263.722" stroke="white" stroke-width="3.7" stroke-linecap="round"/>
					<path class="svg__stroke" d="M237.586 170.69V263.319C237.586 263.54 237.765 263.719 237.986 263.719H287.433" stroke="white" stroke-width="3.7" stroke-linecap="round"/>
					<path class="svg__stroke" d="M155.774 263.717L180.222 170.989C180.269 170.814 180.427 170.691 180.609 170.691L193.688 170.691C193.87 170.691 194.028 170.814 194.075 170.989L218.506 263.71" stroke="white" stroke-width="3.7" stroke-linecap="round"/>
					<path class="svg__stroke" d="M96.2909 170.64L86.1915 248.186C86.1791 248.281 86.2012 248.377 86.2538 248.457L96.1658 263.546C96.2397 263.658 96.3654 263.726 96.5001 263.726H132.609C132.744 263.726 132.869 263.658 132.943 263.546L142.865 248.436C142.918 248.356 142.94 248.259 142.927 248.164L132.834 170.68" stroke="white" stroke-width="3.7" stroke-linecap="round"/>
					<path class="svg__stroke" d="M63.9111 245.51L73.7198 264.876" stroke="white" stroke-width="3.7" stroke-linecap="round"/>
					<path class="svg__stroke" d="M61.1187 252.328L56.7571 263.462C56.697 263.615 56.5492 263.716 56.3846 263.716H20.376C20.2115 263.716 20.0638 263.615 20.0037 263.462L1.88554 217.33C1.84864 217.236 1.84863 217.131 1.88553 217.037L19.9923 170.919C20.0524 170.766 20.2001 170.666 20.3646 170.666H56.4042C56.5686 170.666 56.7163 170.766 56.7765 170.919L74.8869 217.032C74.9239 217.126 74.9238 217.231 74.8868 217.325L66.196 239.41" stroke="white" stroke-width="3.7" stroke-linecap="round"/>
				</svg>
				<button class="button transp-button menu-button header__menu-button">
					<span class="h-line"></span>
					<span class="h-line"></span>
					<span class="h-line"></span>
				</button>
				<nav class="nav header__nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location' 	=> 'main-menu',
							'container' 		=> false,
							'depth'				=> 1,
							'menu_class' 		=> 'menu header__menu',
							'add_li_class'		=> 'menu__item',
							'link_class'		=> 'link anchor-link menu__link text text--fz-16'
						)
					);
					?>
				</nav>
				<a href="#contacts" class="link anchor-link button header__button">
					<span class="button-text text--fz-13">Contact Us</span>
				</a>
			</div>
		</div>
	</header>
	<?php require_once 'parts/menu-popup.php'; ?>