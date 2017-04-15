<?php

function dateParse($date)
{
    //DD/MM/YYYY -> YYYY-MM-DD
    $dateArray = explode('/', $date);
    //[ dd, mm, yyyy]
    $dateArray = array_reverse($dateArray);
    //[ yyyy, mm, dd]
    return implode('-', $dateArray);
}

function numberParse($number)
{
    //1.000,50 -> 1000.50
    $newNumber = str_replace('.', '', $number);
    $newNumber = str_replace(',', '.', $newNumber);
    return $newNumber;
}
