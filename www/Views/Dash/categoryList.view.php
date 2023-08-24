<h2 class="pt-5">Categories</h2>

<div class="d-flex justify-content-end my-3">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Category
    </button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form name="addCategorie" method="post" action="/dash/categorie">
                        <div class="mb-3">
                            <label for="formCategory" class="form-label">Category title</label>
                            <input type="text" name="title" class="form-control" id="formCategory" placeholder="Lifestyle">
                        </div>
                        <button type="submit" class="btn btn-primary" name="add" >Add new category</button>
                    </form>
                </div>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modify Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="editCategorie" id="editForm" method="post" action="">
                    <div class="mb-3">
                        <label for="formCategory" class="form-label">Category Title</label>
                        <input type="text" class="form-control" id="formCategory" placeholder="Lifestyle" name="title" >
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary" id="addCategory">Modify category</button>
                </form>

            </div>

        </div>
    </div>
</div>

<div class="table-responsive small">
    <table class="table  table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($categories)):
        foreach ($categories as $category) :?>
            <tr>
                <td><?= $category->getId() ?></td>
                <td><?= $category->getTitle() ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-category-id="<?= $category->getId() ?>" data-action="edit">Edit</a>
                            <a class="dropdown-item" href="#" data-category-id="<?= $category->getId() ?>" data-action="delete">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach;
        else:?>
        <div class="alert alert-info" role="alert">
            No categories
        </div>
<?php endif;?>
        </tbody>
    </table>
</div>

