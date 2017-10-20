<?php
function my_theme_enqueue_styles() {

    //Enqueuing parent theme style
    $parent_style = 'vantage-style';
    wp_enqueue_style( 'font-script', get_stylesheet_directory_uri() . '/css/font.css' );
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    //Adding Font.css Roboto

}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


//Enqueuing Javascript
function my_theme_enqueue_scripts() {
	   wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );

}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );
