<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= ucfirst($title)?></title>
    <meta name="description" content="Mon portfolio">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<!--<style>-->
<!--    body {-->
<!--        font-family:--><?php //= $front->getPolices() ?>
<!--/*    }*/-->
<!--/*    p {*/-->
<!--/*        color: */--><?php ////= $front->getPColor() ?><!--/* ;*/-->
<!--/*        text-size:  */--><?php ////= $front->getPSize() ?><!--/* ;*/-->
<!--/*    }*/-->
<!--/*    .btn-primary, .btn-primary:hover, .btn-primary:active  {*/-->
<!--/*        background-color: */--><?php ////= $front->getBtnColor() ?><!--/* ;*/-->
<!--/*        border-color : */--><?php ////= $front->getBtnColor() ?><!--/* ;*/-->
<!--/*    }*/-->
<!--/*    h1 {*/-->
<!--/*        color: */--><?php ////= $front->getH1Color() ?><!--/*;*/-->
<!--/*    }*/-->
<!--/*</style>*/-->
</head>
<body>
    <header>
        <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">>
            <div class="container-fluid">
<!--                <a class="navbar-brand" href="/home">--><?php //= $front->getWebsiteName()?><!--</a>-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item" ><a class="nav-link" href="/articles">Tous les articles</a></li>
                        <?php foreach ($categories as $category):?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?= $category->getTitle() ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach ($articles as $article):
                                            if ( $category->getId() == $article->getCategory() ): ?>
                                                <li><a class="dropdown-item" href="/<?= $article->getSlug() ?>"><?= $article->getTitle() ?></a></li>
                                                <li><hr class="dropdown-divider"></li>
                                         <?php endif; endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
<main>
    <div class="container-fluid">

        <?php include $this->view ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="/assets/js/simple-image.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script><!-- Image -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script><!-- Delimiter -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script><!-- List -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script><!-- Checklist -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script><!-- Quote -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script><!-- Code -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script><!-- Embed -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script><!-- Table -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script><!-- Link -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script><!-- Warning -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/raw@latest"></script><!-- Raw -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script><!-- Marker -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script><!-- Inline Code -->'
<script >
    const articleData = document.getElementById("editorjs");
    const content = JSON.parse(articleData.getAttribute("data-content"));
    console.log(content)
    const editor = new EditorJS({
        readOnly: true,
        tools: {
            image: SimpleImage,
            header:  Header,
            list:NestedList,
            checklist: Checklist,
            quote: Quote,
            warning: Warning,
            marker:  Marker,
            code: CodeTool,
            delimiter: Delimiter,
            inlineCode: InlineCode,
             linkTool: LinkTool,
            raw: RawTool,
            embed: Embed,
            table: Table,
        },

        data: content
    });
    // // Récupérer tous les boutons avec la classe "report-btn"
    // const reportButtons  = document.querySelectorAll('#report');
    // reportButtons.forEach((button) => {
    //     button.addEventListener('click', () => {
    //         const commentId = button.dataset.commentId;
    //         reportComment(commentId);
    //     });
    // });
    // function reportComment(commentId) {
    //     // Effectuer la requête AJAX avec la méthode POST
    //     $.ajax({
    //         url: '/admin/reportcomment',
    //         method: 'POST',
    //         data: {
    //             commentId: commentId
    //         },
    //         success: function(response) {
    //             console.log(response);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error:', error);
    //         }
    //     });
    // }
</script>

</body>
</html>