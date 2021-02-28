<?php
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
$motcle = new MOTCLE();
$keywords = null;

if (!empty($_POST['numLang'])) {
    $keywords = $motcle->get_AllMotClesByLang($_POST['numLang']);
}
?>

<?php if ($keywords) : ?>
    <div class="form-group mb-3">
        <label for="numMotCle[]"><b>Mots-Clés :</b></label>
        <select name="numMotCle[]" class="form-control" multiple>
            <option value="">--Choississez un ou plusieurs mot(s)-clé(s)--</option>
            <?php foreach ($keywords as $keyword) : ?>
                <option value="<?= $keyword->numMotCle ?>"><?= $keyword->libMotCle ?></option>
            <?php endforeach ?>
        </select>
    </div>
<?php else : ?>
    <div class="form-group mb-3 col-6">
        <label for="numMotCle[]"><b>Mots-Clés :</b></label>
        <select name="numMotCle[]" class="form-control" disabled>
            <option value="">Aucun mot(s) clé(s) pour cette langue</option>
        </select>
    </div>
<?php endif ?>