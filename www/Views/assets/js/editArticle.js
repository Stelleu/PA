const articleData = document.getElementById("article-data");
const fillTtitle = document.getElementById("title")
const title = articleData.getAttribute("data-title");
fillTtitle.value = title
const content = JSON.parse(articleData.getAttribute("data-content"));
const editor = new EditorJS({
    autofocus: true,
    tools: {
        image: {
            class: SimpleImage,
            inlineToolbar: true,
            config: {
                placeholder: "Paste image URL"
            }
        },
        header: {
            class: Header,
            inlineToolbar: ["marker", "link"],
            config: {
                placeholder: "Header"
            },
            shortcut: "CMD+SHIFT+H"
        },
        list: {
            class: NestedList,
            inlineToolbar: true,
            shortcut: "CMD+SHIFT+L"
        },

        checklist: {
            class: Checklist,
            inlineToolbar: true,
        },

        quote: {
            class: Quote,
            inlineToolbar: true,
            config: {
                quotePlaceholder: "Enter a quote",
                captionPlaceholder: "Quote\'s author",
            },
            shortcut: "CMD+SHIFT+O"
        },

        warning: Warning,

        marker: {
            class:  Marker,
            shortcut: "CMD+SHIFT+M"
        },

        code: {
            class:  CodeTool,
            shortcut: "CMD+SHIFT+C"
        },

        delimiter: Delimiter,

        inlineCode: {
            class: InlineCode,
            shortcut: "CMD+SHIFT+C"
        },

        linkTool: LinkTool,

        raw: RawTool,

        embed: Embed,

        table: {
            class: Table,
            inlineToolbar: true,
            shortcut: "CMD+ALT+T"
        },
    },
    data: content,

    onChange: function(api, event) {
        console.log("something changed", event)
    }
});

const saveButton = document.getElementById("save-button");
const output = document.getElementById("output");
saveButton.addEventListener("click", () => {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    if ( document.getElementById("title").value !== "" &&  document.getElementById("categorie").value !== "" ) {
        const title = document.getElementById("title").value;
        const category = document.getElementById("categorie").value;
        editor.save().then(savedData => {
            const formArticle = {
                article: savedData,
                title: title,
                category: category
            }
            fetch('/dash/newarticle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formArticle)
            }).then(response => {
                return response.json()
            })
                .then(data => {
                    console.log(data)
                    if (data && data.success) {
                        swalWithBootstrapButtons.fire(
                            'Saved!',
                            'Article saved',
                            'success'
                        )
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Error',
                            'Something went wrong, the title is already used !',
                            'error'
                        )
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de l\'enregistrement des données', error)
                    swalWithBootstrapButtons.fire(
                        'Error',
                        'Something went wrong!',
                        'error'
                    );
                })
            output.innerHTML = JSON.stringify(savedData, null, 4);
        })
    }else{
        swalWithBootstrapButtons.fire(
            'Error',
            'The title or the category are empty !',
            'error'
        );
    }

})
