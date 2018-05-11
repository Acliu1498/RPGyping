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

var buff = 0;
var log = [];
var save;
var gameState = "start";
var wait = 0;
var rounds = 0;
var totWPM = 0;
var totAccuracy = 0;
var totMisses = 0;
var enemyXP = enemy["XP"];
var sentence;           //the string the player should be typing
var curr = "";          //current string the player is typing
var playerTurn = true;  //is it the player's turn

var time;               // time it takes for user to type
var state = 'menu';     // current state the user is int
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

var pA = userStats["Attack"];
var pD = userStats["Defense"];

let health = document.getElementById("health");
let enemyHealth = document.getElementById("enemyHealth");

sentenceCTX.font = "25px Consolas";        // the sentence font
textCTX.font = "25px Consolas";            // the text font
textCTX.fillText("Type here", 10, 50);  // initializes typing canvas


// Create gradient
var c=document.getElementById("sentenceCanvas");
var gradient=sentenceCTX.createLinearGradient(0,0,c.width,0);
gradient.addColorStop("0","blue");
gradient.addColorStop("0.5","green");
gradient.addColorStop("0.9","white");

// Fill with gradient
sentenceCTX.fillStyle=gradient;
textCTX.fillstyle=gradient;

// Fill with gradient

//sentenceCTX.fillText("Attack, Defend, Spell, Item",10,50);


var background = document.getElementById("background");
var attackSound = new Audio('../Music/l.mp3');
var defendSound = new Audio('../Music/PowerUp16.mp3');
var magicSound = new Audio('../Music/Space-Cannon.mp3');
var itemSound = new Audio('../Music/PowerUp17.mp3');
var win = new Audio('../Music/Happy-Endings.mp3');
var lose = new Audio('../Music/down.mp3');

// function enemy() {
//     setTimeout(alert(enemyHealth.value, 3000));
// }
function enemyAttack(){
    
    var placeHolderAttack = enemy["Attack"];
    var placeholderPlayerDefence = pD;
    
    textCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    sentenceCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    
    //attack stuff
    var dmg = (Math.random() + 0.5) * 17.5 * placeHolderAttack / placeholderPlayerDefence;
    health.value = health.value - dmg > 0 ? Math.trunc(health.value - dmg) : 0;
    //enemyHealth.value = health.value - dmg > 0 ? Math.trunc(health.value - dmg) : 0;
    //logs damage
    add2Log("The enemy attacked you for:  " + Math.trunc(dmg) + " damage!!");
    document.getElementById("box").style.backgroundColor = "#7FD9AA";

}

