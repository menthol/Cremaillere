<?php

function controller_add_guest($args) {

  if (count($_POST)) {
    model('guest')->insert(array(
      'name' => $_POST['name'],
      'tel' => $_POST['tel'],
      'hash' => base64_encode(uniqid()),
      'inviter_id' => user()->id,
    ));
    redirect('my_guests');
  }

  return array(
    'content' => view('add_guest'),
  );
}
