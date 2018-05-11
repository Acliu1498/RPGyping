<link rel="stylesheet" href="../css/Settings.css" type="text/css"/>

<?php session_start();
    $servername = "127.0.0.1";
    $username = "root";
    $password = "egr302";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
    <body background="../images/kindergarden2.jpg">
    <audio controls autoplay loop="loop" hidden="true">
        
    <!-- this is where the audio is being controlled -->    
      <source src="../Music/Fantasy_Game_Background.mp3" type="audio/mpeg">  
      <!--The nav bars where shows profiles should only show the type of user (ex: if teacher has logged in, there shouldn't be a tab for student profile)-->
      
    </audio>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"></a>
        </div>
        <ul class="nav navbar-nav">
          <?php if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") { ?>
            <li><button class="button1" onclick="window.location='../php/Sentences.php'">Play Game</button></li>
            <li><button class="button2" onclick="window.location='../php/Game_Profile.php'">Profile</button></li>
          <?php } else { ?>
            <li><button class="button2" onclick="window.location='../php/Teacher_Profile.php'">Profile</button></li>
          <?php } ?>
          <li><button class="button3" onclick="window.location='../php/SignOutGeneral.php'">Sign Out</button></li>
          <li><button class="button4" onclick="window.location='../php/Settings.php'">Settings</button></li>
        </ul>
      </div>
    </nav>
    </body>
</html>

<link rel="stylesheet" type="text/css" href="../css/Settings.css">

<html>
    <body background>
      <p>Settings</p>
 
        
        </br></br>
        <div class="settings">
          <div class="container">
            <div class="row">
              <form class="pwForm" action="../php/Settings.php" method=POST>
                <p1>Enter new password:</p1>
                <input type="password" name="newPW"> </br></br>
                <!--Re-enter new password:-->
                <!--<input type="password" name="samePW"></br></br>-->
                <button class="button5" type="submit" name="pwSubmit" value="Change Password" onclick="changePassword()">Change Password</button>
              </form>
              
              <form class="usernameForm" action="../php/Settings.php" method=POST>
                <p1>Enter new username:</p1>
                <input type="text" name="newUsername"> </br></br>
                <button class="button6" type="submit" name="userSubmit" value="Change Username" onclick="changeUsername()">Change Username</button>
              </form>
            </div>
          </div>
        </div>
          
        <?php
          if (isset($_POST['pwSubmit'])) {
            $newPassword = $_POST["newPW"];
            $sql = "USE egr302";
            if ($conn->query($sql) === TRUE) {
              $hash = password_hash($newPassword, PASSWORD_DEFAULT);
              $pwParentChange = mysqli_query($conn, "UPDATE parent_TBL SET password = '" .$hash."' WHERE username= '". $_SESSION["username"]."'");
              if (mysqli_query($conn, "SELECT password from student_TBL WHERE studentID='".$_SESSION["userID"]."'")) {
                $pwStudentChange = mysqli_query($conn, "UPDATE student_TBL SET password = '" .$hash."' WHERE username= '". $_SESSION["username"]."'");
              }
              else if (mysqli_query($conn, "SELECT password from teacher_TBL WHERE teacherID='".$_SESSION["userID"]."'")) {
                $pwTeacherChange = mysqli_query($conn, "UPDATE teacher_TBL SET password = '" .$hash."' WHERE username= '". $_SESSION["username"]."'");
              }
              else {
                $pwGeneralChange = mysqli_query($conn, "UPDATE generalUser_TBL SET password = '" .$hash."' WHERE username= '". $_SESSION["username"]."'");
              } 
              if ($pwParentChange && ($pwStudentChange||$pwTeacherChange||$pwGeneralChange)) {
                echo '<script type="text/javascript">completePW()</script>';
              }
              else {
                print("ERROR: ".mysqli_error($conn));
              }
            }
          }
          
          if (isset($_POST['userSubmit'])) {
            $newUsername = $_POST["newUsername"];
            $sql = "USE egr302";
            if ($conn->query($sql) === TRUE) {
              //UPDATE student_TBL SET username = newPassword WHERE id=SESSIONID#
              $userParentChange = mysqli_query($conn, "UPDATE parent_TBL SET username = '" .$newUsername."' WHERE accountID= '". $_SESSION["userID"]."'");
              if (mysqli_query($conn, "SELECT username from student_TBL WHERE studentID='".$_SESSION["userID"]."'")) {
                $userStudentChange = mysqli_query($conn, "UPDATE student_TBL SET username = '" .$newUsername."' WHERE studentID= '". $_SESSION["userID"]."'");
              }
              else if (mysqli_query($conn, "SELECT username from teacher_TBL WHERE teacherID='".$_SESSION["userID"]."'")) {
                $userTeacherChange = mysqli_query($conn, "UPDATE teacher_TBL SET username = '" .$newUsername."' WHERE teacherID= '". $_SESSION["userID"]."'");
              }
              else {
                $userGeneralChange = mysqli_query($conn, "UPDATE generalUser_TBL SET username = '" .$newUsername."' WHERE fk_userID= '". $_SESSION["userID"]."'");
              }
              if ($userParentChange && ($userStudentChange||$userTeacherChange||$userGeneralChange)) {
                $_SESSION["username"] = $newUsername;
                echo '<script type="text/javascript">completeName()</script>';
              }
            }
          }
        ?>
          
          
          <!--<button onclick="test()"></button>-->
          <!--<button onclick="test2()">TEST BUTTON</button>-->
          
        <script type="text/javascript">
          function completePW() {
            alert("Password changed");
          }
          function completeName() {
            alert("Username changed");
          }
          function test2() {
            document.getElementsById("newTEST").style.display = "none";
          }
          function test() {
            alert("TESTING");
            document.getElementById("test").style.display = "none";
          }
          function formAppear(phase) {
            if (phase == 1) {
              alert("form TESTING");
              document.getElementsByClassName("pwForm").style.display = "none";
            }
          }
        </script>
    </body>
</html>