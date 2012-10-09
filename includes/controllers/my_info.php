<?php

function controller_my_info($args) {
  $user = user();
  if (user()->is_admin && isset($args[0])) {
    $user = model('guest')->load($args[0]);
  }

  if (count($_POST)) {

    $data = array(
      'name' => $_POST['name'],
      'tel' => $_POST['tel'],
      'gift' => $_POST['gift'],
      'more' => $_POST['more'],
      'arrival' => $_POST['arrival'],
      'departure' => $_POST['departure'],
      'cnt_adults' => $_POST['cnt_adults'],
      'cnt_children' => $_POST['cnt_children'],
      'cnt_babies' => $_POST['cnt_babies'],
      'transport' => $_POST['transport'],
    );

    if (user()->is_admin) {
      $data += array(
        'inviter_id' => $_POST['inviter_id'],
        'is_admin' => $_POST['is_admin'],
        'status' => $_POST['status'],
        'sms' => $_POST['sms'],
      );
    }

    model('guest')->update($user->id, $data);
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
