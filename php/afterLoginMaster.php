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
          <li><button class="button1" onclick="window.location='../php/Sentences.php'">Play Game</button></li>
          <li><button class="button2" onclick="window.location='../php/Teacher_Profile.php'">Profile</button></li>
          <li><button class="button3" onclick="window.location='../php/SignOut.php'">Sign Out</button></li>
          <li><button class="button4" onclick="window.location='../php/Settings.php'">Settings</button></li>
        </ul>
      </div>
    </nav>
    </body>
</html>
