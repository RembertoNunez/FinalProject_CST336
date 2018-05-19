<?php
session_start();

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
}
if(isset($_POST['admin'])) {
    header("Location: login.php");
}

function displayInfo(){
    header("Location: info.php");
}

function displayTeams(){
    header("Location: teams.php");
}
function admin() {
    include 'admin.php';   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8 />
        <meta name="description" content="description">
        <title>LoL</title>
        <link rel="stylesheet" media="screen" href="css/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lekton" rel="stylesheet">
    </head> 
    <body>
        <header>
        <h1>
            LEAGUE OF LEGENDS STATS
        </h1>
        <div class="wrapper">
        <ul id="nav">
            <li class="right"><a href="index.php">Home</a></li>
        	<li class="right"><a href="info.php">Characters</a></li>
        	<li class="left"><a href="teams.php">Teams</a></li>
        </ul>
        </div>
        </header> <br/> <br/>
        <div id='index'>
            <?php  
                echo "<h2>Welcome User!</h2> <br/>";
                echo "<form method='post' id='admin'>";
                echo "<p>Register as an Admin</p>";
                echo "<input type='submit' name='admin' id='admin' value='Admin' /> <br/><br/><br/>";
                echo '</form>';
            ?> 
        </div>
    </body>
</html>