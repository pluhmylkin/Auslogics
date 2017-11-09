<?php

class Crypt
{
    private $salt = "fewfWDEFkmvr34wJKWD32mvbe";
    const CIPHER = "AES-128-CBC";

    function __construct()
    {
        $this->salt = file("K")[0];
    }

    /**
     * Decode string
     * @param $string
     * @return string
     */
    function decode($string, $key){
        $string = base64_decode($string);
        $ivLen = $this->iviLen();
        $iv =  substr($string, 0, $ivLen);
        $string =  substr($string, $ivLen);
        return openssl_decrypt($string, self::CIPHER, $key, false, $iv);

    }

    /**
     * Encode string
     * @param $string
     * @return string
     */
    function encode($string, $key){
        $iv = openssl_random_pseudo_bytes($this->iviLen());
        return  base64_encode( $iv.openssl_encrypt($string, self::CIPHER, $key, false, $iv));
    }

    /**
     * Encode email string
     * @param $string
     * @return string
     */
    function encodeEmail($string){
        return  md5($this->salt.md5($string));
    }

    /**
     * Generate key
     * @param $string
     * @return string
     */
    function getKey($string){
        return  md5($string.$this->salt);
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