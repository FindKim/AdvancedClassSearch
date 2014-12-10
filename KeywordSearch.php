<html>
<!-- KEYWORDSEARCH.PHP -->
<link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
<link rel="stylesheet" href="Tables.css">
<title>Advanced Class Search</title>
</head>
<body>

<h1>University of Notre Dame<br>Class Search</h1>
<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>


<?php
// Includes print result functions
include 'Functions.php';


// Connecting, selecting 
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');


// Gdatabaseet username if there is a session; username == '' if no session
session_start();
$username = $_SESSION['username'];
$loggedin = 0;
if ($username != '') {
$loggedin = 1;
}

// Back button
?>
<br>
<button class="rounded" onclick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/AdvancedClassSearchLogin.php'">Back</button>

<?php
// Printing your courses if logged in
if ($loggedin == 1) {
echo '<br>';
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes, EnrolledIn
WHERE studentuser = "$username"
AND classCRN = CRN order by CourseNumber
END;
$result = $db->query($query); 

print_user_results($result);

// Free resultset
$result->closeCursor();
}


// Print out keyword
$keyword = $_GET['keyword'];
$keyword = str_replace(';', '', $keyword);
echo "<br>";

// Performing SQL query
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE CourseSec LIKE "%$keyword%" or Title LIKE "%$keyword%" order by CourseNumber
END;

$result = $db->query($query);
print_result($result, $keyword);

// Free resultset
$result->closeCursor();

// Closing connection
$db = null;
?>
<br><br>
</body>
</html>

<?php
// Add class for user
// check if the form has been submitted
if (isset($_POST['Add'])) {
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');
   if ($username !== '' || $_POST['CRN'] !== '') {
	$sql = "SELECT * FROM EnrolledIn WHERE studentuser = '$username' and classCRN = '$_POST[Add]'";
	$result = $db->query($sql);
	$count = $result->rowCount();
	if ($count < 1) {
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
        echo $sql;
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

