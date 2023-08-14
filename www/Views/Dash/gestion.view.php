    <div class='row'>
        <div class='col  py-4'>
            <h2 class="text-center my-3">Menu creation :</h2>
            <div class="col-sm-3 align-center">
                <div class="form-group">
                    <label for="menuPrinc">Add to the principal Menu:</label>
                    <select class="form-select princMenu" aria-label="Default select example">
                        <option selected > Choose the page you wanna add</option>
                        <?php foreach ($articles as $article) :
                            if ($article->isStatus() && !$article->isMenu()) :?>
                                <option value="<?=  $article->getId() ?>"><?= $article->getTitle() ?></option>
                            <?php endif; endforeach; ?>
                    </select>

                    <button class="btn btn-primary my-5" id="saveMenu"> Save </button>
                </div>
            </div>
            <div class="col-sm-3 align-center">
                <div class="form-group">
                    <label for="menuPrinc">Delete to the principal Menu:</label>
                    <select class="form-select delMenu" aria-label="Default select example">
                        <option selected > Choose the page you wanna delete</option>
                        <?php
                        foreach ($articles as $article) :
                            if ($article->isMenu() == 1) :?>
                                <option value="<?=  $article->getId() ?>"><?= $article->getTitle() ?></option>
                            <?php endif; endforeach; ?>
                    </select>
                    <button class="btn btn-danger my-5" id="delMenu"> Delete </button>
                </div>
            </div>
        </div>
    </div>
<script>
    const addMenu = document.getElementById("saveMenu")
    const delMenu = document.getElementById("delMenu")
    addMenu.addEventListener('click',e =>{
        const princMenu = document.querySelector('.princMenu');
        $.ajax({
            type:'post',
            url:'/dash/setmenu',
            data: { addMenu: 'addMenu', page: princMenu.value},
            success:function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'The page has been added to your menu',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload()

            },
            error:function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'A problem has been encountered',
                    text: 'Call the 0652144163',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })

    delMenu.addEventListener('click', e =>{
        const delMenu = document.querySelector('.delMenu')
        $.ajax({
            type:'post',
            url:'/dash/setmenu',
            data: { delMenu: 'delMenu', page: delMenu.value},
            success:function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'The page has been delete from your menu',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload()
            },
            error:function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'A problem has been encountered',
                    text: 'Call the 0652144163',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })
</script>