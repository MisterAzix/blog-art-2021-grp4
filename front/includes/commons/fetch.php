<?php

	if($_POST['request'])
	{
        require_once __DIR__ . '/../../../CONNECT/database.php';
        require_once __DIR__ . '/../../../util/utilErrOn.php';

        // Crée un tableau pour les articles pour l'affichage
        $arrayArticle = array();

        // Récupère les mots clés ressemblant
		$reqMotCle = $db->prepare('SELECT * FROM motcle WHERE libMotCle Like :id');
		$reqMotCle->execute(array(
		    'id' => "%" . $_POST['request'] . "%"
        ));

        // Récupère les articles ressemblant
        while($donneesMotCle = $reqMotCle->fetch())
        {
            
            $reqMotCleArticle = $db->prepare('SELECT * FROM motclearticle WHERE numMotCle = :id');
            $reqMotCleArticle->execute(array(
                'id' => $donneesMotCle['numMotCle']
            ));
            $donneesMotCleArticle = $reqMotCleArticle->fetch();
            if(!empty($donneesMotCleArticle)) {
                array_push($arrayArticle, $donneesMotCleArticle['numArt']);
            }
        }

?>

<?php

    // Car des articles pouvaient être similaire avec des mots clés ressemblant
    $arrayArticleTrue = array();

    for($i = 0; $i < count($arrayArticle); $i++)
    {
        if(!in_array($arrayArticle[$i], $arrayArticleTrue)) {
            array_push($arrayArticleTrue, $arrayArticle[$i]);
        }
    }

    for($i = 0; $i < count($arrayArticleTrue); $i++)
    {
        $req = $db->prepare('SELECT * FROM article WHERE numArt = :id');
        $req->execute(array(
            'id' => $arrayArticleTrue[$i]
        ));
        $donnees = $req->fetch();
?>

        <a href="/article/<?= $donnees['numArt'] ?>"><?= $donnees['libTitrArt'] ?></a>

<?php

    }

    // Affiche un message d'erreur s'il n'y a pas d'article
    if(count($arrayArticleTrue) == 0) {
        echo "<p class='errorSearch'>Aucun article trouvé !</p>";
    }

?>

<?php
	}

?>