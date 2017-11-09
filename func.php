<?php
require "classes/Db.php";
require "classes/Crypt.php";
require "classes/Func.php";

$mes = '';
if (isset($_POST['add'])) {
    $e = $func->checkEmail($_POST['mail']);
    $p = $func->checkPhone($_POST['phone']);
    if ($e && $p) {
        if ($func->add($crypt->encodeEmail($e), $crypt->encode($p, $crypt->getKey($crypt->encodeEmail($e))))) {
            $mes = $func->success("saved successfully");
        } else {
            $mes .= $func->error("email exists");
        }
    } else {
        if (!$p) {
            $mes .= $func->error("invalid phone");
        }
        if (!$e) {
            $mes .= $func->error("invalid email");
        }
    }
}
if (isset($_POST['retrieve'])) {
    $e = $func->checkEmail($_POST['mail']);
    if ($e) {
        $p = $func->retrieve($crypt->encodeEmail($e));
        if ($p) {
            $p = $crypt->decode($p, $crypt->getKey($crypt->encodeEmail($e)));

            //echo $p;
            $to = $e;
            $subject = 'Your PHONE';
            $message = "Your PHONE is:" . $p;
            $headers = 'From: example@example.com';
            mail($to, $subject, $message, $headers);
            $mes .= $func->success("email is sent");
        } else {
            $mes .= $func->error("email not found");
        }
    } else {
        $mes .= $func->error("invalid email");
    }
}