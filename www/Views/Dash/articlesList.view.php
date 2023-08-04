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

        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $article->getTitle() ?></h5>
                <p class="card-text text-truncate"><?= $article->getText() ?></p>
                <a href="#" class="btn btn-primary">Edit Article</a>
            </div>
        </div>
<?php endforeach;
endif;
?>
