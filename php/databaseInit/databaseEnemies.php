<p>
<?php
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
$file = file_get_contents('Enemies.txt');
$enemies = json_decode($file,true);

foreach ($enemies as $enemy) {
    //checks to use egr302 database
    $sql = "USE egr302;";
    echo $enemy['Name'];
    
    if ($conn->query($sql) === TRUE) {
        //prepares statement to insert $enemy into Game character table
        $stmt = $conn->prepare("INSERT INTO GameCharacter (CharID, Attack, Defense, Health) 
        VALUES (?, ?, ?, ?);");
        $stmt->bind_param('iiii',$enemy['ID'], $enemy['Attack'], $enemy['Defense'], $enemy['Health']);
        //checks if executes correctly
        if ($stmt ->execute() === TRUE) {
            echo "New record created successfully" . '<br/>';
        //checks if not duplicate entry error
        } else if(strpos($conn->error, 'Duplicate entry') === false){
            echo "Error: 1" . $conn->error;
            break;
        }
        
        //prepares statement to insert $enemy info into enemy character
        $stmt = $conn->prepare("INSERT INTO EnemyCharacter (fkCharID, EnemyName, EnemyImage, XP) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('issi',$enemy['ID'], $enemy['Name'], $enemy['Image'], $enemy['XP']);
        if ($stmt ->execute() === TRUE) {
            echo "New record created successfully" . '<br/>';
        } else if(strpos($conn->error, 'Duplicate entry') === false){
            echo "Error: 2" . $conn->error;
            break;
        }
        
        //prepares statement to insert $enemy location info into enemylocation
        $stmt = $conn->prepare("INSERT INTO EnemyLocation (fkCharID, fkStageNum) VALUES (?, ?);");
        $stmt->bind_param('ii',$enemy['ID'], $enemy['Location']);
        if ($stmt ->execute() === TRUE) {
            echo "New record created successfully" . '<br/>';
        } else if(strpos($conn->error, 'Duplicate entry') === false){
            echo "Error: 3" . $conn->error;
            break;
        }
        if(isset($enemy['Location2'])){
            //prepares statement to insert $enemy location info into enemylocation
            $stmt = $conn->prepare("INSERT INTO EnemyLocation (fkCharID, fkStageNum) VALUES (?, ?);");
            $stmt->bind_param('ii',$enemy['ID'], $enemy['Location2']);
            if ($stmt ->execute() === TRUE) {
                echo "New record created successfully" . '<br/>';
            } else if(strpos($conn->error, 'Duplicate entry') === false){
                echo "Error: 3" . $conn->error;
                break;
            }
        }
    } else {
        echo "Error: " . $sql . $conn->error;
        break;
    }

}



$conn->close();
?>
</p>