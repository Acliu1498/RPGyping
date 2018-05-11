
<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $_SESSION["prevPage"] = "php/Teacher_Profile.php"?>
<link rel="stylesheet" href="../css/afterMasterLogin.css" type="text/css"/>

<?php session_start(); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
    <body>
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
          <li><button class="button2" onclick="window.location='../php/Teacher_Profile.php'">Profile</button></li>
          <li><button class="button3" onclick="window.location='../php/SignOutTeacher.php'">Sign Out</button></li>
          <li><button class="button4" onclick="window.location='../php/Settings.php'">Settings</button></li>
        </ul>
      </div>
    </nav>
    </body>
</html>
    
<link rel="stylesheet" type="text/css" href="../css/Teacher_profile.css">
<script src="javascript/Profile.js"></script>
<html>
    <body>
        <div class="student">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-offset-2 col-sm-8 text-center">
                        <img src="../images/teacher.svg" width="400" height="300">
                        <h2>Welcome, <?php print($_SESSION["username"]);?>!</h2>
                    </div>
                </div>    
            </div>        
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn-success" type="button" >
                            <a href="../php/createClassName.php">Add Class</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    <!--Directs user to go to student list of class selected-->
    <?php
        if (isset($_POST["submit"])) {
            print("TEST");
            $class = $_POST['Classes'];
            $_SESSION["classname"] = $class;
            print("Class selected: " .$class);
            //header("location: ../php/ClassList.php");
            header("location: ../php/Teacher_Profile.php");
        }
    ?>
    
  
     
     <!--Alternate version: have classes displayed as a user-->
     <table border="1" width=75% align="center">
         <caption> Classes available: </caption>
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
         
         <?php
            $sql = "USE egr302";
            if($conn ->query($sql) === TRUE){
                $selectClass= 
                    "SELECT DISTINCT class_TBL.className FROM class_TBL, teacher_TBL
                        WHERE teacher_TBL.username = '".$_SESSION["username"]."'
                            AND class_TBL.fk_teacherID = teacher_TBL.teacherID";
                
                $classQuery = mysqli_query($conn, $selectClass);
                if(!$classQuery){
                    print ("No classes: " .mysqli_error($conn));
                 } 
                 while ($classFetch = mysqli_fetch_assoc($classQuery)){
                 ?>
                 <tr>
                     <td><a href="../php/ClassList.php?classname=<?php echo $classFetch['className']; ?>"><?=$classFetch["className"]?></a></td>
                 </tr>
             <?php
                   
               }
         }
         $conn -> close();
         ?>
     </table>
</html>