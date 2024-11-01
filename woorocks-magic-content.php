<?php
/**
 * Plugin Name: WooRocks Magic Content
 * Plugin URI: http://woorocks.com
 * Description: WooRocks Magic Content lets you control output of content created inside Elementor Page Builder Sections using criterias like User has to be logged in or member of a certain role in WordPress to view the section.
 * Version: 1.0.17
 * Author: Andreas Kviby
 * Text Domain: woorocks-magic-content
 * Author URI: http://woorocks.com
 * License: GPL2
 * Elementor requires at least: 1.0.0
 */
 // Create a helper function for easy SDK access.
function wmc_fs() {
    global $wmc_fs;

    if ( ! isset( $wmc_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $wmc_fs = fs_dynamic_init( array(
            'id'                  => '725',
            'slug'                => 'woorocks-magic-content',
            'type'                => 'plugin',
            'public_key'          => 'pk_7023b5d770b6e2c67ba72a7c024c5',
            'is_premium'          => false,
            'has_premium_version' => false,
            'has_addons'          => false,
            'has_paid_plans'      => false,
            'menu'                => array(
                'first-path' => 'plugins.php',
                'account'    => false,
            ),
        ) );
    }

    return $wmc_fs;
}

// Init Freemius.
wmc_fs();

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function wmc_fs_custom_connect_message_on_update(
        $message,
        $user_first_name,
        $plugin_title,
        $user_login,
        $site_link,
        $freemius_link
    ) {
        return sprintf(
            __fs( 'hey-x' ) . '<br>' .
            __( 'Please help us improve %2$s! It means a lot for us in our future development of this plugin. If you opt-in, some data about your usage of %2$s will be sent to %5$s. If you skip this, that\'s okay! %2$s will still work just fine.', 'woorocks-magic-content' ),
            $user_first_name,
            '<b>' . $plugin_title . '</b>',
            '<b>' . $user_login . '</b>',
            $site_link,
            $freemius_link
        );
    }

wmc_fs()->add_filter('connect_message_on_update', 'wmc_fs_custom_connect_message_on_update', 10, 6);
if ( ! function_exists( 'get_editable_roles' ) ) {
    require_once ABSPATH . 'wp-admin/includes/user.php';
}
function get_wp_roles() {
    $roles[] = array();
    $roles = array_merge($roles, array("0"=>"Not enabled"));
    $editable_roles = get_editable_roles();
    foreach ($editable_roles as $role => $details) {
        $sub['role'] = esc_attr($role);
        $sub['name'] = translate_user_role($details['name']);
        $roles = array_merge($roles, array($sub['role']=>$sub['name']));
    }
    return $roles;
}

libxml_use_internal_errors(false);

$GLOBALS['woorocks_buffer_variable'] = '';
$GLOBALS['woorocks-roles'] = array();

/*$GLOBALS['woorocks-roles'] = array(
    '0' => 'Not enabled',
    'administrator' => 'Administrators',
    'editor' => 'Editors',
    'contributor' => 'Contributors',
    'author' => 'Authors',
    'subscriber' => 'Subscribers'
);*/

$GLOBALS['woorocks-roles'] = get_wp_roles();

$request_uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$is_admin = strpos( $request_uri, '/wp-admin/' );


add_action( 'plugins_loaded', 'woorocks_load_plugin_textdomain' );

add_action( 'elementor/element/before_section_start', function( $element, $section_id, $args ) {
    /** @var \Elementor\Element_Base $element */
    if ( 'section' === $element->get_name() && 'section_background' === $section_id ) {

        $element->start_controls_section(
            'woorocks_custom_section',
            [
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
                'label' => __( 'Magic Content Settings', 'woorocks-magic-content' ),
            ]
        );

        $element->add_control(
            'woorocks_loggedin_control',
            [
            'type' => \Elementor\Controls_Manager::SELECT,
            'label' => __( 'Users will have to', 'woorocks-magic-content' ),
						'default' => '0',
						'options' => [
							'0' => __( 'Not enabled', 'woorocks-magic-content' ),
							'notloggedin' => __( 'Be logged out', 'woorocks-magic-content' ),
							'loggedin' => __( 'Be logged in', 'woorocks-magic-content' ),
						],
						'prefix_class' => 'woorocks-',
            ]
        );

				$element->add_control(
            'woorocks_roles_control',
            [
            'type' => \Elementor\Controls_Manager::SELECT,
            'label' => __( 'Users part of role', 'woorocks-magic-content' ),
						'default' => '0',
						'options' => $GLOBALS['woorocks-roles'],
						'prefix_class' => 'woorocks-role:',
            ]
        );

        $element->add_control(
          'woorocks_geo_city',
          [
            'type' => \Elementor\Controls_Manager::TEXT,
            'label' => __( 'Users from city', 'woorocks-magic-content' ),
            'default' => '',
            'placeholder' => __( 'Cityname', 'woorocks-magic-content' ),
            'title' => __( 'Enter fullname of city here', 'woorocks-magic-content' ),
            'prefix_class' => 'woorocks-geo-city:',
				    'label_block' => true,
          ]
        );

        $element->add_control(
          'woorocks_geo_region',
          [
            'type' => \Elementor\Controls_Manager::TEXT,
            'label' => __( 'Users from region', 'woorocks-magic-content' ),
            'default' => '',
            'placeholder' => __( 'Regionname', 'woorocks-magic-content' ),
            'title' => __( 'Enter fullname of region here', 'woorocks-magic-content' ),
            'prefix_class' => 'woorocks-geo-region:',
				    'label_block' => true,
          ]
        );

        $element->add_control(
          'woorocks_geo_country',
          [
            'type' => \Elementor\Controls_Manager::TEXT,
            'label' => __( 'Users from country', 'woorocks-magic-content' ),
            'default' => '',
            'placeholder' => __( 'Countrycode', 'woorocks-magic-content' ),
            'title' => __( 'Enter two letter countrycode', 'woorocks-magic-content' ),
            'prefix_class' => 'woorocks-geo-country:',
				    'label_block' => true,
            'description' => __( 'You can NOT combine values if you want to filter from 2 countries now. Learn more about the GEO API ', 'woorocks-magic-content' ) . sprintf( ' <a href="%s" target="_blank">%s</a>', 'http://freegeoip.net', __( 'here.', 'woorocks-magic-content' ) ),

          ]
        );

        $element->end_controls_section();
    }
}, 10, 3 );
// Add notice to WP Dashboard in some cases with the function below
//add_action( 'admin_notices', 'woorocks_dashboard_message' );



 /**
  * Load gettext translate for our text domain.
  */
function woorocks_load_plugin_textdomain() {
   load_plugin_textdomain( 'woorocks-magic-content' );

}
/*
 * Below is the filters that will change the content output depending on the
 * classes fixed in Elementor Page Editor.
*/
function woorocks_buffer_start() {
    ob_start("woorocks_callback");
}

function woorocks_buffer_end() {
   ob_end_flush();
   //$output = $GLOBALS['woorocks_buffer_variable'];
}
function woorocks_callback($buffer) {
  // modify buffer here, and then return the updated code
  //$GLOBALS['final_html'] .= $buffer;
  //$buffer = str_replace('geolocation:sverige','geolocation:norway',$buffer);
    $woorocks_content = '';
    $doc = new DOMDocument();
    $doc->loadHTML($buffer);
    $selector = new DOMXPath($doc);
    global $current_user;

    $url = 'http://freegeoip.net/json/' . $_SERVER["REMOTE_ADDR"];
    $geoDetails = json_decode(file_get_contents($url));
    $geoCity = preg_replace('/\s+/', '', $geoDetails->city);
    $geoRegion = preg_replace('/\s+/', '', $geoDetails->region_name);
    $geoCountry = preg_replace('/\s+/', '', $geoDetails->country_code);
    //$debugContent = "<h1 style='color:#fff;'>" . $geoCity . "</h1>";

    // GEO Filter does not rely on logged in or not, only GEO information is important here
    foreach($selector->query('//section[contains(@class, "woorocks-geo-city:") and not(contains(@class, "woorocks-geo-city:'.$geoCity.'"))]') as $e ) {
      $e->parentNode->removeChild($e);
    }

    foreach($selector->query('//section[contains(@class, "woorocks-geo-region:") and not(contains(@class, "woorocks-geo-region:'.$geoRegion.'"))]') as $e ) {
      $e->parentNode->removeChild($e);
    }

    foreach($selector->query('//section[contains(@class, "woorocks-geo-country:") and not(contains(@class, "woorocks-geo-country:'.$geoCountry.'"))]') as $e ) {
      $e->parentNode->removeChild($e);
    }

    if ( is_user_logged_in() ) {

      foreach($selector->query('//section[contains(attribute::class, "woorocks-notloggedin")]') as $e ) {
        $e->parentNode->removeChild($e);
      }

      $user_roles = $current_user->roles;
      $role = array_shift($user_roles);
      //$debugContent = "<h1 style='color:#fff;'>" . $role . "</h1>";
      $editable_roles = get_editable_roles();
      foreach ($editable_roles as $c_role => $details) {
        // Delete all other roles content and keep the content targetted to the current logged in
        foreach($selector->query('//section[contains(@class, "woorocks-role:") and not(contains(@class, "woorocks-role:'. $role.'"))]') as $e ) {
          $e->parentNode->removeChild($e);
        }
      }
    }
    else {
      // Not logged in, later GEO stuff here
      foreach($selector->query('//section[contains(attribute::class, "woorocks-loggedin")]') as $e ) {
        $e->parentNode->removeChild($e);
      }
      foreach($selector->query('//section[contains(attribute::class, "woorocks-role:")]') as $e ) {
        $e->parentNode->removeChild($e);
      }

    }
    return $doc->saveHTML($doc);
  }

// add filter in front pages only
if( false === $is_admin || !defined( 'DOING_AJAX' ) || !DOING_AJAX || !isset( $_POST['action'] ) ){
  add_action('wp_loaded', 'woorocks_buffer_start');
  add_action('shutdown', 'woorocks_buffer_end');
} else {
  remove_action('wp_loaded', 'woorocks_buffer_start');
  remove_action('shutdown', 'woorocks_buffer_end');
}
/**
* Show in WP Dashboard notice about the plugin is not activated.
*/
/*function woorocks_dashboard_message() {
	$message = esc_html__( 'WOOROCKS :: Congratulations! You have now installed WooRocks Magic Content Plugin. All the settings can be found in the menubar to the left.', 'woorocks-magic-content' );
	$html_message = sprintf( '<div class="updated notice is-dismissable">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}*/
