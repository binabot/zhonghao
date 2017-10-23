<?php

/**
 * @file
 * Contains \Drupal\zh\Controller\PagesController.
 */

namespace Drupal\zh\Controller;

use Drupal\zh\Utility\Theme;

/**
 * Pages Controller.
 */
class PagesController
{

  /**
   * Node storage.
   */
  private $node_storage;

  /**
   * Constructs a PagesController object.
   */
  public function __construct()
  {
    $this->node_storage = \Drupal::entityTypeManager()->getStorage('node');
  }

  /**
   * Front.
   */
  public function frontPage()
  {
    $vars = Theme::getUsefulVariables() + [

    ];

    // render tpl
    return [
      '#theme' => 'front',
      '#vars'  => $vars,
      '#cache' => [
        'max-age' => 0, // no cache
        // 'max-age' => 900, // 15 min
      ],
    ];
  }

  /**
   * About us.
   */
  public function aboutUsPage()
  {
    $vars = Theme::getUsefulVariables() + [

    ];

    // render tpl
    return [
      '#theme' => 'about_us',
      '#vars'  => $vars,
      '#cache' => [
        'max-age' => 0, // no cache
        // 'max-age' => 900, // 15 min
      ],
    ];
  }

  /**
   * Projects.
   */
  public function projectsPage()
  {
    $vars = Theme::getUsefulVariables() + [

    ];

    // render tpl
    return [
      '#theme' => 'projects',
      '#vars'  => $vars,
      '#cache' => [
        'max-age' => 0, // no cache
        // 'max-age' => 900, // 15 min
      ],
    ];
  }

  /**
   * Affiliates.
   */
  public function affiliatesPage()
  {
    $vars = Theme::getUsefulVariables() + [

    ];

    // render tpl
    return [
      '#theme' => 'affiliates',
      '#vars'  => $vars,
      '#cache' => [
        'max-age' => 0, // no cache
        // 'max-age' => 900, // 15 min
      ],
    ];
  }

  /**
   * Company culture.
   */
  public function companyCulturePage()
  {
    $vars = Theme::getUsefulVariables() + [

    ];

    // render tpl
    return [
      '#theme' => 'company_culture',
      '#vars'  => $vars,
      '#cache' => [
        'max-age' => 0, // no cache
        // 'max-age' => 900, // 15 min
      ],
    ];
  }

  /**
   * Join us.
   */
  public function joinUsPage()
  {
    $vars = Theme::getUsefulVariables() + [

    ];

    // render tpl
    return [
      '#theme' => 'join_us',
      '#vars'  => $vars,
      '#cache' => [
        'max-age' => 0, // no cache
        // 'max-age' => 900, // 15 min
      ],
    ];
  }

  /**
   * Contact us.
   */
  public function contactUsPage()
  {
    $vars = Theme::getUsefulVariables() + [

    ];

    // render tpl
    return [
      '#theme' => 'contact_us',
      '#vars'  => $vars,
      '#cache' => [
        'max-age' => 0, // no cache
        // 'max-age' => 900, // 15 min
      ],
    ];
  }

}
