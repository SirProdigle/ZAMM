function ToggleElement(element, displayType = "block") {
    if (element.style.display === displayType) {
        element.style.display = "none";
    }
    else{
        element.style.display = displayType;
    }
}

function ToggleFilterList(element, thisElement, displayType = "block") {
    ToggleElement(element,displayType);
    if(thisElement.innerText === "Open Filtering Window"){
        thisElement.innerText = "Close Filtering Window";
    }
    else{
        thisElement.innerText = "Open Filtering Window";
    }
}