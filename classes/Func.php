<?php

class Func
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Check email
     * @param $email
     * @return bool
     */
    function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }else{
            return false;
        }
    }

    /**
     * Check phone
     * @param $phone
     * @return bool
     */
    function checkPhone($phone){
        if($phone != '' && preg_match("/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){5,14}(\s*)?$/", $phone)) {
            return $phone;
        }else{
            return false;
        }
    }

    /**
     * Create user
     * @param $e email
     * @param $p phone
     * @return bool
     */
    function add($e, $p){
        if($this->retrieve($e)) {
            return false;
        }else{
            $this->db->query("INSERT INTO user (phone, email) VALUES ('$p', '$e')");
            return true;
        }
    }

    /**
     * Retrieve phone
     * @param $e email
     * @return mixed
     */
    function retrieve($e){
        $this->db->query("SELECT phone FROM user WHERE email LIKE '".$e."'");
        $res = $this->db->fetch();
        if(isset($res['phone'])) {
            return $res['phone'];
        }else{
           return false;
        }

    }

    /**
     * Show error message
     * @param $error text
     * @return string
     */
    function error($error){
        return '<div class="error">'.$error.'</div>';
    }

    /**
     * Show success message
     * @param $error text
     * @return string
     */
    function success($error){
        return '<div class="success">'.$error.'</div>';
    }
}

$func = new Func(new Db());