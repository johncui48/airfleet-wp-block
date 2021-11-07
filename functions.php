<?php

define( 'TEHEME_DIRECTORY', get_stylesheet_directory() );
define( 'TEHEME_DIRECTORY_URI', get_stylesheet_directory_uri() );
define( 'TEHEME_BLOCKS', TEHEME_DIRECTORY .'/custom-blocks' );
define( 'TEHEME_BLOCKS_URI', TEHEME_DIRECTORY_URI .'/custom-blocks' );


/* enqueue scripts and style */
function enqueue_parent_styles() {
    // from parent theme 
    wp_enqueue_style( 'child-style', TEHEME_DIRECTORY_URI, array('twenty-twenty-one-style'), wp_get_theme()->get('Version'));

    // load jquery
    wp_enqueue_script( 'jquery-3-js', TEHEME_DIRECTORY_URI . '/assets/js/jquery-3.6.0.min.js');
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );


/* load all php files in custom-blocks folder */
function custom_load_block_callback() {

    $resource = opendir( TEHEME_BLOCKS );

    while ( ( $file = readdir( $resource ) ) !== false ) {
        if ( in_array( $file, array( '.', '..' ), true ) ) {
            continue;
        }
        $dir = TEHEME_BLOCKS. "/$file";
        if ( is_dir( $dir ) ) {
            $directories[] = $dir;
        }
        foreach (glob("$dir/*.php") as $filename)
        {
            require_once $filename;
        }
    }

    closedir( $resource );
}
custom_load_block_callback();


/* load all acf json files under custom-blocks folder */
function custom_acf_load_json( array $directories ) {

	$resource = opendir( TEHEME_BLOCKS );

	while ( ( $file = readdir( $resource ) ) !== false ) {
		if ( in_array( $file, array( '.', '..' ), true ) ) {
			continue;
		}
		$dir = TEHEME_BLOCKS. "/$file";
		// if it is a directory (not a file), add it to ACF JSON load paths
		if ( is_dir( $dir ) ) {
			$directories[] = $dir;
		}
	}

	closedir( $resource );
	return $directories;
}
add_filter('acf/settings/load_json', 'custom_acf_load_json');


/* register acf custom blocks */
function custom_acf_init_blocks() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              =>  'airfleet',
            'title'             =>  __('AirFleet'),
            'description'       =>  __('A custom block to display different layout.'),
            'render_callback'   =>  'airfleet_block_callback',  // callback function in custom-blocks/block_name/index.php
            'align'             =>  'full',
            'icon'              =>  'airplane',
            'keywords'          =>  array('airfleet'),
            'supports'          =>  array(
                'align'     => true,
                'align_text' => true,
                'align_content' => true
            ),
            'enqueue_style'  =>  TEHEME_BLOCKS_URI . '/main.css', // css file
            'enqueue_script' =>  TEHEME_BLOCKS_URI . '/airfleet/block.min.js' // javascript file
        ));

        // add more new blocks here...
    }
}
add_action('acf/init', 'custom_acf_init_blocks');