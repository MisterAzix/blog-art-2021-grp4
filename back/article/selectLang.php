<?php
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$angle = new ANGLE();
$thematique = new THEMATIQUE();
$perpectives = null;
$thematics = null;

if (!empty($_POST['numLang'])) {
    $perpectives = $angle->get_AllAnglesByLang($_POST['numLang']);
    $thematics = $thematique->get_AllThematiquesByLang($_POST['numLang']);
}
?>

<?php if ($perpectives && $thematics) : ?>
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="numAngl"><b>Angle :</b></label>
            <select name="numAngl" class="form-control" id="numAngl">
                <option value="">--Choississez un angle--</option>
                <?php foreach ($perpectives as $perpective) : ?>
                    <option value="<?= $perpective->numAngl ?>"><?= $perpective->libAngl ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="numThem"><b>Thématique :</b></label>
            <select name="numThem" class="form-control" id="numThem">
                <option value="">--Choississez une thématique--</option>
                <?php foreach ($thematics as $thematic) : ?>
                    <option value="<?= $thematic->numThem ?>"><?= $thematic->libThem ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
<?php else : ?>
    <div class="form-group mb-3">
        <input class="form-control" type="text" value="Aucun angle ou thématique pour cette langue" disabled>
    </div>
<?php endif ?>