# ABOUT PROJECT

- The purpose of this project is to build a small Content Management System (CMS) like Drupal.
- Different concepts like MVC modeling, autoloading with composer, symfony routing, etc. are implemented in this project.
- In this project we are also using TWIG template engine.
- Twig is a template engine for the PHP programming language. It's an open source product.

### TECHNOLOGIES USED:

    HTML, SASS, PHP, MYSQL, TWIG, YAML

### LIBRARIES USED:

- Symfony Rounting Component
- Symfony Security Component
- Symfony HttpFoundation Component
- Intervention Image
- Bootstrap v5
- CodeSniffer

### HOW TO SETUP A PROJECT?

- Open terminal
- Change the current working directory where you want to clone the project.
- Clone a project using this command --> git clone https://github.com/Libbna/CUSTOM-CMS.git
- Now setup a database:

  - Create a database "custom_cms"
  - create a dbconfig.php and include the follow code:
    <?php
    
    $database = [
    'host' => 'DB_hostname',
    'username' => 'DB_username',
    'password' => 'DB_password',
    'database' => 'DB_name',
    ];

- after that import this sql file https://github.com/Libbna/CUSTOM-CMS/blob/master/custom_cms.sql .

For Lando Setup:

- enter this command - lando start
- create a seperate file for database config and create dbconfig.php.
- in dbconfig.php include the following code:

  <?php
  
    $database = [
    'host' => 'DB_hostname',
    'username' => 'DB_username',
    'password' => 'DB_password',
    'database' => 'DB_name',
    ];

## For creating issues and feature branch follow the below link:

- https://github.com/Libbna/CUSTOM-CMS/wiki/Steps-to-create-issues-and-branch.

# CONTRIBUTORS

- [Libbna](https://github.com/Libbna) (Libbna Mathew)
- [RChaubey16](https://github.com/RChaubey16) (Ruturaj Chaubey)
- [vbadkar](https://github.com/vbadkar) (Vivek Badkar)
- [omkar-pd](https://github.com/omkar-pd) (Omkar Deshpande)
- [AkshayDalvi15](https://github.com/AkshayDalvi15) (Akshay Dalvi)
- [Mspiro](https://github.com/Mspiro) (Meeninath Dhobale)
