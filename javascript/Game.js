var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");

function drawButton() {
    ctx.beginPath();
    ctx.rect(50, 50, 23, 200);
    ctx.fillStyle = "chartreuse";
    ctx.fill();
    ctx.closePath();
}

drawButton();