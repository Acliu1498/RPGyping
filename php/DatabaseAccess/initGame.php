<?php
$servername = "127.0.0.1";
$username = "root";
$password = "egr302";
$db = 'egr302';


// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM Sentence;";
$result = $conn->query($sql);
$words = array();


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($words, $row);
    }
} else {
    echo "0 results";
}
$username = "heyAlex";
//gets user info
if($stmt = $conn->prepare("SELECT fkCharID, Attack, Defense, Health, Charlevel, Wpm, Accuracy, NumPotions FROM UserCharacter
INNER JOIN GameCharacter WHERE fkUserID = (SELECT accountID FROM parent_TBL WHERE username = ?);")){
    $stmt->bind_param("s", $username); 
    if($stmt->execute()){
        $userStats = $stmt->get_result()->fetch_assoc();
    } else {
        echo 'error: ' . $conn->error; 
    }
    $stmt->close();
} else {
    echo 'error: ' . $conn->error; 
}

//gets location info
if($stmt = $conn->prepare("SELECT fkStageNum FROM UserLocation WHERE fkCharID = ?;")){
    $stmt->bind_param("s", $userStats['fkCharID']); 
    if($stmt->execute()){
        $location = $stmt->get_result()->fetch_assoc();
    } else {
        echo 'error: ' . $conn->error; 
    }
    $stmt->close();
} else {
    echo 'error: ' . $conn->error; 
}


if($stmt = $conn->prepare("SELECT BackgroundImage, Location, StageNum FROM Stage WHERE StageNum = ?;")){
    $stmt->bind_param("s", $location['fkStageNum']); 
    if($stmt->execute()){
        $location = $stmt->get_result()->fetch_assoc();
    } else {
        echo 'error: ' . $conn->error; 
    }
    $stmt->close();
} else {
    echo 'error: ' . $conn->error; 
}

if($stmt = $conn->prepare("SELECT DISTINCT EnemyCharacter.fkCharID, EnemyName, EnemyImage, XP 
FROM EnemyCharacter INNER JOIN EnemyLocation WHERE fkStageNum = ?;")){
    $stmt->bind_param("s", $location['StageNum']); 
    if($stmt->execute()){
        $enemies = $stmt->get_result()->fetch_assoc();
        
    } else {
        echo 'error: ' . $conn->error; 
    }
    $stmt->close();
} else {
    echo 'error: ' . $conn->error; 
}

if($stmt = $conn->prepare("SELECT DISTINCT CharID, EnemyName, Attack, Defense, Health, EnemyImage, XP  
FROM GameCharacter INNER JOIN EnemyCharacter ON GameCharacter.CharID = EnemyCharacter.fkCharID WHERE GameCharacter.CharID = ?;")){
    $stmt->bind_param("i", $enemies["fkCharID"]); 
    if($stmt->execute()){
        $enemy = $stmt->get_result()->fetch_assoc();
    } else {
        echo 'error: ' . $conn->error;
    }
} else {
    echo 'error: ' . $conn->error; 
}



$conn->close();
?>