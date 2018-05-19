<?php
session_start();
?>
<?php
session_start();
include 'connect.php';
$connect = getDBConnection();
$sql = "SELECT * FROM `characters`";
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
            Characters
        </h1>
        <div class="wrapper">
        <ul id="nav">
            <li class="right"><a href="index.php">Home</a></li>
        	<li class="right"><a href="info.php">Characters</a></li>
        	<li class="left"><a href="teams.php">Teams</a></li>
        </ul>
        </div>
        </header>
        <div id='info'>
            <h2>Search for a League of Legends Character</h2>
            <form method="post">
                <input type="submit" name="display" value="Display All"/><br/><br/>
                <input type="text" name="value" placeholder="Search for Characters"/>
                    <select name="column">
                        <option value="">Select One</option>
                        <option value="character_role">Character Role</option>
                        <option value="character_winrate">Character Winrate</option>
                        <option value="character_play">Character Play Rate</option>
                    </select>
                <input type="submit" name="search" value="Search"/><br/><br/>
                <?php
                if(isset($_POST['display'])){
                    if($statement->rowCount() > 0) {
                    //successful
                    echo "<table>";
                    echo "<tr background-color='background-color:#0000ff'>";
                    echo "<th>Character Name</th>";
                    echo "<th>Character Role</th>";
                    echo "<th>Character Win Rate</th>";
                    echo "<th>Character Play Rate</th>";
                    echo "</tr>";
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row["character_name"]. "</td>";
                        echo "<td>" . $row["character_role"]. "</td>";
                        echo "<td>" . $row["character_winrate"]. "</td>";
                        echo "<td>" . $row["character_play"]. "</td>";
                    }
                    echo "</table>";
                    } 
                    else {
                        echo "0 results";
                    }
                }
                else if(!empty($_POST['value']) && !empty($_POST['column'])) {
                   if(isset($_POST['value']) && isset($_POST['column'])) {
                       if($statement->rowCount() > 0) {
                        //successful
                        $bool = false;
                        echo "<table>";
                        echo "<tr>";
                        echo "<th>Character Name</th>";
                        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            if($row["character_name"] == $_POST['value'] &&  $_POST['column'] == "character_role") {
                                echo "<th>Character Role</th>";
                                echo "</tr>";
                                echo "<tr> ";
                                echo "<td>". $row["character_name"] ."</td>";
                                echo "<td>". $row["character_role"] . "</td>";
                                echo "</tr>";
                                $bool = true;
                                break;
                            }
                            else if($row["character_name"] == $_POST['value'] &&  $_POST['column'] == "character_winrate") {
                                echo "<th>Character Win Rate</th>";
                                echo "</tr>";
                                echo "<tr> ";
                                echo "<td>". $row["character_name"] ."</td>";
                                echo "<td>". $row["character_winrate"] . "</td>";
                                echo "</tr>";
                                $bool = true;
                                break;
                            }
                            else if($row["character_name"] == $_POST['value'] &&  $_POST['column'] == "character_play") {
                                echo "<th>Character Play Rate</th>";
                                echo "</tr>";
                                echo "<tr> ";
                                echo "<td>". $row["character_name"] ."</td>";
                                echo "<td>". $row["character_play"] . "</td>";
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
                    echo "<th>Character Name</th>";
                    echo "<th>Character Role</th>";
                    echo "<th>Character Win Rate</th>";
                    echo "<th>Character Play Rate</th>";
                    echo "</tr>";
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        if($row["character_name"] == $_POST['value']) {
                            echo "<tr>";
                            echo "<td>" . $row["character_name"]. "</td>";
                            echo "<td>" . $row["character_role"]. "</td>";
                            echo "<td>" . $row["character_winrate"]. "</td>";
                            echo "<td>" . $row["character_play"]. "</td>";
                        }
                    }
                    echo "</table>";
                    } 
                    else {
                        echo "0 results";
                    }
                }
                else if(isset($_POST['search']) && empty($_POST['value']) || !empty($_POST['column'])){
                    echo "<p>Sorry Nothing Search</p>";
                }
                ?>
            </form>
        </div>
    </body>
</html>