
<?php include('../php/beforeLoginMaster.php');?>
 <link rel="stylesheet" type="text/css" href="../css/StudentSignUp.css">
<?php session_start(); ?>
<html>
    <body>
        <div class="title">
            <p><strong>Create a Student Account</strong></p>
        </div>
        <div class="image">
            <img src="../images/student.png" width="300" height="300">
        </div>
        <!-- Need to figure out how to connect mysql with aws cloud9 since different than old version -->
    <?php
    $firstNameError = FALSE;
    $lastNameError = FALSE;
    $nameError = FALSE;
    $pwError = FALSE;
    $emailError = FALSE;
    $invalidpwError = FALSE;
    $codeError = FALSE;
    
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
    
    <!-- Checks if user input matches constraints -->
     <?php
     if (isset($_POST["Next"])) {
         $firstname = $_POST["firstname"];
         if (strlen($firstname) == 0) {
             $firstNameError = TRUE;
         }
         $lastname = $_POST["lastname"];
         if (strlen($lastname) == 0) {
             $lastNameError = TRUE;
         }
        $username = $_POST["username"];
        if (strlen($username) == 0) {
            $nameError = TRUE; 
           
        } 
        $password = $_POST["pw"];
        if (strlen($password) == 0 || !preg_match("/[A-Za-z0-9]{8,20}$/", $password)) { #or if not in right format  8-20 alphanumeric
            $pwError = TRUE;
        } 
        $email = $_POST["email"];
        if (strlen($email) == 0 || !preg_match("/^.+@.+\..{3}$/",$email)) {
            $emailError = TRUE;
           
        }
        $hash = password_hash($password, PASSWORD_DEFAULT); #hashes password to store
        #if the retyped pw is not the same as the stored hashed pw, then error
        if (!password_verify($_POST["samepw"], $hash)) {
            $invalidpwError = TRUE;
           
        }
        $code = $_POST["code"];
        #not case sensitive
        #also have to check if in the teacher database...
        $sql = "USE egr302";
        if ($conn->query($sql) === TRUE) {
            $teacherSql = "SELECT * FROM teacher_TBL WHERE teacher_TBL.teacherAccessCode = " .$code. "";
            $selectedTeacherInfo = mysqli_query($conn, $teacherSql);
            $teacherRow = mysqli_fetch_row($selectedTeacherInfo);
            //print("This it the problem: " .$selectResult);
        
            if (strlen($code) == 0 || !preg_match("/^[A-Za-z0-9]{3,6}$/", $code) || !$teacherRow) {
                $codeError = TRUE;
            }
        }
        
        if (!$firstNameError && !$lastNameError && !$nameError && !$pwError && !$emailError && !$invalidpwError && !$codeError) {
            $sql = "USE egr302";
            if ($conn->query($sql) === TRUE) {
                $parentSql = "INSERT INTO parent_TBL (username, password, email) VALUES ('"
                    . $username . "', '"
                    . $hash . "', '"
                    . $email . "')";
                $parentInsert = mysqli_query($conn, $parentSql);
                if (!$parentInsert) {
                       print("problem with sending parent query: " .mysqli_error($conn)); return;
                }
                $selectParent = mysqli_query($conn, "SELECT accountID, username, password, email FROM parent_TBL WHERE parent_TBL.username = '" .$username."'");
                $parentRow = mysqli_fetch_row($selectParent);
                // Make game Character ID for student
                //location line 25 get rid of string thingy
                include('databaseInit/DatabaseCharacter.php');
                $schoolSql = "SELECT * FROM school_TBL WHERE schoolID = " .$teacherRow[7];
                $schoolSelect = mysqli_query($conn, $schoolSql);
                if (!$schoolSelect) {
                    print("problem with selecting school: " .mysqli_error($conn)); 
                    return;
                }
                $schoolRow = mysqli_fetch_row($schoolSelect);
                if ($parentRow /*&& $charRow*/ && $schoolRow) {
                    print("going to insert");
                    $studentSql = "INSERT INTO student_TBL (studentID, firstName, lastName, username, password,
                    email, fk_teacherAccessCode, fk_teacherID, fk_schoolID) VALUES ("
                        . $parentRow[0] . ", '" //studentID references parent table id
                        . $firstname . "', '"
                        . $lastname . "', '"
                        . $parentRow[1] . "', '"
                        . $parentRow[2] . "', '"
                        . $parentRow[3] . "', '"
                        . $teacherRow[6] . "', "  
                        . $teacherRow[0] . ", "
                        . $schoolRow[0] . ")";
                    $studentInsert = mysqli_query($conn, $studentSql);
                    if (!$studentInsert) {
                         print("Error inserting values into table: " .mysqli_error($conn)); return;
                    } else {
                        $_SESSION["username"] = $username;
                        $_SESSION["userID"] = $parentRow[0];
                        $_SESSION["userType"] = "student";
                        print("TEST");
                        header("Location: ../php/Game_Profile.php");
                        $conn -> close();
                    }
                }
            }
        }
     }
    ?>
    <!--Creates form for students to sign in using POST method -->
                <form action="StudentSignUpPage.php" method="post">
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
                                <input type="submit"  class="btn btn-success" name="Next"/>
                            </div>
                        </div>
                    </div>
                </form>
    <!-- Error functions that print errors -->
    <?php
    function firstnameError($firstNameError=FALSE) {
        if ($firstNameError) {
            print "First name required";
        }
    }
    
    function lastnameError($lastNameError= FALSE) {
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
        <p>Student accounts are free to play and learn how to type.
        They can be linked to a parent account but hold the permissions to do so. 
        They can also be linked with a teacher's access code in order to earn
        credit for a class or earn extra credit for practicing.</p>
    </div>    
    </body>
</html>
