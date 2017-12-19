function DeleteBug(id, element) {
    if(!confirm('Bug Fixed?')){
        return;
    }
    axios.post('/bug/delete/' + id, {
        id: id
    }).catch(function (error) {
        console.log(error);
    })
        .then(function (response) {
            if (response.data === "OK")
                element.innerHTML = null;
            else {
                alert(response.data);
            }
        });
}