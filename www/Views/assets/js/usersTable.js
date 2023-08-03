$('.dropdown-item').click(function() {
        const userId = $(this).data('user-id');
        const action = $(this).data('action');
        if (action === "delete")
        {
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
                        data: { id: userId },
                        success: function (response){
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'The user n°'+userId +' has been deleted.',
                                'success'
                            )
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
        }else{
            // var form = $('#kt_modal_add_user_form');
            // var status = document.querySelector('input[type=radio]:checked').value;
            // var formData = form.serialize();
            // formData += '&status='+ encodeURIComponent(status);
            // formData += '&submit='+ encodeURIComponent("S'inscrire");
            // $.ajax({
            //     type: "post",
            //     url: "users",
            //     data : formData,
            //
            // })
            console.log("ouvre modal");


        }
    });
// e.preventDefault();
var form = $('#kt_modal_add_user_form');
var status = document.querySelector('input[type=radio]:checked').value;
var formData = form.serialize();
formData += '&status='+ encodeURIComponent(status);
formData += '&submit='+ encodeURIComponent("S'inscrire");
$.ajax({
    type: "post",
    url: "users",
    data : formData,
    success: function (response) {
        // Show loading indication
        submitButton.setAttribute('data-kt-indicator', 'on');
        // Disable button to avoid multiple click
        submitButton.disabled = true;
        setTimeout(function () {
            // Remove loading indication
            submitButton.removeAttribute('data-kt-indicator');

            // Enable button
            submitButton.disabled = false;

            // Show popup confirmation
            Swal.fire({
                text: "Form has been successfully submitted!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    modal.hide();
                    location.reload();
                }
            });

            //form.submit(); // Submit form
        }, 2000);

    },
    error: function (xhr,status,error){
        console.error(error);
        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
        Swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    }
})

// // Cancel button handler
// const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
// cancelButton.addEventListener('click', e => {
//     e.preventDefault();
//     Swal.fire({
//         text: "Are you sure you would like to cancel?",
//         icon: "warning",
//         showCancelButton: true,
//         buttonsStyling: false,
//         confirmButtonText: "Yes, cancel it!",
//         cancelButtonText: "No, return",
//         customClass: {
//             confirmButton: "btn btn-primary",
//             cancelButton: "btn btn-active-light"
//         }
//     }).then(function (result) {
//         if (result.value) {
//             form.reset(); // Reset form
//             modal.hide();
//         } else if (result.dismiss === 'cancel') {
//             Swal.fire({
//                 text: "Your form has not been cancelled!.",
//                 icon: "error",
//                 buttonsStyling: false,
//                 confirmButtonText: "Ok, got it!",
//                 customClass: {
//                     confirmButton: "btn btn-primary",
//                 }
//             });
//         }
//     });
// });
//
// // Close button handler
// const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
// closeButton.addEventListener('click', e => {
//     e.preventDefault();
//     console.log("ok")
//
//     Swal.fire({
//         text: "Are you sure you would like to cancel?",
//         icon: "warning",
//         showCancelButton: true,
//         buttonsStyling: false,
//         confirmButtonText: "Yes, cancel it!",
//         cancelButtonText: "No, return",
//         customClass: {
//             confirmButton: "btn btn-primary",
//             cancelButton: "btn btn-active-light"
//         }
//     }).then(function (result) {
//         if (result.value) {
//             form.reset(); // Reset form
//             modal.hide();
//         } else if (result.dismiss === 'cancel') {
//             Swal.fire({
//                 text: "Your form has not been cancelled!.",
//                 icon: "error",
//                 buttonsStyling: false,
//                 confirmButtonText: "Ok, got it!",
//                 customClass: {
//                     confirmButton: "btn btn-primary",
//                 }
//             });
//         }
//     });
// });
// }