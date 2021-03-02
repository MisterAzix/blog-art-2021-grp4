<?php
///////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createArticle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTile = 'Article';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$article = new ARTICLE();
$langue = new LANGUE();

// Init variables form
include __DIR__ . '/initArticle.php';
$error = null;
$fileName = null;
$saved = null;

//Récupérer et sauvegarde de l'image
if (isset($_FILES['urlPhotArt'])) {
    $maxSize = 3 * 1000 * 1000; //3Mo
    $validExt = array('.jpg', '.jpeg', '.gif', '.png');

    if ($_FILES['urlPhotArt']['error'] <= 0) {
        $fileSize = $_FILES['urlPhotArt']['size'];

        if ($fileSize < $maxSize) {
            $fileName = $_FILES['urlPhotArt']['name'];
            $fileExt = '.' . strtolower(substr(strrchr($fileName, '.'), 1));

            if (in_array($fileExt, $validExt)) {
                $tmpName = $_FILES['urlPhotArt']['tmp_name'];
                $uniqueName = md5(uniqid(rand(), true));
                $fileName = '../../upload/' . $uniqueName . $fileExt;
                $result = move_uploaded_file($tmpName, $fileName);

                $saved = $result ? ($uniqueName . $fileExt) : null;
            } else {
                $error = 'Le fichier selectionné n\'est pas une image !';
            }
        } else {
            $error = 'Le fichier est trop volumineux!';
        }
    } else {
        $error = 'Erreur durant le transfert !';
    }
}

// Controle des saisies du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($_POST['libTitrArt']) && !empty($_POST['libChapoArt']) && !empty($_POST['libAccrochArt'])
        && !empty($_POST['parag1Art']) && !empty($_POST['libSsTitr1Art']) && !empty($_POST['parag2Art'])
        && !empty($_POST['libSsTitr2Art']) && !empty($_POST['parag3Art']) && !empty($_POST['libConclArt'])
        /*&& !empty($_POST['urlPhotArt'])*/ && !empty($_POST['numAngl']) && !empty($_POST['numThem'])
    ) {
        //$dtCreArt = date("Y-m-d H:i:s");
        $libTitrArt = $_POST['libTitrArt'];
        $libChapoArt = $_POST['libChapoArt'];
        $libAccrochArt = $_POST['libAccrochArt'];
        $parag1Art = $_POST['parag1Art'];
        $libSsTitr1Art = $_POST['libSsTitr1Art'];
        $parag2Art = $_POST['parag2Art'];
        $libSsTitr2Art = $_POST['libSsTitr2Art'];
        $parag3Art = $_POST['parag3Art'];
        $libConclArt = $_POST['libConclArt'];
        $urlPhotArt = $saved;
        $numAngl = $_POST['numAngl'];
        $numThem = $_POST['numThem'];

        if (strlen($parag1Art) >= 10 && strlen($parag2Art) >= 10 && strlen($parag3Art) >= 10) {
            // Ajout effectif de l'article'
            $article->create(
                $libTitrArt,
                $libChapoArt,
                $libAccrochArt,
                $parag1Art,
                $libSsTitr1Art,
                $parag2Art,
                $libSsTitr2Art,
                $parag3Art,
                $libConclArt,
                $urlPhotArt,
                $numAngl,
                $numThem
            );
            header('Location: ./article.php');
        } else {
            $error = 'La longueur minimale des paragraphes est de 1000 caractères';
        }
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$languages = $langue->get_AllLangues();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Article</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Ajout d'un article</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                    <div class="row">
                        <div class="form-group mb-3 col-6">

                            <label for="libTitrArt"><b>Titre de l'article :</b></label>
                            <div class="input-group">
                                <input data-maxlength="100" class="form-control" type="text" name="libTitrArt" id="libTitrArt" maxlength="100" value="<?= $libTitrArt ?>" placeholder="Un bon titre putaclic" autofocus="autofocus" />
                                <span class="input-group-text" id="libTitrArt-span">0/0</span>
                            </div>

                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="urlPhotArt"><b>Image :</b></label>
                            <input type="file" class="form-control" name="urlPhotArt">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libChapoArt"><b>Chapeau :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="500" class="form-control" type="text" name="libChapoArt" id="libChapoArt" rows="3" maxlength="500" placeholder="Chapeau vert (car je suis plein d'ideés)"><?= $libChapoArt ?></textarea>
                            <span class="input-group-text" id="libChapoArt-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libAccrochArt"><b>Accroche :</b></label>
                        <div class="input-group">
                            <input data-maxlength="100" class="form-control" type="text" name="libAccrochArt" id="libAccrochArt" maxlength="100" value="<?= $libAccrochArt ?>" placeholder="Une super accroche" />
                            <span class="input-group-text" id="libAccrochArt-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="parag1Art"><b>Paragraphe 1 :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="1200" class="form-control" type="text" name="parag1Art" id="parag1Art" rows="5" maxlength="1200" placeholder="Premièrement..."><?= $parag1Art ?></textarea>
                            <span class="input-group-text" id="parag1Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libSsTitr1Art"><b>Intertitre 1 :</b></label>
                        <div class="input-group">
                            <input data-maxlength="100" class="form-control" type="text" name="libSsTitr1Art" id="libSsTitr1Art" maxlength="100" value="<?= $libSsTitr1Art ?>" placeholder="Titre 1er article" />
                            <span class="input-group-text" id="libSsTitr1Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="parag2Art"><b>Paragraphe 2 :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="1200" class="form-control" type="text" name="parag2Art" id="parag2Art" rows="5" maxlength="1200" placeholder="Ensuite..."><?= $parag2Art ?></textarea>
                            <span class="input-group-text" id="parag2Art-span">0/0</span>
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label for="libSsTitr2Art"><b>Intertitre 2 :</b></label>
                        <div class="input-group">
                            <input data-maxlength="100" class="form-control" type="text" name="libSsTitr2Art" id="libSsTitr2Art" maxlength="100" value="<?= $libSsTitr2Art ?>" placeholder="Titre 2eme article" />
                            <span class="input-group-text" id="libSsTitr2Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="parag3Art"><b>Paragraphe 3 :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="1200" class="form-control" type="text" name="parag3Art" id="parag3Art" rows="5" maxlength="1200" placeholder="Dans ce troisième paragraphe..."><?= $parag3Art ?></textarea>
                            <span class="input-group-text" id="parag3Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libConclArt"><b>Conclusion :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="800" class="form-control" type="text" name="libConclArt" id="libConclArt" rows="4" maxlength="800" placeholder="En conclusion..."><?= $libConclArt ?></textarea>
                            <span class="input-group-text" id="libConclArt-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="numLang"><b>Langue :</b></label>
                        <select name="numLang" class="form-control" id="ajax-numLang">
                            <option value="">--Choississez une langue--</option>
                            <?php foreach ($languages as $language) : ?>
                                <option value="<?= $language->numLang ?>"><?= $language->lib1Lang ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div id="ajax-container">
                        <!-- SELECT ANGLE & THEMATIQUE -->
                    </div>

                    <div class="form-group">
                        <input type="reset" value="Initialiser" class="btn btn-primary" />
                        <input type="submit" value="Créer" name="submit" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerArticle.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>