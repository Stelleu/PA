<<<<<<< HEAD
const deleteButton = document.querySelector("#deleteBtn");
console.log(deleteButton)
=======
const deleteButton = document.getElementById("deleteBtn");
>>>>>>> Dash
const editButton = document.getElementById("editBtn");
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
                    url: "deletearticle",
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
    })
