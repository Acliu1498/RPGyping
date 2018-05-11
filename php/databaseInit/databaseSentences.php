<h1>test</h1>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "egr302";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$file = file("newVerse.txt");
foreach ($file as $line) {
    list($name, $sentence) = explode("  ", $line);
    if($name != "" && $sentence != ""){
        $len = strlen($sentence);
        $sql = "USE egr302;";
        
        if ($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO Sentence (VerseName, Sentence, Length) VALUES ('$name', '$sentence', $len);";
        
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully" . '<br/>';
            } else if(strpos($conn->error, 'Duplicate entry' === false)){
                echo "Error: " . $sql . $conn->error;
                break;
            }
        } else {
            echo "Error: " . $sql . $conn->error;
            break;
        }
    }
}



$conn->close();
?>