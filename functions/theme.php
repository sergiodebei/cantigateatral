<?php

// define('BASEURL', WP_HOME);

// Setup theme with Timber
if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
    } );
  return;
}

Timber::$dirname = array('views');

class StarterSite extends TimberSite {

  function __construct() {
    if ( WP_DEBUG ) {
      add_filter( 'timber/cache/mode', function () {
        return 'none';
      });
    }

    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    // add_filter( 'show_admin_bar', array( $this, 'my_function_admin_bar' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    add_action( 'init', array($this, 'register_my_menus') );
    add_action( 'admin_init', array( $this, 'remove_meta_boxes') );

    parent::__construct();
  }

  function add_to_context( $context ) {
    $context['menu'] = new TimberMenu();
    $context['site'] = $this;
    // $context['site']->url = BASEURL . '';
    // $context['site']->assets = './assets/';
    $context['site']->is_home = is_front_page();
    return $context;
  }

  function my_function_admin_bar(){ 
    return false; 
  }

  function remove_meta_boxes() {
    remove_meta_box('categorydiv', 'events', 'side');
  }

  function register_post_types() {
    register_post_type( 'events', array(
        'labels' => array(
          'name' => __( 'Events' ),
          'singular_name' => __( 'Event' ),
          'menu_name' => 'Agenda'
        ),
        'menu_position' => 10,
        'menu_icon' => 'dashicons-calendar-alt',
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'show_in_nav_menus' => true,
        'exclude_from_search' => false,
        'rewrite' => array('slug' => 'agenda'),
        'taxonomies' => array('category'),
        'supports' => array('revisions', 'title','menu_order')
      )
    );

  }

  function register_taxonomies() {
    //this is where you can register custom taxonomies
  }

  function enqueue_scripts() 
    {
        // Update jQuery in frontend
        if (!is_admin()) {
            wp_deregister_script('jquery'); // Deregister the included library
            // wp_enqueue_script(
            //     'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js',
            //     array(), '3.2.1', true
            // );
        }

        // wp_enqueue_script(
        //     'moc-lib', get_template_directory_uri() . '/assets/js/lib.js',
        //     array('jquery'), 
        //     $this->file_version('assets/js/lib.js'), true
        // );

        // wp_enqueue_script(
        //     'moc-js', get_template_directory_uri() . '/assets/js/app.js',
        //     array('moc-lib', 'jquery'), 
        //     $this->file_version('assets/js/app.js'), true
        // );
    }

    //to add extra menus
    function register_my_menus() 
      {
        register_nav_menus(
            array(
              'primary-menu' => __( 'Primary menu' )
            )
        );
      }

}
/* functions.php */
if (class_exists('Timber')){
    Timber::$cache = false;
}

new StarterSite();

if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}