<?php
/**
 * Create [current_year] shortcode
 *
 * @param $atts standard param for shortcode
 * @return date current year
 */
add_shortcode( 'current_year', 'current_year_func' );
function current_year_func( $atts ) {
	return date("Y");
}
