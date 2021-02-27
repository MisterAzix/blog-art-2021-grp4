<?php
///////////////////////////////////////////////////////////////
//
//    Gestion des CRUD (PDO) - 25 Février 2021
//
//    Script  : dashboard.php     -		BLOGART21 (Etud)
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/util/utilErrOn.php';

require_once __DIR__ . '/CLASS_CRUD/auth.class.php';
$auth = new Auth();
if (!$auth->is_connected()) {
	header('Location: ./connexion');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Gestion des CRUD</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/back/css/style.css">
</head>

<body>
	<main class="container">
		<h1>Panneau d'Admin : Gestion des CRUD - BLOGART21</h1>
		<hr>
		<div class="row d-flex justify-content-center">
			<div class="col-8">
				<h5>Liste des CRUD</h5>
				<div class="list-group">
					<a class="list-group-item list-group-item-success" href="./BACK/angle/angle.php"><b>Gestion du CRUD :</b> Angle </a>
					<a class="list-group-item list-group-item-success" href="./BACK/article/article.php"><b>Gestion du CRUD :</b> Article </a>
					<a class="list-group-item disabled" href="./BACK/comment/comment.php"><b>Gestion du CRUD :</b> Commentaire </a>
					<a class="list-group-item disabled" href="./BACK/commentplus/commentplus.php"><b>Gestion du CRUD :</b> Réponse sur Commentaire </a>
					<a class="list-group-item list-group-item-success" href="./BACK/langue/langue.php"><b>Gestion du CRUD :</b> Langue </a>
					<a class="list-group-item list-group-item-success" href="./BACK/likeart/likeart.php"><b>Gestion du CRUD :</b> Like Article </a>
					<a class="list-group-item list-group-item-success" href="./BACK/likecom/likecom.php"><b>Gestion du CRUD :</b> Like Commentaire </a>
					<a class="list-group-item list-group-item-success" href="./BACK/membre/membre.php"><b>Gestion du CRUD :</b> Membre</a>
					<a class="list-group-item list-group-item-success" href="./BACK/motcle/motcle.php"><b>Gestion du CRUD :</b> Mot-clé </a>
					<a class="list-group-item list-group-item-success" href="./BACK/motclearticle/motclearticle.php"><b>Gestion du CRUD :</b> Mot-clé Article </a>
					<a class="list-group-item list-group-item-success" href="./BACK/statut/statut.php"><b>Gestion du CRUD :</b> Statut</a>
					<a class="list-group-item list-group-item-success" href="./BACK/thematique/thematique.php"><b>Gestion du CRUD :</b> Thématique </a>
					<a class="list-group-item list-group-item-danger"><b>Gestion du CRUD :</b> User </a>
				</div>
			</div>
			<div class="col-4">
				<h5>État des CRUD</h5>
				<ul class="list-group">
					<li class="list-group-item list-group-item-success">CRUD fini et valide</li>
					<li class="list-group-item list-group-item-info">CRUD en cours</li>
					<li class="list-group-item list-group-item-warning">CRUD à modifier (+ info modif)</li>
					<li class="list-group-item disabled">CRUD à faire</li>
					<li class="list-group-item list-group-item-danger">CRUD Supprimé</li>
				</ul>

				<br>

				<h5>Pages</h5>
				<div class="list-group">
					<a class="list-group-item" href="./article/1">Article</a>
					<a class="list-group-item" href="./cgu">CGU</a>
					<a class="list-group-item" href="./contact">Contact</a>
					<a class="list-group-item" href="./accueil">Home</a>
					<a class="list-group-item" href="./connexion">Login</a>
					<a class="list-group-item" href="./deconnexion">Logout</a>
					<a class="list-group-item" href="./plan">Plan</a>
					<a class="list-group-item" href="./inscription">Register</a>
				</div>
			</div>
		</div>
	</main>
</body>

</html>