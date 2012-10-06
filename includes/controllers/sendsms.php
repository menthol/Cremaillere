<?php

function controller_sendsms($args) {
  if (isset($args[0])) {
    if ($guest = model('guest')->load($args[0])) {
      sms::send($guest->tel, sms::generateMessage($guest));
      model('guest')->update($guest->id, array('sms' => 1));
    }
  }
  redirect('my_guests');
}
