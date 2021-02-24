<?php
//========================================//
//
//           article/index.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Article';
$page_description = '';



require_once '../../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="article_container ">
    <div class="txt_container">
        <div class="article">
            <div class="absolute">
                <div class="info">
                    <p>09/02/2021</p>
                    <div class="trait"></div>
                    <a href=""> <img src="../../../assets/images/Vector-2.png" alt="loginImage">56</a>
                    <a href=""><img src="../../../assets/images/Vector-3.png" alt="loginImage">22</a>
                </div>
            </div>
            <div class="text">
                <h2>Bordeaux, écologie et environnement</h2>
                <p class="editor">Évènements | Par Mylène Micoton</p>
                <p>J’ai toujours été à l’affût des nouveautés dans ma ville. Certains sont, sans doute, éloignés des problématiques de leur fourmilière. De mon côté, j’adore savoir dans quoi est placé l’argent public et les initiatives écologiques prises au sein de notre belle endormie. Tout de suite, ça ne sonne pas très “fun” mais c’est super intéressant. Alors, je vous offre aujourd’hui mon petit concentré d’initiatives à venir et passées, à consommer sans modération, évidemment.
                    Entre pandémie et canicule, ça n’a pas été facile pour tous les français, particulièrement pour les habitants de notre ville du vin. C’est pourquoi l’année dernière Nicolas Florian, ancien maire de Bordeaux, eut l’idée d’aménager une ombrière face au palais Rohan, place Pey Berland. Personnellement, je trouve que c’est vraiment une bonne idée : offrir aux Bordelais un îlot de fraîcheur... super, non ?
                    Seulement, tout le monde n’est pas de cet avis. La raison : le coût de cet aménagement, notamment. 100 000 euros d’argent public. Un grand coût pour redonner de la verdure à 800m2 de terrain, qui, selon certains, ne serait pas justifié face aux autres nombreuses autres problématiques plus urgentes auxquelles s’expose Bordeaux.
                </p>
                <h3>Un projet fondamental : 1 million d’arbres</h3>
                <p>Bordeaux a de réelles ambitions écologiques, il faut l’avouer et j’aime cette initiative de vouloir changer les choses. Néanmoins, l’épisode de pollution continue de se poursuivre. Nous ne sommes pas sans savoir que l’urgence climatique est belle et bien d’actualité. Bordeaux Métropole l’a bien compris et se lance dans un projet de grande envergure depuis 1 mois. Je trouve que ce projet est particulièrement positif et engageant. L’objectif : planter un million d’arbres sur le territoire de Bordeaux au cours des prochaines années. La stratégie : préserver les arbres existants et en planter de nouveaux.
                    Diversifier ses espaces en remodelant et verdissant la ville est la transition progressive idéale !
                    Le 23 novembre 2020, les premiers arbres ont été plantés.
                    Grâce à ces un million d’arbres plantés, 20% de plus du territoire sera arboré sur le territoire métropolitain. Biodiversité recréée, carbone stocké et amélioration de la qualité de l’air seront les maîtres mots de la ville d’ici une dizaine d’années.
                    À proximité de l’aéroport de Bordeaux-Mérignac, plus de 35 000 plants - dont 10 000 arbres - sont plantés. Des espaces d’arbres et arbustes, ne nécessitant que de très peu d’eau et surtout, adaptées au terrain.
                </p>
                <h3>Un budget conséquent, qu’en est-il de l’opinion publique ?</h3>
                <p>Lors du lancement du projet « 1 million d’arbres », la question du budget a suscité de nombreuses interrogations de la part des bordelais. Devant l’école Pressensé, Pierre Hurmic (maire de Bordeaux) dévoile son plan de végétalisation de la ville. Si vous voulez mon avis, annoncer son plan devant une école est loin d’être une décision anodine. La stratégie est ici d’impliquer les enfants dans ce gros changement d’évolution écologique qui se tient depuis quelques années. Le challenge est de faire en sorte que le plus de monde possible prenne part à ce combat, qu’importe l’âge.
                    Ce projet tient à coeur de Pierre Hurmic car il souhaite respecter ses engagements mais surtout respecter le souhait des bordelais : avoir une ville moins minérale et plus végétale. Quatre principes sont maîtres mots du projets : protéger, renouveler, planter, participer. Le maire précise : « Cela ne sert à rien de planter si on n’est pas capable de protéger le patrimoine existant ».
                    Sur le plan économique, le budget de la ville consacré aux plantations est multiplié par trois, passant de 100 000 à 300 000€.
                    Un budget conséquent, surtout vis-à-vis des autres problèmes de la ville. C’est pourquoi la question de végétaliser la ville est beaucoup remise en question dans l’opinion publique.
                    Notre belle endormie a encore de beaux jours devant elle. Végétaliser c’est bien, mais redoubler d’efforts sur les autres questions essentielles de la ville c’est mieux ! Faisons confiance au temps et attendons de voir ce que va donner le projet d’ici quelques années. J’attends une belle évolution de cet aspect là !
                </p>
                <div class="info_bottom">
                    <a href=""><img src="../../../assets/images/share-2 1.png" alt="loginImage"></a>
                    <a href=""> <img src="../../../assets/images/Vector-2.png" alt="loginImage">56</a>
                    <a href=""><img src="../../../assets/images/Vector-3.png" alt="loginImage">22</a>
                    <button class="button">Commentaires</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="suggestions">
            <p>Lis mes autres articles:</p>
            <div class="sug_container">
                <div class="suggestion">
                    <img src="../../../assets/images/philippe-barre.jpg" alt="philippebarreImage">
                    <p>Phillipe Barre : Anticonformiste et créateur d’un éco-système</p>
                    <a class="button" href="../article/">Lire l'article</a>
                </div>
                <div class="suggestion">
                    <img src="../../../assets/images/jardin.jpg" alt="jardinImage">
                    <p>Écologique et insolite C’est possible !</p>
                    <a class="button" href="../article/">Lire l'article</a>
                </div>
            </div>
        </div>
    </div>
    <div class="illustration">
        <img src="../../../assets/images/home.jpg" alt="homeImage">
    </div>

    <div class="container_comment" style="display: none;">
        <?php
        require '../../components/comment.php';
        ?>
    </div>
</div>

<?php require_once '../../commons/footer.php' ?>