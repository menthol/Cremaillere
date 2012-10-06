<?php

function controller_sendsms($args) {
  if (isset($args[0])) {
    if ($guest = model('guest')->load($args[0])) {
      sms::send($guest->tel, sms::generateMessage($guest));
    }
  }
  redirect('');
}
