<?php
session_start();
include 'connect.php';
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
function modify() {
    if(isset($_POST['modifyForm']) && !empty($_POST['nameModify']) && !empty($_POST['roleModify'])) {
        $nameMod = $_POST['nameModify'];
        $roleMod = $_POST['roleModify'];
        $connect = getDBConnection();
        $sql = "SELECT * FROM `characters` WHERE character_name='$nameMod';";
        $statement = $connect->prepare($sql);
        $statement->execute();
        if($statement->rowCount() > 0) {
            $sql = "UPDATE `characters` SET `character_role`='$roleMod' WHERE `characters`.`character_name`='$nameMod';";
        }
        else {
            echo "FAIL";
        }
        $statement = $connect->prepare($sql);
        $statement->execute();
    }
}
function deleteInfo() {
    if(isset($_POST['deleteForm']) && !empty($_POST['nameDelete'])) {
        $nameDel = $_POST['nameDelete'];
        $connect = getDBConnection();
        $sql = "SELECT * FROM `characters` WHERE character_name='$nameDel';";
        $statement = $connect->prepare($sql);
        $statement->execute();
        if($statement->rowCount() > 0) {
            $sql = "DELETE FROM `characters` WHERE character_name='$nameDel'";
        }
        else {
            echo "FAIL";
        }
        $statement = $connect->prepare($sql);
        $statement->execute();
    }
}
function insert() {
    if(isset($_POST['insertForm']) && !empty($_POST['name']) && !empty($_POST['role']) && !empty($_POST['win']) && !empty($_POST['role'])) {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $win = $_POST['win'];
        $play = $_POST['play'];
        $connect = getDBConnection();
        $sql = "INSERT INTO `characters`(`character_name`, `character_role`, `character_winrate`, `character_play`) VALUES('$name', '$role', '$win', '$play')";
        $statement = $connect->prepare($sql);
        $statement->execute(); 
    }
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
        <?php
        if($_SESSION['username'] == "admin") {
            echo "<h1> Welcome Adminitrator! </h1>";
            echo "<form id='logout' method='post'>";
            echo "<input type='submit' name='logout' id='logoutBtn' value='Logout' />";
            echo "</form>";
        }
        ?>
        <br/>
        <?php
            echo "<div id='record'>";
            echo "<form method='post' id='modify'>";
            echo "Modify Characters Role<br/>";
            echo "Enter Name: <input type='text' name='nameModify' placeholder='Name of Character'/> <br/>";
            echo "Enter New Role: <select name ='roleModify'>
            <option value=''>Select One</option>
            <option value='Top'>Top</option>
            <option value='Jungle'>Jungle</option>
            <option value='Middle'>Middle</option>
            <option value='ADC'>ADC</option>
            <option value='Support'>Support</option>
            </select><br/>";
            echo "<input type='submit' name='modifyForm' value='Modify Info'/>";
            echo "</form><br/>";
            if(isset($_POST['modifyForm'])){
                modify();
            }
            echo "<form method='post' id ='delete'>";
            echo "Delete Characters <br/>";
            echo "Enter Name: <input type='text' name='nameDelete' placeholder='Name to Delete'/> <br/>";
            echo "<input type='submit' name='deleteForm' value='Delete Info'/>";
            echo "</form><br/>";
            if(isset($_POST['deleteForm'])) {
            deleteInfo();
            }
            echo "<form method='post' id='insert'>";
            echo "Insert Characters <br/>";
            echo "Enter Name: <input type='text' name='name' placeholder='Name to Add'/> <br/>";
            echo "Enter Role: <input type='text' name='role' placeholder='Role to Add'/> <br/>";
            echo "Enter Win Rate: <input type='text' name='win' placeholder='WinRate to Add'/> <br/>";
            echo "Enter Play Rate: <input type='text' name='play' placeholder='PayRate to Add'/> <br/>";
            echo "<input type='submit' name='insertForm' value='Insert Info'/>";
            echo "</form><br/>";
            echo "</div>";
            if(isset($_POST['insertForm'])) {
            insert();
            }
            echo "<form method='post' id='avg'>";
            echo "<input type='submit' name='winrate' id='winrate' value='Average Winrate' />";
            echo "<input type='submit' name='playrate' id='winrate' value='Average Playrate' />";
            echo "<input type='submit' name='result' id='result' value='Average Both' /><br/>";
            if(isset($_POST['winrate'])) {
                echo "<span class='winResult' id='winResult'></span><br/><br/>";
            }
            if(isset($_POST['playrate'])) {
                echo "<span class='playResult' id='playResult'></span><br/><br/>";
            }
            if(isset($_POST['result'])) {
                echo "<span class='avgResult' id='avgResult'></span><br/><br/>";
            }
            echo "</form>";
        $connect = getDBConnection();
        $sql = "SELECT * FROM `characters`";
        $statement = $connect->prepare($sql);
        $statement->execute();
        if($statement->rowCount() > 0) {
        echo "<table id='table' align='center'>";
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
        echo "</table> <br/><br/>";
        }
        else {
            echo "0 results";
        }
        ?>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/info.js"></script>
</html>