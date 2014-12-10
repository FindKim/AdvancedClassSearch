<html>
<?php
//work in progress... enter at your own risk


// Connecting, selecting database
$link = new mysqli('localhost', 'jgavin', 'jgav23', 'jgavin')
    or die('Could not connect: ' . mysql_error());
//mysql_select_db('jgavin') or die('Could not select database');

//setting some variables
//$myusername=$_POST['username'];
$myusername="jimmy"; //testing purposes once Schedulize.php is called this can be deleted and it will pull in username;
$dbname = "EnrolledIn";
$dbname2 = "classes";
$sql="SELECT CourseSec FROM $dbname as a, $dbname2 as b WHERE a.studentuser='$myusername' and a.classCRN=b.CRN";
$result=mysqli_query($link, $sql) or die('Query failed: ' . mysql_error());
$count=$result->num_rows;
//$result = mysql_query($sql);
$i = 0;
$courses=array(); //array to hold courses w/o section
	while($row = mysqli_fetch_array($result)) { //populate courses array with the course minus section number to be used in sql query
		$unparsed=$row['CourseSec'];
		list($course, $section) = preg_split('[-]', $unparsed);
		$courses[$i] = $course;
		echo $courses[$i]; echo ("<br>");
		$i=$i+1;
	}
	$arrsize = count($courses);
	$sections=array();
	for($j=0; $j<$arrsize; $j++){
		$a=0;
		$s=1;
		$d=2;
		$sql="SELECT Title, ClassTime, CRN FROM $dbname2 where CourseSec LIKE '$courses[$j]%'";
		$result=mysqli_query($link, $sql) or die('Query failed: ' . mysql_error());
		 while($row = mysqli_fetch_array($result)) { //just prints not populating
                	$Title=$row['Title'];
			$ClassTime=$row['ClassTime'];
			$CRN=$row['CRN'];
			//echo("Title:$Title ClassTime:$ClassTime CRN:$CRN <br> ");
                	$sections[$a]=$Title;
			$sections[$s]=$ClassTime;
			$sections[$d]=$CRN;
			//echo("Title:$sections[$a] ClassTime:$ClassTime CRN:$CRN <br> ");
			$a=$a+3;
			$s=$s+3;
			$d=$d+3;
		}
			$courses[$j]=$sections;
			unset($sections);
			$sections = array();

	}
	print_r($courses);
	echo ("<br>");
	echo ("<br>");
	$schedules = array();
	$possible_schedule = array();
	$num_of_courses = count($courses);
	$num_of_sections1 = count($courses[0]);
	$current_course=0;
//echo("shit");
?>

</html>
