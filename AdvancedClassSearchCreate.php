<html>
<link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
<link rel="stylesheet" href="LoginStyle.css">
<title>Advanced Class Search</title>
</head>
<body>

<h1>University of Notre Dame<br>Class Search</h1>
<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>



<?php
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');
//echo "Connection established";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM student WHERE username = '$username'";
$result = $db->query($query);
if ($count = $result->rowCount() != 0) {
	?><br><button class="rounded" onclick="history.go(-1);">Back</button> <?php
	echo "<br><br>This username has already been taken.<br><br>";
} else {

if (ctype_alnum($username) and strlen($username) > 3 and strlen($password) > 3) {
	$query = "INSERT INTO student (`username`, `password`) VALUES ('$username', '$password')";
	$result = $db->query($query);
} else {
$result = 0;
}
$db = null;
if ($result) {
echo("<br>Username created!");
$result->closeCursor();
echo("<br>Redirecting to login in 5 seconds...<br><br>");
?>
<html> <head> <meta http-equiv="Refresh" content="5;url=Login.php">  </head> </html>
<?php
} else {
?>
<button onclick="history.go(-1);">Back</button>
<br>
<?php
echo("<br><strong>Issue creating username</strong><br><br><strong>Username must contain:</strong><br>Only alphanumeric characters<br>Minimum of 4 characters<br><br><strong>Password must contain:</strong><br>Minimum length of 4 characters<br><br>");
}
}
?>
</body>
</html>
