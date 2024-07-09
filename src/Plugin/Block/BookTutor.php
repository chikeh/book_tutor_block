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

  /**
   * Load the current user from route context instead.
 */

if ($user = \Drupal::routeMatch()->getParameter('user')) {
  $uid = $user->id();
  $account = User::load($uid);
  $is_verified = !empty($account->field_id_verified->value);
  $first_name = $account->field_first_name->value ?? '';
  // Set the user role variable
  $roles = $user->getRoles();
  if(in_array('tutor', $roles)) {
    $current_role = 'tutor';
  }
}

return [
  '#theme' => 'book_tutor',
  '#verified' => $is_verified,
  '#firstname' => $first_name,  
  '#currentrole' => $current_role,
  '#cache' => array('max-age' => 0),
];
}
}