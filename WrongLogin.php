<html>
<head>
<link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
<link rel="stylesheet" href="LoginStyle.css">
<title>Advanced Class Search</title>
</head>
<body>

<h1>University of Notre Dame<br>Class Search</h1>
<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>
<div align="center">

<?php
session_start();
session_destroy();
?>

<br>
Username and password do not match
<br>
<br>
Try logging in again
<br>
<br>
<form action="Login.php" method="get">
<form><input type="button" value="Login" class="button"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/Login.php'"></form>
</form>
</div>
</body>
</html>
