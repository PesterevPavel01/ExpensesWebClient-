<?php

    add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles' );
    add_theme_support('custom-logo');

    function add_scripts_and_styles()
    {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery',get_template_directory_uri(  ).'/assets/js/lib/jquery-3.7.1.min.js');
        wp_enqueue_script( 'jquery');

        wp_enqueue_style( 'reset',get_template_directory_uri(  ).'/assets/css/reset.css');
        wp_enqueue_style( 'header_style',get_template_directory_uri(  ).'/assets/css/header_style.css');
        wp_enqueue_style( 'update-target_style',get_template_directory_uri(  ).'/assets/css/update-target_style.css');
        wp_enqueue_style( 'main',get_stylesheet_uri(  ));

        wp_enqueue_style( 'swiper-bundle-css',"https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css");
        wp_enqueue_script( 'swiper-bundle',"https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js");

        wp_enqueue_script( 'loadExpensesOrder',get_template_directory_uri(  ).'/assets/js/loadExpensesOrder.js',false,null,true);
        wp_enqueue_script( 'swiper',get_template_directory_uri(  ).'/assets/js/swiper.js',false,null,true);
        wp_enqueue_script( 'swiper-month',get_template_directory_uri(  ).'/assets/js/swiper-month.js',false,null,true);
        //wp_enqueue_script( 'update-target',get_template_directory_uri(  ).'/assets/js/update-target.js',false,null,true);

    };
?>