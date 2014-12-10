<html>
<?php
//work in progress... enter at your own risk
echo("whos da penguins whos da penguin - i am");
include 'Functions.php';
//FLUSH QUERY CACHE;

// Connecting, selecting database
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

//setting some variables
//$myusername=$_POST[username];

session_start();
$myusername = array_key_exists('username', $_SESSION) ? $_SESSION['username'] : null;
//echo $myusername;
//$myusername="jimmy"; //testing purposes once Schedulize.php is called this can be deleted and it will pull in username;
//echo $myusername;
$dbname = "EnrolledIn";
$dbname2 = "classes";
$sql="SELECT CourseSec FROM $dbname as a, $dbname2 as b WHERE a.studentuser='$myusername' and a.classCRN=b.CRN";
$result = $db->query($sql);
$count=$result->rowCount();
//echo ("$count <br>");
$i = 0;
$sections=array();
$courses=array(); //array to hold courses w/o section
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//populate courses array with the course minus section number to be used in sql query
		$unparsed=$row['CourseSec'];
		list($course, $section) = preg_split('[-]', $unparsed);
//		echo ("$course <br>");
		$courses[$i] = $course;
		$i=$i+1;
	}
	$arrsize = count($courses);
//	echo("$arrsize");
	$a=0;
	$s=1;
	for($j=0; $j<$arrsize; $j++){
		$sql="SELECT Title, Subject FROM $dbname2 where CourseSec LIKE '$courses[$j]%'";
		$result = $db->query($sql);	
		 while($row = $result->fetch(PDO::FETCH_ASSOC)) { //just prints not populating
                	$Title=$row['Title'];
			$Subject=$row['Subject'];
		}
                $sections[$a]=$Title;
                $sections[$s]=$Subject;
//                echo ("$sections[$a]");
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
//echo("<br>"); echo($secsize); echo("<br>");
//print_r($sections);
for($j=0; $j<$secsize; $j=$j+2)
{
	$sql="SELECT a.*, b.classCRN, c.SectionNumber FROM $dbname3 as a, $dbname as b, $dbname2 as c WHERE a.classTitle='$sections[$a]' and a.subject='$sections[$s]' and b.classCRN = c.CRN and c.Title = a.classTitle";
	$result = $db->query($sql);
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$scoredata[] =  implode("; ", $row);
	}
	$handle = fopen('query.txt', 'w+');
	fwrite($handle, implode("\r\n", $scoredata));
	fclose($handle);
	/* while($row = mysqli_fetch_array($result))
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
	$a=$a+2;
	$s=$s+2;
}
$result->closeCursor();
$db = null;
//$command = escapeshellcmd('schedular.py');
//$output = shell_exec($command);
//echo $output;
$command = escapeshellcmd('./scheduler.py');
$output = exec($command);
//echo $output;
//$result = exec('pyton scheduler.py');
?>
<head>

  <meta http-equiv="refresh" content="0; url=Schedule.html" />

</head>
</html>
