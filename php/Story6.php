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
                    <a class="btn btn-primary" href="../php/Story7.php" role="button">Next</a>
                     <?php
                        if ($_SESSION["userType"] == "student" || $_SESSION["userType"] == "general") {
                     ?>
                    <a class="btn btn-warning" href="../php/Sentences.php" role="button">Skip Story</a>
                    <?php }?>
                </div> 
            </div>
        </div>
        <div class="story">
            <p> This boy's name is Tim!  At least that's what the mouse said...</p>
            <p> Is a keyboard a foreign object to his kind?</p>
            <p> Why does he look so confused...</p>
            <img src= "../images/keyboardgiven.jpg" name = "words" alt= "word" width="100" height="500"/>
        </div>
    </body>
</html>
