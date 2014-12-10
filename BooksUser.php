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





$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

?>
<br>
<button class="rounded" onclick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/AdvancedClassSearchLogin.php'">Back</button>
<?php

$username = $_GET['UserBooks'];
echo "<br>";

$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes, EnrolledIn
WHERE studentuser = "$username"
AND classCRN = CRN
order by CourseNumber
END;
$result = $db->query($query);
print_user_results($result);
echo "<br>\n";


echo "<br>";

$query = <<<END
SELECT bookCRN, ISBN, Title, Price
FROM books, EnrolledIn
WHERE bookCRN = classCRN
AND studentuser = "$username"
END;
$result = $db->query($query);
print_user_books($result);

$result->closeCursor();
$db = null;


?>
<br><br><br>
</body>
</html>

<?php
if (isset($_POST['Remove'])) {
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
