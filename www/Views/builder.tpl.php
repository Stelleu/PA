<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/plugins/font-awesome-4.7.0/css/font-awesome.min.css" data-type="keditor-style" />
    <!-- Start of KEditor styles -->
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/dist/css/keditor.css" data-type="keditor-style" />
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/dist/css/keditor-components.css" data-type="keditor-style" />
    <!-- End of KEditor styles -->
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/plugins/code-prettify/src/prettify.css" />
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/css/examples.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/plugins/bootstrap-3.4.1/css/bootstrap.min.css" data-type="keditor-style" />

</head>

<body>
    <?php include $this->view ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/jquery-1.11.3/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/bootstrap-3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/ckeditor-4.11.4/ckeditor.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/formBuilder-2.5.3/form-builder.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/formBuilder-2.5.3/form-render.min.js"></script>
    <!-- Start of KEditor scripts -->
    <script type="text/javascript" src="/Views/keditor-master/dist/js/keditor.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/dist/js/keditor-components.js"></script>
    <!-- End of KEditor scripts -->
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/code-prettify/src/prettify.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/js-beautify-1.7.5/js/lib/beautify.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/js-beautify-1.7.5/js/lib/beautify-html.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/js/examples.js"></script>
    <script type="text/javascript" data-keditor="script">
        $(function () {
            $('#content-area').keditor();
            $('.fa-save').click(function () {
                const title = $('#title').val()
                if (title !== "") {
                    const content = $('#content-area').keditor('getContent', true);
                    const pageId = document.getElementById("title").getAttribute("data-page-id")
                    const description = $('#exampleFormControlTextarea1').val()
                    const selectedRadio = document.querySelector('input[name="listGroupRadio"]:checked');
                    let selectedCategoryId = ""
                    if (selectedRadio) {
                        selectedCategoryId = selectedRadio.getAttribute("data-category-id");
                    }
                    fetch('/dash/page', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            action: 'send-content',
                            content: content,
                            title: title,
                            id: selectedCategoryId,
                            description: description,
                            pageId: pageId
                        })
                    })
                        .then(response => {
                            console.log(response.json())

                            if (response.ok) {
                                return response.json();
                            } else {
                                console.log(response)
                                console.log(response.json())
                                throw new Error('Network response was not ok');
                            }
                        })
                        .then(data => {
                            console.log(data)
                            if (JSON.parse(data).success()) {
                                $('#content-area').html($('#content-area').keditor('getContent', true));
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successful backup',
                                    text: 'The changes have been saved successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'A problem has been encountered',
                                text: 'Call the 0652144163',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        });
                }else{
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire(
                        'Error',
                        'Something went wrong!',
                        'error'
                    );
                }
            });
        });
    </script>
</body>
</html>


