function UpdateStarRating(RatingBox, StarNum) {
    var starsAndField = RatingBox.childNodes;
    var stars = [];


    for (var i = 0; i < starsAndField.length; i++) {

        // Add all the <li> nodes to an array, skip the text nodes
        if (starsAndField[i].nodeType != 3) {
            stars.push(starsAndField[i]);
        }
    }

    var hidden = stars[5];
    hidden.value = StarNum + 1;

    for (i = 0; i <= StarNum; i++) {
        var star = stars[i];
        try {
            star.classList.add('star-full');
        }
        catch (e) {

        }
    }

    for (i = StarNum + 1; i < stars.length + 1; i++) {
        try {
            stars[i].classList.remove('star-full');
        }
        catch (e) {
        }
    }
}

function reviewIsOkay(){

    var briefing = document.getElementsByName('briefing')[0].value;
    if(briefing === null || briefing === ""){
        alert("Briefing not set");
        return false;
    }
    var  equipment= document.getElementsByName('equipment')[0].value;
    if(equipment === ""){
        alert("Equipment not set");
        return false;
    }
    var enemies = document.getElementsByName('enemy')[0].value;
    if(enemies === ""){
        alert("Enemies not set");
        return false;
    }
    var location = document.getElementsByName('location')[0].value;
    if(location === ""){
        alert("Location not set");
        return false;
    }
    var objectives = document.getElementsByName('objectives')[0].value;
    if(objectives === ""){
        alert("Objectives not set");
        return false;
    }
    var enjoyment = document.getElementsByName('enjoyment')[0].value;
    if(enjoyment === ""){
        alert("Overall Design not set");
        return false;
    }
    var competency = document.getElementsByName('competency')[0].value;
    if(competency === ""){
        alert("Implementation not set");
        return false;
    }
    return true;
}