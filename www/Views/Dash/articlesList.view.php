<h1  class="pt-5" >All Articles</h1>
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

<div class="container mt-4">
    <div class="row">
        <?php if (!empty($articles)) :
            foreach ($articles as $article) :
                $given_date = new DateTime($article->getCreatedAt());
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
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= ($article->getImgUrl())?$article->getImgUrl():"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUMAAACcCAMAAADS8jl7AAAAllBMVEX5qNT////5o9L94/H96PP5ptP5pNJTKUH82ez81+vw7u/5rNb8z+f80+n7yeT5odH7xeK0p67Btrz93e77y+X6u93o5OZ7Ym/7weD6udz6stmMeIPQyMxWLkX6tdrHvsNzV2aCandQIz1DACza1NeYho9bNUp/ZnOomKFrTF1MGziejZaJdH+8sLallZ1kQ1Xi3uBJFDTOj8tfAAAEKUlEQVR4nO3ce3OiOhgG8ARMSIQAilguonjDe22//5c7b6A9Pac7u38ss3W1z68VQ/JS6dNAnGmnjAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD8vZxHcpsI5cB9HAN5kwwd/khuMxGRITL8P2TYHzLs79Ez3C3+/Gs8eIab8Re8yL1muCjLctvOsW35TNvZ+X2/a58WbdF2W275kPbL85Q6yvJC28t5w/npzJ9L6zzrey73muGoeiqv3ojzqdc0Q87HXl1eV12I4+qwu3pPtqhe7s5Ucl3uaspw5jVXGn+2dfWKb3dPzXX59H0z9Mb8pTpwvq/K6mIzHPGFd2rHbJuX1Z6K2lCn1a47qGxKj6bg3nbXHiU/9Ha9z+S+M5xVNeeHhtspN65O0+2qm1Jthi80OGrK0X5BGR5Go32b2NTb/jfDqT20t7vNsGka77jgm9UzL70pHzfNK828VpshBWeLqlVJzWtVebZ/TNEhw3d2il3oFrdtlqdds6d89sN6tWnH2gwvVdlOVv5xLddNeaqbRdd9qJBhFw+/XpfL5fXQ5rZ5S2RcbWf7ynuhNeU0m80ow7Z/6h2otlnS3K1no7bvm2e4tu9S+Hht39iU6814TRdyvW5viJfj6lg90ZwcHVevr0c+fa1t9/Paxn54nfLR9bh6su91puu695ncb4bD4aentvXvbtcYDrvW+97n7cdzL/ea4d8EGfaHDPtDhv0hw/6QYX/IsL/bZCgHj+Q2v1/G3zkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADAr4lbn8C98H8+VPwQ4s+KpR3yu9YPNb94hccgFBNShqkQkkkh6CGlYII4SeZQi7ql7Ra2IqZh6qJsbVn7SZgInCiRsd03UWwL3sboC0k/trvigSe1UMKoPM4zHbJEhSLRwcRPs1TrYpAmKtfKSegRqCzTgTS5CqRWmRBpEvhJwoxWgSvn8UQPHOMnaj7IAqGTNFOuHxiXxfRlg1ClgY4fN0TKcGJUnKbBQKgoCXPfGD/L3Inrq8iNfOPO3UixJJJU4ahMFzSmpHQjaYrCKKGLcB4UVCu1KaSTRDoPIjdM56H24zQLBswE82IwcW/0n6e+gFBzw5I4d6MB05GKs0IHxSRz6UJMoiSiWZrarRs5VOEoyQapiYQvqCDI54EWxg9zbQelCnIpqHiuKcOcMmQxHWszLPwketxpyEQojInTItaG7nahYwxFGuSFovnpTEShTDFxQpYldC0bGaeaeum6nheJvahlyGI/TY2TKSNDQR0mjsUkKbKiSGOWz2MdMPq5yJhuE7f+Vv8cwbpFxC4A9KGTQnRrQbv78dyuKeJt6RFvjW7M97tB1i0+XbFoV5G3g5h45DXlM/E7t61vlA8AfKl/AJ10YarQ+oLaAAAAAElFTkSuQmCC"; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article->getTitle(); ?></h5>
                            <p class="card-text"><?= "Updated ". $result ?></p>
                            <a href="/dash/editarticle?id=<?= $article->getId(); ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <?php if ($_SESSION['user']['role'] == 0 ) : ?>
                                <button class="btn btn-danger delete-btn  btn-sm" data-article-id="<?= $article->getId(); ?>">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                                <button class="btn btn-success publish-btn btn-sm" data-article-id="<?= $article->getId(); ?>" data-published="<?= $article->isStatus() ? 'true' : 'false'; ?>">
                                    <i class="bi bi-eye<?= $article->isStatus() ? '-slash' : ''; ?>"></i>
                                    <?= $article->isStatus() ? 'Unpublish' : 'Publish'; ?>
                                </button>

                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endforeach;  else:?>
            <div class="alert alert-info" role="alert">
                No Article
            </div>
        <?php endif;?>

        </div>
    </div>



