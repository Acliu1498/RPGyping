<!-- https://d4deaa4e1e2043fdb438c522a96c778b.vfs.cloud9.us-east-2.amazonaws.com/StudentSignInPage.php -->
<?php include('../php/afterLoginMaster.php');?>
<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="../css/createClass.css">
<html>
    <a href="">Next</a>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="title">
                        <h3>Create a Class Name</h3>
                    </div>
                </div>
            </div>
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
    //echo "Connected successfully";
    ?>

    <!--If user clicks submit (done adding classes)-->
    <?php

        if (isset($_POST["submit"])) {
            $className = $_POST["className"];
            $students = $_POST['studentNames'];
            
            if (strlen($className) == 0) {
                $classNameError = TRUE;
            }
            
            if (!$classNameError) {
            $sql = "USE egr302";
            if ($conn->query($sql) === TRUE) {
                print("students: " .$_POST['studentNames']);
                foreach($students as $student) {
                $classSql = "INSERT INTO class_TBL (className, fk_teacherID, fk_studentID) VALUES ('"
                    .$className."', "
                    .$_SESSION["userID"].", "
                    .$student.")";
                $classInsert = mysqli_query($conn, $classSql);
                }
                if ($classInsert) {
                    header("Location: ../php/Teacher_Profile.php");
                }
                else {
                    print("Trouble inserting class: " .mysqli_error($conn));
                }// something is going wrong here with inserting the class into the class table
            }
                
            }
        }

        if (isset($_POST["add"])) {
             $className = $_POST["className"];
            //array of selected students
            $studentNames = $_POST['studentNames'];
            $sql = "USE egr302";
            if ($conn->query($sql) === TRUE) {
//now insert class
                foreach($studentNames as $student) {
                    $classSql = "INSERT INTO class_TBL (className, fk_teacherID, fk_studentID) VALUES ('"
                        .$className."', "
                        .$_SESSION["userID"].", "
                        .$student.")";
                    $classInsert = mysqli_query($conn, $classSql);
                }
                if ($classInsert) {
                    header("Refresh:0; url=../php/createClassName.php");
                }
                else {
                    print("Trouble inserting class: " .mysqli_error($conn));
                }
            }
        }
        
        if (isset($_POST["back"])) {
            header("Location: ../php/Teacher_Profile.php");
        }

    ?>

    <form action="../php/createClassName.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="title">
                        Please create your class name:
                    <div>
                </div>
            </div>
        </div>    
        <div class="container">
            <div class="row">
                <div class="col-xs-offset-5 col-sm-2 text-center">
                    <div class="title">
                        <h4 class="display-4">Class</h4>
                        <input type="text" name="className" class="form-control"/>
                    </div>
                </div>
            </div>
        </div> 
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="title">
                        <br/>
                        Please select student's you would like to add to the class before adding another class or returning to your profile page. 
                        </br>
                        Add students to class:             (hold ctrl to select multiple students)
                    </div>
                </div>
            </div>
        </div>             
        <?php
        $sql = "USE egr302";
        if ($conn->query($sql) === TRUE) {
        //select all students that have same access code as teacher
        $studentQuery = "SELECT studentID, firstName, lastName FROM student_TBL WHERE fk_teacherAccessCode = '" .$_SESSION["accessCode"]. "' ORDER BY lastName";
        $studentSelect = mysqli_query($conn, $studentQuery);
        if (!$studentSelect) {
            print("No students registered");
        } ?>
        <div class="selection">
        <select name="studentNames[]" multiple="multiple" size = "10">
        <?php
        while ($row = mysqli_fetch_assoc($studentSelect)) {
        ?>
            <option value="<?= $row["studentID"] ?>">
            <?= $row["firstName"]. " " .$row["lastName"]?>
            </option>
        <?php
        }
        }
        print "</select>";
        ?>
        </div>
        <form>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <input type="submit" class="btn btn-danger" value="Save and Back to Profile Page" name="submit">
                </div>    
            </div>
        </div>
        <br/>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <input type ="submit" class="btn btn-danger text-center" value="+ Add another class" name="add">
                </div>    
            </div>
        </div>
        <br/>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <input type = "submit" class="btn btn-danger text-center" value="Back" name="back">
                </div>    
            </div>
        </div>
    </form>

    </body>
</html>