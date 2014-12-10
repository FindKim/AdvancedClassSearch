<html>
<head>
<link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
<link rel="stylesheet" href="LoginStyle.css">
<title>Advanced Class Search</title>
</head>
<body>

<h1>University of Notre Dame<br>Class Search</h1>
<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>

<?php
session_start();
session_destroy();

// Connecting, selecting database
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

//setting some variables

$myusername=$_POST['username'];
$mypassword=$_POST['password'];
$mypassword1=$_POST['newpassword1'];
$mypassword2=$_POST['newpassword2'];

$mysername=str_replace(';', '', $myusername);
$mypassword=str_replace(';', '', $mypassword);

//dont want sql injection;
if (strpos($mypassword1, ';') == true or strpos($mypassword2, ';') == true) {
?>
<form action="Login.php" method="get">
<form><input type="button" value="Back" onclick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/Login.php'"></form>
</form>
<?php
echo "<br>Invalid password change:<br>Cannot contain ;";

} else {

//selecting username and password
$dbname2 = "student";
$sql="SELECT * FROM $dbname2 WHERE username='$myusername' and password='$mypassword'";
$result=$db->query($sql);
//count number of returned rows will only be one if
// username and password are same
$count=$result->rowCount();
$result->closeCursor();
if($count==1){
	if($mypassword1==$mypassword2){
		$sql2="UPDATE $dbname2 SET username='$myusername', password='$mypassword1' WHERE username='$myusername' and password='$mypassword'";
		$result2=$db->query($sql2);
	}
	if($result2){
		echo("<br>Password Changed!");
	}
	else{
		echo("<br>Passwords didn't match");
	}
	$result2->closeCursor();
}
else
{
	echo("<br>Incorrect Username or Password");
}

$db = null;
echo("<br><br>Redirecting for login in 5 seconds...<br><br>");
?>
<meta http-equiv="Refresh" content="5;url=Login.php">
<?php } ?>
</body>
</html>






