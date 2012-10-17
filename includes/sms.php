<?php

class sms {

  static $user, $password, $account, $sender;

  public static function setCredentials($user, $password, $account, $sender) {
    self::$user = $user;
    self::$password = $password;
    self::$account = $account;
    self::$sender = $sender;
  }

  public static function send($to, $msg) {
    try {
      if (self::phoneNumberCleaner($to)) {
        $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.48.wsdl");
        $soap->telephonySmsUserSend(self::$user, self::$password, self::$account, self::phoneNumberCleaner(self::$sender), self::phoneNumberCleaner($to), $msg, "2160", "1", "0", "3", "2", "", true);
      }
    }
    catch(SoapFault $fault) {
    }
  }

  public static function phoneNumberCleaner($phone_number) {
    $phone_number = preg_replace('#([\.\- \(\)])#', '', trim($phone_number));
    if (strpos($phone_number, '00') === 0) {
      $phone_number = '+' . substr($phone_number, 2);
    }

    if (strpos($phone_number, '0') === 0) {
      $phone_number = '+33' . substr($phone_number, 1);
    }

    if (preg_match('#^\+[0-9]{10,}$#', $phone_number)) {
      return $phone_number;
    }
    return null;
  }

  public static function generateMessage($guest) {
    $inviter = model('guest')->load($guest->inviter_id);
    if ($inviter->id == 1) {
      return 'Oyé ' . $guest->name .
        ', c\'est ' . $inviter->name .
        '! Envie de faire la fête? Rdv le 27 oct chez moi pour ma cremaillère ! Invitation sur ' .
        surl('dispatcher/' . $guest->hash);
    }
    else {
      return 'Oyé ' . $guest->name .
        ', c\'est ' . $inviter->name .
        '! Envie de faire la fête? Rdv le 27 oct chez nath pour sa cremaillère ! Invitation sur ' .
        surl('dispatcher/' . $guest->hash);
    }
  }

  public static function generateMessage2($guest) {
    return 'Oyé ' . $guest->name .
      'Dans 10 jours c’est la crémaillère de Nath! Dimanche il sera trop tard pour répondre !
Je viens : ' . surl('dispatcher/' . $guest->hash . '/1') . '
Je ne viens pas : ' . surl('dispatcher/' . $guest->hash . '/3') . '
Ou par sms/tel au 0641686775.
Informations :' . surl('dispatcher/' . $guest->hash);
  }
}
