<script type="text/javascript">var words = <?php echo json_encode($words)?>;</script>
<html>

<head>
    <p>hj</p>
    <meta charset="utf-8" />

    <title>RPGyping</title>

    <style>* { padding: 0; margin: 0; } canvas { background: #eee; display: block; margin: 0 auto; }</style>

</head>

<body>


<div id='d1' style="position:absolute; top:100; left:100; z-index:1">
    <canvas id="myCanvas" width="1000" height="750"></canvas>
</div>



<script>

    
    var divCanvas = document.getElementById("d1");
    var canvas = document.getElementById("myCanvas");
    var ctx = canvas.getContext("2d");
    var xOffset = divCanvas.offsetLeft;
    var yOffset = divCanvas.offsetTop;
    var xPosition = 250;
    var yPosition = 100;
    
    
    /*
    function drawButton(){
        
        var x = xPosition + xOffset;
        var y = yPosition + yOffset;
        var xLength = 120;
        var yLength = 50;
        
        ctx.beginPath();
        ctx.rect(x, y, xLength, yLength);
        ctx.fillStyle = "chartreuse";
        ctx.fill();
        ctx.closePath();

        ctx.font = "16px Comic Sans MS";
        ctx.fillStyle = "black";
        ctx.fillText("GET SHREKT", x + 3, y + yLength * 0.6);
    };
    
    function getClickPosition(e) {
        
        xPosition = e.clientX;
        yPosition = e.clientY;
        drawButton();
    };
    
    canvas.addEventListener("click", getClickPosition);
    */
    
    function updateTurn(){
        
        playerTurn();
        enemyTurn();
    };
    
    function draw(){
        
    };
    
    function playerTurn(){
        
        //select option
        playerAttack();
    };
    
    function enemyTurn(){
        
    };
    
    // function useItem(){
    // 
    // };
    
    function playerAttack(){
        
        //get typing efficiency
        
    };
    
    function enemyAttack(){
        
    };
    
    function win(){
        
    };
    
    function lose(){
        
    };
    
    while(true){
        
        updateTurn();
    }
    
</script>



</body>

</html>