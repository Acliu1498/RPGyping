<link rel="stylesheet" type="text/css" href="../css/login.css">
<?php include('../php/beforeLoginMaster.php');?>

<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    } ?>
    <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
        
        <body>
            <audio controls autoplay loop="loop" hidden="true">
                <!--<source src="../Music/Hypnotic-Puzzle3.mp3" type="audio/mpeg">-->
            </audio>
            <div class="title">
                <p><strong>Login Page</strong></p>
            </div>
            <?php
            #change and update to AWS connection
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
            <!-- IF THE USER PRESSES SUBMIT, THEN VERFIY IF THE INPUTTED EMAIL AND PASSWORD ARE INPUTTED IN A USER TABLE -->
            <!-- ELSE MUST PRINT LOGIN ERROR -->
            
            <?php
            if (isset($_POST["next"])) {
                 $email = $_POST["email"];
                 $pw = $_POST["pw"];
                 
                 $sql = "USE egr302";
                 if ($conn->query($sql) === TRUE) {
                     $parentSql = "SELECT * FROM parent_TBL WHERE email = '" . $email . "'"; 
                     $parentEmailResult = mysqli_query($conn, $parentSql);
                     $parentRow = mysqli_fetch_assoc($parentEmailResult);
                     // IF THE STUDENT ROW IS EMPTY, THEN IT IS AN ERROR
                     if (!$parentRow) {
                         if (!$parentRow["email"]) {
                             $EmailError = TRUE;
                         }
                     }
                    
                     $hash = $parentRow['password'];
                     $hash = substr( $hash, 0, 60 );
                    
                     if(password_verify($pw, $hash)){
                     echo "password is valid";
                     } else {
                         $PasswordError = TRUE;
                     }
        
                     if ($EmailError || $PasswordError) {
                         print "ERROR";
                     }
                     else {
                         
                         //CHECK EACH USER SUBTYPE TABLE TO DIRECT USER TO APPROPRIATE PROFILE
                         $selectTeacher = "SELECT username, teacherAccessCode FROM teacher_TBL WHERE teacherID = " .$parentRow["accountID"];
                         $teacherQuery = mysqli_query($conn, $selectTeacher);
                         $teacherRow = mysqli_fetch_assoc($teacherQuery);
                     
                         if ($teacherRow) {
                             $_SESSION["username"] = $teacherRow["username"];
                             $_SESSION["userID"] = $parentRow["accountID"];
                             $_SESSION["accessCode"] = $teacherRow["teacherAccessCode"];
                             $_SESSION["userType"] = "teacher";
                             header("Location: ../php/Teacher_Profile.php");
                         }
                         
                         $selectStudent = "SELECT student_TBL.username FROM student_TBL WHERE student_TBL.studentID = " .$parentRow["accountID"];
                         $studentQuery = mysqli_query($conn, $selectStudent);
                         $studentRow = mysqli_fetch_assoc($studentQuery);
                         if ($studentRow) {
                             print("User is student");
                             $_SESSION["username"] = $studentRow["username"];
                             $_SESSION["userID"] = $parentRow["accountID"];
                             $_SESSION["userType"] = "student";
                             header("Location: ../php/Game_Profile.php");
                         }
             
                         $selectGeneral = "SELECT username FROM generalUser_TBL WHERE fk_userID = " .$parentRow["accountID"];
                         $generalQuery = mysqli_query($conn, $selectGeneral);
                         $generalRow = mysqli_fetch_assoc($generalQuery);
                         if ($generalRow) {
                             print("User is general");
                             $_SESSION["username"] = $generalRow["username"];
                             $_SESSION["userID"] = $parentRow["accountID"];
                             $_SESSION["userType"] = "general";
                             header("Location: ../php/Game_Profile.php");
                         }
                    }
                    $conn -> close();
                 }
            }
             
            ?>
            <form action="Login.php" method="post">
                <div class="container">   
                    <div class="row">
                        <div class="col-xs-offset-4 col-sm-4 text-center">
                            <h4 class="display-4">Email</h4><input type ="text" name="email" class="form-control" required/> * <?php emailError($EmailError) ?>
                        </div>                        
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-offset-5 col-sm-2 text-center">
                            <h4 class="display-4">Password</h4><input type="password" name="pw" class="form-control" required/> * <?php passwordError($PasswordError) ?>
                        </div>
                    </div>
                </div> 
                <div class="container">
                    <div class="row">
                        <div class="col-xs-offset-7">
                            <input type="submit" class="btn btn-danger" name="next"/>
                        </div> 
                    </div>
                </div>
            </form>
        
        <!-- ERROR FUNCTIONS -->
        <?php
        function emailError($EmailError = FALSE) {
            if ($EmailError) {
                print("Email not found");
            }
        }
        
        function passwordError($PasswordError = FALSE) {
            if ($PasswordError) {
                print ("Password incorrect");
            }
        }
        ?>
        
        </body>
    </html>