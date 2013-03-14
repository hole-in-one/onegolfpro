<?php
/**
 * simple function file
 */
class MjFunctions{

    public static function MathCaptcha(){
        $rand_int1 = substr(mt_rand(),0,2);
        $rand_int2 = substr(mt_rand(),0,1);
        $rand_int3 = substr(mt_rand(),0,1);
        $captcha_answer = $rand_int1 + $rand_int2 - $rand_int3;
        $_SESSION['captcha_answer'] = $captcha_answer;
        return $rand_int1.' + '.$rand_int2.' - '.$rand_int3." = ?";
    }
    public static function BaseIncode(){
        return base64_encode($_SESSION['captcha_answer']);
    }
    public static function BaseDecode($value){
        return base64_decode($value);
    }



}