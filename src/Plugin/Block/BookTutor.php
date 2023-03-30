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
  $user = \Drupal::routeMatch()->getParameter('user');
  $uid = $user->id();
  $account = User::load($uid);
  $is_verified = !empty($account->field_id_verified->value);
  return [
    '#theme' => 'book_tutor',
    '#verified' => $is_verified,
  ];
}

}
