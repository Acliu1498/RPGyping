<?php include ('../RPGyping/ClassList.php'); ?>
<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="../css/afterMasterLogin.css">
<script src="javascript/Profile.js"></script>

<?php session_start(); ?>

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
          <li><button class="button1" onclick="window.location='../php/Story1.php'">Play Game</button></li>
          <li><button class="button2" onclick="window.location='../php/Game_Profile.php'">Profile</button></li>
          <li><button class="button3" onclick="window.location='../php/SignOutGeneral.php'">Sign Out</button></li>
          <li><button class="button4" onclick="window.location='../php/Settings.php'">Settings</button></li>
          <li><button class="button5" onclick="window.location='../php/Leaderboard.php'">Leaderboard</button></li>
        </ul>
      </div>
    </nav>
        <div class="student">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-offset-2 col-sm-8 text-center">
                        <img src="../images/generaluser.png" width="400" height="300">
                        <h2>Welcome, <?php print($_SESSION["username"]);?>!</h2>
                        
                        <!--need access to game tables to get exact info on user's stats-->
                        <?php
                        $sql = "USE egr302";
                        if ($conn->query($sql) === TRUE) {
                            $userQuery = mysqli_query($conn, "SELECT UserCharacter.CurrXP, GameCharacter.Attack, GameCharacter.Defense, UserCharacter.Charlevel FROM UserCharacter, GameCharacter
                                WHERE UserCharacter.fkUserID = ".$_SESSION["userID"]." AND
                                GameCharacter.CharID = UserCharacter.fkCharID");
                            $userRow = mysqli_fetch_assoc($userQuery);
                            if (!$userRow) {
                                echo "No info";
                            }
                        }
                            
                        ?>
                        
                        <div class="progress">
                            <!--aria-valuenow=70-->
                            Level:
                            <?php echo $userRow['Charlevel']?>
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= $userRow['CurrXP']?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $userRow['CurrXP']?>%">
                               
                            </div>
                        </div>
                       
                        <div class="progress">
                            <!--aria-valuenow = 100-->
                            <!--<?php echo $userRow['Attack']; ?>-->
                            Attack
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $userRow['Attack'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $userRow['Attack'] ?>%">
                            </div>
                        </div>
                        
                        <div class="progress">
                            <!--aria-volumenow = 68-->
                            <!--<?php echo $userRow['Defense']; ?>-->
                            Defense
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= $userRow['Defense'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $userRow['Defense'] ?>%">
                            </div>
                        </div>
                        
                        <div class="progress">
                             Magic
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?= $userRow['Magic'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $userRow['Magic'] ?>%">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <div class="container">
        <div class="dropdown">
            <!--will have to insert data from user's GameCharacter table-->
            <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Current Items
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Stats Up</a></li>
                <li><a href="#">Life Up</a></li>
                <li><a href="#">Stamina Up</a></li>
            </ul>
        </div>
    </div>
</html>


