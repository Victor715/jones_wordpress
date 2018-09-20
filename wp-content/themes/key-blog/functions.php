<?php
/**
 * Describe child theme functions
 *
 * @package Optimistic Blog Lite
 * @subpackage Key Blog
 * 
 */

/*-------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'key_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function key_blog_setup() {
    
    $key_blog_theme_info = wp_get_theme();
    $GLOBALS['key_blog_version'] = $key_blog_theme_info->get( 'Version' );
}
endif;

add_action( 'after_setup_theme', 'key_blog_setup' );

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed the theme default color
 */
function key_blog_customize_register( $wp_customize ) {

		global $wp_customize;

        /**
          * Theme Primary Color
        */
        $wp_customize->add_section( 'key_blog_primary_theme_color', array(
          'title'    => esc_html__('Primary Color Options', 'key-blog'),
          'priority' => 2,
        ));

            $wp_customize->add_setting('key_blog_primary_theme_color_options', array(
                'default' => '#0D88D2',
                'sanitize_callback' => 'sanitize_hex_color',        
            ));

            $wp_customize->add_control('key_blog_primary_theme_color_options', array(
                'type'     => 'color',
                'label'    => esc_html__('Primary Colors', 'key-blog'),
                'section'  => 'key_blog_primary_theme_color',
                'setting'  => 'key_blog_primary_theme_color_options',
            ));

	}

add_action( 'customize_register', 'key_blog_customize_register', 20 );

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'key_blog_scripts', 20 );

function key_blog_scripts() {
    
    global $key_blog_version;
    
    wp_dequeue_style( 'optimistic-blog-lite-style' );

    wp_dequeue_style( 'optimistic-blog-lite-custom-style' );
    
	wp_enqueue_style( 'optimistic-blog-lite-parent-style', get_template_directory_uri() . '/style.css', array(), esc_attr( $key_blog_version ) );

    wp_enqueue_style( 'optimistic-blog-lite-custom-parent-style', get_template_directory_uri() . '/offshorethemes/assets/dist/css/main.min.css', array(), esc_attr( $key_blog_version ) );
    
    wp_enqueue_style( 'key-blog-style', get_stylesheet_uri(), array(), esc_attr( $key_blog_version ) );
    
    
    $key_blog_primary_theme_color = get_theme_mod( 'key_blog_primary_theme_color_options', '#0D88D2' );
    
    $output_css = '';
    

    $output_css .= ".main-post-area-layout-one .main-post-area-holder article .post-permalink a:hover, .widget_search .search-submit, .widget_product_search input[type='submit'], .pagination .nav-links .current, .wpcf7 input[type='submit'], .wpcf7 input[type='button'], input[type=submit].comments__form-submit:hover, input[type=submit].comments__form-submit:focus, .general-banner .swiper-pagination-bullet-active, .widget-recent-posts .widget-recent-posts .swiper-pagination-bullet-active, .comments__form-label::after { background-color: ". esc_attr( $key_blog_primary_theme_color ) ."}\n";
    
    $output_css .= "a:hover, .postmeta ul li, .postmeta ul li a, .main-post-area-layout-one .main-post-area-holder article .post-permalink a:after, .widget a:hover, .widget_archive a:hover, .widget_categories a:hover, .widget_recent_entries a:hover, .widget_meta a:hover, .widget_product_categories a:hover, .widget_rss li a:hover, .widget_pages li a:hover, .widget_nav_menu li a:hover, footer .footer-inner .copyright-and-nav-row ul li a:hover, .copyrights p a:hover, .main-post-area-wrapper .layout-two-post-details-holder .post-meta-category p a:hover, .main-post-area-wrapper .layout-two-post-details-holder .post-meta-category p a:focus, .main-post-area-wrapper .layout-two-post-details-holder .post-title h2 a:hover, .main-post-area-wrapper .layout-two-post-details-holder .post-title h2 a:focus, .main-post-area-wrapper .layout-two-post-details-holder .post-meta-posted-date p a:hover, .main-post-area-wrapper .layout-two-post-details-holder .post-meta-posted-date p a:focus, .main-post-area-holder .layout-three-post-details-holder .post-extra-details .post-title h2 a:hover, .main-post-area-holder .layout-three-post-details-holder .post-extra-details .post-title h2 a:focus, .main-post-area-holder .layout-three-post-details-holder .post-extra-details .post-meta-category span a:hover, .main-post-area-holder .layout-three-post-details-holder .post-extra-details .post-meta-category span a:focus, .widget-popular-post .widget-extra-info-holder .widget-posts .post-title h5 a:hover { color: ". esc_attr( $key_blog_primary_theme_color ) ."}\n";
    
    $output_css .= ".main-post-area-layout-one .main-post-area-holder article .post-permalink a:hover, .wpcf7 input[type='submit'], .wpcf7 input[type='button'] { border-color: ". esc_attr( $key_blog_primary_theme_color ) ."}\n";
                
    wp_add_inline_style( 'key-blog-style', $output_css );
    
}