<?php
use LeafFilter\Util\PhoneNumber as PhoneNumber;
class PhoneNumberTest extends PHPUnit_Framework_TestCase {
  public function testGetFormattedNumberReturnsInvalidPhoneNumberUnchanged() {
    $testValue = "1 (555) 555-4804";
    $result = PhoneNumber::getFormattedNumber($testValue); 
    $this->assertEquals($testValue, $result);
  }
  public function testGetFormattedNumberReturnsShortPhoneNumberUnchanged() {
    $testValue = "1 (330) 480-480";
    $result = PhoneNumber::getFormattedNumber($testValue); 
    $this->assertEquals($testValue, $result);
  }
  public function testGetFormattedNumberReturnsSentenceContainingPhoneNumberUnchanged() {
    $testValue = "My phone number is 1 (330) 480-4804. Please call soon!";
    $result = PhoneNumber::getFormattedNumber($testValue); 
    $this->assertEquals($testValue, $result);
  }
  public function testGetFormattedNumberReturnsValidPhoneNumberFormattedCorrectly() {
    $testValue = "1 (330) 480-4804";
    $result = PhoneNumber::getFormattedNumber($testValue); 
    $this->assertEquals("330-480-4804", $result);
  }
}
