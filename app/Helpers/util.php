<?php

function format_currency($amount, $space = ""){
    return  "₦" . $space . format_number($amount);
}

function format_number(float $number): string
{
    $numberStr = (string) $number;

    if (preg_match('/^0\.0[0-9]{3,}$/', $numberStr)) {
        return $numberStr;
    } else {
        return number_format($number, 2);
    }
}