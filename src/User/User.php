<?php
/**
 * Set the user details like name, password, email, etc.
 *
 * @category Content_Management_System
 * @package  User
 * @author   Author <author@gmail.com>
 * @license  License v3
 * @link     https://github.com/Libbna/CUSTOM-CMS#readme
 */
namespace Cms\User;

use Symfony\Component\Security\Core\User\UserInterface;
/**
 * A class representing a user interfaces methods.
 *
 * @category Content_Management_System
 * @package  User
 * @author   Author <author@gmail.com>
 * @license  License v3
 * @link     https://github.com/Libbna/CUSTOM-CMS#readme
 */
class User implements UserInterface
{
    public $username;
    public $password;
    public $roles;
    /**
     * Contructs username, password, role and user id objects.
     *
     * @param string $username Name of the user.
     * @param string $password Password of the user.
     * @param string $roles    User Role.
     * @param string $user_id  User id.
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
     * @return void
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * Method to fetch the password.
     *
     * @return void
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Method to fetch the roles to a user.
     *
     * @return void
     */
    public function getRoles()
    {
        $role = explode(',', $this->roles);
        return $role[0];
    }
    /**
     * Method to fetch the user id.
     *
     * @return void
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    /**
     * Returns the salt that was originaly used to encode a password.
     *
     * @return void
     */
    public function getSalt()
    {
        return '';
    }
    /**
     * Removes the sensitve data from the user.
     *
     * @return void
     */
    public function eraseCredentials()
    {
    }
}
