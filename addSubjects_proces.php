<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Subjects</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
</head>
<body>
<?php 
require 'db.php';
$conn = connect();
date_default_timezone_set('Europe/Amsterdam');

$subjectID = $_POST['subjectID'];
$date = date("Y-m-d", strtotime($_POST['deadline']));
$title = $_POST['title'];

if($subjectID!= NULL) {
$sql = "
INSERT INTO `homework` (`id`,`subject_id`,`date`,`title`,`content`) 
VALUES (NULL,'$subjectID','$date','$title','Te lui om dit aan te passen')";

if ($conn->query($sql) === TRUE) {
  echo "<script type=\"text/javascript\">
        window.alert('Succes');
		window.location.replace('/docent/addSubjects');
      </script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>
</body>
</html>