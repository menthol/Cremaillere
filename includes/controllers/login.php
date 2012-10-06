<?php

function controller_login($args) {
  if (isset($args[0])) {
    // if the user can login.
    if ($user = model('guest')->load(array('hash' => $args[0]))) {
      user($user);
    }
  }
  redirect('');
}
