function UpdateStarRating(RatingBox, StarNum) {
    var starsAndField = RatingBox.childNodes;
    var stars = [];


    for (var i=0; i<starsAndField.length; i++) {

        // Add all the <li> nodes to an array, skip the text nodes
        if (starsAndField[i].nodeType != 3) {
            stars.push(starsAndField[i]);
        }
    }

    var hidden = stars[5];
    hidden.value = StarNum+1;

    for (i=0;i<=StarNum; i++){
        var star = stars[i];
        try {
            star.classList.add('star-full');
        }
        catch(e) {

        }
    }

    for(i=StarNum+1;i<stars.length+1;i++){
        try {
            stars[i].classList.remove('star-full');
        }
        catch (e){}
    }