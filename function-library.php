<?php

function get_full_names ($fileName) {
  $lineNumber = 0;
  $fullName = [];
  
  $nameList = fopen($fileName, "r");
  $nextName = fgets($nameList);
  
  while(!feof($nameList)) {
      
      if($lineNumber % 2 == 0) {
          $endOfNamePosition = strpos($nextName, "--") - 1;
          $nextName = substr($nextName, 0, $endOfNamePosition);
          $fullName[] = $nextName;
      }
      
      $lineNumber++;
      $nextName = fgets($nameList);
  }
  
  return $fullName;
}

function get_first_names ($arrayName) {
  for($i = 0; $i < count($arrayName); $i++) {
    $commaPosition = strpos($arrayName[$i], ",");    
    $firstName[$i] = trim(substr($arrayName[$i], $commaPosition + 1));
  }
  
  return $firstName;
}

function get_last_names ($arrayName) {
  for($i = 0; $i < count($arrayName); $i++) {
    $commaPosition = strpos($arrayName[$i], ",");    
    $lastName[$i] = trim(substr($arrayName[$i], 0, $commaPosition));
  }
  
  return $lastName;
}

