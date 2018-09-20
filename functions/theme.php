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
    $context['site']->assets = './assets/';
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

  /**
     * @author http://netters.nl/nederlandse-datum-in-php
     */
    function nlDate($datum){
      /*
       // AM of PM doen we niet aan
       $parameters = str_replace("A", "", $parameters);
       $parameters = str_replace("a", "", $parameters);

      $datum = date($parameters);
     */
       // Vervang de maand, klein
      $datum = str_replace("january",     "januari",         $datum);
       $datum = str_replace("february",     "februari",     $datum);
      $datum = str_replace("march",         "maart",         $datum);
       $datum = str_replace("april",         "april",         $datum);
       $datum = str_replace("may",         "mei",             $datum);
       $datum = str_replace("june",         "juni",         $datum);
      $datum = str_replace("july",         "juli",         $datum);
      $datum = str_replace("august",         "augustus",     $datum);
       $datum = str_replace("september",     "september",     $datum);
       $datum = str_replace("october",     "oktober",         $datum);
       $datum = str_replace("november",     "november",     $datum);
      $datum = str_replace("december",     "december",     $datum);

      // Vervang de maand, hoofdletters
     $datum = str_replace("January",     "Januari",         $datum);
       $datum = str_replace("February",     "Februari",     $datum);
      $datum = str_replace("March",         "Maart",         $datum);
       $datum = str_replace("April",         "April",         $datum);
       $datum = str_replace("May",         "Mei",             $datum);
       $datum = str_replace("June",         "Juni",         $datum);
      $datum = str_replace("July",         "Juli",         $datum);
      $datum = str_replace("August",         "Augustus",     $datum);
       $datum = str_replace("September",     "September",     $datum);
       $datum = str_replace("October",     "Oktober",         $datum);
       $datum = str_replace("November",     "November",     $datum);
      $datum = str_replace("December",     "December",     $datum);

      // Vervang de maand, kort
       $datum = str_replace("Jan",         "Jan",             $datum);
       $datum = str_replace("Feb",         "Feb",             $datum);
       $datum = str_replace("Mar",         "Maa",             $datum);
       $datum = str_replace("Apr",         "Apr",             $datum);
       $datum = str_replace("May",         "Mei",             $datum);
       $datum = str_replace("Jun",         "Jun",             $datum);
       $datum = str_replace("Jul",         "Jul",             $datum);
       $datum = str_replace("Aug",         "Aug",             $datum);
       $datum = str_replace("Sep",         "Sep",             $datum);
       $datum = str_replace("Oct",         "Ok",             $datum);
     $datum = str_replace("Nov",         "Nov",             $datum);
       $datum = str_replace("Dec",         "Dec",             $datum);

      // Vervang de dag, klein
     $datum = str_replace("monday",         "maandag",         $datum);
       $datum = str_replace("tuesday",     "dinsdag",         $datum);
       $datum = str_replace("wednesday",     "woensdag",     $datum);
     $datum = str_replace("thursday",     "donderdag",     $datum);
     $datum = str_replace("friday",         "vrijdag",         $datum);
       $datum = str_replace("saturday",     "zaterdag",     $datum);
      $datum = str_replace("sunday",         "zondag",         $datum);

      // Vervang de dag, hoofdletters
       $datum = str_replace("Monday",         "Maandag",         $datum);
       $datum = str_replace("Tuesday",     "Dinsdag",         $datum);
       $datum = str_replace("Wednesday",     "Woensdag",     $datum);
     $datum = str_replace("Thursday",     "Donderdag",     $datum);
     $datum = str_replace("Friday",         "Vrijdag",         $datum);
       $datum = str_replace("Saturday",     "Zaterdag",     $datum);
      $datum = str_replace("Sunday",         "Zondag",         $datum);

      // Vervang de verkorting van de dag, hoofdletters
       $datum = str_replace("Mon",            "Maa",             $datum);
       $datum = str_replace("Tue",         "Din",             $datum);
       $datum = str_replace("Wed",         "Woe",             $datum);
       $datum = str_replace("Thu",         "Don",             $datum);
       $datum = str_replace("Fri",         "Vri",             $datum);
       $datum = str_replace("Sat",         "Zat",             $datum);
       $datum = str_replace("Sun",         "Zon",             $datum);

      return $datum;
  }
