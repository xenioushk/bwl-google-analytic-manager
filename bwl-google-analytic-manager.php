<?php

/*
  Plugin Name: BWL Google Analytic Manager
  Version: 1.0.2
  Description: Include Google Analytic code in your website.
  Author: xenioushk
  Author URI:  https://bluewindlab.net
 */

// Make sure it's wordpress
if (!defined('ABSPATH'))
    die('Forbidden');

Class BWL_Google_Analytic_Manager {

    function __construct() {

        /* ------------------------------ PLUGIN COMMON CONSTANTS --------------------------------- */

        $bgam_status = get_option('bgam_status');
        
        // If user logged in , we are not going to include analytics code in front end.

        if ( is_user_logged_in() ) :
            $bgam_status = 0;
        endif;


        if ( $bgam_status == 1 ) {

            $bgam_loc = get_option('bgam_loc');

            if ($bgam_loc == 'header') {
                add_action('wp_head', array(&$this, 'bwl_google_analytics_tracking_code'));
            } else {
                add_action('wp_footer', array(&$this, 'bwl_google_analytics_tracking_code'));
            }
        }

        $this->includes();
    }

    function bwl_google_analytics_tracking_code() {

        echo get_option('bgam_code');
    }

    function includes() {
        if (is_admin()) {

            include_once dirname(__FILE__) . '/admin/settings/bpdb-settings.php';
        }
    }

}

/* ------------------------------ Initialization --------------------------------- */

function init_bwl_google_analytic_manager() {

    new BWL_Google_Analytic_Manager();
}

add_action('init', 'init_bwl_google_analytic_manager');