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
		//echo $courses[$i]; echo ("<br>");
		$i=$i+1;
	}
	$arrsize = count($courses);
	echo("$arrsize");
	//$sections=array();
	$a=0;
	$s=1;
	for($j=0; $j<$arrsize; $j++){
		$sql="SELECT Title, Subject FROM $dbname2 where CourseSec LIKE '$courses[$j]%'";
		$result=mysqli_query($link, $sql) or die('Query failed: ' . mysql_error());
		 while($row = mysqli_fetch_array($result)) { //just prints not populating
                	$Title=$row['Title'];
			$Subject=$row['Subject'];
		}
                $sections[$a]=$Title;
                $sections[$s]=$Subject;
                $a=$a+2;
                $s=$s+2;
	}
//at this point:
//sections is an array containing Title and subject of each class the person is in we will use to query classTimes
//courses is no longer needed, but is an array containing previously queried info like "ROSOP20201"
//	print_r($sections);
//	print_r($courses);
$dbname3 = "classTimes";
$a=0;
$s=1;
$acp=0; //position in allclasses array
$allclass = array();
$secsize=count($sections); //section array is size/2 cuz ot hold Title AND subject next to each other
echo("<br>"); echo($secsize); echo("<br>");
//print_r($sections);
       // $sql="SELECT a.*, b.classCRN, c.SectionNumber FROM $dbname3 as a, $dbname as b, $dbname2 as c WHERE a.classTitle='$sections[$a]' and b.classCRN = c.CRN and c.Title = a.classTitle";
       // $result=mysqli_query($link, $sql) or die('Query failed: ' . mysql_error());
       //while($row = mysqli_fetch_array($result)){
       //        $scoredata[] =  implode("; ", $row);
       // }
       // $handle = fopen('query.txt', 'w+');
       // fwrite($handle, implode("\r\n", $scoredata));
       // fclose($handle);

for($j=0; $j<=$secsize; $j=$j+1)
{
	$sql="SELECT a.*, b.classCRN, c.SectionNumber FROM $dbname3 as a, $dbname as b, $dbname2 as c WHERE a.classTitle='$sections[$a]' and b.classCRN = c.CRN and c.Title = a.classTitle";
	$result=mysqli_query($link, $sql) or die('Query failed: ' . mysql_error());
	while($row = mysqli_fetch_array($result)){
		$scoredata[] =  implode("; ", $row);
	}
	$handle = fopen('query.txt', 'w+');
	fwrite($handle, implode("\r\n", $scoredata));
	fclose($handle);
/*	while($row = mysqli_fetch_array($result))
	{
		$allclass[$acp]=$row['classTitle'];
                $allclass[$acp+1]=$row['subject'];
                $allclass[$acp+2]=$row['day1'];
                $allclass[$acp+3]=$row['day2'];
                $allclass[$acp+4]=$row['day3'];
                $allclass[$acp+5]=$row['startTime'];
                $allclass[$acp+6]=$row['endTime'];
                $allclass[$acp+7]=$row['numDays'];
		$acp=$acp+8;
	}*/
	$a=$a+1;
	$s=$s+1;
}
	echo ("<br>");
	echo ("<br>");
print_r($allclass);
	$schedules = array();
	$possible_schedule = array();
//echo("shit");
?>

</html>
