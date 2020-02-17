<?php

include("function-library.php");

$fullName = get_full_name("names.txt");

for($count = 0; $count < count($fullName); $count++) {
    print("<p>$fullName[$count]</p>");
}