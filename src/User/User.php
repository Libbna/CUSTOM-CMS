<?php

namespace Cms\User;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * A class representing a user interfaces methods.
 *
 * @category Content_Management_System
 * @package User
 * @license License v3
 * @link https://github.com/Libbna/CUSTOM-CMS#readme
 */
class User implements UserInterface {
  /**
   * {@inheritdoc}
   */
  public $username;
  /**
   * {@inheritdoc}
   */
  public $password;
  /**
   * {@inheritdoc}
   */
  public $roles;

  /**
   * Contructs username, password, role and user id objects.
   *
   * @param string $username
   *   Name of the user.
   * @param string $password
   *   Password of the user.
   * @param string $roles
   *   User Role.
   * @param int $user_id
   *   User id.
   */
  public function __construct(
        string $username,
        string $password,
        string $roles,
        int $user_id
    ) {
    if (empty($username)) {
      throw new \InvalidArgumentException('No username provided.');
    }
    $this->username = $username;
    $this->password = $password;
    $this->roles = $roles;
    $this->user_id = $user_id;
  }

  /**
   * Method to fetch the username.
   *
   * {@inheritdoc}
   */
  public function getUsername() {
    return $this->username;
  }

  /**
   * Method to fetch the password.
   *
   * {@inheritdoc}
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Method to fetch the roles to a user.
   *
   * {@inheritdoc}
   */
  public function getRoles() {
    $role = explode(',', $this->roles);
    return $role[0];
  }

  /**
   * Method to fetch the user id.
   *
   * {@inheritdoc}
   */
  public function getUserId() {
    return $this->user_id;
  }

  /**
   * Returns the salt that was originaly used to encode a password.
   *
   * {@inheritdoc}
   */
  public function getSalt() {
    return '';
  }

  /**
   * Removes the sensitve data from the user.
   */
  public function eraseCredentials() {
  }

}
