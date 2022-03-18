<?php 
/**
 * Overide the mobile menu to apple like design
 */
add_action('astra_masthead_toggle_buttons_before', 'overide_mobile_menu');
function overide_mobile_menu() {
	if ( function_exists( 'astra_get_option' ) ) {
		$theme_color = astra_get_option( 'theme-color' );
	}

	if ( empty( $theme_color ) ) {
		$theme_color = '#000000';
	}

	ob_start(); ?>
		<style>
			.ast-header-break-point .ast-button-wrap {
				display: none;
			}
			
			.ast-header-break-point .ast-button-wrap.custom {
				display: inline-block;
			}
			
			.ast-header-break-point .menu-toggle, 
			button,
			button:focus, 
			.menu-toggle:hover, 
			button:hover{
				background-color: transparent;
				border: 0;
			}
			
			.ast-header-break-point .main-header-menu {
				background-color: transparent;
			}

			.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu {
				border-top: 0;
			}
			
			.ast-header-break-point .main-header-bar-navigation {
				display: block !important;
				max-height: 0;
				overflow-y: hidden;

				transition: all 0.5s ease-out, background 1s ease-out;
				transition-delay: 0.2s;
			}
			
			.ast-header-break-point .main-header-bar-navigation.toggle-on {
				max-height: 1000px;
				transition: all 0.5s ease-in, background 0.5s ease-in;
		    	transition-delay: 0.25s;
			}
			
			.ast-header-break-point button.menu-toggle.main-header-menu-toggle {
				-webkit-transform: rotate(0deg);
				transform: rotate(0deg);
				transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
			}
			
			.ast-header-break-point button.menu-toggle.main-header-menu-toggle.toggled {
				-webkit-transform: rotate(90deg);
				transform: rotate(90deg);
			}
			
			.ast-header-break-point div#burger {
				width: 40px;
				height: 10px;
				position: relative;
				display: block;
			}
			
			.ast-header-break-point #burger .bar {
				width: 100%;
				height: 2px;
				display: block;
				position: relative;
				background-color: <?php echo $theme_color; ?>;
				
				transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
		    	transition-delay: 0s;
			}
			
			.ast-header-break-point #burger .bar.topBar {
		    	-webkit-transform: translateY(0px) rotate(0deg);
		    	transform: translateY(0px) rotate(0deg);
			}
			
			.ast-header-break-point #burger .bar.btmBar {
				-webkit-transform: translateY(6px) rotate(0deg);
				transform: translateY(6px) rotate(0deg);
			}
			
			.ast-header-break-point .menu-toggle.toggled #burger .bar.topBar {
				-webkit-transform: translateY(4px) rotate(45deg);
		   		transform: translateY(4px) rotate(45deg);
			}
			
			.ast-header-break-point .menu-toggle.toggled #burger .bar.btmBar {
				-webkit-transform: translateY(3px) rotate(-45deg);
				transform: translateY(3px) rotate(-45deg);
			}

			.ast-header-break-point .menu-label {
			    font-size: 12px;
			    margin-bottom: 5px;
			}

			.ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu {
				margin: 10px 5px;
			}
			
			.ast-header-break-point .main-navigation li {
				width: 100%;
				margin: 5px 30px;
			}

		</style>

		<div class="ast-button-wrap custom">
					<button type="button" class="menu-toggle main-header-menu-toggle " rel="main-menu" aria-controls="primary-menu" aria-expanded="false" data-index="1">
						<span class="screen-reader-text"><?php echo esc_html ( 'Main Menu' ); ?></span>
						<div class="menu-label"><?php echo esc_html ( 'Menu' ); ?></div>
						<div id="burger">
				        	<div class="bar topBar"></div>
				        	<div class="bar btmBar"></div>
			      		</div>
					</button>
		</div>

	<?php
	$html = ob_get_clean();
	echo $html;
}