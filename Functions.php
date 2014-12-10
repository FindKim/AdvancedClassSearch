<?php
function print_user_results($result) {
?>
<!--Printing results in HTML-->
<table class="pure-table pure-table-bordered">
<caption>Your classes:</caption>
   <thead>
	<tr>
		<th>Remove</th>
		<th>Books</th>
		<th nowrap>Course-Section</th>
		<th>Title</th>
		<th>Credits</th>
		<th>St</th>
		<th>Max</th>
		<th>Open</th>
		<th>Xlst</th>
		<th>CRN</th>
		<th>Instructor</th>
		<th nowrap>Time</th>
		<th>Begin</th>
		<th>End</th>
	</tr>
   </thead>
   <tbody>
<?php
while ($tuple = $result->fetch(PDO::FETCH_ASSOC)) {
?>
    	<tr>
    		<td align="center">
        <form name="Remove" action="" method="post">
        <button type="submit" name="Remove" class="rounded" value="<?php echo $tuple['CRN']; ?>"/>x</button>
        </form>
		</td>
		<td align="center">
        <form action="Books.php" method="get">
        <button name="Books" class="rounded" value="<?php echo $tuple['CRN']; ?>"/>View<br>books</button>
        </form>
		</td>
    <?php
    foreach ($tuple as $col_value) {
        echo "\t\t<td nowrap>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
}


// Prints search results with add button
function print_result($result, $result_type) {
?>
<!--Printing results in HTML-->
<table class="pure-table pure-table-bordered">
<caption>Class results for: <?php echo $result_type ?></caption>
   <thead>
        <tr>
                <th>Add</th>
                <th>Books</th>
                <th nowrap>Course-Section</th>
                <th>Title</th>
                <th>Credits</th>
                <th>St</th>
                <th>Max</th>
                <th>Open</th>
                <th>Xlst</th>
                <th>CRN</th>
                <th>Instructor</th>
                <th nowrap>Time</th>
                <th>Begin</th>
                <th>End</th>
        </tr>
   </thead>
   <tbody>
<?php
while ($tuple = $result->fetch(PDO::FETCH_ASSOC)) {
?>
	<tr>
		<td align="center">
        <form name="Add" action="" method="post">
        <button type="submit" name="Add" class="rounded" value="<?php echo $tuple['CRN']; ?>"/>+</button>
        </form>
		</td>
		<td align="center">
        <form action="Books.php" method="get">
        <button name="Books" class="rounded" value="<?php echo $tuple['CRN']; ?>"/>View<br>books</button>
        </form>
		</td>
    <?php
    foreach ($tuple as $col_value) {
        echo "\t\t<td nowrap>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
}

function print_no_add($result) {
?>
<table class="pure-table pure-table-bordered">
<caption>Class:</caption>
   <thead>
        <tr>
                <th nowrap>Course-Section</th>
                <th>Title</th>
                <th>Credits</th>
                <th>St</th>
                <th>Max</th>
                <th>Open</th>
                <th>Xlst</th>
                <th>CRN</th>
                <th>Instructor</th>
                <th nowrap>Time</th>
                <th>Begin</th>
                <th>End</th>
        </tr>
   </thead>
   <tbody>
<?php
while ($tuple = $result->fetch(PDO::FETCH_ASSOC)) {
foreach ($tuple as $col_value) {
        echo "\t\t<td nowrap>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
}

function print_user_books($result) {
?>
<table class="pure-table pure-table-bordered">
<caption>Books:</caption>
   <thead>
        <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Price</th>
        </tr>
   </thead>
   <tbody>
<?php
$sum = 0;
while ($tuple = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "\t<tr>\n";
        echo "\t\t<td>$tuple[ISBN]</td>\n";
        echo "\t\t<td>$tuple[Title]</td>\n";
        echo "\t\t<td>\$$tuple[Price]</td>\n";
        echo "\t</tr>\n";

        $sum += $tuple['Price'];
}

echo "</tbody>\n";
echo "</table>\n";
echo "<br><strong>Total cost: $", $sum, "<strong><br>";
}


function TeacherQuery($Teacher) {
// Parse professor for different styles of input
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

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
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE Instructor LIKE "%$first_name%" and Instructor LIKE "%$last_name%" order by CourseNumber
END;
} else if ($first_name !== '') {
$query = <<<END
SELECT  CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE Instructor LIKE "%$first_name%" order by CourseNumber
END;
} else if ($last_name !== '') {
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes
WHERE Instructor LIKE "%$last_name%" order by CourseNumber
END;
} else {
echo "A parsing issue has occured.", "<br>";
}

return $db->query($query);
}

function viewAllClasses() {
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');
$query = 'SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, 
End FROM classes order by CourseNumber';
$result = $db->query($query);
print_result($result, 'all');
echo 'in function';
// Closing db connection
$result->closeCursor();
$db = null;
}

?>
