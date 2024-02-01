<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Theme Park V1</title>
  <link rel="stylesheet">
</head>

<style>
  .header {
    font-family: 'Times New Roman', Times, serif; color: black; font-size: 24px;
  }
  .paragraph {
    font-family: 'Times New Roman', Times, serif; color: black; font-size: 16px;
  }
  body {
    background-color: beige;
  }
  .centerTXT {
    text-align: center;
    border: 3px solid green;
    border-radius: 25px;
    margin: 5% 10%;
  }
  .centerIMG {
    width: 560px;
    height: 315px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
  }
  ol.siteLinks {
    display: inline-block;
    text-align: left;
  }
  .button {
  background-color: #4CAF50;
  border: none;
  border-radius: 25px;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}
.button1:hover {
  background-color: #4CAF50;
  color: white;
}
</style>

<body>
  <div class = 'centerTXT'>
  <br><p class='header'>Date and time of last revision: 11 November, 2022. 22:49:31</p>
      
  <?php
  date_default_timezone_set('UTC');
  ?>

  <script>
  var d = new Date(<?php echo time() * 1000 ?>);
  
  function updateClock() {
    // Increment the date
    d.setTime(d.getTime() + 1000);

    // Translate time to pieces
    var currentHours = d.getHours();
    var currentMinutes = d.getMinutes();
    var currentSeconds = d.getSeconds();

    // Add the beginning zero to minutes and seconds if needed
    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

    // Determine the meridian  
    var meridian = (currentHours < 12) ? "am" : "pm";

    // Convert the hours out of 24-hour time
    currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
    currentHours = (currentHours == 0) ? 12 : currentHours;

    // Generate the display string
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + meridian;

    // Update the time
    document.getElementById("clock").firstChild.nodeValue = currentTimeString;
  }

  window.onload = function() {
    updateClock();
    setInterval('updateClock()', 1000);
  }
  </script>
  
  <?php
    date_default_timezone_set("America/New_York");
    echo ("<p class ='header'>Today is " . date("m/d/Y"));
  ?>

  <div id="clock" style="font-size:24px">&nbsp;</div><br>

  <a style="color:green" href='http://167.99.253.247/csc443/hauserm3/CSC443/theme_park/themepark.php'>Theme Park Landing Page</a><br>

<?php
    echo ("<br><p class ='header'>Maxwell Hauser</p>");
    echo ("<p class ='header'>Proposed theme/topic for my site: AI-generated art</p>");
    echo ("<p class ='paragraph' style='margin: 0% 25%'>
         My theme park will focus on AI-generated art and techniques to use to generate quality AI imagery. 
         This site will focus specifically on the Midjourney bot and some of the prompts/commands expert artists
         use to create their best work. Unsurprisingly, there are a lot of politics and controversy
         surrounding AI-generated art, but discussing that is outside the scope of this site. This site will showcase
         various images created by Midjourney users and will offer tips and tricks to help new users create awesome art.</p><br>");
  
    echo ("<p class='header'>Group member site links:</p><br>");
    echo ("<ol class = 'siteLinks'>");
    echo ("<li><a style='color:green' href='http://167.99.253.247/csc443/fernandezf2/CSC-443/Assignment3/'>Felix</a></li>
         <li><a style='color:green' href='http://167.99.253.247/csc443/delgadoj11/themeParkProposal/'>Joseph</a></li>
         <li><a style='color:green' href='http://167.99.253.247/csc443/harrisona9/harrison_CSC443_assignment3.php'>Aaron</a></li>
         <li><a style='color:green' href='null'>Sam</a></li>");
    echo ("</ol></div>");

    
  ?>

</div>
<div class="slide" id="client-csv-data-io">
  <h1><br><br>Client-side file upload (input) & display (output)</h1>
  <ul class="incremental">

    <li><p>Select a client-side CSV file from your device:</p>

      <!-- prompt for path to CSV input file  -->
      <input type="file" id="csvFileInput" onchange="readCSVFile(this.files)" accept=".csv">

      <!-- display CSV data as HTML -->
      <output id="csv-table">
          <div id="output" style="font-family:"Times New Roman", Times, serif;"></div>

      <li><p>A <a href="https://developer.mozilla.org/en-US/docs/Glossary/UTF-8" target="_blank">UTF-8</a> CSV file uploaded from a client is read by <a href="https://www.w3.org/TR/file-upload/" target=_blank>W3C HTML5 File API<a>" target="_blank">HTML5 File API</a> and displayed in an HTML table</p></li>
      <p>Another option is <a href="https://github.com/evanplaice/jquery-csv" target=_blank>jQuery-CSV.</a></p>
  </ul>
</div>

<div class="slide" id="server-csv-data-io">
  <h1><br><br>Server-side file reading (input) & display (output) </h1>
  <ul class="incremental">

    <li><p>A <a href="https://developer.mozilla.org/en-US/docs/Glossary/UTF-8" target="_blank">UTF-8</a> CSV stored on the server is read by php and stored as a <a href="https://www.php.net/manual/en/language.types.array.php" target="_blank">PHP associative array</a> and displayed in HTML</p>
      <?php

      // enable PHP debugging
      ini_set('display_startup_errors', 1);
      ini_set('display_errors', 1);
      error_reporting(-1);

      // specify a CSV file to read
      $csv_url = "data/io.csv";

      // read the CSV file
      $csv_file = file_get_contents($csv_url);

      // extract each row in the CSV file
      $csv_row = explode("\n", $csv_file);

      // identify header row
      $headers = explode(',', $csv_row[0]);

      // remove header row as the header names will be applied to the associative array
      unset($csv_row[0]);

      // initialize an associative array to store the values returned from CSV rows
      $csv_data = [];

      // import row data into an associative array
      foreach ($csv_row AS $row)
      $csv_data[] = array_combine($headers, explode(',', $row));

      // display the associative array contents as HTML
      print_r($csv_data);
      ?>

    <li><p>A <a href="https://www.php.net/manual/en/language.types.array.php" target="_blank">PHP associative array</a> stored in server memory (RAM) is displayed in a dynamically-generated HTML table</p>

<?php
// dynamically generate an HTML table to display contents of a PHP associative array
echo "<table>";
foreach($csv_data as $key=>$row) {
    echo "<tr>";
    foreach($row as $key2=>$row2){
        echo "<td>" . $row2 . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<li><p>A CSV file stored on a server's local storage (disk) is displayed in a dynamically-generated HTML table</p>

<?php

// dynamically generate an HTML table to display contents of a CSV file
echo "<table>";
$csv_file = fopen($csv_url, "r");
while (($line = fgetcsv($csv_file)) !== false) {
  echo "<tr>";
  foreach ($line as $cell) {
        echo "<td>" . $cell. "</td>";
  }
  echo "</tr>\n";
}
fclose($csv_file);
echo "</table>";

?>
</li>
</ul>
</div>
</body>
</html>