<?php
/* 

Plugin Name: Rendez-Vous Plugin
Description: Paquete creado a medida para la web de "Rendez-Vous Magazine". El cual añade la posibilidad de implementar Sliders, Categorías personalizadas y Wigets.
Version: 1.0.4
Author: Jonathan Rodríguez
Author URI: https://www.instagram.com/silicatopa/
Text Domain: Rendez-Vous Plugin
*/

//Widgets
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}
require_once "rv-widgets.php";

function rv_widget_init(){

    register_sidebar( 
        array(

            'name'  => 'Subtitulo',
            'id'    => 'subtitle',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   =>  ''


        ));


    register_sidebar( 
        array(

            'name'  => 'Mostrar post 1',
            'id'    => 'mostrar_cat1',
            'before_widget' => '<div class="nombre-categoria">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="link-categoria"',
            'after_title'   =>  '</h3>'


        ));
        register_sidebar( 
            array(
    
                'name'  => 'Mostrar post 2',
                'id'    => 'mostrar_cat2',
                'before_widget' => '<div class="nombre-categoria">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="link-categoria"',
                'after_title'   =>  '</h3>'
    
    
        ));
        register_sidebar( 
            array(
    
                'name'  => 'Mostrar post 3',
                'id'    => 'mostrar_cat3',
                'before_widget' => '<div class="nombre-categoria">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="link-categoria"',
                'after_title'   =>  '</h3>'
    
    
        ));
        register_sidebar( 
            array(
    
                'name'  => 'Carta editorial',
                'id'    => 'rv_cart_edit',
                'before_widget' => '<div class="nombre-categoria">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="link-categoria"',
                'after_title'   =>  '</h3>'
    
    
        ));
        register_sidebar( 
            array(
    
                'name'  => 'Logo inferior',
                'id'    => 'log_inf',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '',
                'after_title'   =>  ''
    
    
        ));
        register_sidebar( 
            array(
    
                'name'  => 'Footer1',
                'id'    => 'red_soc1',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '',
                'after_title'   =>  ''
    
    
        ));
        register_sidebar( 
            array(
    
                'name'  => 'Footer 2',
                'id'    => 'red_soc2',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '',
                'after_title'   =>  ''
    
    
        ));
        

}

add_action('widgets_init', 'rv_widget_init');



// Slider

function create_slider_post_type(){

    $labels = array(

        'name' => __('Sliders'),
        'singular_name' => __('Sliders'),
        'all_items'     => __('Todos los Sliders'),
        'view_item'     => __('Ver los sliders'),
        'add_new_item'  => __('Agregar un nuevo slider'),
        'add_new'       => __('Agregar un nuevo slider'),
        'edit_item'     => __('Editar slider'),
        'update_item'   => __('Actualizar Slider'),
        'search_items'  => __('Buscar Slider'),
        'search_items'  => __('Sliders')

    );

    $args = array(

        'labels'  => $labels,
        'description' => 'Agregar un nuevo contenido de tipo slider',
        'menu_position' => 27,
        'public' => true,
        'has_archive' => true,
        'map_meta_cap' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array( 'slug' => false),
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array(
            'title',
            'thumbnail',
            'excerpt'

        ),

    );

    register_post_type('slider', $args);

}

add_action('init', 'create_slider_post_type');


add_action('init', function(){
    remove_post_type_support( 'slider', 'editor');
    remove_post_type_support( 'slider', 'slug');
});

//Tamaño de imagen para el Slider

function rv_theme_support(){

    add_theme_support( 'post-thumbnails');
    add_image_size( 'slider_image', '500' ,'250', true );

}

add_action( 'after_setup_theme', 'rv_theme_support' );



?>