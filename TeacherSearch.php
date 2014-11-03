<html>
<head>
<title>Advanced Class Search</title>
</head>
<body>
<p> Advanced Class Search: Created by Jake Gavin, Kim Ngo, and James Bowyer </p>
<?php
// Connecting, selecting database
$link = mysql_connect('localhost', 'jgavin', 'jgav23')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('jgavin') or die('Could not select database');
echo 'Connected successfully', "<br>";

$teacher = mysql_real_escape_string($_GET['teacher']);
echo $teacher, "<br>";

$first_name = '';
$last_name = '';
if (strpos($teacher, ', ') !== false) {
    $teacher_name = explode(', ', $teacher);
    $first_name = trim($teacher_name[1]);
    $last_name = trim($teacher_name[0]);
} else if (strpos($teacher, ' ') !== false) {
    $teacher_name = explode(' ', $teacher);
    $first_name = trim($teacher_name[0]);
    $last_name = trim($teacher_name[1]);
} else {
    $first_name = trim($teacher);
}

// Performing SQL query
if ($first_name !== '' and $last_name !== '') {
$query = <<<END
SELECT *
FROM classes
WHERE Instructor LIKE "%$first_name%" and Instructor LIKE "%$last_name%"
END;
} else if ($first_name !== '') {
$query = <<<END
SELECT *
FROM classes
WHERE Instructor LIKE "%$first_name%"
END;
} else if ($last_name !== '') {
$query = <<<END
SELECT *
FROM classes
WHERE Instructor LIKE "%$last_name%"
END;
} else {
echo "A parsing issue has occured.", "<br>";
}

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
