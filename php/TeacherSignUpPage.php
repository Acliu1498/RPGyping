<?php include('../php/beforeLoginMaster.php');?>
<link rel="stylesheet" type="text/css" href="../css/TeacherSignUp.css">
<?php session_start(); ?>
<html>
    <body>
        <div class="title">
            <p><strong>Create a Teacher Account</strong></p>
        </div>
        <div class="image">
            <img src="../images/teacher.svg" width="400" height="300">
        </div>
    <!-- Need to figure out how to connect mysql with aws cloud9 since different than old version -->
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
    ?>


     <?php
     if (isset($_POST["Next"])) {
         $firstname = $_POST["firstname"];
         if(strlen($firstname) == 0) {
             $firstNameError = TRUE;
         }
         $lastname = $_POST ["lastname"];
         if (strlen($lastname)==0) {
             $lastNameError = TRUE;
         }
         $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        if (strlen($username) == 0) {
            $nameError = TRUE; 
           
        } 
        $password = $_POST["pw"];
        if (strlen($password) == 0 || !preg_match("/^[A-Za-z0-9]{8,20}$/", $password)) { #or if not in right format  8-20 alphanumeric
            $pwError = TRUE;
        } 
        $email = $_POST["email"];
        if (strlen($email) == 0 || !preg_match("/^.+@.+\..{3}$/",$email)) { #or if not in right format (regex)
            $emailError = TRUE;
           
        }
        $hash = password_hash($password, PASSWORD_DEFAULT); #hashes password to store in db
        #if the retyped pw is not the same as the stored hashed pw, then error
        if (!password_verify($_POST["samepw"], $hash) /* || !preg_match("/^[A-Za-z0-9]{8,20}$/", $_POST["samepassword"])*/) {
            $invalidpwError = TRUE;
          //check if runs right cause this is different than line 56 on student
        }
        $code = $_POST["code"];
        if (strlen($code) == 0 || !preg_match("/^[A-Za-z0-9]{3,6}$/", $code)) {
            $codeError = TRUE;
        }
        
        if (!$firstNameError && !$lastNameError && !$nameError && !$pwError && !$emailError && !$invalidpwError && !$codeError) {
             $sql = "USE egr302";
               if ($conn->query($sql) === TRUE) {
                   $parentSql = "INSERT INTO parent_TBL(username, password, email)
                   VALUES ('" .$username. "', '" .$hash. "', '" .$email. "')";
                   $parentInsert = mysqli_query($conn, $parentSql);
                  //check if parentInsert had successfully connected to mysql
                  if (!$parentInsert) {
                       print("problem with sending parent query: " .mysqli_error($conn));
                  }
                  $selectParent = mysqli_query($conn, "SELECT accountID, username, password, email FROM parent_TBL WHERE parent_TBL.username = '" .$username."'");
                  $parentRow = mysqli_fetch_row($selectParent);
                  //get/create school
                  $schoolName = $_POST["schoolName"];
                  $schoolSql = "SELECT * FROM school_TBL WHERE schoolName = '" .$schoolName."'";
                  $selectSchool = mysqli_query($conn, $schoolSql);
                  $schoolRow = mysqli_fetch_row($selectSchool);
                  if (!$schoolRow) {
                      //then insert
                      //test
                      print("new school being inserted");
                      $schoolInsert = mysqli_query($conn, "INSERT INTO school_TBL (school_TBL.schoolName) VALUES ('" .$schoolName. "')");
                      $schoolSql = "SELECT * FROM school_TBL WHERE schoolName = '" .$schoolName."'";
                      $selectSchool = mysqli_query($conn, $schoolSql);
                      $schoolRow = mysqli_fetch_row($selectSchool);
                  }
                   if (!$parentRow) {
                       print("ERROR ON parentRow");
                   }
                   #ERROR ON SCHOOLROW CURRENTLY
                   if (!$schoolRow) {
                       print("ERROR ON schoolRow");
                   }
                  if ($parentRow && $schoolRow) {
                      print("USERNAME: " .$parentRow["username"]);
                     
                   $mysql = "INSERT INTO teacher_TBL(teacherID,firstName, lastName, username, password, email, teacherAccessCode, fk_schoolID)
                     VALUES (" .$parentRow[0]. ", '" 
                     .$firstname. "', '" 
                     .$lastname. "', '"
                     .$parentRow[1]. "', '"
                     .$parentRow[2]. "', '"
                     .$parentRow[3]. "', '"
                     .$code. "', '"
                     .$schoolRow[0]. "')";
                     $insert = mysqli_query($conn, $mysql);
                     if (!$insert){
                         print("Error inserting values into table: " .mysqli_error($conn));
                     }else {
                         $_SESSION["username"] = $username;
                         $_SESSION["userID"] = $parentRow[0];
                         $_SESSION["accessCode"] = $code;
                         $_SESSION["schoolID"] = $schoolRow[0];
                         $_SESSION["userType"] = "teacher";
                         print("TEST");
                         header("Location: Teacher_Profile.php");
                         $conn -> close();
                     }
                 }
             }
         }
     }
    ?>
    
    <!--Creates form for students to sign in using POST method -->
    <form action="TeacherSignUpPage.php" method="post">
        <div class="container">   
            <div class="row">
                <div class="col-xs-offset-3 col-sm-2 text-center">
                     <h4 class="display-4">First name:</h4><input type="text" name="firstname" class="form-control"/> * <?php firstNameError($firstNameError) ?>
                </div>
                <div class="col-sm-2 text-center"> 
                    <h4 class="display-4">Last name:</h4><input type="text" name="lastname" class="form-control"/> * <?php lastnameError($lastNameError)?>
                </div>
                <div class="col-sm-2 text-center">
                    <h4 class="display-4">Username:</h4><input type="text" name="username"  class="form-control"/> * <?php nameError($nameError) ?>
                </div>
            </div>
        </div>
        <div class="container">   
            <div class="row">
                <div class="col-xs-offset-4 col-sm-4 text-center">
                    <h4 class="display-4">Email:</h4><input type ="text" name="email" class="form-control"/> * <?php emailError($emailError) ?>
                </div>                        
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-4 col-sm-2 text-center">
                    <h4 class="display-4">Create Password:</h4><input type="password" name="pw" class="form-control"/> * <?php pwError($pwError) ?>
                </div>
                <div class="col-sm-2 text-center">
                    <h4 class="display-4">Re-type Password:</h4><input type="password" name="samepw" class="form-control"/> * <?php invalidpwError($invalidpwError) ?>
                </div>
            </div>
        </div>    
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-4 col-sm-4 text-center">
                    <h4 class="display-4">Teacher Access Code:</h4><input type="text" name="code" class="form-control"/> * <?php codeError($codeError) ?>
                </div>
            </div>
        </div>
        <!--need to enter school info-->
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-4 col-sm-4 text-center">
                    <h4 class="display-4">School Employed At:</h4><input type="text" name="schoolName" class="form-control"/>
                    <input type="submit"  class="btn btn-success" name="Next"/>
                </div>
            </div>
        </div>
    </form>             
    
    <!-- Error functions that print errors -->
    <?php
    function firstNameError($firstNameError=FALSE) {
        if ($firstNameError) {
            print "First name required";
        }
    }
    function lastNameError($lastNameError= FALSE) {
        if ($lastNameError) {
            print "Last name required";
        }
    }
    function nameError($nameError=FALSE) {
        if ($nameError) {
            print "Username required";
        }
    }
    function pwError($pwError=FALSE) {
        if ($pwError) {
            print "Invalid Password. Password needs to be 8-20 alphanumeric characters";
        }
    }
    function emailError($emailError=FALSE) {
        if ($emailError) {
            print "Invalid Email";
        }
    }
    function invalidpwError($invalidpwError) {
        if ($invalidpwError) {
            print "Invalid Password";
        }
    }
    function codeError($codeError) {
        if ($codeError) {
            print "Invalid Code";
        }
    }
    ?> 
    <div class="instructions">
        <p>Teacher accounts are used to monitor student accounts.
        They can be linked to a student account in order to monitor students results. 
        </p>
    </div>    
    </body>
</html>