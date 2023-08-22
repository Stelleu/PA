document.addEventListener("DOMContentLoaded", function() {
    $('.dropdown-item').click(function () {
        const userId = $(this).data('user-id');
        const action = $(this).data('action');
        if (action === "delete") {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "deleteUser",
                        data: {id: userId},
                        success: function (response) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'The user n°' + userId + ' has been deleted.',
                                'success'
                            )
                            document.location.reload();
                        },
                        error: function (error) {
                            swalWithBootstrapButtons.fire(
                                'Error',
                                'Something went wrong !',
                                'error'
                            )
                        }
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'The user is safe :)',
                        'error'
                    )
                }
            })
        } else {
            $.ajax({
                type: "post",
                url: "editUser",
                data: {id: userId},
                success: function (response) {
                    const modalElement = document.getElementById("editModal");
                    const modal = new bootstrap.Modal(modalElement);
                    const form = document.querySelector('#editForm');
                    try {
                        const formData = JSON.parse(response);
                        const hiddenButton = document.createElement("input");
                        hiddenButton.type = "hidden";
                        hiddenButton.name = "id";
                        hiddenButton.value = userId;
                        form.appendChild(hiddenButton);
                        form.elements["UserId"].value = userId;
                        form.elements["Lastname"].value = formData.lastname;
                        form.elements["Email"].value = formData.email;
                        form.elements["Role"].value = formData.role;
                        form.elements["Password"].value = formData.password;

                        modal.show();

                    } catch (e) {
                        console.error("Error parsing JSON response:", e);
                    }
                },
                error: function (error) {
                    console.log(error)
                }
            })
        }
    });
})
