<?php

function controller_sendsms($args) {
  if (isset($args[0]) && isset($args[1])) {
    switch($args[1]) {
      case 1:
        if ($guest = model('guest')->load($args[0])) {
          sms::send($guest->tel, sms::generateMessage($guest));
          model('guest')->update($guest->id, array('sms' => 1));
        }
        break;
      case 2:
        if ($guest = model('guest')->load($args[0])) {
          sms::send($guest->tel, sms::generateMessage2($guest));
          model('guest')->update($guest->id, array('sms2' => 1));
        }
        break;
    }
  }
  redirect('my_guests');
}
