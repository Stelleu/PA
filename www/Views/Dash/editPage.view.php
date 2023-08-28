<div class="container">
    <div class="row">
        <h2 class="py-3 text-center">New Page</h2>
<?php
if (!empty($errors)):
    echo '<div class="alert alert-danger d-flex align-items-center p-2">
                    <i class="fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                       <h4 class="mb-1 text-dark">Something went wrong ! </h4>';
    foreach ($errors as $error){
        echo '  <span>'.$error.'</span>
                    </div>
                   </div>';
    } else:?>
            <div class="col py-3">
                <div class="form-group">
                    <label for="inputPassword2" class="form-label">Title  </label>
                    <input type="text" class="form-control"  id="title" placeholder="Title" value="<?= $page->getTitle()?>" data-page-id="<?= $page->getId()?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $page->getDescription()?></textarea>
                </div>
                <div class="form-group">
                    <label>Select the category article </label>
                    <ul class="list-group list-group-horizontal">
                        <?php foreach ($categories as $category) : ?>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" name="listGroupRadio" value="" id="firstRadio" data-category-id="<?= $category->getId()?>" >
                                <label class="form-check-label" for="firstRadio" <?=($category->getId() === $page->getCategory() )??"checked"  ?> ><?= $category->getTitle()?></label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div data-keditor="html">
        <div id="content-area" >
            <?= trim($page->getContent())?>
        </div>
    </div>
<?php endif?>



