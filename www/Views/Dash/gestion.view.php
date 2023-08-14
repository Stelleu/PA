<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Front edit</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h3 class="pt-3" >Menu</h3>
            <p  class="pb-3">Add / Remove on menu .</p>
            <div class="row text-center">
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
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h3 class="pt-3">Front edit </h3>
            <p  class="pb-3">Edit your front page.</p>
            <div  class="row text-center">
                    <div class="col-sm-3 align-center">
                        <div class="form-group">
                            <label for="colorPicker">Paragraph color :</label>
                            <input type="color" id="pColorPicker" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="fontSelector">Polices :</label>
                            <select class="form-select font" aria-label="Default select example">
                                <option <?= (!empty($setting) && $setting['polices']=="Arial, sans-serif")?"selected": " "  ?> value="Arial, sans-serif">Arial</option>
                                <option  <?= (!empty($setting) && $setting['polices']== "Verdana, sans-serif")?"selected": " "  ?>    value="Verdana, sans-serif">Verdana</option>
                                <option <?= (!empty($setting) && $setting['polices']=="Courier New, monospace")?"selected": " "  ?>    value="Courier New, monospace">Courier New</option>
                                <option  <?= (!empty($setting) && $setting['polices']== "Times New Roman, serif")?"selected": " "  ?>   value="Times New Roman, serif">Times New Roman</option>
                                <option  <?= (!empty($setting) && $setting['polices']== "Georgia, serif")?"selected": " "  ?>   value="Georgia, serif">Georgia</option>
                                <option  <?= (!empty($setting) && $setting['polices']== "Roboto, sans-serif")?"selected": " "  ?>   value="Roboto, sans-serif">Roboto</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="fontSizeSelector">Paragraph size :</label>
                            <select class="form-select fontSize" aria-label="Default select example">
                                <option <?= (!empty($setting) && $setting['text_size']== "12px")?"selected": " " ?>  value="12px">12</option>
                                <option  <?= (!empty($setting) && $setting['text_size']== "14px")?"selected": " " ?>  value="14px">14</option>
                                <option <?= (!empty($setting) && $setting['text_size']== "16px")?"selected": " " ?>  value="16px">16</option>
                                <option <?= (!empty($setting) && $setting['text_size']== "18px")?"selected": " " ?>  value="18px">18</option>
                                <option  <?= (!empty($setting) && $setting['text_size']== "20px")?"selected": " " ?> value="20px">20</option>
                                <option <?= (!empty($setting) && $setting['text_size']== "24px")?"selected": " " ?>  value="24px">24</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="colorPicker">H1 color :</label>
                            <input type="color" id="hColorPicker" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="buttonColorPicker">Button size:</label>
                            <input type="color" id="buttonColorPicker" class="form-control" >
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="submit" class="btn btn-primary my-2 text-center" id="save" name="page" value="Save changes ">
                </div>
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