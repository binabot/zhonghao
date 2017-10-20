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
   * Front page
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












}
