<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="../css/Leaderboard.css">

<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
 <?php
      
    $servername = "127.0.0.1";
    $username = "root";
    $password = "egr302";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
   //echo "Connected successfully";
 ?>
 
 <!--This page shows the classes that the teacher user has registered in the system-->
 
<html>
    <body>
    <audio controls autoplay loop="loop" hidden="true">
        
    <!-- this is where the audio is being controlled -->    
    <source src="../Music/Hypnotic-Puzzle3.mp3" type="audio/mpeg">
    </audio>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"></a>
        </div>
        <ul class="nav navbar-nav">
          <li><button class="button2" onclick="window.location='../php/Teacher_Profile.php'">Profile</button></li>
          <li><button class="button3" onclick="window.location='../php/SignOut.php'">Sign Out</button></li>
          <li><button class="button4" onclick="window.location='../php/Settings.php'">Settings</button></li>
        </ul>
      </div>
    </nav>
        <div class="container">
        <table class="table" border = "2" style="width:50% left:50%" >
            <?php $_SESSION["classname"] = $_GET["classname"];?>
            <p1>Students of <?=$_SESSION["classname"]?></p1>
            <tr>
            <th>Student</th><th>Username</th><th>WPM</th><th>Accuracy</th><th>Average</th>
            </tr>
            </div>
            </td></tr>
            <?php
                $sql = "USE egr302";
                if($conn -> query($sql) == TRUE){
                    $studentSql = "SELECT student_TBL.studentID, student_TBL.firstName, student_TBL.lastName, student_TBL.username
                        FROM student_TBL, class_TBL WHERE 
                        class_TBL.fk_studentID = student_TBL.studentID AND
                        class_TBL.className = '" .$_SESSION["classname"]."'";
                        
                        $selectStudent = mysqli_query($conn,$studentSql);
                
                while ($studentRow = mysqli_fetch_assoc($selectStudent)) {
                    
                        $studentName = $studentRow["firstName"]. " " .$studentRow["lastName"];
                        $characterSql = "SELECT UserCharacter.Wpm, UserCharacter.Accuracy FROM UserCharacter 
                            WHERE fkUserID = ".$studentRow["studentID"];
                        $characterSelect = mysqli_query($conn, $characterSql);
                        $characterRow = mysqli_fetch_assoc($characterSelect);
                        
                ?>
            <tr>
                    
                <td><?=$studentName?></td>
                <td><?=$studentRow["username"]?></td>
                <td><?php if ($characterRow["Wpm"]){ print $characterRow["Wpm"];} else { print "N/A";} ?></td>
                <td><?php if ($characterRow["Accuracy"]) { print $characterRow["Accuracy"];} else { print "N/A";}?></td>
                
                <td><?= $characterRow["Wpm"] / $characterRow["Accuracy"] ?></td>
            </tr>
            <?php } $conn -> close(); }?>
        </table>
        
        </br>
        
        <button class="button1" onclick="window.location='../php/Teacher_Profile.php'">Back</button>

    </body>
</html>