const deleteButton = document.getElementById("deleteBtn");
deleteButton.addEventListener("click", () => {
    const articleId = $(this).data('article-id');

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
                    url: "deleteArticle",
                    data: {id: articleId},
                    success: function (response) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'The article  n°' + articleId + ' has been deleted.',
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
                    'The article is safe :)',
                    'error'
                )
            }
        })

        // $.ajax({
        //     type: "post",
        //     url: "editUser",
        //     data: {id: userId},
        //     success: function (response) {
        //         console.log(response)
        //         const modalElement = document.getElementById("editModal");
        //         const modal = new bootstrap.Modal(modalElement);
        //         const form = document.querySelector('#editForm');
        //         try {
        //             const formData = JSON.parse(response);
        //             const hiddenButton = document.createElement("input");
        //             hiddenButton.type = "hidden";
        //             hiddenButton.name = "id";
        //             hiddenButton.value = userId;
        //             form.appendChild(hiddenButton);
        //             form.elements["UserId"].value = userId;
        //             form.elements["Lastname"].value = formData.lastname;
        //             form.elements["Email"].value = formData.email;
        //             form.elements["Role"].value = formData.role;
        //             form.elements["Password"].value = formData.password;
        //
        //             modal.show();
        //
        //         } catch (e) {
        //             console.error("Error parsing JSON response:", e);
        //         }
        //     },
        //     error: function (error) {
        //         console.log(error)
        //     }

    })

