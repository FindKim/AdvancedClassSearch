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
<button class="rounded" onclick="history.go(-1);">Back</button>
<?php

$crn = $_GET['Books'];

$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE CRN = $crn
END;
$result = $db->query($query);
print_no_add($result);

$query = <<<END
SELECT ISBN, Title, Price
FROM books
WHERE bookCRN = $crn
END;
$result = $db->query($query);
print_user_books($result);

$result->closeCursor();
$db = null;

?>
<br><br>
</body>
</html>
