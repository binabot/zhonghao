<?php

/**
 * @file
 * Contains \Drupal\zh\Controller\PagesController.
 */

namespace Drupal\zh\Controller;

use Drupal\zh\Utility\Theme;
use Drupal\field\Entity\FieldConfig;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Url;

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
      'news'       => $this->getLastNews('新闻资讯'),
      'activities' => $this->getLastNews('公司活动'),
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
   * Get news node tpl variables.
   */
  private function getLastNews($type, $count = 4)
  {
    $output     = [];
    $node_query = \Drupal::entityQuery('node');
    $node_query->condition('type', 'news', '=');
    $node_query->condition('status', 1, '=');
    $node_query->condition('field_article_type', $type, '=');
    $node_query->sort('created', 'DESC');
    $node_query->sort('nid', 'DESC'); // second sort
    $node_query->range(0, $count); // last x articles
    $nids = $node_query->execute();
    if (!empty($nids)) {
      $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);
      foreach ($nodes as $nid => $n) {
        // image
        if ($n->get('field_tupian')->entity) {
          $image_uri = $n->get('field_tupian')->entity->getFileUri();
        } else {
          $image_field           = FieldConfig::loadByName('node', 'news', 'field_tupian');
          $image_default_setting = $image_field->getSetting('default_image');
          $image_default_file    = $this->loadEntityByUuid('file', $image_default_setting['uuid']);
          $image_uri             = $image_default_file->getFileUri();
        }
        $image_url = ImageStyle::load('scale_270x180')->buildUrl($image_uri);
        // set output
        $output[$nid] = [
          'title'   => $n->getTitle(),
          'image'   => $image_url,
          'summary' => $n->get('field_article_summary')->value,
          'link'    => Url::fromRoute('entity.node.canonical', ['node' => $nid]),
        ];
      }
    }
    return $output;
  }

  /**
   * Loads an entity by UUID.
   *
   * The \Drupal::entityManager() will be removed before Drupal 9.0.0. So we use
   * \Drupal::entityTypeManager() instead in most cases. On the other hand, the
   * needed method loadEntityByUuid is not on \Drupal\Core\Entity\EntityTypeManagerInterface
   * . So we realize our loadEntityByUuid static function.
   *
   * @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21EntityRepository.php/function/EntityRepository%3A%3AloadEntityByUuid/8
   *
   * @param string $entity_type_id
   *   ID of the entity type.
   * @param string $uuid
   *   The UUID of the entity to load.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   The entity object, or NULL if there is no entity with the given UUID.
   */
  private function loadEntityByUuid($entity_type_id, $uuid)
  {
    $entity_type = \Drupal::entityTypeManager()->getDefinition($entity_type_id);
    if (!$uuid_key = $entity_type->getKey('uuid')) {
      throw new EntityStorageException("Entity type $entity_type_id does not support UUIDs.");
    }
    $entities = \Drupal::entityTypeManager()->getStorage($entity_type_id)->loadByProperties([$uuid_key => $uuid]);
    return reset($entities);
  }

  /**
   * Join us.
   */
  public function joinUsPage()
  {
    $vars = Theme::getUsefulVariables() + [
      'jobs' => [],
    ];
    // set jobs
    $jobs = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties([
      'type' => 'zhaopin',
      'status' => 1,
    ]);
    foreach ($jobs as $nid => $node) {
      $vars['jobs'][$nid] = [
        'title'       => $node->getTitle(),
        'number'      => $node->get('field_zp_number')->value,
        'work_place'  => $node->get('field_zp_work_place')->value,
        'salary'      => $node->get('field_zp_salary')->value,
        'description' => $node->get('field_zp_description')->value,
      ];
    }
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
