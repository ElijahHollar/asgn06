<?php

include("function-library.php");
include_once("functions/utility-functions.php");

$fullNames = get_full_names("names.txt");
 
$validNames = validate_names($fullNames);

// for($i = 0; $i < count($validNames); $i++) {
//     print("<p>$validNames[$i]</p>");
// }


$firstNames = get_first_names($validNames);

$lastNames = get_last_names($validNames);

// print("<p>Most common first names:</p>");

// find_common_names($firstNames);

// print("<p>Most common last names:</p>");

// find_common_names($lastNames);

// find_special_unique_names($firstNames, $lastNames, 25);

// print("<h1>Temp Seperator</h1>");

modify_unique_names($firstNames, $lastNames, 25);