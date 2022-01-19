<?php

namespace Cms\Models;

require 'vendor/autoload.php';

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class AdminModel
{
    public $conn;
    public $result;
    public $sql;

    //establishing database connection
    public function __construct()
    {
        require './dbconfig.php';

        $this->conn = mysqli_connect(
            $database['host'],
            $database['user'],
            $database['password'],
            $database['dbName']
        );
        if (!$this->conn) {
            echo '<h1>Datbase connection failed</h1>';
            return;
        }
    }

    // query for displaying Users
    public function displayUsers()
    {
        $query = $this->conn->prepare('SELECT * FROM userauth');
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function setUserToAdmin($user_id)
    {
        // UPDATE userdetails SET bio = ? WHERE user_id = ?
        $query = $this->conn->prepare(
            'UPDATE userauth SET roles = ? WHERE id = ?'
        );
        $query->bind_param('si', $role, $user_id);
        $role = 'admin';
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function setUserToAuth($user_id)
    {
        $authenticated = 'authenticated';
        $query = $this->conn->prepare(
            'UPDATE userauth SET roles = ? WHERE id = ?'
        );
        $query->bind_param('si', $role, $user_id);
        $role = $authenticated;

        // if logged in user who is also admin, requests to change the role.
        if ($_SESSION['user_id'] == $user_id) {
            if ($_SESSION['role'] == 'admin') {
                $_SESSION['role'] = $authenticated;
            }
        }

        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
    public function deleteUser($id)
    {
        $query = $this->conn->prepare('DELETE FROM userauth WHERE id = ?');
        $query->bind_param('i', $id);
        $query->execute();
        return;
    }

    // funtion insert logo
    public function updateLogo($site_name, $configId)
    {
        $logo = $_FILES['logo_upload'];
        $file = $logo['name'];
        $file_tmp = $logo['tmp_name'];

        $profile_ext = explode('.', $file);
        $filecheck = strtolower(end($profile_ext));

        $file_ext_stored = ['jpeg', 'png', 'jpg'];

        // location
        $location = 'assets/images/logo/' . $file;
        $resized_loc = 'assets/images/logo/resized_' . $file;

        // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

        if (in_array($filecheck, $file_ext_stored)) {
            $manager = new ImageManager(['driver' => 'gd']);

            $img = Image::make($file_tmp)
                ->resize(50, 50)
                ->save($resized_loc);

            move_uploaded_file($img, $resized_loc);
        }
        $query = $this->conn->prepare(
            'UPDATE config SET logo = ?, siteName = ? WHERE id = ?'
        );
        $query->bind_param('ssi', $resized_loc, $site_name, $configId);
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    // display logo
    public function displayLogo()
    {
        $query = $this->conn->prepare(
            'SELECT * FROM config ORDER BY id DESC LIMIT 1'
        );
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function usersEmpty()
    {
        $query = $this->conn->prepare(
            'SELECT * FROM userauth'
        );
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
}
