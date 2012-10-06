<?php

function controller_my_info($args) {
  $user = user();
  if (user()->is_admin && isset($args[1])) {
    $user = model('guest')->load($args[1]);
  }

  if (count($_POST)) {
    model('guest')->update($user->id, array(
      'name' => $_POST['name'],
      'tel' => $_POST['tel'],
      'more' => $_POST['more'],
    ));
    $user = model('guest')->load($user->id);
    redirect('');
  }

  return array(
    'content' => view('my_info', array(
      'user' => $user,
    )),
  );
}
