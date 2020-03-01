<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/styles.css">
  </head>
  <body>
    <?php
      include("function-library.php");
      include_once("functions/utility-functions.php");

      $fullNames = get_full_names("names.txt");
      $validNames = validate_names($fullNames);
      $firstNames = get_first_names($validNames);
      $lastNames = get_last_names($validNames);
      $uniqueFullNames = count_unique_names($validNames);
      $uniqueFirstNames = count_unique_names($firstNames);
      $uniqueLastNames = count_unique_names($lastNames);

      print("<h2>Number of Unique Full Names</h2>");
      print("<p>$uniqueFullNames</p>");

      print("<h2>Number of Unique First Names</h2>");
      print("<p>$uniqueFirstNames</p>");

      print("<h2>Number of Unique Last Names</h2>");
      print("<p>$uniqueLastNames</p>");

      print("<h2>Most common first names:</h2>");
      find_common_names($firstNames);

      print("<h2>Most common last names:</h2>");
      find_common_names($lastNames);

      print("<h2>Specially Unique Names</h2>");
      find_special_unique_names($firstNames, $lastNames, 25);

      print("<h2>Modified Names</h2>");
      modify_unique_names($firstNames, $lastNames, 25);
    ?>
    <p><a href="..">Return to WEB 182 main page</a></p>
  </body>
</html>
