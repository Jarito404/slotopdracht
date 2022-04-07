<?php
session_start();
$mail = $_POST["mail"];
$password = $_POST["pwd"];

#om te kijken of er überhaupt iets is ingevuld
if(count($_POST)) {
require 'db.php';
$conn = connect();

$sql = "SELECT * 
FROM `account`, 
(SELECT @mail := '$mail', @password := '$password') AS var 
WHERE Email=@mail 
AND Password=@password";

#als er een match is, dan sta je als online
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	#we gaan ervan uit dat elk account uniek is, dus er is slechts 1 match, dus we hoeven niet geen while-loop te gebruiken
  $row = $result->fetch_assoc();
  if ($row["Type"] == "student") {   
  $_SESSION['nummer'] = $row["nummer"];
	$_SESSION['student'] = true;
  echo "
    <script type=\"text/javascript\">
      window.location.replace('/online/studentEnvironment');
    </script>
  ";
  #voor als de gebruiker een docent is
  } elseif ($row["Type"] == "docent") {
    $_SESSION['docent'] = true;
    echo "
    <script type=\"text/javascript\">
      window.location.replace('/docent/teacherEnvironment');
    </script>
    ";
  }
} else {
  #deze session variabele wordt vooral gebruikt voor het weergeven van de "invalid password" melding
	$_SESSION['online'] = false;
  echo "
    <script type=\"text/javascript\">
      window.location.replace('/');
    </script>
  ";
}
}
$conn->close();
?>