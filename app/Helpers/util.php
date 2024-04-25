<?php

function format_currency($amount, $space = ""){
    return  "₦" . $space . number_format($amount, 2);
}