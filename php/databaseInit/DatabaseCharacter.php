<?php
    $charID;
    $charSql = "SELECT MAX(CharID) FROM GameCharacter WHERE CharID > 999";
    $result = $conn->query($charSql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $charID = $row['MAX(CharID)'] + 1;
    } else {
        $charID = 1000;
    }
        
    if($charSql = $conn->prepare("INSERT INTO GameCharacter (CharID) VALUES (?);")){
        $charSql->bind_param('i', $charID);
        if ($charSql->execute() === FALSE) {
            print("problem with sending character query: " . $conn->error); return;
        }
        if($charSql = $conn->prepare("INSERT INTO UserCharacter (fkCharID, fkUserID) VALUES (?, ?);")){
            $charSql->bind_param('ii', $charID, $parentRow[0]);
            if ($charSql->execute() === FALSE) {
                print("problem with sending character query: " . $conn->error); return;
            }
            if($charSql = $conn->prepare("INSERT INTO UserLocation (fkCharID) VALUES (?);")){
                $charSql->bind_param('i', $charID);
                if ($charSql->execute() === FALSE) {
                    print("problem with sending character query: " . $conn->error); return;
                }
                if($charSql = $conn->prepare("INSERT INTO GamesPlayed (fkCharID) VALUES (?);")){
                    $charSql->bind_param('i', $charID);
                    if ($charSql->execute() === FALSE) {
                        print("problem with sending character query: " . $conn->error); return;
                    }
                } else {
                    echo 'err 3' . $conn->error;
                }
            } else {
                echo 'err 3' . $conn->error;
            }
        } else {
            echo 'err 2' . $conn->error;
        }
    } else {
        echo 'err 1' . $conn->error;
    }
?>