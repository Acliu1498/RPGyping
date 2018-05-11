//grab  username

/*function asd(a)
{
    if(a==1)
    document.getElementById("asd").style.display="none";
    else
    document.getElementById("asd").style.display="block";
}

document.getElementById('tableID').getElementsByTagName('td');
*/
function formAppear(press) {
    if (press == 1) {
        console.log("TEST");
        document.getElementsByClassName("pwForm").getElementsByTagName('form').style.display = "none"; //hides the form
    }
    document.getElementsByClassName("pwForm").getElementsByTagName('form').style.display = "none";
}
function changePassword() {
    //check what kind of user they are first
    //UPDATE student_TBL SET password = newPassword WHERE username=SESSION_username
    //UPDATE parent_TBL SET password = newPassword WHERE username=SESSION_username
}

function changeUsername() {
    //check what kind of user they are first
    //UPDATE student_TBL SET username = newPassword WHERE id=SESSIONID#
    //UPDATE parent_TBL SET password = newPassword WHERE id=SESSIONID#
}