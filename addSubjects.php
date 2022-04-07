<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Subjects</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="style/styleSubject.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<form action="addSubjects_proces.php" method="post">
	<select id="subjects" name="subjectID">
		<option value="1">Nederlands</option>
	</select>
	
	<label for="deadline">Deadline:</label>
	<input type="date" id="deadline" name="deadline"
       value="2022-01-01"
       min="2022-01-01" max="2023-12-31">
	
	<label for="title">Onderwerp:</label>
	<input type="text" id="title" name="title">
	<input type="submit" name="Voeg in">
</form>
</body>
</html>