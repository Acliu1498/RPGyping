<link rel="stylesheet" href="../css/Sentences.css" type="text/css"/>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php include('../php/battleMaster.php');?>
<?php include('DatabaseAccess/initGame.php')?>

<head>
    <div class="container">
        <div class="row">
            <div class="col-12 col-xs-2 ">
                <img id = "picture" src="../images/dead_inside.jpg" width="400" height="400"/>
                <progress id="health" value= <?=$userStats["Health"]?> max="100"></progress>
            </div>
             <div class="col-12 col-sm-offset-6 col-xs-2 ">
                <div id="monster">
                    <img src="../images/monster.jpg" width="400" height="400">
                </div>
                <progress id="enemyHealth" value=<?=$enemy["Health"]?> max="100"></progress>
            </div>
        </div>
    </div> 
     
    
</head>
<div class="container">
    <div class="row">
        <div class="col-12">
            <br/><br/>
        </div>
    </div>
</div>
<body onload="start()" background="../images/forest.webp" width="300" height="300">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-offset-1 col-xs-9 ">
                <div class="textArea">
                    <br/>
                    <canvas id="sentenceCanvas" height="100" width="1000"></canvas>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-12 col-sm-offset-1 col-xs-9 ">
                <div class="entry" id="box">
                    <canvas id="textCanvas" height="100" width="1000"></canvas>
                        <div id="stats">
                            <p id="time"></p>
                            <p id="wpm"></p>
                            <p id="accuracy"></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="uglybox" cols="100" rows="10">

            <ul>
                <li id="log1"></li>
                <li id="log2"></li>
                <li id="log3"></li>
                <li id="log4"></li>
                <li id="log5"></li>
            </ul>

    </div> 
</body>




<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
    var words = <?php echo json_encode($words); ?>;
    var userStats = <?php echo json_encode($userStats); ?>;
    
    var enemy = <?php echo json_encode($enemy); ?>;
    
    </script>
<script type="text/javascript" src="../javascript/Keystrokes2.js"></script>
