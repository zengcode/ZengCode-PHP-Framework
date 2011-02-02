<?php
defined('SYSTEM_CLASS_PATH') or die('You can not access this file directly');

class CmsException extends Exception
 {
 public function Test1()
  {
  //error message
  $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$this->getMessage();
  return $errorMsg;
  }
 }

 class CmsException2 extends Exception
 {
 public function Test2()
  {
  //error message
  $errorMsg = '222Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$this->getMessage();
  return $errorMsg;
  }
 }

$a = 4;

try
 {
  if ($a > 5){

  throw new CmsException(" $a > 5"); //ตรงนี้โยนไป ไม่ได้แสดงผลแต่ส่งคา่ได้
  }
  if ($a < 5){

  throw new CmsException2(" $a < 5"); //ตรงนี้โยนไป ไม่ได้แสดงผลแต่ส่งคา่ได้
  }
 }

catch (CmsException $e)
 {
	echo $e->Test1();
 }
 catch (CmsException2 $e)
 {
	echo $e->Test2();
 }
 echo "<br> HELLO WORLD";



?>