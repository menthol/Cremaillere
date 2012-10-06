<?php

function controller_my_guests($args) {
  $inviter = model('guest')->load(user()->inviter_id);

  if (user()->is_admin) {
    $guests = model('guest')->load('*', true);
  }
  else {
    $guests = model('guest')->load(array('inviter_id' => user()->id), true);
  }

  return array(
    'content' => view('my_guests', array(
      'inviter' => $inviter,
      'guests' => $guests,
    )),
  );
}
