<?php

function controller_actions($args) {
  if (isset($args[0])) {
    switch($args[0]) {
      case 'guests' :
        if (isset($args[1]) && in_array($args[1], array(1, 2, 3))) {
          model('guest')->update(user()->id, array('status' => $args[1]));
          if ($args[1] != 3) {
            redirect('my_info');
          }
        }
    }
  }
  redirect('');
}
