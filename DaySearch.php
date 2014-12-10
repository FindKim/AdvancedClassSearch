<html>
<!--DaySearch.php-->
<head>
<link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
<link rel="stylesheet" href="Tables.css">
<title>Advanced Class Search</title>
</head>
<body>

<h1>University of Notre Dame<br>Class Search</h1>
<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>

<?php
include 'Functions.php';

// Connecting, selecting database
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

// Print user courses if logged in
session_start();
$username = $_SESSION['username'];
$loggined = 0;
if ($username != '') {
$loggedin = 1;

// Back button
if ($loggedin == 1) {
?>
<br>
<form action="AdvancedClassSearchLogin.php" method="get">
<form><input type="button" value="Back" class="rounded"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/AdvancedClassSearchLogin.php'"></form>
</form>
<?php
}


echo '<br>';
echo PHP_EOL;
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes, EnrolledIn
WHERE studentuser = "$username"
AND classCRN = CRN order by CourseNumber
END;
$result = $db->query($query);
print_user_results($result);
$result->closeCursor();
} // END OF PRINTING USER COURSES



// Query for search by subject
$day = $_GET['day'];
//echo $day;
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE ClassTime LIKE "$day - %" order by ClassTime
END;



$result = $db->query($query);

// Printing results in HTML
echo "<br>";
print_result($result, $day);

// Free resultset
$result->closeCursor();

// Closing connection
$db = null;
?>
<br><br>
</body>
</html>



<!-- ADD/REMOVE CLASS -->
<?php
// Add class for user
// check if the form has been submitted
if (isset($_POST['Add'])) {
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');
   if ($username !== '' || $_POST['CRN'] !== '') {
        $sql = "SELECT * FROM EnrolledIn WHERE studentuser = '$username' and classCRN = '$_POST[Add]'";
        $result = $db->query($sql);
        $count = $result->rowCount();
        if ($count == 0) {
                $sql = "INSERT INTO EnrolledIn (`studentuser`, `classCRN`) VALUES ('$username', '$_POST[Add]')";
		$result = $db->query($sql);
        }
   }
// once saved, redirect back to view page
$result->closeCursor();

// Closing connection
$db = null;

// Unset post
unset($_POST['Add']);
?>
<meta http-equiv="refresh" content="0">
<?php
}

// Remove class for user
// check if the form has been submitted
else if (isset($_POST['Remove'])) {
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

   if ($username !== '' || $_POST['CRN'] !== '') {
        $sql = "DELETE FROM EnrolledIn WHERE studentuser='$username' and classCRN='$_POST[Remove]'";
        $result = $db->query($sql);
   }
// once saved, redirect back to view page
$result->closeCursor();

// Closing connection
$db = null;
// Unset post
unset($_POST['Remove']);

// Refreshes page with new results
?>
<meta http-equiv="refresh" content="0">
<?php

}
?>
