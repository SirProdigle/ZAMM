function UpdateRow(rowElement) {
    var debugging = false;
    //DEBUG INFO
    var id = rowElement.id;
    var rowCells = rowElement.childNodes;


    if(debugging) {
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

    axios.post('/mission/'+id,{
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