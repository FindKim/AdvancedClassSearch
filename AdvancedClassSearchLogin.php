<html>
<head>
<link rel="icon" type="image/png" href="http://dsg1.crc.nd.edu/cse30246f14/ngo/NDicon.png">
<link rel="stylesheet" href="Tables.css">
<title>Advanced Class Search</title>
</head>
<body>

<h1>University of Notre Dame<br>Class Search</h1>
<div class="footer">Created by Jake Gavin, Kim Ngo, and James Bowyer -- CSE Class of 2016</div>

<?php
include 'Functions.php';


// Connecting, selecting database
global $cache, $db;
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

// Check user credential
// Starting session to store username and password variable
session_start();
$username = array_key_exists('username', $_SESSION) ? $_SESSION['username'] : null;
$password = '';
$loggedin = 0;
if ($username == '') {
	$username = array_key_exists('username', $_POST) ? $_POST['username'] : null;
	$password = array_key_exists('username', $_POST) ? $_POST['password'] : null;

	if ($username == '') { $loggedin = 0; }

	else {
	//echo "NEW SESSION";
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	$loggedin = 1;
	//echo $_SESSION['username'];
	}
} else {
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$username = str_replace(';', '', $username);
	$password = str_replace(';', '', $password);
	$loggedin = 1;
	//echo "IN SESSION, $username";
}

$sql="SELECT * FROM student WHERE username='$username' and password='$password'";
$result = $db->query($sql);
//count number of returned rows will only be one if
// username and password are same
$count = $result->rowCount();
//$count=mysql_num_rows($result);

