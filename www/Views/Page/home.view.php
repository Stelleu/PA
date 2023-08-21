    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic"><?= $articles["0"]->getTitle()?></h1>
            <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
            <p class="lead mb-0"><a href="<?= $articles["0"]->getSlug()?>" class="text-body-emphasis fw-bold">Continue reading...</a></p>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                All Articles
            </h3>
            <!-- Ajoutez le menu déroulant pour sélectionner une catégorie -->
            <select id="categoryFilter" class="form-select mb-3">
                <option value="all">All Categories</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getTitle() ?></option>
                <?php endforeach ?>
            </select>
            <!-- Ajoutez le conteneur pour afficher les articles filtrés -->
            <div id="filteredArticles">
                <!-- Les articles filtrés seront affichés ici -->
            </div>

            <!-- Ajoutez le conteneur pour le spinner de chargement -->
            <div id="spinner" class="d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

<!--            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">-->
<!--                --><?php //foreach ($articles as $article) : ?>
<!--                    <div class="col">-->
<!--                        <div class="card shadow-sm">-->
<!--                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
<!--                            <div class="card-body">-->
<!--                                <p class="card-text">--><?php //= $article->getTitle()?><!--</p>-->
<!--<!--                                <p class="card-text">-->--><?php ////= $article->getDescription()?><!--<!--</p>-->-->
<!--                                <div class="d-flex justify-content-between align-items-center">-->
<!--                                    <a class="btn btn-primary" href="/--><?php //= $article->getSlug()?><!--" role="button">View</a>-->
<!--                                    <small class="text-body-secondary">--><?php //= $article->getCreatedAt()?><!--</small>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //endforeach ?>
<!--            </div>-->
        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-body-tertiary rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Sitemap</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="/sitemap">Sitemap</a></li>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="https://github.com/Stelleu/PA">GitHub</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Écouteur d'événement sur la sélection de la catégorie
            $('#category-filter').on('change', function() {
                var selectedCategory = $(this).val();

                // Afficher le spinner pendant le chargement
                $('#articles-container').html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');

                // Effectuer la requête AJAX pour obtenir les articles filtrés
                $.ajax({
                    url: '/filterarticle', // URL vers votre action de contrôleur pour filtrer les articles
                    method: 'POST',
                    dataType: 'html', // Vous attendez du contenu HTML en réponse
                    data: { category: selectedCategory }, // Envoyez la catégorie sélectionnée au serveur
                    success: function(response) {
                        // Mettez à jour la liste d'articles avec le contenu HTML de la réponse
                        $('#articles-container').html(response);
                    },
                    error: function() {
                        // En cas d'erreur lors de la requête
                        $('#articles-container').html('<p>Une erreur s\'est produite.</p>');
                    }
                });
            });
        });

    </script>
