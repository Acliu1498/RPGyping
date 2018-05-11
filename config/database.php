 <?php
            #change and update to AWS connection
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