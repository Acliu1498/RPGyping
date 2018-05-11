<html>
    <head>
        <script type="text/javascript" src="javascript/Game.js"></script>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <title>Typing Game</title>
         <style> 
    	    * { padding: 0; margin: 0; } 
    	    canvas { background: #eee; display: block; margin: 0 auto; } 
         </style> 
    </head>
    <body>
        <canvas id="myCanvas" width="480" height="320"></canvas>
        <div class="wrapper">
            <h1>Level 1</h1>
            <p>Type the words shown on the screen</p>
            <button>FIGHT</button>
            <div class="outerWrap">
                <div class="scoreWrap">
                    <p>Score</p>
                    <span class="score">0</span>
                </div>
                <div class="timeWrap">
                    <p>Time</p>
                    <span class="time">60</span>
                </div>
            </div>
            <div class="wordsWrap">
                <p class="words"></p>
            </div>
        </div>
    </body>
</html>