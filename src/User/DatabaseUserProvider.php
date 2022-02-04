<?php

namespace Cms\User;

session_start();

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 *
 */
class DatabaseUserProvider implements UserProviderInterface {
  public $connection;

  /**
   *
   */
  public function __construct($connection) {
    $this->connection = $connection;
  }

  /**
   *
   */
  public function loadUserByUsername($username) {
    return $this->getUser($username);
  }

  /**
   *
   */
  public function getUser($username) {
    $stmt = $this->connection->prepare("SELECT * FROM userauth WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $ans = $stmt->get_result();
    $row = $ans->fetch_assoc();
    $id = $row['id'];

    if (!$row['username']) {
      $exception = new UsernameNotFoundException(sprintf('Username "%s" not found in the database.', $row['username']));
      $exception->setUsername($username);
      throw $exception;
    }
    else {
      return new User($row['username'], $row['password'], $row['roles'], $id);
    }
  }

  /**
   *
   */
  public function insertUser($username, $password, $role) {
    $stmt = $this->connection->prepare("INSERT INTO userauth(username, password, roles) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $ans = $stmt->get_result();
    return TRUE;
  }

  /**
   *
   */
  public function refreshUser(UserInterface $user) {
    if (!$user instanceof User) {
      throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
    }

    return $this->getUser($user->getUsername());
  }

  /**
   *
   */
  public function supportsClass($class) {
    return 'Cms\User\User' === $class;
  }

}
