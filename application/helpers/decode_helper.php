<?php

function _encrypt($str)
{
    $encrypted = "";
    $str = base64_encode($str);
    $str = base64_encode($str);

    for ($i = 0; $i < strlen($str); $i++) {
        $a = ord($str[$i]);
        $b = $a ^ 10;

        $encrypted .= chr($b);
    }

    $encrypted = base64_encode($encrypted);
    return $encrypted;
}

function _decrypt($encoded)
{
    $encoded = base64_decode($encoded);
    $str = "";

    for ($i = 0; $i < strlen($encoded); $i++) {
        $b = ord($encoded[$i]);
        $a = $b ^ 10;

        $str .= chr($a);
    }
    return base64_decode(base64_decode($str));
}
