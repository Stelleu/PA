saveButton = document.getElementById("saveBtn")
saveButton.style.display= "none"
editButton = document.getElementById("editProfil")
deleteButton= document.getElementById("deleteUser")
const id = document.getElementById("profil")
const sessionId = id.getAttribute("data-id");

editButton.addEventListener("click",e =>{
    saveButton.style.display= "block"
    editButton.style.display= "none"
    callReadonly()
} )

saveButton.addEventListener("click",e =>{

    const firstnameInput = document.getElementById("firstname");
    const lastnameInput = document.getElementById("lastname");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const firstnameValue = firstnameInput.value;
    const lastnameValue = lastnameInput.value;
    const emailValue = emailInput.value;
    const passwordValue = passwordInput.value;
    const profilForm = document.getElementById("profil");
    const dataRoleValue = profilForm.getAttribute("data-role");
    let websiteNameValue = "";
    if (dataRoleValue == 0 ){
        const websiteNameInput = document.getElementById("websiteName");
        websiteNameValue = websiteNameInput.value;
    }
    const form = {
        firstname: firstnameValue,
        lastname: lastnameValue,
        email: emailValue,
        password: passwordValue,
        websiteName: websiteNameValue
    };
    callReadonly()
    fetch(`/dash/editprofil`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(form)
    })
        .then(response => {return response.json()})
        .then(data => {
            console.log(data)
            if (JSON.parse(data).success) {

                saveButton.style.display= "none"
                editButton.style.display= "block"
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'Modification is done',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                swalWithBootstrapButtons.fire(
                    'Error',
                    'Something went wrong !',
                    'error'
                )
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX', error);
        });
} )
deleteButton.addEventListener("click",e =>{

    $.ajax({
        type: "post",
        url: "deleteUser",
        data: {id: sessionId},
        success: function (response) {
            console.log(response)
           window.location.replace("/dash/logout")

        },
        error: function (error) {
            swalWithBootstrapButtons.fire(
                'Error',
                'Something went wrong !',
                'error'
            )
        }
    })



} )

function readonly(input){
    let namedInput = document.getElementById(input)
    if (namedInput.readOnly){
        namedInput.readOnly=false
        namedInput.classList.replace("form-control-plaintext", "form-control");
    }else {
        namedInput.readOnly= true
        namedInput.classList.replace("form-control", "form-control-plaintext");
    }
}
function callReadonly(){
    readonly("firstname")
    readonly("lastname")
    readonly("email")
    readonly("password")
    readonly("websiteName")
}