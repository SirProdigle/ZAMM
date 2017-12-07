function DeleteUserAjax(id, element) {
    axios.post('/users/' + id + '/delete', {
        id: id
    }).catch(function (error) {
        console.log(error);
    })
        .then(function (response) {
            if (response.data === "OK")
                element.parentElement.innerHTML = null;
            else {
                alert(response.data);
            }
        });
}

function ChangeUserRoleAjax(id, role) {
    axios.post('/users/' + id + '/role', {
        role: role
    }).catch(function (error) {
        alert(error);
    })
        .then(function (response) {
        });
}