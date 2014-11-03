<?php
$link = mysql_connect('localhost', 'jgavin', 'jgav23')
	or die('Could not connect: ' . mysql_error());
mysql_select_db('jgavin') or die('Could not select database');
echo "Connection established"

$sql = "INSERT INTO EnrolledIn ('studentuser', 'classCRN') VALUES ('$_POST[username]', '$_POST[CRN]')";

if (!mysql_query($sql, $link)) {
	die('Error: ' . mysql_error());
}
echo "SUCCESSFULLY ADDED";

mysql_close($link);

header("Location: AdvancedClassSearch.php");
/*
// check if the form has been submitted
if (isset($_POST['Add']))) {
        if ($username == '' || $_POST['CRN']) {
        echo "ERROR adding class.", "<br>"
        }
   mysql_query("INSERT EnrolledIn studentuser='$username', classCRN='$_POST['CRN']'")
   or die(mysql_error());

// once saved, redirect back to view page
header("Loaction: AdvancedClassSearch.php");
}
*/
?>
