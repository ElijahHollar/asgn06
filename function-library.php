<?php

function get_full_names($fileName) {

    $nameFile = fopen("$fileName", "r");
    $nameToProcess = fgets($nameFile);
    $fullName = [];
    $lineNumber = 0;

    // process and extract names
    while(!feof($nameFile)) {
        if($lineNumber % 2 == 0) {
            $fullName[] = substr($nameToProcess, 0, strpos($nameToProcess, " --")); 
        }

    $lineNumber++;
    $nameToProcess = fgets($nameFile); 
    }

    // return names
    return $fullName;
}

function validate_names($array) {
  for($i = 0; $i < sizeof($array); $i++) {

    // names with numbers are removed, names with 's are allowed
    if(preg_match("/^([A-Z][a-zA-Z']+), ([A-Z][a-zA-Z]+)/", $array[$i] )) {
      $validName[] = $array[$i];
    }
  } 
  return $validName;
}

function count_unique_names($array) {
    $uniqueNames = count(array_unique($array));
    return $uniqueNames;
}

function get_first_names ($array) {
  for($i = 0; $i < count($array); $i++) {   
    $firstName[$i] = trim(substr($array[$i], strpos($array[$i], ",") + 1));
  }
  
  return $firstName;
}

function get_last_names ($array) {
  for($i = 0; $i < count($array); $i++) {
    $lastName[$i] = trim(substr($array[$i], 0, strpos($array[$i], ",")));
  }
  
  return $lastName;
}

// found code at https://stackoverflow.com/questions/30626785/php-most-frequent-value-in-array

function find_common_names ($array) {
  $values = array_count_values($array);
  arsort($values);
  $commonNames = array_slice(array_keys($values), 0, 10, true);
    
  for($i = 0; $i <= 9; $i++) {
    print("<p>$commonNames[$i]</p>");
  }
}

function find_special_unique_names($firstNameArray, $lastNameArray, $numberOfValuesToReturn) {
  $uniqueFirst = array_unique($firstNameArray);
  $uniqueLast = array_unique($lastNameArray);
  $nameNum = 1;

  for($i = 0; $i < $numberOfValuesToReturn; $i++) {
    if( empty($uniqueFirst[$i]) or empty($uniqueLast[$i]) ) {
      $numberOfValuesToReturn++;
    }
    else {
      print("<p>$nameNum. $uniqueLast[$i], $uniqueFirst[$i]</p>");
      $nameNum++;
    }
  }
}

function modify_unique_names($firstNameArray, $lastNameArray, $numberOfValuesToReturn) {

  // get arrays to create names from
  $uniqueFirst = array_values(array_unique($firstNameArray));
  $uniqueLast = array_values(array_unique($lastNameArray));

  // create validation array
  $checkLastNames = $uniqueLast;

  // shuffle last name array
  shuffle($uniqueLast);

  // establish name numbering variable
  $nameNum = 1;

  for($i = 0; $i < $numberOfValuesToReturn; $i++) {

    // check to make sure that shuffled last name is in different spot (i.e. make sure that name #18 didnt get put back into key 18 after being shuffled)
    if ($uniqueLast[$i] == $checkLastNames[$i]) {
      // if validation fails print nothing and increase the names to be printed by 1, so that the number of values requested are still outputted
      $numberOfValuesToReturn++;
    }

    // if validation passes print the name and increment the name numbering variable by 1
    else {
      print("<p>$nameNum. $uniqueLast[$i], $uniqueFirst[$i]</p>");
      $nameNum++;
    }
  }
  
  // $i = 0;
  // $n = $i + 1;

  // for($i = 0; $i < $numberOfValuesToReturn; $i++) {
  //   if($i == $numberOfValuesToReturn - 1) {
  //     $n = 0;
  //     print("<p>$uniqueFirst[$i] $uniqueLast[$n]");
  //   }
  //   else {
  //       print("<p>$uniqueFirst[$i] $uniqueLast[$n]");
  //       $n = $n + 1;
  //   }
  // }
}