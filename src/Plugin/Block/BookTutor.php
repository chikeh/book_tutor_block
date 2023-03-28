<?php

namespace Drupal\dol_book_tutor\Plugin\Block;

use Drupal\Core\Block\BlockBase;

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
   * Implements template_preprocess_user for user.html.twig.
 */
 function dol_book_tutor_preprocess_user(&$variables) {
   // Load the current user.
   $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

   // Get field data from that user.
   $variables['id-verified'] = $user->get('field_id_verified')->value;
   }

  public function build() {
    return [
      '#theme' => 'book_tutor',
    ];
  }

}
