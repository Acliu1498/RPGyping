<?php include('../php/beforeLoginMaster.php');?>
<link rel="stylesheet" type="text/css" href="../css/GeneralUserSignUpPage.css">
<?php session_start(); ?>
<html>
    <body>
        <div class="title">
            <p><strong>Create General Account</strong></p>
        </div>
        <div class="image">
            <img src="../images/generaluser.png" width="400" height="300">
        </div>
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
    
    <!-- Checks if user input matches constraints -->
     <?php
     if (isset($_POST["Next"])) {
         //print("test");
        $username = $_POST["username"];
        if (strlen($username) == 0) {
            $nameError = TRUE; 
            //print("error1");
        } 
        $password = $_POST["pw"];
        if (strlen($password) == 0 || !preg_match("/^[A-Za-z0-9]{8,20}$/", $password)) { #or if not in right format  8-20 alphanumeric
            $pwError = TRUE;
            //print("error2");
        } 
        $email = $_POST["email"];
        if (strlen($email) == 0 || !preg_match("/^.+@.+\..{3}$/",$email)) {
            $emailError = TRUE;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT); #hashes password to store
        #if the retyped pw is not the same as the stored hashed pw, then error
        $samepassword = $_POST["samepw"];
        if (!password_verify($_POST["samepw"], $hash)) {
            $invalidpwError = TRUE;
        }
        else {
            //need to insert into parent table
            $sql = "USE egr302";
                if($conn -> query($sql) == TRUE){
                    $parentSql = "INSERT INTO parent_TBL(username, password, email) VALUES ('" .$username. "', '" .$hash. "', '" .$email. "')";
                    //checking if successful connection to mysql
                    $parentInsert = mysqli_query($conn, $parentSql);
                    if(!$parentInsert){
                        print ("problem with sending parent query: ". mysqli_error($conn));
                        break;
                    }
                    $selectParent = mysqli_query($conn, "SELECT accountID, username, password, email FROM parent_TBL WHERE
                        parent_TBL.username = '" .$username."'");
                    $parentRow = mysqli_fetch_row($selectParent);
                    include('databaseInit/DatabaseCharacter.php');
                    /* INSERT INTO THE GENERALUSER TABLE*/
                $mysql = "INSERT INTO generalUser_TBL (fk_userID, username, password, email) VALUES(
                    ".$parentRow[0].
                    ", '".$username. 
                    "', '" .$hash. 
                    "', '".$email. 
                     "')";
                $insert = mysqli_query($conn, $mysql);
                if (!$insert) {
                    print("Error inserting values into table: " .mysqli_error($conn));
                    break;
                    
                } else {
                    #will direct to homepage for now until create character page created
                    $_SESSION["username"] = $username;
                    $_SESSION["userID"] = $parentRow[0];
                    $_SESSION["userType"] = "general";
                    header("Location: ../php/Game_Profile.php");
                    $conn -> close();
                }
            }
            
        }
    }
    ?>
    <form action="GeneralUserSignUpPage.php" method="post">
        <div class="container">  
            <div class="row">
                <div class="col-xs-offset-4 col-sm-4 text-center">
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
                    <input type="submit" class="btn btn-success" name="Next"/>
                </div>
            </div>
        </div>    
    </form>
    
    <!-- Error functions that print errors -->
    <?php
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
            print "Passwords do not match";
        }
    }
    ?> 
    </body>
</html>