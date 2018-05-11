/* global words */
/* global userStats */
/* global location */
/* global enemy */
/* global $*/

// parses words encoded in json
// userStats = {"Attack" , "Defense", "Health", "Wpm", "Accuracy"}
// enemy = {"EnemyHealth", "Defense", "Health", "EnemyImage", "XP"}
// location = {"BackgroundImage", "Location"}

//write code to print this array ^


var save;
var gameState = "start";
var nextState = "enemy";
var started = false;
var dotCount = 0;

var wait = 0;
var totWPM = 0;
var totAccuracy = 0;
var totMisses = 0;
var enemyXP = enemy["XP"];
var sentence;           //the string the player should be typing
var curr = "";          //current string the player is typing
var playerTurn = true;  //is it the player's turn

var time;               // time it takes for user to type
var currentWordsTyped;

var sentenceCanvas = document.getElementById("sentenceCanvas"); // canvas for the sentence
var sentenceCTX = sentenceCanvas.getContext("2d");

var textCanvas = document.getElementById("textCanvas");         // canvas for the text
var textCTX = textCanvas.getContext("2d");

var wordstyped = 0; // number of words user typed
var wpm = 0;        // the words per minute
var totalTime = 0;  // the total time the user has taken
var misses = 0;     // the number of misses the user has made per word
var numTyped = 0;   // of letters typed
var totNumTyped = 0;

let health = document.getElementById("health");
let enemyHealth = document.getElementById("enemyHealth");

sentenceCTX.font = "20px Consolas";        // the sentence font
textCTX.font = "20px Consolas";            // the text font
textCTX.fillText("Type here", 10, 50);  // initializes typing canvas

// Create gradient
var c=document.getElementById("sentenceCanvas");
var gradient=sentenceCTX.createLinearGradient(0,0,c.width,0);

gradient.addColorStop("0","blue");
gradient.addColorStop("0.5","green");
gradient.addColorStop("0.9","black");

// Fill with gradient
sentenceCTX.fillStyle=gradient;
sentenceCTX.fillText("Attack, Defend, Spell, Item",10,50);

var background = document.getElementById("background");
var attackSound = new Audio('../Music/l.mp3');
var defendSound = new Audio('../Music/PowerUp16.mp3');
var magicSound = new Audio('../Music/Space-Cannon.mp3');
var itemSound = new Audio('../Music/PowerUp17.mp3');
var win = new Audio('../Music/Happy-Endings.mp3');
var lose = new Audio('../Music/down.mp3');

function start() {
    
    if(enemyHealth.value == 0){
        endGame();
        background.pause();
        win.play();
        totAccuracy = (totNumTyped - totMisses) / totNumTyped;
        // save JSON string
        var save = "{\"Wpm\" : " + wpm + ", \"Accuracy\" :" + totAccuracy + ", \"xp\" : " + enemyXP + " }";
        // ajax request to update database
        $.ajax({
            data: "save=" + save,
            url: "../php/DatabaseAccess/saveGame.php",
            method: 'POST', // or GET
            success: function() {
                window.location.href='../php/winner.php';
            }
        });
        
        
    }
    if(health.value == 0){
        $.ajax({
            data: "save=" + save,
            url: "../php/DatabaseAccess/saveGame.php",
            method: 'POST', // or GET
            success: function() {
                window.alert("you lost..");
            }
        });
        
    }
    //clears the text and sentences
    textCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    sentenceCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    
    // fills them with text
    sentenceCTX.fillText("Attack, Defend, Spell, Item", 10, 50);
    textCTX.fillText("Type here", 10, 50);
    document.getElementById("box").style.backgroundColor = "white";
}

// tracks the time it took for user to finish sentence
function end() {

    time = (new Date() - time) / 1000;
    wordstyped += sentence.split(" ").length;
    currentWordsTyped = sentence.split(" ").length;

    return time;
}

//checks if sentence is correct
function check() {
    return curr.length == sentence.length;
}

function endGame(){

    
    
}

//initializes sentence typing action
function startAction() {
    
    time = new Date();  // instantiates timer
    setNewSentence();   // sentence being typed
    printSentence();    // prints the current sentence

    // reintializes values
    numTyped = 0;
    misses = 0;
    curr = "";
    textCTX.fillText("Start Typing!!!", 10, 50);
}

function init(){
    
    //probably doStuff()
}

//returns how much damage out of 100 health the player inflicts
function playerAttack(atk = 10, def = 10, wpm, par){
    
    var dmg = 20 * ((numTyped - misses) / numTyped) * atk / def * (wpm / par > 1.5 ? 1.5 : wpm / par);
    dmg = dmg > 0 ? Math.ceil(enemyHealth.value - dmg) : 0;
    //average attack is 10
    return dmg;
}

// track the user
function trackAction() {

    numTyped++;
    if (curr.charAt(curr.length - 1).toUpperCase() == sentence.toUpperCase().charAt(curr.length - 1)) {
        
        document.getElementById("box").style.backgroundColor = "lightgreen";
    }
    else {

        document.getElementById("box").style.backgroundColor = "lightcoral";
    }
}

