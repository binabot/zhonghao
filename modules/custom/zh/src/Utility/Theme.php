<?php

/**
 * @file
 * Contains \Drupal\zh\Utility\Theme.
 */

namespace Drupal\zh\Utility;

use Drupal\Core\Url;
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
      'links' => [
        'front'           => $base_url,
        'about_us'        => [
          'main_page'     => Url::fromRoute('zh.about_us'),
          'qygk'          => Url::fromRoute('zh.about_us', [], ['fragment' => 'qygk']),
          'zbzs'          => Url::fromRoute('zh.about_us', [], ['fragment' => 'zbzs']),
          'gszz'          => Url::fromRoute('zh.about_us', [], ['fragment' => 'gszz']),
        ],
        'projects'        => Url::fromRoute('zh.projects'),
        'affiliates'      => Url::fromRoute('zh.affiliates'),
        'company_culture' => Url::fromRoute('zh.company_culture'),
        'join_us'         => Url::fromRoute('zh.join_us'),
        'contact_us'      => Url::fromRoute('zh.contact_us'),
      ],
    ];
    // get current page
    $current_route_name   = \Drupal::routeMatch()->getRouteName();
    $vars['current_page'] = $current_route_name;
    if ($current_route_name == 'entity.node.canonical' && $node = \Drupal::routeMatch()->getParameter('node')) {
      if ($node->getType() === 'news') {
        $vars['current_page'] = 'zh.company_culture';
      }
    }
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
