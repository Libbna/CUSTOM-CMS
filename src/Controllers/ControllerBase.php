<?php

namespace Cms\Controllers;

use Cms\Models\AdminModel;
use Cms\Models\Database;

/**
 * {@inheritdoc}
 */
class ControllerBase {
  /**
   * {@inheritdoc}
   */
  protected $page = [];

  /**
   * {@inheritdoc}
   */
  protected $reverie = 'Reverie';

  /**
   * {@inheritdoc}
   */
  protected function preprocessPage() {
    $this->page['nav_links'] = $this->getNavLinks();
    $this->page['base_url'] = $this->getBaseUrl();
    $this->page['logo'] = $this->getLogoDisplay();
    $this->page['footer'] = $this->getFooterDisplay();
    return $this->page;
  }

  /**
   * {@inheritdoc}
   */
  protected function getNavLinks() {
    $displayMenu = new Database();
    $result = $displayMenu->displayMenu();
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  protected function getBaseUrl() {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $base = explode("load_route", $url);
    return $base[0];
  }

  /**
   * {@inheritdoc}
   */
  protected function getLogoDisplay() {
    $displayLogo = new AdminModel();
    $result = $displayLogo->displayLogo();
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  protected function getFooterDisplay() {
    $displayFooter = new AdminModel();
    $result = $displayFooter->getFooterDetails();
    return $result;
  }

}
