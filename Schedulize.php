<html>
<?php
//work in progress... enter at your own risk


// Connecting, selecting database
$link = mysql_connect('localhost', 'jgavin', 'jgav23')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('jgavin') or die('Could not select database');

//setting some variables
//$myusername=$_POST['username'];
$myusername="jimmy"; //testing purposes once Schedulize.php is called this can be deleted and it will pull in username;
$dbname = "EnrolledIn";
$dbname2 = "classes";
$sql="SELECT CourseSec FROM $dbname as a, $dbname2 as b WHERE a.studentuser='$myusername' and a.classCRN=b.CRN";
$result=mysql_query($sql) or die('Query failed: ' . mysqlerror());
$count=mysql_num_rows($result);
$result = mysql_query($sql);
$i = 0;
$courses=array(); //array to hold courses w/o section
	while($row = mysql_fetch_array($result)) { //populate courses array with the course minus section number to be used in sql query
		$unparsed=$row['CourseSec'];
		list($course, $section) = preg_split('[-]', $unparsed);
		$courses[$i] = $course;
		$i=$i+1;
	}
	$arrsize = count($courses);
	$sections=array();
	for($j=0; $j<$arrsize; $j++){
		echo $courses[$j];
		echo("<br>");
		$sql="SELECT Title, ClassTime, CRN FROM $dbname2 where CourseSec LIKE '$courses[$j]%'";
		$result=mysql_query($sql) or die('Query failed: ' . mysqlerror());
		 /*while($row = mysql_fetch_array($result)) { //just prints not populating
                	$Title=$row['Title'];
			$ClassTime=$row['ClassTime'];
			$CRN=$row['CRN'];
			echo("Title:$Title ClassTime:$ClassTime CRN:$CRN <br> ");
                }*/

	}
//echo("shit");
?>

</html>
