<?php

function controller_my_info($args) {
  $user = user();
  if (user()->is_admin && isset($args[0])) {
    $user = model('guest')->load($args[0]);
  }

  if (count($_POST)) {
    model('guest')->update($user->id, array(
      'name' => $_POST['name'],
      'tel' => $_POST['tel'],
      'more' => $_POST['more'],
      'sms' => $user->tel == $_POST['tel'] ? $user->sms : 0,
    ));
    $user = model('guest')->load($user->id);
    if (user()->is_admin) {
      redirect('my_guests');
    }
    redirect('');
  }

  return array(
    'content' => view('my_info', array(
      'user' => $user,
    )),
  );
}
