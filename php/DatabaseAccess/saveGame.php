<?php
session_start();
echo "here";
$servername = "127.0.0.1";
$username = "root";
$password = "egr302";
$dbname = "egr302";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//uses egr302 database
$sql = "USE egr302;";
$conn->query($sql);

if(isset($_POST['save'])){
    $gameInfo = json_decode($_POST['save'], true);
    //gathers necessary user character data
    if($stmt = $conn->prepare("SELECT fkCharID, Wpm, Accuracy, Charlevel, CurrXP, XP2LVL FROM UserCharacter WHERE 
    fkUserID = (SELECT accountID FROM parent_TBL WHERE username = ?);")){
        $stmt->bind_param('s', $_SESSION['username']);
        
    }else {
        echo 'error' . $conn->error;
    }
    $userStats = array();
    foreach ($gameInfo as $key => $value) {
        echo "Key: $key; Value: $value\n";
    }
    
    //check if executes correctly
    if($stmt->execute()){
        //sets user stats array = to the row returned
        $userStats = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        //prepares new statement to get the number of games played
        $stmt = $conn->prepare("SELECT NumStages FROM GamesPlayed WHERE fkCharID = ?;");
        $stmt->bind_param('s', $userStats['fkCharID']);
        //checks if executes correctly
        if($stmt->execute()){
            //pushes info to userStats
            $tmpArr = $stmt->get_result()->fetch_assoc();
            $userStats = array_merge($tmpArr, $userStats);
            $stmt->close();
            //gets new values for wpm and accuracy
            $wpm = (($userStats['NumStages'] * $userStats['Wpm']) + $gameInfo['Wpm']) / ($userStats['NumStages'] + 1);
            $acc = (($userStats['NumStages'] * $userStats['Accuracy']) + $gameInfo['Accuracy']) / ($userStats['NumStages'] + 1);
            echo $acc;
            //updates database
            if($stmt = $conn->prepare("UPDATE UserCharacter SET Wpm = ?, Accuracy = ?, CurrXP = CurrXP + ? WHERE fkCharID = ?")){
                $stmt->bind_param('ddii', $wpm, $acc, $gameInfo['xp'], $userStats['fkCharID']);
            }else {
                echo 'error' . $conn->error;
            }
            //checks if executes correctly
            if($stmt->execute()){
                //updates database
                $stmt->close();
                if($stmt = $conn->prepare("UPDATE GamesPlayed SET NumStages = NumStages + 1 WHERE fkCharID = ?")){
                    $stmt->bind_param('i', $userStats['fkCharID']);
                }else {
                    echo 'error' . $conn->error;
                }
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    if($userStats['CurrXP'] >= $userStats['XP2LVL']){
        if($stmt = $conn->prepare("UPDATE GameCharacter SET Attack = Attack * 1.5,
        Defense = Defense *1.5, Health = Health * 1.5 WHERE CharID = ?")){
            $stmt->bind_param('i', $userStats['fkCharID']);
            if($stmt->execute()){
                if($stmt = $conn->prepare("UPDATE UserCharacter SET CurrXP = 0, CharLevel = CharLevel + 1 WHERE fkCharID = ?")){
                    $stmt->bind_param('i', $userStats['fkCharID']);
                    $stmt->execute();
                }
                if(($userStats['CharLevel'] + 1 ) % 20 == 0){
                    if($stmt = $conn->prepare("SELECT MAX(StageNum) FROM Stage;")){
                        $stmt->execute();
                        $max = $stmt->get_result()->fetch_assoc();
                    }
                    if($stmt = $conn->prepare("SELECT fkStageNum FROM UserLocation WHERE fkCharID = ?;")){
                        $stmt->bind_param('i', $userStats['fkCharID']);
                        $stmt->execute();
                        $currLoc = $stmt->get_result()->fetch_assoc();
                    }
                    if($currLoc == max){
                        if($stmt = $conn->prepare("UPDATE UserLocation SET fkStageNum = 1 WHERE fkCharID = ?")){
                            $stmt->bind_param('i', $userStats['fkCharID']);
                            $stmt->execute();
                        }
                    } else {
                        if($stmt = $conn->prepare("UPDATE UserLocation SET fkStageNum = fkStageNum + 1 WHERE fkCharID = ?")){
                            $stmt->bind_param('i', $userStats['fkCharID']);
                            $stmt->execute();
                        }
                    }
                }
            }
            
        }else {
            echo 'error' . $conn->error;
        }
    }
}