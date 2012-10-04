<?php

if (file_exists(BASE_DIRECTORY . '/includes/config.local.php')) {
  require_once BASE_DIRECTORY . '/includes/config.local.php';
}
else {
  db::connect(array(
    'datasource' => 'mysql:host=localhost;dbname=cremaillere',
    'username' => 'root',
    'password' => 'root',
    'options' => array(
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    ),
  ));
}
