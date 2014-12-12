<html>
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

// Get username if there is a session; username == '' if no session
session_start();
$username = $_SESSION['username'];
$loggedin = 0;
if ($username != '') {
$loggedin = 1;
}

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

// Printing your courses if logged in
if ($loggedin == 1) {
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes, EnrolledIn
WHERE studentuser = ?
AND classCRN = CRN order by CourseNumber
END;

$result = $db->prepare($query);
$result->execute(array($username));
// Printing results in HTML
print_user_results($result);
// Free resultset
$result->closeCursor();
}

echo '<br>';

// Print out professor
$teacher =$_GET['teacher'];
$teacher = str_replace(';', '', $teacher);

// Parse professor for different styles of input
$first_name = '';
$last_name = '';
if (strpos($teacher, ', ') !== false) {
    $teacher_name = explode(', ', $teacher);
    $first_name = trim($teacher_name[1]);
    $last_name = trim($teacher_name[0]);
} else if (strpos($teacher, ' ') !== false) {
    $teacher_name = explode(' ', $teacher);
    $first_name = trim($teacher_name[0]);
    $last_name = trim($teacher_name[1]);
} else {
    $first_name = trim($teacher);
}

// Performing SQL query
if ($first_name !== '' and $last_name !== '') {
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE Instructor LIKE ? and Instructor LIKE ? order by CourseNumber
END;

$result = $db->prepare($query);
$result->execute(array('%'.$first_name.'%', '%'.$last_name.'%'));
print_result($result, $teacher);

// Free resultset
$result->closeCursor();

} else if ($first_name !== '') {
$query = <<<END
SELECT  CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE Instructor LIKE ? order by CourseNumber
END;

$result = $db->prepare($query);
$result->execute(array('%'.$first_name.'%'));
print_result($result, $teacher);

// Free resultset
$result->closeCursor();

} else if ($last_name !== '') {
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE Instructor LIKE ? order by CourseNumber
END;

$result = $db->prepare($query);
$result->execute(array('%'.$last_name.'%'));
print_result($result, $teacher);

// Free resultset
$result->closeCursor();

} else {
echo "A parsing issue has occured.", "<br>";
}

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
        if ($count == 0) {
                $sql = "INSERT INTO EnrolledIn (`studentuser`, `classCRN`) VALUES ('$username', '$_POST[Add]')";
                $result = $db->query($sql);
        }
   }
// once saved, redirect back to view page
$result->closeCursor();

// Closing connection
mysql_close($db);

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
mysql_close($db);

// Unset post
unset($_POST['Remove']);

// Refreshes page with new results
?>
<meta http-equiv="refresh" content="0">
<?php
}

?>

