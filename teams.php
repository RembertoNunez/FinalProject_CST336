<?php
session_start();
include 'connect.php';
$connect = getDBConnection();
$sql = "SELECT * FROM `teams`";
$statement = $connect->prepare($sql);
$statement->execute();
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
            Teams
        </h1>
        <div class="wrapper">
        <ul id="nav">
            <li><a href="index.php">Home</a></li>
        	<li><a href="info.php">Characters</a></li>
        	<li class="teams"><a href="teams.php">Teams</a></li>
        </ul>
        </div>
        </header>
        <div id='team'>
        <h2>Search for a League of Legends Team</h2>
        <form method="post">
            <input type="submit" name="display" value="Display All"/><br/><br/>
            <input type="text" name="value" placeholder="Search for Team"/>
                <select name="column">
                    <option value="">Select One</option>
                    <option value="team_region">Team Region</option>
                    <option value="team_wins">Team Win</option>
                    <option value="team_losses">Team Losses</option>
                </select>
            <input type="submit" name="search" value="Search"/><br/><br/>
            <?php
            if(isset($_POST['display'])){
                if($statement->rowCount() > 0) {
                //successful
                echo "<table>";
                echo "<tr background-color='background-color:#0000ff'>";
                echo "<th>Team Name</th>";
                echo "<th>Team Region</th>";
                echo "<th>Team Wins</th>";
                echo "<th>Team Losses</th>";
                echo "</tr>";
                while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["team_name"]. "</td>";
                    echo "<td>" . $row["team_region"]. "</td>";
                    echo "<td>" . $row["team_wins"]. "</td>";
                    echo "<td>" . $row["team_losses"]. "</td>";
                }
                echo "</table>";
                } 
                else {
                    echo "0 results";
                }
            }
            if(!empty($_POST['value']) && !empty($_POST['column']) && isset($_POST['search'])) {
               if(isset($_POST['value']) && isset($_POST['column'])) {
                   if($statement->rowCount() > 0) {
                    //successful
                    $bool = false;
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Team Name</th>";
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        if($row["team_name"] == $_POST['value'] &&  $_POST['column'] == "team_region") {
                            echo "<th>Team Region</th>";
                            echo "</tr>";
                            echo "<tr> ";
                            echo "<td>". $row["team_name"] ."</td>";
                            echo "<td>". $row["team_region"] . "</td>";
                            echo "</tr>";
                            $bool = true;
                            break;
                        }
                        else if($row["team_name"] == $_POST['value'] &&  $_POST['column'] == "team_wins") {
                            echo "<th>Team Wins</th>";
                            echo "</tr>";
                            echo "<tr> ";
                            echo "<td>". $row["team_name"] ."</td>";
                            echo "<td>". $row["team_wins"] . "</td>";
                            echo "</tr>";
                            $bool = true;
                            break;
                        }
                        else if($row["team_name"] == $_POST['value'] &&  $_POST['column'] == "team_losses") {
                            echo "<th>Team Losses</th>";
                            echo "</tr>";
                            echo "<tr> ";
                            echo "<td>". $row["team_name"] ."</td>";
                            echo "<td>". $row["team_losses"] . "</td>";
                            echo "</tr>";
                            $bool = true;
                            break;
                        }
                    }
                    echo "</table>"; 
                    if($bool == false) {
                        echo "Sorry Couldn't find Team";
                    }
                    }
                }
            }
            else if(isset($_POST['search']) && !empty($_POST['value']) && empty($_POST['column'])){
                if($statement->rowCount() > 0) {
                //successful
                echo "<table>";
                echo "<tr>";
                echo "<th>Team Name</th>";
                echo "<th>Team Region</th>";
                echo "<th>Team Wins</th>";
                echo "<th>Team Losses</th>";
                echo "</tr>";
                while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    if($row["team_name"] == $_POST['value']) {
                        echo "<tr>";
                        echo "<td>" . $row["team_name"]. "</td>";
                        echo "<td>" . $row["team_region"]. "</td>";
                        echo "<td>" . $row["team_wins"]. "</td>";
                        echo "<td>" . $row["team_losses"]. "</td>";
                    }
                }
                echo "</table>";
                } 
                else {
                    echo "0 results";
                }
            }
            else if(isset($_POST['search']) && empty($_POST['value']) && empty($_POST['column'])){
                echo "<p>Sorry Nothing Search</p>";
            }
            ?>
        </form>
        </div>
    </body>
</html>