function playerDefend(){
    
    
}

function playerItem(){
    
    
}

function playerSpell(){
    
    
}

function enemyAttack(){
    
    var enemyAttack = enemy["Attack"];         //userStats["Attack"]
    var playerDefence = userStats["Defense"];  //userStats["Defense"]
    
    textCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    sentenceCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    
    //attack stuff
    var dmg = (Math.random() + 0.5) * 20 * enemyAttack / playerDefence;
    health.value = health.value - dmg > 0 ? Math.trunc(health.value - dmg) : 0;
    
    //fill text
    sentenceCTX.fillText("Enemy did " + dmg + "damage", 10, 50);
    textCTX.fillText("Ouch", 10, 50);
    document.getElementById("box").style.backgroundColor = "white";
}


//function to set the sentence to something new
function setNewSentence() {

    sentence = words[Math.floor(Math.random() * words.length)]["Sentence"];
}

//prints current sentence
function printSentence() {
    
    sentenceCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    sentenceCTX.fillText(sentence, 10, 50);
}

function helpful(){
    
    trackAction();

    // checks if the user has completed the sentence
    return check();
}

$(document).keydown(function(event) {
    
    var key = event.which || event.keyCode;
    
    if(nextState == "enemy"){
        
        if (key == 8) {
        
            curr = curr.substr(0, curr.length - 1);
        }
        else {
        
            //if upper case
            if (event.shiftKey) {
                
                if(key == 186){
                    curr += ':';
                }  
                else if(key == 222){
                    curr += '?"';
                } 
                
                curr += String.fromCharCode(key).toUpperCase();
            }
            else if(key == 186){
                
                curr += ';';
            } 
            else if(key == 222){
                
                curr += '\'';
            } 
            else if(key == 190){
                
                curr += '.';
            }
            else if(key == 189){
                
                curr += '-';
            }
            else if(key == 188){
                
                curr += ',';
            }
            else if(key == 186 && key == 16){
                
                curr += ';';
            }
            else if(event.which == 46){
                
                curr += '.';
            }
            else {
        
                //else for lower
                curr += String.fromCharCode(key).toLowerCase();
            }
        }
        textCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
        textCTX.fillText(curr, 10, 50);
    }
    switch(gameState){
        
        case "start":
            
            init();
            gameState = "player";
            nextState = "enemy";
            break;
            
        case "log":
            
            //TODO implement logging here
            
            gameState = nextState;
            break;
            
        case "attack":
            
            if(!started){
                
                startAction();
                started = true;
            }
            
            if(helpful()){
                
                var playerAttack = userStats["Attack"];
                var enemyDefence = userStats["Defense"];
                var parWpm = userStats["Wpm"];
        
                document.getElementById("time").innerHTML = "Time: " + end() + 'secs';
        
                totalTime += time / 60;
                wpm = wordstyped / totalTime;
                document.getElementById("accuracy").innerHTML = "Accuracy: " + ((numTyped - misses) / numTyped);
                
                enemyHealth.value -= playerAttack(playerAttack, enemyDefence, wpm, parWpm);
                
                if(health.value == 0){
                        
                    gameState = "lose";
                }
                if(enemyHealth.value == 0){
                    
                    gameState = win;
                }
                
                var n = wpm.toPrecision(2);
                document.getElementById("wpm").innerHTML = "Time: " + n + 'wpm';
                
                gameState = "log";
                curr = '';
                start();
                
                started = false;
            }
            
            break;
        
        case "defend":
            
            break;
        
        case "spell":
            
            break;
            
        case "item":
            
            break;
        
        case "enemyAttack":
            
            break;
            
        case "player":
            
            nextState = "enemy";
        
            //checks if ENTER
            if (key == 13) {
            
                // if the user does some action
                var tmp = curr.toLowerCase();
                
                if(tmp == 'attack'){
                    
                    var x = document.getElementById("picture");
                    x.setAttribute("src", "../images/attack.JPG");
                    
                    gameState = "attack";
                }
                if(tmp == 'defend'){
                    
                    var y = document.getElementById("picture");
                    y.setAttribute("src", "../images/defend.JPG");
                    
                    gameState = "defend";
                }
                if(tmp == 'spell'){
                    
                    var z = document.getElementById("picture");
                    z.setAttribute("src", "../images/spell.JPG");
                    
                    gameState = "spell";
                }
                if(tmp == 'item'){
                    
                    var a = document.getElementById("picture");
                    a.setAttribute("src", "../images/item.JPG");
                    
                    gameState = "item";
                }
            }
            
            break;
            
        case "enemy":
            
            enemyAttack();
            gameState = "log";
            nextState = "player";
            
            break;
            
        case "end":
            
            //FINISH HIM!
            break;
            
        default:
            health.style.color = "chartreuse";
            health.value = 100 * Math.random();
    }

    if(dotCount > 0){
        
        dotCount--;
    }
});

//var location = <?php echo json_encode($location); ?>;


