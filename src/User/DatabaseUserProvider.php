<?php
/**
 * Database methods to store and fetch user details.
 *
 * @category Content_Management_System
 * @package  User_Database
 * @author   Author <author@gmail.com>
 * @license  License v3
 * @link     https://github.com/Libbna/CUSTOM-CMS#readme
 */
namespace Cms\User;

session_start();

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Cms\User\User;

/**
 * A class DatabaseUserProvider implementing UserProviderInterface.
 *
 * @category Content_Management_System
 * @package  User
 * @author   Author <author@gmail.com>
 * @license  License v3
 * @link     https://github.com/Libbna/CUSTOM-CMS#readme
 */
class DatabaseUserProvider implements UserProviderInterface
{
    public $connection;
    /**
     * Constructs connection variable.
     *
     * @param $connection Establish Connection.
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    /**
     * Loads the user for the given username.
     *
     * @param $username Name of he user.
     *
     * @return void
     */
    public function loadUserByUsername($username)
    {
        return $this->getUser($username);
    }
    /**
     * To fetch the user.
     *
     * @param $username Name of he user.
     *
     * @return void
     */
    public function getUser($username)
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM userauth WHERE username = ?'
        );
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $ans = $stmt->get_result();
        $row = $ans->fetch_assoc();
        $id = $row['id'];

        if (!$row['username']) {
            $exception = new UsernameNotFoundException(
                sprintf(
                    'Username "%s" not found in the database.',
                    $row['username']
                )
            );
            $exception->setUsername($username);
            throw $exception;
        } else {
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
     * @param $username Name of the user.
     * @param $password Password of the user.
     * @param $role     User Role.
     *
     * @return void
     */
    public function insertUser($username, $password, $role)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO userauth(username, password, roles) VALUES(?, ?, ?)'
        );
        $stmt->bind_param('sss', $username, $password, $role);
        $stmt->execute();
        $ans = $stmt->get_result();
        return true;
    }
    /**
     * Refreshes the user.
     *
     * @param $user UserInterface variable.
     *
     * @return void
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    get_class($user)
                )
            );
        }

        return $this->getUser($user->getUsername());
    }
    /**
     * Whether this provider supports the given user class.
     *
     * @param $class Class variable.
     *
     * @return void
     */
    public function supportsClass($class)
    {
        return 'Cms\User\User' === $class;
    }
}
