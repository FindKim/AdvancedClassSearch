<html>
<body>
Hey Whats UP
<br>

<?php
$link = mysql_connect('localhost', 'jgavin', 'jgav23')
        or die('Could not connect: ' . mysql_error());
mysql_select_db('jgavin') or die('Could not select database');
echo "Connection established";

$sql = "INSERT INTO student (`username`, `password`) VALUES ('$_POST[username]', '$_POST[password]')";
$result = mysql_query($sql);
if  ($result) {
echo("<br>Successfull add");
} else {
echo("<br>Unsuccessful add");
}

mysql_free_result($result);
mysql_close($link);

//session_start();
//$_SESSION['username'] = $_POST['username'];
//$_SESSION['password'] = $_POST['password'];

header("Location: AdvancedClassSearchLogin.php");
?>
</body>
</html>
