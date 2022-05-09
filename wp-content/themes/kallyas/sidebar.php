<?php if(! defined('ABSPATH')){ return; }

global $zn_config;

	if( isset( $zn_config['disable_sidebar'] ) && $zn_config['disable_sidebar'] ){
		return;
	}

	$current_post_type = get_post_type( $post->ID );

	$exclude_post_type = array(
		'zn_layout',
		'znpb_template_mngr',
		'attachment',
		'product',
		'post',
	);

	// Check to see on what type of page we are on
	$layout = 'blog_sidebar';
	if ( !empty( $zn_config['force_sidebar'] ) ) {
		$layout = $zn_config['force_sidebar'];
	} else {
		if( is_page() || is_404() || is_attachment() ) {
			$layout = 'page_sidebar';
		}
		elseif ( is_archive() && ! in_array( $current_post_type, $exclude_post_type ) ) {
			$layout = $current_post_type . '_archive_sidebar';
		}
		elseif ( is_archive() ) {
			$layout = 'archive_sidebar';
		}
		elseif ( is_singular() && ! in_array( $current_post_type, $exclude_post_type ) ) {
			$layout = $current_post_type . '_sidebar';
		}
		elseif ( is_singular() ) {
			$layout = 'single_sidebar';
		}
	}

	// Get the sidebar position
	$sidebar_pos 	 = zn_get_sidebar_class( $layout );
	$has_sidebar 	 = false;

	if(strpos($sidebar_pos, 'left_sidebar')  !== false) $has_sidebar = true;
	if(strpos($sidebar_pos, 'right_sidebar')  !== false) $has_sidebar = true;

	$left_sidebar_col = strpos($sidebar_pos, 'left_sidebar')  !== false ? 'col-md-pull-9':'';

	$sidebar_size = zget_option( 'sidebar_size', 'unlimited_sidebars', false, 3 );
	$def_sidebar_class = 'col-sm-4 col-md-'.$sidebar_size.' '.$left_sidebar_col;

	$sidebar_class = apply_filters( 'kl_sidebar_css_class', $def_sidebar_class );

	// Return if we do not have a sidebar
	if( !$has_sidebar ) return;

	// Show the sidebar already :)
	echo '<aside class=" '.$sidebar_class.'" '.WpkPageHelper::zn_schema_markup('sidebar').'>';

	$sidebar_color_style = zget_option( 'zn_main_style', 'color_options', false, 'light' );

		echo '<div class="zn_sidebar sidebar kl-sidebar--'.$sidebar_color_style.' element-scheme--'.$sidebar_color_style.'">';

			// Check to see if this is a page and has a custom sidebar
			if( ! empty( $zn_config['forced_sidebar_id'] ) ){

				$sidebar = $zn_config['forced_sidebar_id'];

				if( $sidebar == 'default' ){
					$sidebar = zget_option( $layout, 'unlimited_sidebars');
					$sidebar_selected = ! empty( $sidebar['sidebar'] ) ? $sidebar['sidebar'] : 'defaultsidebar' ;
					dynamic_sidebar( $sidebar_selected );
				}
				else{
					dynamic_sidebar( $sidebar );
				}

			}
			elseif ( is_singular() && $sidebar = get_post_meta( get_the_ID(), 'zn_sidebar_select', true ) ){

				if( $sidebar == 'default' ){
					$sidebar = zget_option( $layout, 'unlimited_sidebars');
					$sidebar_selected = ! empty( $sidebar['sidebar'] ) ? $sidebar['sidebar'] : 'defaultsidebar' ;
					dynamic_sidebar( $sidebar_selected );
				}
				else{
					dynamic_sidebar( $sidebar );
				}
			}
			else {
				// Get the sidebar set in the theme options
				$sidebar = zget_option( $layout, 'unlimited_sidebars' );

				// Check to see if we have a sidebar set or we need to use the default one
				if( empty( $sidebar['sidebar'] ) ) {
					if( is_archive() ){
						$sidebar = zget_option( 'archive_sidebar', 'unlimited_sidebars' );
					}
					elseif ( is_singular() ){
						$sidebar = zget_option( 'single_sidebar', 'unlimited_sidebars' );
					}
				}

				$sidebar_selected = ! empty( $sidebar['sidebar'] ) ? $sidebar['sidebar'] : 'defaultsidebar' ;
				dynamic_sidebar( $sidebar_selected );

			}

		echo '</div>';
	echo '</aside>';

?>