function start() {
    if(enemyHealth.value == 0){
        background.pause();
        win.play();
        totAccuracy = (totNumTyped - totMisses) / totNumTyped;
        // save JSON string
        var save = "{\"Wpm\" : " + totWPM/rounds + ", \"Accuracy\" :" + totAccuracy + ", \"xp\" : " + enemyXP + " }";
        // ajax request to update database
        $.ajax({
            data: "save=" + save,
            url: "../php/DatabaseAccess/saveGame.php",
            method: 'POST', // or GET
            success: function winner() {
                window.location.href='../php/winner.php';
            }
        });
        
        
    }
    if(health.value == 0){
        lose.play();
        background.pause();
        $.ajax({
            data: "save=" + save,
            url: "../php/DatabaseAccess/saveGame.php",
            method: 'POST', // or GET
            success: function loser() {
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
    document.getElementById("box").style.backgroundColor = "#7FD9AA";
}

//tracks keystrokes user types
function startAction() {
    time = new Date();  // instantiates timer
    setNewSentence();   // sentence being typed
    printSentence();    // prints the current sentence

    // reintializes values
    numTyped = 0;
    misses = 0;
    turn = 0;
    curr = "";
    textCTX.fillText("Start Typing!!!", 10, 50);
}

// tracks the time it took for user to finish sentence
function end() {

    time = (new Date() - time) / 1000;
    wordstyped += sentence.split(" ").length;
    currentWordsTyped = sentence.split(" ").length;

    return time;
}

// 
// when the user types a key track it
// 
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

$(document).keydown(function(event) {

    if(playerTurn){
        
        textCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
        var key = event.which || event.keyCode;
    
        //checks if the user is entering something
        if (key == 13) {
    
            // if the user does some action
            var tmp = curr.toLowerCase();
            if (tmp == 'attack' || tmp == 'defend' || tmp == 'spell' || tmp == "item") {
                if(tmp == 'attack'){
                    var x = document.getElementById("picture");
                    x.setAttribute("src", "../images/attack.JPG");
                    //playerAttack();
                    startAction();
                    attackSound.play()
                    
                }
                if(tmp == 'defend'){
                    
                    var y = document.getElementById("picture");
                    y.setAttribute("src", "../images/defend.JPG");
                    
                    startAction();
                    defendSound.play()
                }
                if(tmp == 'spell'){
                    var z = document.getElementById("picture");
                    z.setAttribute("src", "../images/spell.JPG");
                    var luck = Math.random()*6+1;
                    var a = parseInt(luck, 10);
                    
                    if(a == 1 || a ==3){
                        
                    enemyHealth.value -= 50;    
    
                    }
                    startAction();
                    magicSound.play();
                }
                if(tmp == 'item'){
                    
                    var a = document.getElementById("picture");
                    a.setAttribute("src", "../images/item.JPG");
                    let health = document.getElementById("health");
                    
                    health.value += Math.random()*5;
                    startAction();
                    itemSound.play();
                }
                state = tmp
                startAction();
           
            }
        }
        else if (key == 8) {
    
            curr = curr.substr(0, curr.length - 1);
        }
        else if (key == 16) {
            //shift stuff
        }
        else {
    
            //if upper case
            if (event.shiftKey) {
                
                if(key == 186){
                    curr += ':';
                }  
                else if(key == 222){
                    curr += '\"';
                } else { 
                    curr += String.fromCharCode(key);
                }
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
            else if(key == 186){
                curr += ';';
        
            }
            else if(event.which == 46){
                curr += '.';
        
            }
            else {
    
                //else for lower
                curr += String.fromCharCode(key).toLowerCase();
            }
            if (state != "menu") {
    
                trackAction();
    
                // checks if the user has completed the sentence
                if (check()) {
                    var placeholderEnemyDefence = enemy["Defense"];
                    var parWpm = userStats["Wpm"];
                    var typingTime = end();
    
                    document.getElementById("time").innerHTML = "Time: " + typingTime + 'secs';
                    
                    totalTime += time / 60;
                    var thisTime = typingTime / 60;
                    wpm = wordstyped / totalTime;
                    totWPM += wpm;
                    rounds++;
                    var thisWpm = currentWordsTyped / thisTime;
                    totNumTyped += numTyped;
                    totMisses += misses 
                    
                    if(buff == 0){
                        pD = userStats["Defense"];
                    } else {
                        buff--;
                    }
                    
                    document.getElementById("accuracy").innerHTML = "Accuracy: " + ((numTyped - misses) / numTyped);
                    if(state == 'attack'){
                        enemyHealth.value -= playerAttack(pA, placeholderEnemyDefence, thisWpm, parWpm);
                    } else if(state == 'defend'){
                        playerDefend(pD, thisWpm, parWpm);
                        buff = 3
                    }
                    
                    
                    var n = wpm.toPrecision(2);
                    document.getElementById("wpm").innerHTML = "Speed: " + n + 'wpm';
                    
                    //enemy();
                    
                    enemyAttack();

                    state = "menu";
                    curr = '';
                    start();
                }
            }
        }
    
        textCTX.fillText(curr, 10, 50);
    }
    else{
        
        playerTurn = true;
    }
});

// track the user
function trackAction() {

    numTyped++;
    if (curr.charAt(curr.length - 1).toUpperCase() == sentence.toUpperCase().charAt(curr.length - 1)) {
        document.getElementById("box").style.backgroundColor = "lightgreen";
    }
    else {
        misses++;
        document.getElementById("box").style.backgroundColor = "lightcoral";
    }
}



//checks if sentence is correct
function check() {
    return curr.length == sentence.length;
}

//function to set the sentence to something new
function setNewSentence() {

    sentence = words[Math.floor(Math.random() * words.length)]["Sentence"].trim();

}

//prints current sentence
function printSentence() {
    sentenceCTX.clearRect(0, 0, textCanvas.width, textCanvas.height);
    sentenceCTX.fillText(sentence, 10, 50);
}

//returns how much damage out of 100 health the player inflicts
function playerAttack(atk, def, wpm, par){
    //window.alert(wpm);
    var dmg = 20 * ((numTyped - misses) / numTyped) * atk / def * (wpm / par > 1.5 ? 1.5 : wpm / par);
    dmg = dmg > 0 ? Math.ceil(dmg):0;
    //average attack is 10
    //print attack here
    add2Log('You attacked the enemy for: ' + Math.trunc(dmg) + " damage!!");
   
    return dmg;
}

function playerDefend(def, wpm, par){
    if(buff != 0){
        pD = userStats["Defense"];
    }
    
    var bonus = 1.0 + (((numTyped - misses) / numTyped) / 2) + (wpm / par > 0.5 ? 0.5 : wpm / par);
    pD = pD * bonus;
    add2Log('Your Defense went up by ' + (pD - userStats['Defense']) + " points for 3 turns!!");

}

function add2Log(value){
    log.push(value);
    if(log.length > 5){
        log.shift();
    }
    printLog();
}

function printLog(){
    for(var i = log.length - 1; i > -1; i--){
        if(log[i] != null){
            document.getElementById("log" + (log.length - i)).innerHTML = log[i];
        }
    }
}



//=======================================================================================================================NEW CODE STARTS HERE==========================================================================
/*
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

$(document).keydown(function(event) {

    if(wait <= 0){
        
        switch(gameState){
            
            case "start":
                
                init();
                state = "player";
                break;
                
            case "player":
                
                            
    var key = event.which || event.keyCode;

    //checks if ENTER
    if (key == 13) {
    
        // if the user does some action
        var tmp = curr.toLowerCase();
        
        if(tmp == 'attack'){
            
            var x = document.getElementById("picture");
            x.setAttribute("src", "../images/attack.JPG");
            state = curr;
            startAction();
        }
        if(tmp == 'defend'){
            
            var y = document.getElementById("picture");
            y.setAttribute("src", "../images/defend.JPG");
            let health = document.getElementById("health");
            health.value -= 10;
            
            state = curr;
            startAction();
        }
        if(tmp == 'spell'){
            
            var z = document.getElementById("picture");
            z.setAttribute("src", "../images/spell.JPG");
            var luck = Math.random()*6+1;
            var a = parseInt(luck, 10);
            
            if(a == 1 || a ==3){
                
            enemyHealth.value -= 20;    
            
                if(enemyHealth.value == 0){
                    
                    alert("Winner!");
                } 
            }
            state = curr;
            startAction();
        }
        if(tmp == 'item'){
            
            var a = document.getElementById("picture");
            a.setAttribute("src", "../images/item.JPG");
            let health = document.getElementById("health");
            
            health.value -= Math.random()*5-5;
            state = curr;
            startAction();
        }
        
        
    }
    else {
        
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
                curr += '\"';
            } 
            
            curr += String.fromCharCode(key).toUpperCase();
        }
        else if(key == 186){
                curr += ':';
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
    }
    if (state != "menu") {
    
                trackAction();
    
                // checks if the user has completed the sentence
                if (check()) {
                    
                    var placeholderPlayerAttack = userStats["Attack"];
                    var placeholderEnemyDefence = userStats["Defense"];
                    var parWpm = userStats["Wpm"];
    
                    document.getElementById("time").innerHTML = "Time: " + end() + 'secs';
    
                    totalTime += time / 60;
                    wpm = wordstyped / totalTime;
                    document.getElementById("accuracy").innerHTML = "Accuracy: " + ((numTyped - misses) / numTyped);
                    
                    enemyHealth.value -= playerAttack(placeholderPlayerAttack, placeholderEnemyDefence, wpm, parWpm);
                    
                    if(health.value == 0){
                            
                            alert("You lost..");
                    }
                    if(enemyHealth.value == 0){
                        
                        alert("Winner!");
                    }
                    
                    var n = wpm.toPrecision(2);
                    document.getElementById("wpm").innerHTML = "Time: " + n + 'wpm';
                    
                    enemyAttack();
                    state = "menu";
                    curr = '';
                    start();
                    
                }
            }
                    }
                }
                
                state = "enemy";
                break;
                
            case "enemy":
                
                enemyAttack();
                state = "player";
                break;
                
            case "end":
                
                //FINISH HIM!
                break;
                
            default:
                health.style.color = "chartreuse";
                health.value = 100;
        }
    }
});
*/


//var location = <?php echo json_encode($location); ?>;