<?php

namespace Cms\Services\ServicesClass;

/**
 * {@inheritDoc}
 */
class MessageGenerator {

  /**
   * {@inheritDoc}
   */
  public function getMessage(): string {
    $messages = [
      'You did it! You Successfully created! ',
    ];

    $index = array_rand($messages);

    return $messages[$index];
  }

}
