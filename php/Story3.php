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
                    <a class="btn btn-primary" href="../php/Story4.php" role="button">Next</a>
                     <?php
                        if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") {
                     ?>
                    <a class="btn btn-warning" href="../php/Sentences.php" role="button">Skip Story</a>
                    <?php }?>
                </div> 
            </div>
        </div>
        <div class="story">
            <p> um...</p>
            <p> What is going on?</p>
            <p> Why does he look so confused?</p>
            <p> Also, how does his head move so fast...?</p>
            <img src= "../images/what happened.jpg" name = "words" alt= "word" width="100" height="500">
        </div>
    </body>
</html>
