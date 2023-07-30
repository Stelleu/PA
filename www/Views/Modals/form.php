<form
        method="<?= $config["config"]["method"]??"GET" ?>"
        action="<?= $config["config"]["action"] ?>"
        class="<?= $config["config"]["class"]?>"
>

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
                            class="<?= $input["class"]?>"
                    >
        </div>
        <?php endif;?>

    <?php endforeach; ?>



    <input type="submit" name="submit" class="btn btn-primary text-center py-2" value="<?= $config["config"]["submit"] ?>">
    <?php if(!empty($config["config"]["cancel"])) : ?>
    <input type="reset" class="btn btn-danger" value="<?= $config["config"]["cancel"] ?>">
    <?php endif; ?>
</form>