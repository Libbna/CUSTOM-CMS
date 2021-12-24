<?php
namespace Cms\User;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $username;
    private $password;
    private $roles;

    public function __construct(string $username, string $password, string $roles)
    {
        if (empty($username))
        {
            throw new \InvalidArgumentException('No username provided.');
        }

        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        $role = explode(",", $this->roles);
        return $role[0];
    }

    public function getSalt()
    {
        return '';
    }

    public function eraseCredentials() {}
}