<?php session_start(); ?>
 <link rel="stylesheet" type="text/css" href="../css/SignOut.css">

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
    <body background="../images/maxresdefault.jpg">
    <?php
    if (isset($_POST["Yes"])) {
        session_destroy();
        header("Location: ../php/Homepage.php");
    }
    if (isset($_POST["No"])) {
       header("Location: ../php/Student_Profile.php");
    }
    if (isset($_POST["Maybe"]))
        header("Location: ../php/SignOutStudent.php")
    
    ?>
        <div class="container">
            <div class="row">
                <div class="text-center" style="padding-top:300px;">
                    <form action="SignOutStudent.php" method="post">
                        <p>Are you sure you want to sign out?</p>
                        <p><input type="submit" class="btn btn-lg btn-success" name="Yes" value="Yes, please!"/></p>
                        <p><input type="submit" class="btn btn-lg btn-danger" name="No" value="No, thank you"/></p>
                        <p><input type="submit" class="btn btn-lg btn-warning" name="Maybe" value="Maybe.."/></p>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>