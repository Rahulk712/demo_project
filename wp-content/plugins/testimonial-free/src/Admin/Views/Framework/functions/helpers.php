<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Array search key & value
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spftestimonial_array_search' ) ) {
	/**
	 * Array search key & value
	 *
	 * @param  mixed $array array.
	 * @param  mixed $key key.
	 * @param  mixed $value value.
	 * @return array
	 */
	function spftestimonial_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[ $key ] ) && $array[ $key ] == $value ) {
				$results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, spftestimonial_array_search( $sub_array, $key, $value ) );
			}
		}

		return $results;

	}
}

/**
 *
 * Between Microtime
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spftestimonial_timeout' ) ) {
	/**
	 * Timeout function
	 *
	 * @param  mixed $timenow current.
	 * @param  mixed $starttime start time.
	 * @param  mixed $timeout time out.
	 * @return statement
	 */
	function spftestimonial_timeout( $timenow, $starttime, $timeout = 30 ) {
		return ( ( $timenow - $starttime ) < $timeout ) ? true : false;
	}
}

/**
 *
 * Check for wp editor api
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spftestimonial_wp_editor_api' ) ) {
	/**
	 * Check for wp editor api
	 *
	 * @return statement
	 */
	function spftestimonial_wp_editor_api() {
		global $wp_version;
		return version_compare( $wp_version, '4.8', '>=' );
	}
}
