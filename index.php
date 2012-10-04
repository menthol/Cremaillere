<?php

session_start();
define('BASE_DIRECTORY', __DIR__);

// Load libraries
require_once BASE_DIRECTORY . '/includes/db.php';
require_once BASE_DIRECTORY . '/includes/controllers/errors.php';
require_once BASE_DIRECTORY . '/includes/view.php';

// Load configs
require_once BASE_DIRECTORY . '/includes/config.php';

$controller = null;

$args = array();
if (!isset($_GET['q'])) {
  $controller = 'homepage';
}
else {
  $args = explode('/', $_GET['q']);
  $controller = array_shift($args);
}

if ($controller && file_exists(BASE_DIRECTORY . '/includes/controllers/' . $controller . '.php')) {
  require_once BASE_DIRECTORY . '/includes/controllers/' . $controller . '.php';
}

$controller_function = function_exists('controller_' . $controller) ? 'controller_' . $controller : 'controller_error404';

$controller_results = $controller_function($args);


print_r(array('args' => $args, 'controller' => $controller, 'function' => $controller_function));
