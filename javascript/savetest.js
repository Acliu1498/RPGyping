/* global location*/
/* global $ */
function endGame(){
    var save = "{\"Wpm\" : 10, \"Accuracy\" : 0.5, \"xp\" : 10}";
    $.ajax({
        data: "save=" + save,
        url: "../php/DatabaseAccess/saveGame.php",
        method: 'POST', // or GET
        success: function() {
            alert("done");
        }
    });
}