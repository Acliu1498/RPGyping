<link rel="stylesheet" type="text/css" href="../css/Leaderboard.css">
<?php session_start(); ?>
<html lang="en">
<head>
    <!--NEED TO HAVE A TOOLBAR-->
  <title>Leaderboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
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

     <body>
        <audio controls autoplay loop="loop" hidden="true">
        
    <!-- this is where the audio is being controlled -->    
    <source src="../Music/Hypnotic-Puzzle3.mp3" type="audio/mpeg">
    </audio>     
         <?php
            $sql = "USE egr302";
            if($conn -> query($sql) == TRUE){
                if (isset($_POST["name"]) && strlen($_POST["name"]) != 0) {
                    $query = "SELECT parent_TBL.username, UserCharacter.Wpm, UserCharacter.Accuracy, UserCharacter.CharLevel 
                                FROM parent_TBL, UserCharacter 
                                    WHERE parent_TBL.accountID = UserCharacter.fkUserID AND
                                        parent_TBL.username = '" .$_POST["name"]."'";
                    $userNameQuery = mysqli_query($conn, $query);
                }
            
                else if (isset($_POST["AccuracyOrder"])) {
              
                    $query = "SELECT parent_TBL.username, UserCharacter.Wpm, UserCharacter.Accuracy, UserCharacter.CharLevel 
                                FROM parent_TBL, UserCharacter 
                                    WHERE parent_TBL.accountID = UserCharacter.fkUserID
                                        ORDER BY UserCharacter.Accuracy DESC";
                    $userNameQuery = mysqli_query($conn, $query);
                }
                else if (isset($_POST["levelOrder"])) {
                    $query = "SELECT parent_TBL.username, UserCharacter.Wpm, UserCharacter.Accuracy, UserCharacter.CharLevel 
                                FROM parent_TBL, UserCharacter 
                                    WHERE parent_TBL.accountID = UserCharacter.fkUserID
                                        ORDER BY UserCharacter.CharLevel DESC";
                    $userNameQuery = mysqli_query($conn, $query);
                }
                else {
                    $query = "SELECT parent_TBL.username, UserCharacter.Wpm, UserCharacter.Accuracy, UserCharacter.CharLevel 
                                FROM parent_TBL, UserCharacter 
                                    WHERE parent_TBL.accountID = UserCharacter.fkUserID
                                        ORDER BY UserCharacter.Wpm DESC";
                    $userNameQuery = mysqli_query($conn, $query);
                }
            }
         ?>
         
         <form action = "../php/Leaderboard.php" method="post">
             <p>Search for username:</p>
                 <input name = "name"/><input type = "submit" value = "Search" />
            
             </br></br>
             <div>
                 <!--<button name = "wpmOrder" type="submit" value="Submit">Order by WPM</button>-->
                 <input name = "wpmOrder" type="submit" value="Order by WPM">
             </div>
             </br>
             <div>
                 <!--<button name = "AccuracyOrder" type="submit" value="Submit">Order by Accuracy</button>-->
                 <input name = "AccuracyOrder" type="submit" value="Order by Accuracy">
             </div>
             </br>
             <div>
                 <input name = "levelOrder" type="submit" value="Order by Level">
             </div>
         </form>
            <div class="container">
                <!--border = "2" style= "width: 75%"-->
    
                <table class="table" border = "2" style="width:50% left:50%" >
                
                <p><b>Leaderboard</b></p>
                
                    <tr> 
                        <th>Username</th>
                        <th>WPM</th>
                        <th>Accuracy</th>
                        <th>Level</th>
                    </tr>
            </div> 
             <?php
                $sql = "USE egr302";
                if($conn -> query($sql) == TRUE)
                    
                    if(!$userNameQuery){
                        print("No userNames: " .mysqli_error($conn));
                    }
                    
                    while($userNameRow = mysqli_fetch_assoc($userNameQuery)){
                    ?>
                    <tr>
                        <td> <?= $userNameRow["username"] ?> </td>
                        <td> <?= $userNameRow["Wpm"] ?> </td>
                        <td> <?= $userNameRow["Accuracy"] ?> </td>
                        <td> <?= $userNameRow["CharLevel"] ?></td>
                    </tr>
                    <?php 
                    }
                //}
                $conn -> close();
                ?>
         </table>
         
        <button class="button2" onclick="window.location='../php/Homepage.php'">Back to Homepage</button>
     </body>
 </html>