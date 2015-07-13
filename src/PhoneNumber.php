<?php
namespace LeafFilter\Util;
class PhoneNumber {
  private static $util;
  private static $search_pattern = "/^(\d{3})(\d{3})(\d{4})$/";
  private static $replace_pattern = "$1-$2-$3";
  private static $initialized = false;
  private static function initialize() {
    if ( self::$initialized ) return;
    self::$util = \libphonenumber\PhoneNumberUtil::getInstance();
    self::$initialized = true;
  }
  public static function getFormattedNumber($input_string) {
    self::initialize(); 
    try {
      $number = self::$util->parse($input_string, "US");
      if ( self::$util->isValidNumber($number) ) {
        $formatted_number = preg_replace(self::$search_pattern, self::$replace_pattern, $number->getNationalNumber());
        if ( $formatted_number == $number->getNationalNumber() ) return $input_string;
        // Drop extensions - do not use below check
        /*
        if ( $number->hasExtension() ) {
          $formatted_number .= " x" . $number->getExtension();
        }
        */
        return $formatted_number;
      } else {
        return $input_string;
      }
    } catch (\libphonenumber\NumberParseException $e ) {
      return $input_string;
    }
  }  
}
