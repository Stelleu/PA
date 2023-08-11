
const deleteButton = document.getElementById("deleteBtn");
const editButton = document.getElementById("editBtn");
const deleteButtons = document.querySelectorAll(".delete-btn");
deleteButtons.forEach(button => {
    button.addEventListener("click", () => {
        const articleId = button.dataset.articleId;
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
                       setTimeout(
                           swalWithBootstrapButtons.fire(
                           'Deleted!',
                           'The article  n°' + articleId + ' has been deleted.',
                           'success'
                       ) ,3000) ;
                        document.location.reload()
                    },
                    error: function (error) {
                        swalWithBootstrapButtons.fire(
                            'Error',
                            'Something went wrong !'+ error,
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
})

const publishButtons = document.querySelectorAll(".publish-btn");
publishButtons.forEach(button => {
    button.addEventListener("click", () => {
        const articleId = button.dataset.articleId;
        const isPublished = button.dataset.published === 'true';

        // Construire les données à envoyer dans la requête AJAX
        const requestData = {
            id: articleId,
            published: !isPublished
        };

        // Envoyer la requête AJAX pour publier ou dépublier l'article
        fetch(`/dash/statusarticle`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData)
        })
            .then(response =>  response.json())
            .then(data => {
                console.log(data)
                if (data.success) {
                    button.dataset.published = !isPublished;
                    button.innerHTML = `<i class="bi bi-eye ${!isPublished ? '-slash' : ''}"></i> ${!isPublished ? 'Publish' : 'Unpublish'}`;
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
    })
})
