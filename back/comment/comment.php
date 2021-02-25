<?php
/////////////////////////////////////////////////////
//
//  CRUD COMMENT (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : comment.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'Commentaire';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$comment = new COMMENT();
$article = new ARTICLE();

// Appel méthode : toutes les langues en BDD
$all = $comment->get_AllComments();
$allComments = $comment->get_AllCommentsByArticle(3);
$allArticles = $article->get_AllArticles();

foreach ($all as $key => $value) {
    $allOrdered[$value->numArt][$key] = $value;
}

//$allComments[array_search($value->numSeqCom, array_column($allComments, 'numSeqCom'))]->libCom

/* 
Article 1
  |_[Commentaire 1]
  |___[Sous-commentaire 1]
  |___[Sous-commentaire 2]
  |______[Sous-sous-commentaire 1]
  |_________[Sous-sous-sous-commentaire 1]
  |___[Sous-commentaire 3]
  |______[Sous-sous-commentaire 1]
  |_[Commentaire 2]
  |_[Commentaire 3]
  |___[Sous-commentaire 1]
  |_[Commentaire 4]
  | 
*/

foreach ($allOrdered as $articleComments) {

    $mainComments[] = "SELECT * FROM comment WHERE numArt = $article->numArt AND numSeqCom NOT IN (SELECT numSeqComR FROM commentplus WHERE numArt = $article->numArt)";
    foreach ($mainComments as $mainComment) {
        subComment($mainComment);
    }
}

function subComment($mainComment)
{
    echo '<pre>';
    print_r($mainComment);
    echo '</pre>';
    $subComment[] = [];
}

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <h1>BLOGART21 Admin - Gestion du CRUD Commentaire</h1>

</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>