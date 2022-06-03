<div class="popup menu__popup">
	<div class="popup__body menu-popup__body">
		<nav class="nav menu__nav">
			<?php
			wp_nav_menu(
				array(
					'theme_location' 	=> 'main-menu',
					'container' 		=> false,
					'depth'				=> 1,
					'menu_class' 		=> 'menu menu__menu',
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
	<i class="quala-close icon decoration popup__close"></i>
</div>