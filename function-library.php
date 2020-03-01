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
    $numUniqueNames = count(array_unique($array));
    return $numUniqueNames;
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
    $valueKey = $commonNames[$i];
    print("<p>$commonNames[$i] - appears $values[$valueKey] times</p>");
  }
}

function find_special_unique_names($firstNameArray, $lastNameArray, $numOfValues) {
  $uniqueFirst = array_unique($firstNameArray);
  $uniqueLast = array_unique($lastNameArray);
  $nameNum = 1;

  for($i = 0; $i < $numOfValues; $i++) {
    if( empty($uniqueFirst[$i]) or empty($uniqueLast[$i]) ) {
      $numOfValues++;
    }
    else {
      print("<p>$nameNum. $uniqueLast[$i], $uniqueFirst[$i]</p>");
      $nameNum++;
    }
  }
}

function modify_unique_names($firstNameArray, $lastNameArray, $numOfValues) {
  
  // get starting arrays
  $uniqueFirst = array_unique($firstNameArray);
  $uniqueLast = array_unique($lastNameArray);
  
  // get number of last-first name pairs to grab
  $numLastNames = $numOfValues;
  
  // extract the required number of last-first name pairs
  for($i = 0; $i < $numLastNames; $i++) {
    
    // skip any pairs where there are any empty values
    if( empty($uniqueFirst[$i]) ) {
      $numLastNames++;
    }
    elseif( empty($uniqueLast[$i]) ) {
      $numLastNames++;
    }

    // create name generation and validation arrays
    else {
      $useableFirst[] = $uniqueFirst[$i];
      $shuffleLast[] = $uniqueLast[$i];
      $checkLastNames[] = $uniqueLast[$i];
    }
  }
  
  // shuffle the last name array
  shuffle($shuffleLast);
  
  // declare misc variables
  $nameNum = 1;
  $usedNames = [];
  $a = 0;
  $subtract = 0;

  for($i = 0; $i < $numOfValues; $i++) {

    // validation (make sure the shuffle actually shuffled things)
    if($shuffleLast[$i] == $checkLastNames[$a]) {

      // subtract the number of names to return based on the number of names already generated
      $numOfValues = $numOfValues - $subtract;
      $subtract = 0;

      // reset $i (after this if statement process $i will increment and be back to 0)
      $i = 0 - 1;
      
      // remove last names that have already been used, compact the array, and reshuffle the array
      $shuffleLast = array_diff($shuffleLast, $usedNames);
      $shuffleLast = array_values($shuffleLast);
      shuffle($shuffleLast);
    }
    else {
      
      // print the genearted name
      print("<p>$nameNum. $shuffleLast[$i], $useableFirst[$a]</p>");

      // increment numbering variable
      $nameNum++;

      // add last name to list of used names
      $usedNames[] = $shuffleLast[$i];

      // increment first name and validation array counter
      $a++;

      // increment subtraction variable
      $subtract++;
    }
  }
  exit();
}