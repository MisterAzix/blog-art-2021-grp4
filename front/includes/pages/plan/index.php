<?php
// WRITE YOUR PHP LOGIC HERE
$page_title = 'Home';
$page_description = '';



require_once '../../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="plan_container layout">
    <div class="title">
        <p><span></span>Plan du Site</p>
    </div>
    <div class="sections">
        <div class="section_container">
            <h2>Acces rapide</h2>
            <p>Inscription</p>
            <p>Connexion</p>
            <p>Me contacter</p>
        </div>
            <svg width="4" height="102" viewBox="0 0 4 102" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 0L2 102" stroke="#BFF088" stroke-width="4"/>
            </svg>
        <div class="section_container">
            <h2>Rubriques</h2>
            <p>Actualité</p>
            <p>Ecologie</p>
            <p>Insolite</p>
            <p>Evenements</p>
            <p>Culture</p>
        </div>
            <svg width="4" height="102" viewBox="0 0 4 102" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 0L2 102" stroke="#BFF088" stroke-width="4"/>
            </svg>
        <div class="section_container">
            <h2>tous mes articles</h2>
            <p>Bordeaux, écologie et environnement</p>
            <p>Écologique et insolite,c’est possible !</p>
            <p>Phillipe Barre : Anticonformiste et créateur d’un éco-systeme</p>
        </div>
    </div>
</div>


<?php require_once '../../commons/footer.php' ?>