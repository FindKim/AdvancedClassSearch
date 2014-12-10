<html>
<head>
<link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
<link rel="stylesheet" href="LoginStyle.css">
<title>Advanced Class Search</title>
</head>
<body>

<h1>University of Notre Dame<br>Class Search</h1>
<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>
<br>
<button class="rounded" onclick="history.go(-1);">Back</button>
<br>
<br>
<form name = "New Password" method="post" action="CheckPasswords.php">
  <input type="text" name="username" placeholder="Username" class="rounded"><br>
  <input type="password" name="password" placeholder="Old password" class="rounded"><br>
  <input type="password" name="newpassword1" placeholder="New password" class="rounded"><br> 
  <input type="password" name="newpassword2" placeholder="Confirm new password" class="rounded"><br>
  <br>
  <input type="submit" name="Submit" value="Change Password" class="button"><br>
</form>
</body>
</html>
