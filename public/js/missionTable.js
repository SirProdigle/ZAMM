function UpdateRow(rowElement) {
    var debugging = false;
    //DEBUG INFO
    var id = rowElement.id;
    var rowCells = rowElement.childNodes;


    if (debugging) {
        for (var x = 0; x < 40; x++) {
            try {
                console.log(x + ":0: " + rowCells[x].childNodes[0].value + "\n");
                console.log(x + ":1: " + rowCells[x].childNodes[1].value + "\n");
            }
            catch (e) {
            }
        }
    }


    var Status = rowCells[1].childNodes[1].value;
    var Min = rowCells[5].childNodes[1].value;
    var Author = rowCells[11].childNodes[0].value;
    var LastPlayed = rowCells[13].childNodes[1].value;
    var Notes = rowCells[25].childNodes[0].value;
    var Completed = rowCells[15].childNodes[0].value;
    if(Author === "???"){
        Author = null;
    }
    axios.post('/mission/' + id, {
        status: Status,
        min: Min,
        user_id: Author,
        lastPlayed: LastPlayed,
        notes: Notes,
        completed: Completed
    }).catch(function (error) {
        console.log(error);
    });
}


function sortTable(sorterID) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("mainTable");
    switching = true;
    /*Make a loop that will continue until
     no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("tr");
        /*Loop through all table rows (except the
         first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
             one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("td")[sorterID];
            //alert("X: " + x.textContent);
            y = rows[i + 1].getElementsByTagName("td")[sorterID];
            if (isNaN(parseInt(x.textContent))) {
                NumX = 0
            } else {
                var NumX = parseInt(x.textContent);
            }
            if (isNaN(parseInt(y.textContent))) {
                NumY = 0
            } else {
                var NumY = parseInt(y.textContent);
            }
            if (NumX < NumY) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
             and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function DeleteMission(id, ElementToDestroy){
    if(confirm("Really Delete Mission?") === false){
        return;
    }
    axios.get('/mission/' + id+'/delete', {

    }).catch(function(error){
        console.log(error);
        //alert(error);
    }).then(function (response) {
        alert(response.data);
        ElementToDestroy.innerHTML = "";

        //alert(response);
    })

}

function AddStatusClass(Status, ele){
    console.log("S " +Status);
    switch (Status){
        case "Online":{
            ele.classList = null;
            ele.classList.add('is-online');
            break;
        }
        case "Updated":{
            ele.classList = null;
            ele.classList.add('is-updated');
            break;
        }
        case "New":{
            ele.classList = null;
            ele.classList.add('is-new');
            break;
        }
        case "Broken":{
            ele.classList = null;
            ele.classList.add('is-broken');
            break;
        }
        case "Pending Details":{
            ele.classList = null;
            ele.classList.add('is-pending');
            break;
        }
    }
}

