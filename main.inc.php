<?php
/*
Version: 1.0
Plugin Name: TensorflowFaceTag
Plugin URI: // Here comes a link to the Piwigo extension gallery, after
           // publication of your plugin. For auto-updates of the plugin.
Author: VoidedIceberg
Description: I hope this will implemnet tensorflow to tag faces
*/

// Chech whether we are indeed included by Piwigo.
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

// Define the path to our plugin.
define('TENSORFLOWFACE_PATH', PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');
define('TFFT_ID',      basename(dirname(__FILE__)));
define('TFFT_PATH' ,   PHPWG_PLUGINS_PATH . TFFT_ID . '/');
define('TFFT_PUBLIC',  get_absolute_root_url() . make_index_url(array('section' => 'tagFace')) . '/');

$menu_file = TFFT_PATH . 'include/menu_events.class.php';

// Hook on to an event to show the administration page.
add_event_handler('get_admin_plugin_menu_links', 'tensorflow_admin_menu');
// add_event_handler('blockmanager_apply', 'tfft_apply'); 

// Add an entry to the 'Plugins' menu.
function tensorflow_admin_menu($menu) {
 array_push(
   $menu,
   array(
     'NAME'  => 'TensorflowFaceTag',
     'URL'   => get_admin_plugin_menu_link(dirname(__FILE__)).'/admin.php'
   )
 );
 return $menu;
}

// adding a menu to the menubar on the main screen
add_event_handler('blockmanager_register_blocks', array('TFFTMenu', 'blockmanager_register_blocks'),
  EVENT_HANDLER_PRIORITY_NEUTRAL, $menu_file);


?>