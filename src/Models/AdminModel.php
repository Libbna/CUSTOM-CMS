<?php

namespace Cms\Models;

require 'vendor/autoload.php';

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\Request;

/**
 * {@inheritdoc}
 */
class AdminModel {
  /**
   * {@inheritdoc}
   */
  public $conn;
  /**
   * {@inheritdoc}
   */
  public $result;
  /**
   * {@inheritdoc}
   */
  public $sql;

  /**
   * Establishing database connection.
   */
  public function __construct() {
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

  /**
   * Query for displaying Users.
   */
  public function displayUsers() {
    $query = $this->conn->prepare('SELECT * FROM userauth');
    $query->execute();
    $ans = $query->get_result();
    return $ans;
  }

  /**
   * {@inheritdoc}
   */
  public function setUserToAdmin($user_id) {
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

  /**
   * {@inheritdoc}
   */
  public function setUserToAuth($user_id) {
    $authenticated = 'authenticated';
    $query = $this->conn->prepare(
          'UPDATE userauth SET roles = ? WHERE id = ?'
      );
    $query->bind_param('si', $role, $user_id);
    $role = $authenticated;

    // If logged in user who is also admin, requests to change the role.
    if ($_SESSION['user_id'] == $user_id) {
      if ($_SESSION['role'] == 'admin') {
        $_SESSION['role'] = $authenticated;
      }
    }

    $query->execute();
    $ans = $query->get_result();
    return $ans;
  }

  /**
   * {@inheritdoc}
   */
  public function deleteUser($id) {
    $query = $this->conn->prepare('DELETE FROM userauth WHERE id = ?');
    $query->bind_param('i', $id);
    $query->execute();
  }

  /**
   * Funtion insert logo.
   */
  public function updateLogo($site_name, $alt_text, $configId) {
    $request = Request::createFromGlobals();
    $logo = $request->files->get('logo_upload');
    // dump($logo);
    // die();
    $file = $logo->getClientOriginalName();
    $file_tmp = $logo->getRealPath();

    $profile_ext = explode('.', $file);
    $filecheck = strtolower(end($profile_ext));

    $file_ext_stored = ['jpeg', 'png', 'jpg'];

    // Location.
    $location = 'assets/images/logo/' . $file;
    $resized_loc = 'assets/images/logo/resized_' . $file;

    // File extension.
    $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    if (in_array($filecheck, $file_ext_stored)) {
      $manager = new ImageManager(['driver' => 'gd']);

      $img = Image::make($file_tmp, $manager)
        ->resize(50, 50)
        ->save($resized_loc);

      move_uploaded_file($img, $resized_loc);
    }
    $query = $this->conn->prepare(
          'UPDATE config SET logo = ?, alt_text = ? ,siteName = ? WHERE id = ?'
      );
    $query->bind_param(
          'sssi',
          $resized_loc,
          $alt_text,
          $site_name,
          $configId
      );
    $query->execute();
    $ans = $query->get_result();
    return $ans;
  }

  /**
   * {@inheritdoc}
   */
  public function updateFooter($desc, $location, $contact, $email) {
    $query = $this->conn->prepare(
          'UPDATE footerDetails SET description = ?, location = ?, contact = ?, email = ?'
      );
    $query->bind_param('ssss', $desc, $location, $contact, $email);
    $query->execute();
    $ans = $query->get_result();
    return $ans;
  }

  /**
   * Display logo.
   */
  public function displayLogo() {
    $query = $this->conn->prepare(
          'SELECT * FROM config ORDER BY id DESC LIMIT 1'
      );
    $query->execute();
    $ans = $query->get_result();
    return $ans;
  }

  /**
   * {@inheritdoc}
   */
  public function getFooterDetails() {
    $query = $this->conn->prepare('SELECT * FROM footerDetails');
    $query->execute();
    $ans = $query->get_result();
    return $ans;
  }

  /**
   * {@inheritdoc}
   */
  public function usersEmpty() {
    $query = $this->conn->prepare('SELECT * FROM userauth');
    $query->execute();
    $ans = $query->get_result();
    return $ans;
  }

}
