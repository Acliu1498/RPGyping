<html>
<?php session_start();

    
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

        if (isset($_POST["wpm"])) {
                 
                 $sql = "USE egr302";
                 if ($conn->query($sql) === TRUE) {
                     
                     if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") {
                         //print("test");
                         $gameQuery = mysqli_query($conn,"UPDATE UserCharacter SET Wpm = Wpm + 1 WHERE fkUserID = '" .$_SESSION["userID"]."'");
                         if (!$gameQuery) {
                             print("Could not update: " .mysqli_error($conn));
                         }
                         else {
                             print("WPM updated!");
                             $sql = mysqli_query($conn, "SELECT Wpm FROM UserCharacter WHERE fkUserID = '" .$_SESSION["userID"]."'");
                             $sqlRow = mysqli_fetch_assoc($sql);
                             print("   WPM now: " . $sqlRow["Wpm"]);
                         }
                     }
                 }
        }
        
        if (isset($_POST["accuracy"])) {
                 
                 $sql = "USE egr302";
                 if ($conn->query($sql) === TRUE) {
                     if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") {
                         $gameQuery = mysqli_query($conn,"UPDATE UserCharacter SET Accuracy = Accuracy + 1 WHERE fkUserID = '" .$_SESSION["userID"]."'");
                         if (!$gameQuery) {
                             print("Could not update: " .mysqli_error($conn));
                         }
                         else {
                             print("Accuracy updated!");
                              $sql = mysqli_query($conn, "SELECT Accuracy FROM UserCharacter WHERE fkUserID = '" .$_SESSION["userID"]."'");
                               $sqlRow = mysqli_fetch_assoc($sql);
                             print("   Accuracy now: " . $sqlRow["Accuracy"]);
                         }
                     }
                 }
        }
?>
<form action="gameInfoUpdate.php" method=post>
<input type="submit" name="wpm" value="Increase WPM" /> </br></br>
<input type="submit" name="accuracy" value="Increase Accuracy" /> </br></br>
</form>
</html>