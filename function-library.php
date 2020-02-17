<?php

function get_full_name($fileName) {

    $nameFile = fopen("$fileName", "r");
    $nameToProcess = fgets($nameFile);
    $fullName = [];
    $lineNumber = 0;

    while(!feof($nameFile)) {
        if($lineNumber % 2 == 0) {
            $nameCutOff = strpos($nameToProcess, "-") - 1;
            $processedName = substr($nameToProcess, 0, $nameCutOff);
            $fullName[] = $processedName;   
        }

    $lineNumber++;
    $nameToProcess = fgets($nameFile); 
}

return $fullName;
}

function count_unique_names($array) {
    $uniqueNames = count(array_unique($array));
    return $uniqueNames;
}