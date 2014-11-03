<html>
<body>

<p>Here are your ages:</p>
<?php




//Connect and select db
$link = mysql_connect('localhost', 'jgavin', 'jgavinpw') or die('connection failed');
echo 'Connection success';

//Select a database
mysql_select_db('jgavin') or die('DB not found');

//Do a query
$query = 'SELECT * from user_age;';

$result = my_sql_query($query) or die('Query failed');

echo '<table>';
while($tuple = mysql_fetch_array($result, MYSQL_ASSOC)){

	echo '<tr>';
	foreach($tuple as $colvalue){
		echo '<td>'.$colvalue.'</td>';

	}
echo '</tr>';
}
echo '</table>';


?>




</body>
<html>
