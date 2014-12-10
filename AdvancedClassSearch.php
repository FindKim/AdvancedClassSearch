<html>
<head>
<title>Advanced Class Search</title>
</head>
<body>

<p> Advanced Class Search: Created by Jake Gavin, Kim Ngo, and James Bowyer </p>

<!--Login-->
<form><input type="button" value="Login"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/Login.php'">
</form>

<br><br>

<!--Search by Professor functionaility-->
<form action="TeacherSearch.php" method="get">
Search by professor: <input type="textbox" name="teacher">
</form>

<?php
// Connecting, selecting database
$link = mysql_connect('localhost', 'jgavin', 'jgav23')
    or die('Could not connect: ' . mysql_error());

mysql_select_db('jgavin') or die('Could not select database');

echo "All courses:";

// Performing SQL query
$query = 'SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End FROM classes';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

// Printing results in HTML
echo "<table>\n";
echo "<table border=1>";
echo "\t<tr>\n";
echo "\t\t<td>Course-Section</td>\n";
echo "\t\t<td>Title</td>\n";
echo "\t\t<td>Credits</td>\n";
echo "\t\t<td>St</td>\n";
echo "\t\t<td>Max</td>\n";
echo "\t\t<td>Open</td>\n";
echo "\t\t<td>Xlst</td>\n";
echo "\t\t<td>CRN</td>\n";
echo "\t\t<td>Instructor</td>\n";
echo "\t\t<td>Class Time</td>\n";
echo "\t\t<td>Begin</td>\n";
echo "\t\t<td>End</td>\n";
echo "\t</tr>\n";

while ($tuple = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($tuple as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>
</body>
</html>

<?php


// Add class for user
// check if the form has been submitted
if (isset($_POST['Add'])) {
$link = mysql_connect('localhost', 'jgavin', 'jgav23')
    or die('Could not connect: ' . mysql_error());

mysql_select_db('jgavin') or die('Could not select database');
   if ($username !== '' || $_POST['CRN'] !== '') {
	$sql = "INSERT INTO EnrolledIn (`studentuser`, `classCRN`) VALUES ('$username', '$_POST[Add]')";
	$result = mysql_query($sql);
	
	if ($result) {
	echo("<br>Successful insert");
    	} else {
	echo("<br>Unsuccessful insert");
    	}
   }
// once saved, redirect back to view page
//header("Loaction: AdvancedClassSearch.php");
mysql_free_result($result);

// Closing connection
mysql_close($link);
}


// Remove class for user
// check if the form has been submitted
if (isset($_POST['Remove'])) {
$link = mysql_connect('localhost', 'jgavin', 'jgav23')
    or die('Could not connect: ' . mysql_error());

mysql_select_db('jgavin') or die('Could not select database');
   if ($username !== '' || $_POST['CRN'] !== '') {
        $sql = "DELETE FROM EnrolledIn WHERE studentuser='$username' and classCRN='$_POST[Remove]'";
	echo $sql;
        $result = mysql_query($sql);

        if ($result) {
        echo("<br>Successful removal");
        } else {
        echo("<br>Unsuccessful removal");
        }
   }
// once saved, redirect back to view page
//header("Loaction: AdvancedClassSearch.php");
mysql_free_result($result);

// Closing connection
mysql_close($link);
}


?>
