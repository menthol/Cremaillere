<?php

function redirect($path, $query = null) {
  if (is_array($path)) {
    $path = implode('/', $path);
  }
  $real_path = url($path, $query);
  header("Location: $real_path");
  die();
}

function url($path, $query = null, $absolute = false, $lang = NULL) {
  if (strpos($path, '://') !== FALSE) {
    return $path . ($query ? "?$query" : null);
  }
  if (is_bool($query)) {
    $absolute = $query;
    $query = null;
  }
  return ($absolute ? 'http://' . $_SERVER['HTTP_HOST'] : null) . '/' . $path . ($query ? "?$query" : null);
}

function surl($path) {
  $url = url($path, '', true);
  $url = 'http://l.n--z.net/api?' . http_build_query(array('p' => $url));
  $url = file_get_contents($url);
  return $url;
}

function user() {
  static $user = null;

  if (func_num_args() == 1) {
    $user = null;
    if (is_numeric(func_get_arg(0))) {
      $user = model('guest')->load(func_get_arg(0));
    }
    elseif (is_object(func_get_arg(0)) && isset(func_get_arg(0)->id)) {
      $user = model('guest')->load(func_get_arg(0)->id);
    }
  }
  else {
    if (!isset($user->id) && isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
      $user = model('guest')->load($_SESSION['user_id']);
    }

    if (!isset($user->id) && isset($_COOKIE['user']) && !empty($_COOKIE['user'])) {
      $user = model('guest')->load(array('hash' => $_COOKIE['user']));
    }
  }

  if (!isset($user->id)) {
    $user = null;
    if (isset($_SESSION['user_id'])) {
      unset($_SESSION['user_id']);
    }
    if (isset($_COOKIE['user']) && $_COOKIE['user'] != 'logout') {
      setcookie('user', 'logout', strtotime('+1 SEC'));
    }
  }
  else {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $user->id) {
      $_SESSION['user_id'] = $user->id;
    }
    if (!isset($_COOKIE['user']) || $_COOKIE['user'] != $user->hash) {
      setcookie('user', $user->hash, strtotime('+30 DAYS'));
    }
  }

  return $user;
}

