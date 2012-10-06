<?php

function controller_homepage($args) {
  $digicode = url('digicode/' . user()->id);

  $inviter = model('guest')->load(user()->inviter_id);

  return array(
    'content' => view('homepage', array(
      'name' => user()->name,
      'inviter' => $inviter->name,
      'digicode' => $digicode,
      'status' => user()->status,
    )),
  );
}
