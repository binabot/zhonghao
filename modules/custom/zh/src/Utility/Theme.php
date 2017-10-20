<?php

/**
 * @file
 * Contains \Drupal\zh\Utility\Theme.
 */

namespace Drupal\zh\Utility;

// use Drupal\Core\Url;
// use Drupal\webform\Entity\Webform;
// use Drupal\Core\Database\Database;
// use Drupal\image\Entity\ImageStyle;

/**
 * Theme.
 */
class Theme
{

  /**
   * Get useful variables.
   */
  public static function getUsefulVariables()
  {
    return [
      'image_directory' => '/' . \Drupal::theme()->getActiveTheme()->getPath() . '/images/',
    ];
  }

  /**
   * Get header tpl.
   */
  public static function getHeaderTpl()
  {
    global $base_url;
    $vars = self::getUsefulVariables() + [

    ];
    // get current page
    /*
    $current_route_name = \Drupal::routeMatch()->getRouteName();
    switch ($current_route_name) {
      case 'ficelles.hansanders':
        $vars['current_page'] = 'hansanders';
        break;
      case 'ficelles.nos_montures':
      case 'ficelles.nos_solaires':
      case 'ficelles.nos_lentilles':
        $vars['current_page'] = 'produit';
        break;
      case 'ficelles.nos_magasins':
        $vars['current_page'] = 'magasin';
        break;
      case 'ficelles.nos_actualites':
        $vars['current_page'] = 'actualite';
        break;
      case 'ficelles.contact':
        $vars['current_page'] = 'contact';
        break;
      case 'ficelles.affiliation':
        $vars['current_page'] = 'affiliation';
        break;
    }
    if ($current_route_name == 'entity.node.canonical' && $get_parameter_node = \Drupal::routeMatch()->getParameter('node')) {
      $get_parameter_node_type = $get_parameter_node->getType();
      switch ($get_parameter_node_type) {
        case 'magasin':
          $vars['current_page'] = 'magasin';
          break;
        case 'actualite':
          $vars['current_page'] = 'actualite';
          break;
      }
    }
    */

    // render tpl
    $tpl_path = \Drupal::theme()->getActiveTheme()->getPath() . '/templates/Element/header.html.twig';
    $tpl      = \Drupal::service('twig')->loadTemplate($tpl_path);
    return $tpl->render($vars);
  }

  /**
   * Get footer tpl.
   */
  public static function getFooterTpl()
  {
    $vars = self::getUsefulVariables() + [

    ];
    $tpl_path = \Drupal::theme()->getActiveTheme()->getPath() . '/templates/Element/footer.html.twig';
    $tpl      = \Drupal::service('twig')->loadTemplate($tpl_path);
    return $tpl->render($vars);
  }

}
