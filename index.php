<?php
ini_set('session.gc_maxlifetime', 3600);

//de sessie ID wordt voor 3600 seconden lang onthouden
session_set_cookie_params(3600);

session_start();

#dit is voor als de student al is ingelogd, want deze hoeft niet bij het inlogscherm te komen
if(isset($_SESSION['student'])) {
	echo "
	<script type=\"text/javascript\">
		  window.location.replace('/online/studentEnvironment');
	</script>
  ";
} elseif(isset($_SESSION['docent'])) {
	echo "
	<script type=\"text/javascript\">
		  window.location.replace('/docent/teacherEnvironment');
	</script>
  ";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Home</title>
	<link href="style/home/style.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="https://kit.fontawesome.com/c298114dd8.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <div id="Menu">
        </div>
        <h1>AJA Leren</h1>
	</div>
	<div id="Inlog">
        <h2> Inloggen </h2>
        <div id="Input">
			<form action="login_proces.php" method="post">
				<label for="mail">Mail</label><br>
				<input type="text" class="input" name="mail"><br>
				<label for="pwd">Password:</label><br>
				<input type="password" class="input" name="pwd"><br><br>
				<input id="submit" type="submit" value="Login"/>
			</form>
			<?php
				if(isset($_SESSION['online'])){
					if($_SESSION['online'] == false) {
						echo '<div style="color:#B72409;width:64%;height:16%;margin-top:-50%;margin-right:-25%;font-style:bold;position:center;text-align:right;padding-top:10%;"><p>Invalid Credentials.</p></div>';
					}
				}
			?>
		</div>
		</div>
	</div>	
</body>
</html>