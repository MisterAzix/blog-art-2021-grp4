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
            <div class="section">
                <h2>Acces rapide</h2>
               <a href="../register">Inscription</a>
               <a href="../login">Connexion</a>
               <a href="../contact/">Me contacter</a>
            </div>
        </div>
        <div class="path">
            <svg width="4" height="102" viewBox="0 0 4 102" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 0L2 102" stroke="#BFF088" stroke-width="4"/>
            </svg>
        </div>
            
        <div class="section_container">
        <div class="section">
            <h2>Rubriques</h2>
           <a href="">Actualité</a>
           <a href="">Ecologie</a>
           <a href="">Insolite</a>
           <a href="">Evenements</a>
           <a href="">Culture</a>
        </div>

        </div>
        <div class="path">
            <svg width="4" height="102" viewBox="0 0 4 102" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 0L2 102" stroke="#BFF088" stroke-width="4"/>
            </svg>
        </div>
        <div class="section_container">
            <div class="section">
                <h2>tous mes articles</h2>
               <a href="">Bordeaux, écologie et environnement</a>
               <a href="">Écologique et insolite,c’est possible !</a>
               <a href="">Phillipe Barre : Anticonformiste et créateur d’un éco-systeme</a>
            </div>
        </div>
    </div>
</div>


<?php require_once '../../commons/footer.php' ?>