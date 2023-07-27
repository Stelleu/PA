<form
        method="<?= $config["config"]["method"]??"GET" ?>"
        action="<?= $config["config"]["action"] ?>">

    <?php foreach ($config["inputs"] as $name=>$input):?>

        <?php if($input["type"] == "select"):?>
            <select name="<?= $name;?>">
                <?php foreach ($input["options"] as $option):?>
                    <option><?= $option;?></option>
                <?php endforeach;?>
            </select>
        <?php else: ?>
        <div class="mb-3">
            <label for="<?= $name?>" class="form-label"> <?= $name?> </label>
            <input
                            name="<?= $name;?>"
                            type="<?= $input["type"]?>"
                            placeholder=" <?= $input["placeholder"]?>"
                            class="form-control"
                    >
        </div>
        <?php endif;?>

    <?php endforeach; ?>



    <input type="submit" name="submit" class="btn btn-primary" value="<?= $config["config"]["submit"] ?>">
    <input type="reset" class="btn btn-danger" value="<?= $config["config"]["cancel"] ?>">
</form>