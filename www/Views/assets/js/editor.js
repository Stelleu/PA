/**
 * Initialize the Editor
 */
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
    data: {
        time: 1552744582955,
        blocks: [
            {
                type: "image",
                data: {
                    url: "https://cdn.pixabay.com/photo/2017/09/01/21/53/blue-2705642_1280.jpg",
                    caption: "Here is a caption field",
                    withBorder: false,
                    withBackground: false,
                    stretched: false
                }
            },
            {
                id: "zcKCF1S7X8",
                type: "header",
                data: {
                    text: "Editor.js",
                    level: 1
                }
            },
            {
                id: "b6ji-DvaKb",
                type: "paragraph",
                data: {
                    text: "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text. Source code of the page contains the example of connection and configuration."
                }
            },
        ],
    },
    onReady: function(){
        saveButton.click();
    },
    onChange: function(api, event) {
        console.log("something changed", event)
    }
});

/**
 * Add handler for the Save button
 */
const saveButton = document.getElementById("save-button");
const output = document.getElementById("output");

saveButton.addEventListener("click", () => {
    const title = document.getElementById("title").value;
    const author = document.getElementById("auteur").value;
    const category = document.getElementById("categorie").value;
    editor.save().then( savedData => {
    const formArticle = {
        article: savedData,
        title: title,
        author: author,
        category: category
    }
        fetch('/dash/newarticle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body:JSON.stringify(formArticle)
        }).then(response => {response.json()})
            .then(data =>{
                console.log('Données enregistrées avec succès',data)
            })
            .catch(error => {
                console.error('Erreur lors de l\'enregistrement des données', error)
            })

        output.innerHTML = JSON.stringify(savedData, null, 4);
    })
})