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
                    <a class="btn btn-primary" href="../php/Story6.php" role="button">Next</a>
                    <?php
                        if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") {
                     ?>
                    <a class="btn btn-warning" href="../php/Sentences.php" role="button">Skip Story</a>
                    <?php }?>
                </div> 
            </div>
        </div>
        <div class="story">
            <p> Oh look! The mouse has found him!</p>
            <p> I wonder...</p>
            <p> Is this the one we have been waiting for?</p>
            <img src= "../images/mouse.jpg" name = "words" alt= "word" width="100" height="500">
        </div>
    </body>
</html>
