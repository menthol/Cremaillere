<?php

function controller_digicode($args) {
  if (isset($args[0])) {
    if ($quest = model('guest')->load($args[0])) {
      require_once BASE_DIRECTORY . '/includes/contrib/phpqrcode/qrlib.php';

      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=invitation.png');
      header('Content-Transfer-Encoding: binary');
      header('Pragma: public');

      QRcode::png(surl('dispatcher/' . $quest->hash, null, true), false, 'H', 16, 3);
      die();
    }
  }
}
