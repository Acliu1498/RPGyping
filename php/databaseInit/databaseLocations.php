<p>
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
//gets location information in form of json
$file = file_get_contents('locations.txt');
$locations = json_decode($file, true);
//goes through each value in array
foreach ($locations as $location) {
    echo $location['Name'];
    $sql = "USE egr302;";
    //checks if using egr302
    if ($conn->query($sql) === TRUE) {
        //inserts $locarion info into stage table
        $stmt = $conn->prepare("INSERT INTO Stage (StageNum, Location, BackgroundImage) VALUES (?, ?, ?);");
        $stmt->bind_param('iss', $location['StageNum'], $location['Name'], $location['Img']);
        //checks if executes correctly
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully" . '<br/>';
        } else if(strpos($conn->error, 'Duplicate entry') === false){
            echo "Error: " . $stmt->error;
            break;
        }
    } else {
        echo "Error: " . $sql . $conn->error;
        break;
    }
}



$conn->close();
?>
</p>