function UpdateRow(rowElement) {
    var debugging = false;
    //DEBUG INFO
    var id = rowElement.id;
    var rowCells = rowElement.childNodes;


    if (debugging) {
        for (var x = 0; x < 40; x++) {
            try {
                console.log(x + ":0: " + rowCells[x].childNodes[0].value + "\n");
            }
            catch (e) {
            }
            try {
                console.log(x + ":1: " + rowCells[x].childNodes[1].value + "\n");
            }
            catch (e) {
            }
        }
    }


    var Status = rowCells[1].childNodes[1].value;
    var Author = rowCells[11].childNodes[0].value;
    var LastPlayed = rowCells[13].childNodes[1].value;
    var Notes = rowCells[25].childNodes[0].value;
    var Completed = rowCells[15].childNodes[0].value;
    if (Author === "???") {
        Author = null;
    }
    axios.post('/mission/' + id, {
        status: Status,
        user_id: Author,
        lastPlayed: LastPlayed,
        notes: Notes,
        completed: Completed
    }).catch(function (error) {
        console.log(error);
    });
}


function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("mainTable");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("TR");
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function DeleteMission(id, ElementToDestroy) {
    if (confirm("Really Delete Mission?") === false) {
        return;
    }
    axios.get('/mission/' + id + '/delete', {}).catch(function (error) {
        console.log(error);
        //alert(error);
    }).then(function (response) {
        alert(response.data);
        ElementToDestroy.innerHTML = "";

        //alert(response);
    })

}

function AddStatusClass(Status, ele) {
    console.log("S " + Status);
    switch (Status) {
        case "Online": {
            ele.classList = null;
            ele.classList.add('is-online');
            break;
        }
        case "Updated": {
            ele.classList = null;
            ele.classList.add('is-updated');
            break;
        }
        case "New": {
            ele.classList = null;
            ele.classList.add('is-new');
            break;
        }
        case "Broken": {
            ele.classList = null;
            ele.classList.add('is-broken');
            break;
        }
        case "Pending Details": {
            ele.classList = null;
            ele.classList.add('is-pending');
            break;
        }
    }
}

function FillInBox(ToFill, SelectBox) {
    document.getElementById(ToFill).value = SelectBox.value;
}


function MoveMissionShowBox(row) {
    var currentServer = decodeURIComponent(window.location.search.match(/(\?|&)server\=([^&]*)/)[2]);
    var missionDisplay = (row.childNodes[9].innerText);
    var modal = document.getElementById('moveMissionModal');
    document.getElementById('move-message').innerText = "Mission: " + missionDisplay;
    document.getElementById('moveMissionID').innerText = row.id;
    modal.classList.add('is-active');
}

function MoveMissionCloseBox() {
    var modal = document.getElementById('moveMissionModal');
    modal.classList.toggle('is-active');
}

function MoveMission(id, server) {
    axios.get('/mission/' + id + /move/ + server, {}).then(function (response) {
        document.getElementById('moveMissionModal').classList.toggle('is-active');
        if (response.data === "OK") {
            alert("Mission Moved Successfully");
            document.getElementById(id).innerHTML = "";
        }
        else
            alert(response.data);
    });




}

