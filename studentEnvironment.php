<?php
session_start();

#iemand die niet is ingelogt kan eigenlijk de url intypen van de studentenomgeving en dit stuurt zo'n persoon terug
if(isset($_SESSION['student'])) {
	;
} else {
	$_SESSION['online'] = false;
  echo "
    <script type=\"text/javascript\">
      window.location.replace('/');
    </script>
  ";
}

$nummer = $_SESSION['nummer'];
require 'db.php';
$conn = connect();

$sql = "SELECT *
FROM `accountstats`,
(SELECT @nummer := $nummer) AS var
WHERE account_id=@nummer";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>AJA Leren</title>
            <link href="style/styleStudent.css" rel="stylesheet" type="text/css" media="screen" />
            <script src="https://kit.fontawesome.com/c298114dd8.js" crossorigin="anonymous"></script>
    </head>
    <style>
        body {
            overflow: auto;
        }
        #MenuButton:hover {
            cursor:pointer;
        }
        table {
            font-size: auto;
            margin-left:auto;
            margin-right:auto;
            border-collapse: collapse;
            height:auto;
            width:auto;
            color: #F2EFBD;
        }
        table th {
            font-size: 14px;
            font-weight: bold;
            border: 1px solid #999999;
            padding: 0px 5px;
        }
        table td {
            border: 1px solid #999999;
            padding: 5px 5px;
        }
        table a {
            text-decoration:none;
            color: #F2EFBD;
        }
        table a:hover{
            cursor: pointer;
            text-decoration:underline;
        }
        #playlist{
            list-style: none;
            display: none;
        }
        #playlist li a{
            color:black;
            text-decoration: none;
            display: none;
        }
        #playlist .current-song a{
            color:blue;
            display: block;
        }
        audio {
            display:none;
        }
        #audio {
            position: relative;
            margin-top: -8%;
            margin-right: 3%;
            width: 100px;
        }
    </style>
    <script>
    function logout() {
        window.location.replace('/online/logout');
    };
    </script>
    <body>
    <div class="header">
        <div id="Menu">
        <button class="fa fa-sign-out" id="MenuButton" onclick="logout()"></button>
        </div>
        <h1>AJA Leren</h1>
        <?php include 'audio.html'; ?>
        </div>
    </div>
    <div id="Main">
        <div id="character">
            <!--hier moet de caracter komen-->
        </div>
        <?php 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {       
                echo '
                <div id="info">
                    <div class="small">
                        <h2 class="center">Name: '.$row["username"].'</h2>
                    </div>
                    <div id="statistics">
                        <h2 class="center">Statistics</h2>
                        <h2 class="left"><u>S</u>trength: '.$row["strength"].'</h2>
                        <h2 class="left"><u>U</u>tility: '.$row["utility"].'</h2>
                        <h2 class="left"><u>S</u>peed: '.$row["speed"].'</h2>
                    <h2 class="center">Coins: '.$row["coins"].'</h2>
                </div>
            </div>';
            }
        }?>
        <div id="opdrachten" style='overflow:hidden;'>
           <div class="small">
             <h2 class="center">Upcoming tasks</h2>
            </div>
            <div style='overflow-y:auto;'>
                <?php
                    $sql = "SELECT *
                    FROM `homework`,`subject`
                    ORDER BY date ASC;";
                    
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<table border='1'>
                            <thead><tr>
                                <th><h2>Vak</h2></th>
                                <th><h2>Onderwerp</h2></th>
                                <th><h2>Datum</h2></th></tr>
                            </thead>";
                        while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["subject_name"]."</td><td><a>".$row["title"]."</td></a><td>".$row["date"]."</td></tr>";
                    }
                    echo "</tbody></table>";
                    } else {
                    echo "Geen tasks";
                    }
                ?>
            </div>
        <!--Hier moeten de taken komen-->
        </div>
        <div id="shop">
        </div>
    </div>
    <?php
        $conn->close();
    ?>
    </body>
	</html>