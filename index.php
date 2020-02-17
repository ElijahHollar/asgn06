<?php

include("function-library.php");

$nameList = "short-list-names.txt";

$fullName = get_full_names($nameList);
$lastName = get_last_names($fullName);
$firstName = get_first_names($fullName);

// for($count = 0; $count < count($fullName); $count++) {
//   print("<p>$fullName[$count]</p>");
// }

$uniqueFullNames = count(array_unique($fullName));
$uniqueLastNames = count(array_unique($lastName));
$uniqueFirstNames = count(array_unique($firstName));

print("<p>Number of unique names: $uniqueFullNames</p>");
print("<p>Number of unique last names: $uniqueLastNames</p>");
print("<p>Number of unique first names: $uniqueFirstNames</p>");