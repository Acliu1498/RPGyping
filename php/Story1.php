<?php include('../php/storyTimeMaster.php');?>
<?php session_start();?>
<link rel="stylesheet" type="text/css" href="../css/intro.css">
<html>
    <head>
        <br/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <a class="btn btn-primary" href="../php/Story2.php" role="button">Next</a>
                    <?php
                        if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") {
                     ?>
                    <a class="btn btn-warning" href="../php/Sentences.php" role="button">Skip Story</a>
                    <?php }?>
                </div> 
            </div>
        </div>
            <div class="story">
                <b>   
                    <br/>
                    <p>What's that noise?</p>
                    <p>Where is it coming from?</p>
                    <p>is that a shooting star in the sky?</p>
                    <p>wait...It's coming towards us!!</p>
                    <p>HIDE!</p>
                </b> 
            </div>
        <p id = "image"><img src= "../images/words.jpg" name = "words" alt= "word" width="100" height="500"></p>
    </body>
</html>
