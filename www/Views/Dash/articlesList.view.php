<h2>Articles</h2>
<div class="d-flex justify-content-end my-3">

    <a class="btn btn-dark" href="/dash/addArticle" role="button">Add Article</a>
</div>
<?php
if (!empty($errors)){
    echo '<div class="alert alert-danger d-flex align-items-center p-2">
                    <i class="fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                       <h4 class="mb-1 text-dark">Something went wrong ! </h4>';
    foreach ($errors as $error){
        echo '  <span>'.$error.'</span>
                    </div>
                   </div>';
    }
};
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $this->modal("form",$addArticle);?>
            </div>
        </div>
    </div>
</div>


<div class="row">
        <?php if (!empty($articles)) :
            foreach ($articles as $article) :
                $given_date = new DateTime($article->getDateUpdated());
                // Obtenir la date actuelle
                $current_date = new DateTime();

                // Calculer la différence entre les deux dates
                $interval = $current_date->diff($given_date);

                // Extraire le nombre de semaines, mois et jours
                $weeks = floor($interval->days / 7);
                $months = $interval->y * 12 + $interval->m;
                $days = $interval->days;
                $hours = $interval->h;
                $minutes = $interval->i;

                // Construction de la phrase résultante
                $result = "";

                if ($weeks > 0) {
                    $result .= "$weeks week" . ($weeks > 1 ? 's' : '') . " ";
                }
                if ($months > 0) {
                    $result .= "$months mounth ";
                }
                if ($days > 0) {
                    $result .= "$days day" . ($days > 1 ? 's' : '') . " ";
                }
                if ($hours > 0) {
                    $result .= "$hours hour" . ($hours > 1 ? 's' : '') . " ";
                }
                if ($minutes > 0) {
                    $result .= "$minutes min" . ($minutes > 1 ? 's' : '') . " ";
                } ?>

                <div class="card me-2 mb-3" style="width: 18rem;" >
                    <div class="card-body">
                        <h5 class="card-title"><?= $article->getTitle() ?></h5>
                        <p class="card-text"><?= "Updated ". $result ?></p>
                        <div class="row">
                            <div class="col">
                                <a href="/dash/editArticle?id=<?= $article->getId() ?>" class="btn btn-sm btn-primary" id="editBtn" >Edit Article</a>
                            </div>
                            <?php if ($_SESSION['user']['role'] == 0 ) : ?>
                            <div class="col">
                                <button class="btn btn-sm btn-outline-danger" id="deleteBtn" data-article-id="<?= $article->getId()?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                </button>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
        <?php endforeach;
        else:?>
            <div class="alert alert-info" role="alert">
                No Article
            </div>
        <?php endif;?>
</div>
