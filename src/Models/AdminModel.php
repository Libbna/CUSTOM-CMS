<?php

namespace Cms\Models;

require 'vendor/autoload.php';

use Intervention\Image\ImageManager;


class AdminModel
{
    public $conn;
    public $result;
    public $sql;
    
    //establishing database connection
    public function __construct()
    {
        require './dbconfig.php';

        $this->conn = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
        if (!$this->conn) {
            echo "<h1>Datbase connection failed</h1>";
            return;
        }
    }

    // query for displaying Users 
    public function displayUsers() {
        $query = $this->conn->prepare("SELECT * FROM userauth");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function setUserToAdmin($user_id){
        // UPDATE userdetails SET bio = ? WHERE user_id = ?
        $query = $this->conn->prepare("UPDATE userauth SET roles = ? WHERE id = ?");
        $query->bind_param("si", $role, $user_id);
        $role = "admin";
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function setUserToAuth($user_id){
        $authenticated = "authenticated"; 
        $query = $this->conn->prepare("UPDATE userauth SET roles = ? WHERE id = ?");
        $query->bind_param("si", $role, $user_id);
        $role = $authenticated;

        // if logged in user who is also admin, requests to change the role.
        if ($_SESSION['user_id'] == $user_id){
            if ($_SESSION['role'] == 'admin'){
                $_SESSION['role'] = $authenticated;
            }
        }

        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }
    public function deleteUser($id){
        $query = $this->conn->prepare("DELETE FROM userauth WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        return;
    }

    // compress Image function definition
    public function resize_image($source, $path, $max_res)
    {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

        //resolution
        $original_width = imagesx($image);
        $original_height = imagesy($image);

        //width
        $ratio = $max_res / $original_width;
        $new_width = $max_res;
        $new_height = $original_height * $ratio;

        // if that didn't work
        if ($new_height > $max_res) {
            $ratio = $max_res / $original_height;
            $new_height = $max_res;
            $new_width = $original_width * $ratio;
        }

        if ($image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        }

        imagejpeg($new_image, $path, 90);
    }

    // funtion insert logo
    public function insertLogo() {
        $logo = $_FILES['logo_upload']['name'];
        $logo_tmp = $_FILES['logo_upload']['tmp_name'];
        

        $profile_ext = explode('.',  $logo);
        $filecheck = strtolower(end($profile_ext));

        $file_ext_stored = array('jpeg', 'png', 'jpg');

        // creating new image name of numbers
        $new_logo = time() . '.' . $filecheck;

        // location
        $location = '/assets/images/logo/' . $new_logo;
        $resized_loc = '/assets/images/logo/resized_' . $new_logo;

        // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

        if (in_array($filecheck, $file_ext_stored)) {
            // $destinationFile = 'assets/images/logo/' . $logo;

            // $manager = new ImageManager(['driver' => 'gd']);
            // $image = $manager->make($file)->resize(50,50);

            move_uploaded_file($logo_tmp, $location);

            $this->resize_image($location, $resized_loc, "500");

            $query = $this->conn->prepare("INSERT INTO config(logo) VALUES(?)");
            $query->bind_param("s", $new_logo);
            $query->execute();
            $ans = $query->get_result();
            return $ans;

        }
    }

    
   
}