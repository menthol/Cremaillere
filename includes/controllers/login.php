<?php

function controller_login($args) {
  if (isset($args[0])) {
    // if the user can login.
    if ($user = model('guest')->load(array('hash' => $args[0]))) {
      if (user($user) && isset($args[1])) {
        model('guest')->update(user()->id, array('status' => $args[1]));
      }
    }
  }
  if(user()->is_admin) {
    redirect('my_guests');
  }
  redirect('');
}
