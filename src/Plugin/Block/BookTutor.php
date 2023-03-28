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
  $account = User::load(\Drupal::currentUser()->id());
  $is_verified = !empty($account->get('field_is_verified')[0]->value);
  return [
    '#theme' => 'book_tutor',
    '#verified' => $is_verified,
  ];
}

}
