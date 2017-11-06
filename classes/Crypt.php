<?php

class Crypt
{
    const SALT = "fewfWDEFkmvr34wJKWD32mvbe";
    const CIPHER = "AES-128-CBC";

    /**
     * Decode string
     * @param $string
     * @return string
     */
    function decode($string){
        $string = base64_decode($string);
        $ivLen = $this->iviLen();
        $iv =  substr($string, 0, $ivLen);
        $string =  substr($string, $ivLen);
        return openssl_decrypt($string, self::CIPHER, self::SALT, false, $iv);

    }

    /**
     * Encode string
     * @param $string
     * @return string
     */
    function encode($string){
        $iv = openssl_random_pseudo_bytes($this->iviLen());
        return  base64_encode( $iv.openssl_encrypt($string, self::CIPHER, self::SALT, false, $iv));
    }

    /**
     * Encode email string
     * @param $string
     * @return string
     */
    function encodeEmail($string){
        return  md5($string).self::SALT.md5($string);
    }


    /**
     * Get ivi length
     * @return int
     */
    function iviLen(){
        return openssl_cipher_iv_length(self::CIPHER);
    }

}

$crypt = new Crypt;