// Credentials do not match
if ($count != 1) {
?>
<meta http-equiv="refresh" content="0; url=http://dsg1.crc.nd.edu/cse30246f14/ngo/WrongLogin.php" />
<?php
// Valid user credential
} else {

// Print username
echo '<br>Username: ';
echo $username, "<br><br>";

?>
<!--Logout-->
<form action="Logout.php" method="get">
<form><input type="button" value="Logout" class="button"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/Logout.php'"></form?
</form> 

<!--Change password functionality-->
<form action="NewPassword.php" method="get">
<form><input type="button" value="New Password" class="button"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/NewPassword.php'"></form>
</form>

<!--Search by keyword functionality-->
<form action="KeywordSearch.php" method="get">
<input type="textbox" name="keyword" placeholder="Search by keyword" class="rounded">
</form>

<!--Search by Professor functionaility-->
<form action="TeacherSearch.php" method="get">
<input type="textbox" name="teacher" placeholder="Search by professor" class="rounded">
</form>

<!--Make a Random Schedule-->
<form action="SchedulizeFinal.php" method="get">
<form><input type="button" value="Make a Schedule" class="button"
onClick="window.location.href='http://dsg1.crc.nd.edu/cse30246f14/ngo/SchedulizeFinal.php'"></form>
</form>



<!--Search by Subject functionaility-->
<form action = "SubjectSearch.php" method = "get">
<div align="center">
<select name="subject" class="styled-select">
	<option selected value="ACCT">Accountancy
	<option value="AME">Aerospace and Mechanical Engr.
	<option value="AFAM">African & African-American Stu
	<option value="AFST">Africana Studies
	<option value="AS">Air Force-Aerospace Studies
	<option value="AMST">American Studies
	<option value="ANTH">Anthropology
	<option value="ACMS">Applied & Comp Math and Stats
	<option value="MEAR">Arabic Language and Literature
	<option value="ARCH">Architecture
	<option value="ARHI">Art History
	<option value="ARST">Art Studio
	<option value="ART">Art,Art History,& Design (SMC)
	<option value="AL">Arts and Letters (Non-dept.)
	<option value="CORE">Arts and Letters - Core
	<option value="ALHN">Arts and Letters - Honors
	<option value="ALPP">Arts and Letters Preprofessnal
	<option value="ASIA">Asian Studies
	<option value="BIOS">Biological Sciences
	<option value="BIO">Biology (SMC)
	<option value="BAAC">Bus Admin - Accounting/Bus Law
	<option value="BALW">Bus Admin - Business Law
	<option value="BACM">Bus Admin - Communication
	<option value="BAEN">Bus Admin - Entrepreneurship
	<option value="BAET">Bus Admin - Ethics
	<option value="BAFI">Bus Admin - Finance
	<option value="BAMG">Bus Admin - Management
	<option value="BA">Business Administration
	<option value="BUAD">Business Administration (SMC)
	<option value="BAAL">Business Administration - A&L
	<option value="BAEG">Business Administration - EG
	<option value="BASC">Business Administration - SC
	<option value="BAUG">Business Administration - UG
	<option value="CST">Catholic Social Tradition
	<option value="CSC">Center for Social Concerns
	<option value="CBE">Chemical & Biomolecular Engr.
	<option value="CHEM">Chemistry and Biochemistry
	<option value="EALC">Chinese
	<option value="CE">Civil Engineering
	<option value="CLAS">Classics in Translation
	<option value="CSEM">College Seminar
	<option value="CA">Communication Arts
	<option value="COMM">Communications (SMC)
	<option value="CSD">Communicative Sciences (SMC)
	<option value="CAPP">Computer Applications
	<option value="CPSC">Computer Science (SMC)
	<option value="CSE">Computer Science and Engr.
	<option value="CNST">Constitutional Studies
	<option value="DANC">Dance (SMC)
	<option value="DESN">Design
	<option value="DMA">Doctor of Musical Arts
	<option value="ESTM">EG, SC & Tech Entrepreneurship
	<option value="LLEA">East Asian Lang & Lit
	<option value="ECON">Economics
	<option value="ECOE">Economics and Econometrics
	<option value="EDU">Education
	<option value="EDUC">Education (SMC)
	<option value="ESS">Education, School and Society
	<option value="EE">Electrical Engineering
	<option value="ENER">Energy Studies
	<option value="ESTS">Eng., Science, Tech. & Society
	<option value="EG">Engineering (Non-Departmental)
	<option value="EGBA">Engineering Business Program
	<option value="EGSC">Engineering Science Program
	<option value="ENGL">English
	<option value="ELS">English Language School (SMC)
	<option value="ENLT">English Literature (SMC)
	<option value="ENWR">English Writing (SMC)
	<option value="ENVG">Environmental Geosciences
	<option value="ENVS">Environmental Studies (SMC)
	<option value="FTT">Film, Television, and Theatre
	<option value="FIN">Finance
	<option value="FYC">First Year Composition
	<option value="FYS">First Year of Studies
	<option value="ROFR">French
	<option value="GWS">Gender & Women's Studies (SMC)
	<option value="GSC">Gender Studies
	<option value="GE">German
	<option value="GERO">Gerontology (SMC)
	<option value="GH">Global Health - Eck Institute
	<option value="GLST">Global Studies (SMC)
	<option value="GRED">Graduate Education
	<option value="CLGR">Greek Language and Literature
	<option value="MEHE">Hebrew Language and Literature
	<option value="HESB">Hesburgh Prg in Public Service
	<option value="HIST">History
	<option value="HPS">History and Phil. of Science
	<option value="HUST">Humanistic Studies (SMC)
	<option value="HUM">Humanities Seminar
	<option value="IUSM">Indiana U. Sch of Med. S. Bend
	<option value="IIPS">Inst. for Int'l Peace Studies
	<option value="IBMS">Integrated Biomedical Sciences
	<option value="ICS">Intercultural Studies (SMC)
	<option value="IDS">Internatnl Development Studies
	<option value="IRLL">Irish Language and Literature
	<option value="IRST">Irish Studies
	<option value="ROIT">Italian
	<option value="EALJ">Japanese
	<option value="JED">Journalism, Ethics & Democracy
	<option value="JUST">Justice Studies (SMC)
	<option value="EALK">Korean
	<option value="LAST">Latin American Studies
	<option value="CLLA">Latin Language and Literature
	<option value="ILS">Latino Studies
	<option value="LAW">Law
	<option value="LIT">Literature
	<option value="MBCM">MBA Bus Communications
	<option value="MBET">MBA Business Ethics
	<option value="MBLW">MBA Business Law
	<option value="MBAC">MBA Chicago
	<option value="MBAE">MBA Executive Program
	<option value="MBGR">MBA General
	<option value="MBAL">MBA Local
	<option value="MGT">Management
	<option value="MGTC">Management - Consulting
	<option value="MGTE">Management - Entrepreneurship
	<option value="MGTI">Management - IT
	<option value="MARK">Marketing
	<option value="MBA">Master of Business Admin.
	<option value="MNA">Master of Nonprofit Admin.
	<option value="MSM">Master of Sacred Music
	<option value="MSBA">Master of Sc in Bus Analytics
	<option value="MSB">Master of Science Business
	<option value="MSA">Master of Science in Admin.
	<option value="MSF">Master of Science in Finance
	<option value="MSMG">Master of Science in Mgtment
	<option value="MATH">Mathematics
	<option value="MI">Medieval Institute
	<option value="MELC">Middle Eastern Studies
	<option value="MSL">Military Science (Army ROTC)
	<option value="MODL">Modern and Classical Languages
	<option value="MUS">Music
	<option value="NSCI">Naval Science (ROTC)
	<option value="CLST">Near East Lit./Culture in Engl
	<option value="NURS">Nursing (SMC)
	<option value="PATC">Patent Law
	<option value="PATL">Patent Law Masters
	<option value="PHIL">Philosophy
	<option value="PRL">Philosophy, Religion and Lit
	<option value="PE">Physical Education
	<option value="PHYS">Physics
	<option value="POLS">Political Science
	<option value="POSC">Political Science (SMC)
	<option value="ROPO">Portuguese
	<option value="PS">Poverty Studies
	<option value="PCSE">Pre-College Summer Experience
	<option value="PLS">Program of Liberal Studies
	<option value="PSY">Psychology
	<option value="PSYC">Psychology (SMC)
	<option value="REG">Registrar's Office
	<option value="RLT">Religion and Literature
	<option value="RLST">Religious Studies (SMC)
	<option value="LLRO">Romance Lang & Lit
	<option value="RU">Russian
	<option value="SC">Science (Non-departmental)
	<option value="SCPP">Science Preprofessional
	<option value="STV">Science, Technology and Values
	<option value="SDM">Self Designed Major (SMC)
	<option value="SBCM">So. Bend Cen for Medical Educ.
	<option value="SW">Social Work (SMC)
	<option value="SOC">Sociology
	<option value="SPLL">Sophia Program (SMC)
	<option value="ROSP">Spanish
	<option value="SMC">St. Mary's
	<option value="SUS">Sustainability
	<option value="CLSS">Syriac Language and Literature
	<option value="THTR">Theatre (SMC)
	<option value="THEO">Theology
	<option value="UB">Upward Bound Program
	<option value="VHNR">VHNR (SMC)
	<option value="WOST">Women's Studies (SMC)
	<option value="WR">Writing and Rhetoric

</select>
<input type="submit" value="Search By Subject" class="button">
</div>
</form>

<!--Search by Subject functionaility-->
<form action = "DaySearch.php" method = "get">
<div align=center> 
<select name="day" class="styled-select">
        <option selected value="M W F">M W F
        <option value="M W">M W
        <option value="T R">T R
        <option value="M">M
        <option value="T">T
        <option value="W">W
        <option value="R">R
        <option value="F">F
</select>
<input type="submit" value="Search By Day" class="button">
</div>
</form>

<?php

echo PHP_EOL;
$query = <<<END
SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End
FROM classes, EnrolledIn
WHERE studentuser = "$username"
AND classCRN = CRN order by CourseNumber 
END;

$result = $db->query($query);
print_user_results($result);

// Free resultset
$result->closeCursor();

// Button to display scheduled books
echo "<br>";
?>
<form action="BooksUser.php" method="get">
<button name="UserBooks" class="rounded" value="<?php echo $username; ?>"/>Cost for books</button>
</form>


<br>
<br>

<?php

if (isset($_POST['All'])) {
// Performing SQL query
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');
$query = 'SELECT CourseSec, Title, Credits, ST, Max, Open, Xlst, CRN, Instructor, ClassTime, Begin, End FROM classes';
$result = $db->query($query);
print_result($result, 'All classes');
// Closing db connection
$result->closeCursor();
$db = null;
?>
<input name="All" type="submit" value="" class="rounded" disabled=true>
<?php
unset($_POST['All']);
}

// Add class for user
// check if the form has been submitted
if (isset($_POST['Add'])) {
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');
   if ($username !== '' || $_POST['CRN'] !== '') {
        $sql = "SELECT * FROM EnrolledIn WHERE studentuser = '$username' and classCRN = '$_POST[Add]'";
        $result = $db->query($sql);
        $count = $result->rowCount();
        if ($count < 1) {
                $sql = "INSERT INTO EnrolledIn (`studentuser`, `classCRN`) VALUES ('$username', '$_POST[Add]')";
		$result = $db->query($sql);
	}
   }
// once saved, redirect back to view page
$result->closeCursor();

// Closing connection
$db = null;

// Unset post
unset($_POST['Add']);
?>
<meta http-equiv="refresh" content="0">
<?php
}


// Remove class for user
// check if the form has been submitted
else if (isset($_POST['Remove'])) {
$db = new PDO('mysql:host=localhost;dbname=jgavin', 'jgavin', 'jgav23');

   if ($username !== '' || $_POST['CRN'] !== '') {
        $sql = "DELETE FROM EnrolledIn WHERE studentuser='$username' and classCRN='$_POST[Remove]'";
	$result = $db->query($sql);
   }
// once saved, redirect back to view page
$result->closeCursor();

// Closing connection
$db = null;
// Unset post
unset($_POST['Remove']);

// Refreshes page with new results
?>
<meta http-equiv="refresh" content="0">
<?php

}




}

?>
