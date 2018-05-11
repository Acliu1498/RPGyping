<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <link rel="stylesheet" type="text/css" href="css/intro.css">

</head>
<?php session_start();?>
    <body>
        <ul class="nav navbar-nav">
          <?php
            if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") {
          ?>
          <li><button class="button1" onclick="window.location='../php/Sentences.php'">Play Game</button></li>
          <li><button class="button2" onclick="window.location='../php/Game_Profile.php'">Back to Profile</button></li>
          <?php
            } else {
          ?>
          <li><button class="button1" onclick="window.location='../php/Homepage.php'">Back to Homepage</button></li>
          <?php } ?>
          <li><button class="button2" onclick="window.location='../php/Story1.php'">Back To Story</button></li>
        </ul>
            <br/>
            <br/>
        <div class="instructions">
            <p>When you enter the game you will need to select the action you would like to use.</p>
            <p>Attack will allow you to attack the monster.</p>
            <p>Defense will allow you to defend yourself from the monster.</p>
            <p>Spells will allow you to do special attacks against the monster.</p>
            <p>Items will allow you special power ups depending on the item.</p>
            <p>Do you think you are ready?</p>
            <p><b>Quick!</b> do as Mouse is telling you and type as quickly and accurately as possible.</p>
            <p>The faster more accurately you type the better then command will respond to your typing. </p>
        </div>
        <p id = "image"><img src= "../images/keyboard.png" name = "keyboard" alt= "key"></p>
            
    </body>

<style>
    body{
        background-image:url("../images/kindergarden2.jpg");
        background-size:100%;
    }
    .button1{
    color:white;
    background-color:#FC3F3F;
    font-size:20px;
    border-radius:8px;
    border: 2px solid black;
    position:relative;
    top:5px;
    left:15px;
    }
    .button2{
        color:white;
        background-color:#F17647;
        font-size:20px;
        border-radius:8px;
        border: 2px solid black;
        position:relative;
        top:5px;
        left:20px;
    }
    p {
    font-size: x-large;
    text-align: center;
    font-family: "Comic Sans MS", cursive, sans-serif;
    font-weight: bold;
    color:black;
}
</style>