<html>

  <title> Class Search 2.0 </title>
  <link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
  <link rel="stylesheet" href="LoginStyle.css">

<h1>University of Notre Dame<br>Class Search</h1>

<?php
session_start();
$username = array_key_exists('username', $_POST) ? $_POST['username'] : null;
# Check if logged in
if ($username != '') {
	echo 'LOGGED IN';
	?>
	<meta http-equiv="refresh" content="0; url=http://dsg1.crc.nd.edu/cse30246f14/ngo/AdvancedClassSearchLogin.php" />
	<?php
} else {
echo $username;
}
?>

<body>
<br>
<br>
<form method="post">
<input type="text" name="username" placeholder="Username" class="rounded">
<input type="password" name="password" placeholder="Password" class="rounded">
<br>
<br>
<input value="Login" type="submit" class="button" formaction="AdvancedClassSearchLogin.php">
<form action="NewLogin.php" method="get">
<br>
<br>
<br>
<form><input type="button" value="Create Account" class="button"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/NewUser.php'"></form>

<form action="NewPassword.php" method="get">
<form><input type="button" value="Change Password" class="button"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/NewPassword.php'"></form>
</form>


<br>



</form>
</body>

<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>
</html>
