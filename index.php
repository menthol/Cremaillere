<?php
session_set_cookie_params(3600 * 24 * 30);
session_start();
define('BASE_DIRECTORY', __DIR__);

// Load libraries
require_once BASE_DIRECTORY . '/includes/functions.php';
require_once BASE_DIRECTORY . '/includes/db.php';
require_once BASE_DIRECTORY . '/includes/sms.php';
require_once BASE_DIRECTORY . '/includes/controllers/errors.php';
require_once BASE_DIRECTORY . '/includes/view.php';

// Load configs
require_once BASE_DIRECTORY . '/includes/config.php';

// Execute page.
$controller = null;

$args = array();
if (!isset($_GET['q'])) {
  $controller = 'homepage';
}
else {
  $args = explode('/', $_GET['q']);
  $controller = array_shift($args);
}

if ($controller == 'homepage' && isset($args[0])) {
  user(model('guest')->load(array('hash' => $args[0])));
}

if (
  $controller
  && file_exists(BASE_DIRECTORY . '/includes/controllers/' . $controller . '.php')
  && (
    in_array($controller,array('login', 'dispatcher'))
    || user()
  )
) {
  require_once BASE_DIRECTORY . '/includes/controllers/' . $controller . '.php';
}

$controller_function = function_exists('controller_' . $controller) ? 'controller_' . $controller : 'controller_error404';

$controller = $controller_function == 'controller_error404' ? 'error404' : $controller;

$controller_results = $controller_function($args);
if (!is_array($controller_results)) {
  $controller_results = controller_error404($args);
  $controller = 'error404';
}
$controller_results['controller'] = $controller;

echo view('layout', $controller_results);

