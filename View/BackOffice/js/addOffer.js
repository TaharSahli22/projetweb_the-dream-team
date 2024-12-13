
// Correction partie 3 etude de cas Partie JS
function validerFormulaire() {
document.addEventListener("DOMContentLoaded", function(){

var titleElement= document.getElementById("title");
var userelement= document.getElementById("adminuser");
var subjectElement= document.getElementById("subjects");

var isvalid=true;


titleElement.addEventListener("keyup", function(){
    var titleErrorElement= document.getElementById("title_error");
    var titleErrorValue=titleElement.value;
    var pattern = /^[A-Za-z0-9]{3,}$/
    if(!pattern.test(titleErrorValue)){
        titleErrorElement.innerHTML = "Le titre doit contenir au moins 3 caractères";
        titleErrorElement.style.color = "red";
        isvalid=false;
    }
    else {
        titleerrorElement.innerHTML = "Correct";
        titleerrorElement.style.color = "green";
    }
})
subjectElement.addEventListener("keyup", function(){
    var subjecterrorElement= document.getElementById("subjects_error");
    var subjectErrorValue=subjectElement.value;
    if(subjectErrorValue.length < 3) {
        subjecterrorElement.innerHTML = "Le subject doit contenir au moins 3 caractères";
        subjecterrorElement.style.color = "red";
        isvalid=false;
    }
    else {
        subjecterrorElement.innerHTML = "Correct";
        subjecterrorElement.style.color = "green";
    }
})
userelement.addEventListener("keyup",function(){
    var userErrorElement= document.getElementById("user_error");
    var userErrorValue=userelement.value;
    var pattern = /^[A-Za-z]{3,}$/
    if(!pattern.test(userErrorValue)){
        userErrorElement.innerHTML = "La user doit contenir  uniquement des lettres et des espaces et au moins 3 caractères";
        userErrorElement.style.color = "red";
        isvalid=false;
    }else
    { userErrorElement.innerHTML = "Correct";
        userErrorElement.style.color = "green";

    }
});
 
return isvalid;
})
}