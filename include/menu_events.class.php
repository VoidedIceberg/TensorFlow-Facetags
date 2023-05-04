<?php
defined('TFFT_PATH') or die('Hacking attempt!');

/*
 * There is two ways to use class methods as event handlers:
 *
 * >  add_event_handler('blockmanager_apply', array('SkeletonMenu', 'blockmanager_apply'));
 *      in this case the method 'blockmanager_apply' must be a static method of the class 'SkeletonMenu'
 *
 * >  $myObj = new SkeletonMenu();
 * >  add_event_handler('blockmanager_apply', array(&$myObj, 'blockmanager_apply'));
 *      in this case the method 'blockmanager_apply' must be a public method of the object '$myObj'
 */

class TFFTMenu
{
  /**
   * add link in existing menu
   */
  static function blockmanager_apply1($menu_ref_arr)
  {
    $menu = &$menu_ref_arr[0];

    if (($block = $menu->get_block('mbMenu')) != null)
    {
      $block->data[] = array(
        'URL' => TFFT_PUBLIC,
        'TITLE' => l10n('FaceTag'),
        'NAME' => l10n('FaceTag'),
        );
    }
  }

  /**
   * add a new menu block
   */
  static function blockmanager_register_blocks($menu_ref_arr)
  {
    $menu = &$menu_ref_arr[0];

    if ($menu->get_id() == 'menubar')
    {
      // identifier, title, owner
      $menu->register_block(new RegisteredBlock('mbTFFT', l10n('FaceTag'), 'FaceTag'));
    }
  }

  /**
   * fill the added menu block
   */
  static function blockmanager_apply2($menu_ref_arr)
  {
    $menu = &$menu_ref_arr[0];

    if (($block = $menu->get_block('mbTFFT')) != null)
    {
      $block->set_title(l10n('FaceTag'));
      $block->template = realpath(TFFT_PATH . 'template/menubar_tfft.tpl');
    }
  }
}
