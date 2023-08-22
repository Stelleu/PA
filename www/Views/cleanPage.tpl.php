<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= ucfirst($title)?></title>
    <meta name="description" content="Mon portfolio">
    <link href="/Views/assets/simple-image.css" rel="stylesheet">
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
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }
        .bd-mode-toggle {
            z-index: 1500;
        }
    </style>
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
<!--                    <ul class="navbar-nav">-->
<!--                        <li class="nav-item" ><a class="nav-link" href="/articles">Tous les articles</a></li>-->
<!--                        --><?php //foreach ($categories as $category):?>
<!--                                <li class="nav-item dropdown">-->
<!--                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                                        --><?php //= $category->getTitle() ?>
<!--                                    </a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        --><?php //var_dump($articles);
//                                        foreach ($articles as $article):
//                                            if ( $category->getId() == $article->getCategory() ): ?>
<!--                                                <li><a class="dropdown-item" href="/--><?php //= $article->getSlug() ?><!--">--><?php //= $article->getTitle() ?><!--</a></li>-->
<!--                                                <li><hr class="dropdown-divider"></li>-->
<!--                                         --><?php //endif; endforeach; ?>
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            --><?php //endforeach; ?>
<!--                    </ul>-->
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
    <div class="container-fluid">

        <?php include $this->view ?>
    </div>
</main>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script><!-- Inline Code -->
    <?=($title!="Home")?'
        <script>
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
    </script> ':""?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('category-filter');
            const articlesContainer = document.getElementById('articles-container');
            const spinner = document.getElementById("spinner");

            categoryFilter.addEventListener('change', function() {
                const selectedCategory = categoryFilter.value;
                spinner.classList.remove("d-none");
                fetch('/filterarticle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({id: selectedCategory})
                })
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        articlesContainer.innerHTML = '';
                        var parseData = JSON.parse(data)
                        if (data && parseData.success) {
                            if (parseData.content) {
                                spinner.classList.add("d-none");
                                const contents = parseData.content;
                                contents.forEach(content => {
                                    const div = document.createElement("div");
                                    div.classList.add("col")
                                    const articles = document.createElement("article");
                                    articles.classList.add("card");
                                    articles.classList.add("shadow-sm");
                                    articles.innerHTML = `<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                                                            <div class="card-body">
                                                                <p class="card-text">${content.title}</p>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <a class="btn btn-primary" href="/${content.slug}" role="button">View</a>
                                                                    <small class="text-body-secondary">${content.created_at}</small>
                                                                </div>
                                                            </div>`;
                                    articlesContainer.appendChild(div);
                                    div.appendChild(articles);
                                })
                            }
                        }else {
                            articlesContainer.innerHTML = '<p>Une erreur s\'est produite.</p>';
                        }
                    })
                    .catch(error => {
                        articlesContainer.innerHTML = '<p>Une erreur s\'est produite.</p>';
                    });
            });
        });
    </script>
</body>
</html>