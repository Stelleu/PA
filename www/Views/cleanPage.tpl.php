<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= ucfirst($title)?></title>
    <meta name="description" content="Mon portfolio">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<style>
    body {
        font-family:<?= $front->getPolices() ?> ;
    }
    p {
        color: <?= $front->getPColor() ?> ;
        text-size:  <?= $front->getPSize() ?> ;
    }
    .btn-primary, .btn-primary:hover, .btn-primary:active  {
        background-color: <?= $front->getBtnColor() ?> ;
        border-color : <?= $front->getBtnColor() ?> ;
    }
    h1 {
        color: <?= $front->getH1Color() ?>;
    }
</style>
<body>


<header>
    <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">>
        <div class="container-fluid">
            <a class="navbar-brand" href="/home"><?= $front->getWebsiteName()?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php foreach ($articles as $article):
                        if ($article->isMenu() == 1):
                            ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= $article->getSlug()?>"><?= ucfirst($article->getTitle())?></a>
                            </li>
                        <?php endif;endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
        <div data-id="<?= $article->getId() ?>" id="restored-content">
            <!-- Le texte restauré sera affiché ici -->
        </div>

        <?php include  $this->view?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script type="text/javascript" src="Views/Dash/theme/dist/assets/plugins/custom/jquery-1.11.3/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="Views/Dash/theme/dist/assets/plugins/custom/bootstrap-3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="Views/Dash/theme/dist/assets/plugins/custom/code-prettify/src/prettify.js"></script>
<script type="text/javascript" src="Views/Dash/theme/dist/assets/plugins/custom/js-beautify-1.7.5/js/lib/beautify.js"></script>
<script type="text/javascript" src="Views/Dash/theme/dist/assets/plugins/custom/js-beautify-1.7.5/js/lib/beautify-html.js"></script>
<script type="text/javascript" src="Views/Dash/theme/dist/assets/js/examples.js"></script>
<script>
    // Récupérer tous les boutons avec la classe "report-btn"
    const reportButtons  = document.querySelectorAll('#report');
    reportButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const commentId = button.dataset.commentId;
            reportComment(commentId);
        });
    });
    function reportComment(commentId) {
        // Effectuer la requête AJAX avec la méthode POST
        $.ajax({
            url: '/admin/reportcomment',
            method: 'POST',
            data: {
                commentId: commentId
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    const editor = new EditorJS();

    editor.save().then((outputData) => {
        console.log('Article data: ', outputData)
        restoreVersion()
    }).catch((error) => {
        console.log('Saving failed: ', error)
    });
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
                console.log(data);
                if (data && data.success) {
                    const restoredContent = JSON.parse(data.restoredContent);

                    // Afficher le texte restauré dans une div avec l'ID "restored-content"
                    const restoredContentDiv = document.getElementById('restored-content');
                    if (restoredContentDiv) {
                        restoredContentDiv.textContent = restoredContent.blocks.map(block => block.data.text).join('\n');
                    }
                } else {
                    // Gérer les erreurs si nécessaire
                }
            })
            .catch(error => {
                console.error('Erreur lors de la restauration de la version', error);
                // Gérer les erreurs ici
            });
    }

</script>

</body>
</html>