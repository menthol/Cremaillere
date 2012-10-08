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
  if (func_num_args() > 0) {
    if (is_numeric(func_get_arg(0))) {
      $_user = model('guest')->load(func_get_arg(0));
      $_SESSION['user_id'] = $_user->id;
      setcookie('user', $_user->hash, strtotime('+30 DAYS'));
    }
    elseif (is_object(func_get_arg(0)) && isset(func_get_arg(0)->id))
    {
      $_user = model('guest')->load(func_get_arg(0)->id);
      $_SESSION['user_id'] = $_user->id;
      setcookie('user', $_user->hash, strtotime('+30 DAYS'));
    }
    else
    {
      $_SESSION['user_id'] = null;
      $_COOKIE['user'] = uniqid();
    }
  }
  elseif (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
  {
    if (isset($_COOKIE['user'])) {
      $_user = model('guest')->load(array('hash' => $_COOKIE['user']));
      if (isset($_user->id)) {
        return user($_user);
      }
    }

    $_SESSION['user_id'] = null;
    $_COOKIE['user'] = uniqid();
  }

  if (!is_object($user) || $user->id != $_SESSION['user_id']) {
    if ($_SESSION['user_id']) {
      $user = model('guest')->load($_SESSION['user_id']);
      setcookie('user', $user->hash, strtotime('+30 DAYS'));
    }
    else
    {
      $user = null;
    }
  }
  return $user;
}

