<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_library {

    public function __construct() {
        date_default_timezone_set('Asia/Bangkok');
    }

    function getAvatars($user_avatars) {
        $text1=$user_avatars;
        $text2=mb_substr($text1, 0, 34);
        $id_photo=mb_substr($text2, -32, 32);

        if ($id_photo=="") {
            return "";
        }

        else {
            return $id_photo;
        }
    }

    // email validation
    public function validateEmail($email) {
        return preg_match('/^[^\@]+@.*.[a-z]{2,15}+.*.[a-z]$/i', $email)?TRUE: FALSE;
    }

    // mobile validation
    public function validateMobile($mobile) {
        return preg_match('/^[0]{1}+[0-9]{1}+-[0-9]{4}+-[0-9]{4}$/', $mobile)?TRUE: FALSE;
        //return preg_match('/^[0-9]{10}+$/', $mobile)?TRUE: FALSE;
    }

    // password validation
    public function checkPasswd($passwd) {
        //return preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%_])[0-9A-Za-z!@#$%_]{6,32}$/', $passwd)?TRUE: FALSE;
        return preg_match('/^(?=.*\d)[0-9A-Za-z!@#$%_]{6,32}$/', $passwd)?TRUE: FALSE;
    }

    public function validateCID($cid) {
        $arr_ph=explode("-", $cid);
        $nationalId="";

        foreach($arr_ph as $i) {
            $nationalId=$nationalId.$i;
        }

        if (strlen($nationalId)===13) {
            $digits=str_split($nationalId);
            $lastDigit=array_pop($digits);

            $sum=array_sum(array_map(function($d, $k) {
                        return ($k+2) * $d;
                    }

                    , array_reverse($digits), array_keys($digits)));
            return $lastDigit===strval((11 - $sum % 11) % 10);
        }

        return FALSE;
    }

    public function utf8_strlen($s) {

        $c=strlen($s);
        $l=0;
        for ($i=0; $i < $c; ++$i) if ((ord($s[$i]) & 0xC0) !=0x80)++$l;
        return $l;
    }

   



}