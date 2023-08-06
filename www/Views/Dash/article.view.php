<h2>New Article</h2>
<div class="d-flex justify-content-end my-3">

    <a class="btn btn-dark" id="save-button"  role="button">Save</a>
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
<?php $this->modal("form",$addArticle); ?>
<label for="category" class="form-label"> Categories</label>
<select name="categorie" class="form-select"  id="categorie">
    <option selected >Open this select menu</option>
    <?php  foreach ($category as $option):
        ?>
        <option value="<?=  $option->getId() ?>"><?= $option->getTitle()?></option>
    <?php endforeach;?>
</select>
<div id="editorjs"></div>
<pre id="output"></pre>
