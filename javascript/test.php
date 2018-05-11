<!DOCTYPE html>
<?php
session_start();
$_SESSION["username"] = "asdf";
?>
<html>
    <p>Click the button to trigger a function that will output "Hello World" in a p element with id="demo".</p>

    <button onclick="endGame()">Click me</button>
    
    <p id="demo"></p>
    
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="savetest.js"></script>

</html>