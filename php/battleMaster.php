<?php session_start(); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
    <body>
    <audio id="background" controls autoplay loop="loop" hidden="true">
      <source src="../Music/Metal.mp3" type="audio/mpeg">
    </audio>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"></a>
        </div>
        <ul class="nav navbar-nav">
          <li><button class="button1" onclick="window.location='../php/Student_Profile.php'">Profile</button></li>
          <li><button class="button2" onclick="window.location='../php/SignOutStudent.php'">Student</button></li>
          <li><button class="button3" onclick="window.location='../php/SignOutStudent.php'">Sign Out</button></li>
        </ul>
      </div>
    </nav>
    </body>
</html>
