<?php

/*

  Plugin Name: Custom Clean
  Description: Custom Clean is a simple clean up plugin to remove unwanted things from the project
  Author: Abdul Samad vpd
  Author URI:  www.fb.com/samuvpd
  Text Domain: custom-clean-up
  Version: 1.0.0
  License: GPL-3.0
  License URI: https://opensource.org/licenses/GPL-3.0 
 
  */

// activation hook
register_activation_hook(__FILE__, 'remove_dashboard_meta');


// function activate_clean_up(){
//   remove_dashboard_meta();
// }
// add_action('init', 'activate_clean_up');


function remove_dashboard_meta() {
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8

  // welcome panel
  remove_action('welcome_panel', 'wp_welcome_panel');

  // remove gutenberg panel
  remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
}
add_action( 'admin_init', 'remove_dashboard_meta' );



/* custom dashboard widget */

  /**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function twenty_seven_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'twenty_seven_dashboard_widget',         // Widget slug.
                 'Twenty Seven Dashboard Widget',         // Title.
                 'twenty_seven_dashboard_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'twenty_seven_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function twenty_seven_dashboard_widget_function() {
  
// $user_data = get_userdata($user_id);
$current_user = wp_get_current_user();

  echo "<em>  <h2> Welcome, <strong>".$current_user->user_login."</strong> to 27 Technologies </h2></em>";

  // echo "<pre>";
  // print_r($current_user);
  // echo "</pre>";
}

/* custom dashboard widget */




/* remove submenu */

function remove_menus(){
  
  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'jetpack' );                    //Jetpack* 
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  // remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
  remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  
}

(!is_admin()) ? add_action( 'admin_menu', 'remove_menus' ) : '' ;


/* !remove submenu */