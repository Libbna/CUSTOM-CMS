<?php

namespace Cms\User;

session_start();

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * A class DatabaseUserProvider implementing UserProviderInterface.
 *
 * @category Content_Management_System
 * @package User
 * @license License v3
 * @link https://github.com/Libbna/CUSTOM-CMS#readme
 */
class DatabaseUserProvider implements UserProviderInterface {
  /**
   * {@inheritdoc}
   */

  public $connection;

  /**
   * Constructs connection variable.
   *
   * {@inheritdoc}
   */
  public function __construct($connection) {
    $this->connection = $connection;
  }

  /**
   * Loads the user for the given username.
   *
   *   {@inheritdoc}
   */
  public function loadUserByUsername($username) {
    return $this->getUser($username);
  }

  /**
   * To fetch the user.
   *
   *   {@inheritdoc}
   */
  public function getUser($username) {
    $stmt = $this->connection->prepare(
          'SELECT * FROM userauth WHERE username = ?'
      );
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $ans = $stmt->get_result();
    $row = $ans->fetch_assoc();
    $id = $row['id'];

    if (!$row['username']) {
      return 0;
    }
    else {
      return new User(
            $row['username'],
            $row['password'],
            $row['roles'],
            $id
            );
    }
  }

  /**
   * To insert user details.
   *
   *   {@inheritdoc}
   */
  public function insertUser($username, $password, $role) {
    $stmt = $this->connection->prepare(
      'INSERT INTO userauth(username, password, roles) VALUES(?, ?, ?)'
    );
    $stmt->bind_param('sss', $username, $password, $role);
    $stmt->execute();
    return TRUE;
  }

  /**
   * Refreshes the user.
   *
   *   {@inheritdoc}
   */
  public function refreshUser(UserInterface $user) {
    if (!$user instanceof User) {
      throw new UnsupportedUserException(
            sprintf(
                'Instances of "%s" are not supported.',
                get_class($user)
            )
        );
    }
  }

  /**
   * Whether this provider supports the given user class.
   *
   *   {@inheritdoc}
   */
  public function supportsClass($class) {
    return 'Cms\User\User' === $class;
  }

}
