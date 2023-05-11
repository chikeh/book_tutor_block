<?php

namespace Drupal\dol_book_tutor\Plugin\Block;

use Drupal\Core\Block\BlockBase;

use Drupal\user\Entity\User;

/**
 * Provides a 'Book Tutor' Block.
 *
 * @Block(
 *   id = "book_tutor",
 *   admin_label = @Translation("Book Tutor block"),
 *   category = @Translation("Tutors"),
 * )
 */
class BookTutor extends BlockBase {

  /**
   * {@inheritdoc}
   */

  /**
   * Fetch value of field_is_verified bolean.
 */

public function build() {
  //load the user in one line: $account = User::load(\Drupal::currentUser()->id());
  //load the user id in two steps: $uid = \Drupal::currentUser()->id();
  //$account = User::load($uid);
  //$is_verified = !empty($account->get('field_id_verified')[0]->value);
 /**
   * Load the current user from route context instead.
 */
$cacheability = new \Drupal\Core\Cache\CacheableMetadata();
if ($user = \Drupal::routeMatch()->getParameter('user')) {
  $uid = $user->id();
  $account = User::load($uid);
  $is_verified = !empty($account->field_id_verified->value);
  \Drupal::messenger()->addMessage(json_encode($account->field_first_name->value). 'first name value');
  $first_name = !empty($account->field_first_name->value);
  // Set the user role variable
  $roles = $user->getRoles();
  if(in_array('tutor', $roles)) {
    $current_role = 'tutor';
  }
  // Add the user as a cache dependency in case the verified value changes.
  $cacheability->addCacheableDependency($account);
}
$build = [
  '#theme' => 'book_tutor',
  '#verified' => $is_verified,
  '#firstname' => $first_name,
  '#current_role' => $current_role,
  // Adding path as cache context because the user in the route parameter might
  // change.
  '#cache' => ['contexts' => ['url.path']]
];
// Apply the caching metadata to the build render array.
$cacheability->applyTo($build);
return $build;
}
}
  





/* refactored code
  $current_role = NULL; // Or 'anonymous'.
  $is_verified = FALSE;
  // Now add all your checks.
  if ($user = \Drupal::routeMatch()-->getParameter ('user')) {
    $uid = $user->id();
    $account = User::load($uid);
    if ($account->hasField('field_id_verified') && !($account->get('field_id_verified')->isEmpty())) {
    $is_verified = $account->field_id_verified->value;
    }
    if (in_array('tutor', $user->getRoles())) {
      $current_role = 'tutor';
    }
  }
  return [
    '#theme' => 'book_tutor',
    '#verified' => $is_verified,
    '#current_role' => $current_role,
  ]; */
