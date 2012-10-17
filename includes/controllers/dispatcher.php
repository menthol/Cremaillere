<?php

function controller_dispatcher($args) {
  if (user() && user()->is_admin) {
    $quest = model('guest')->load(array('hash' => $args[0]));
    if ($quest->id) {
      redirect('my_info/' . $quest->id);
    }
    redirect('my_guests');
  }
  redirect('login/' . implode('/', $args));
}
