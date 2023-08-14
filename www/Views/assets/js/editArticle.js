const articleData = document.getElementById("article-data");
const fillTtitle = document.getElementById("title")
const title = articleData.getAttribute("data-title");
const articleId = articleData.dataset.id;
console.log(articleId)
fillTtitle.value = title
const content = JSON.parse(articleData.getAttribute("data-content"));
let currentContent = '';
let previousContentText = content.blocks.map(block => block.data.text).join("");

const versionList = document.getElementById("versions");

// Charger la liste des versions
fetch('/dash/versionlist')
    .then(response =>  response.json())
    .then(data => {
        console.log(data)
        if (data && data.success) {
            const versions = data.versions;

            // Ajouter chaque version à la liste
            versions.forEach(version => {
                const listItem = document.createElement("li");
                listItem.classList.add("list-group-item");
                listItem.innerHTML = `
                        <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#version-${version.id}" aria-expanded="false" aria-controls="version-${version.id}">
                            Version ${version.id}
                        </button>
                        <div class="collapse" id="version-${version.id}">
                            <div class="card card-body">
                               Version du ${version.created_at}
                                <button class="btn btn-primary mt-2" onclick="restoreVersion(${version.id})">Restore</button>
                            </div>
                        </div>
                    `;
                versionList.appendChild(listItem);
            });
        }
    })
    .catch(error => {
        console.error('Erreur lors du chargement de la liste des versions', error);
    });

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})
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
        console.log(event);
        if (event.type === 'addBlock' || event.type === 'deleteBlock') {
            return;
        }
        if (event.type === 'block-changed') {
            editor.save()
                .then(savedData => JSON.stringify(savedData))
                .then(newContentJSON => {
                    const newContent = JSON.parse(newContentJSON);
                    if (newContent.blocks.length > 0 && JSON.stringify(newContent.blocks) !== JSON.stringify([{ type: 'paragraph', data: {} }])) {
                        const newContentText = normalizeText(newContent.blocks.reduce((text, block) => text + block.data.text, ""));
                        const previousContentTextNormalized = normalizeText(previousContentText);

                        if (newContentText !== previousContentTextNormalized) {
                            saveInMemento(newContentJSON);
                            currentContent = newContentJSON;
                            previousContentText = newContentText; // Mettre à jour le texte du contenu précédent
                        }
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la sauvegarde des données', error);
                });
        }
    }
});

function saveInMemento(content) {
    const formMemento = {
        content: content,
        id: articleId
    };
    console.log(formMemento)

    fetch('/dash/savememento', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formMemento)
    })
        .then(response => { return response.json();
        })
        .then(parsedData => {
            if (JSON.parse(parsedData).success) {
                const restoredContent = data.restoredContent;
                editor.blocks.clear();
                editor.blocks.render({ blocks: restoredContent });
            } else {
                swalWithBootstrapButtons.fire(
                    'Error',
                    'Something went wrong !',
                    'error'
                );
            }
        })
        .catch(error => {
            console.error('Erreur lors de l\'enregistrement dans le Memento', error);
            swalWithBootstrapButtons.fire(
                'Error',
                'Something went wrong !',
                'error'
            );
        });
}


function normalizeText(text) {
    const normalizedText = text
        .replace(/&nbsp;/g, ' ')
        .replace(/&amp;/g, '&')
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"')
        .replace(/&apos;/g, "'");

    return normalizedText.trim();
}
function restoreVersion(versionId) {
    fetch(`/dash/restoreversion`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: versionId })
    })
        .then(response => response.json())
        .then(data => {
            const parsedData = JSON.parse(data)
            if (parsedData.success) {
                const restoredContent = JSON.parse(parsedData.restoredContent); // Parse the JSON content
                console.log(restoredContent);

                editor.blocks.clear();
                editor.blocks.render({ blocks: restoredContent.blocks });
            } else {
                // Gérer les erreurs si nécessaire
            }
        })
        .catch(error => {
            console.error('Erreur lors de la restauration de la version', error);
            // Gérer les erreurs ici
        });
}

