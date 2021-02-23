<?php
//========================================//
//
//             home/index.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Home';
$page_description = '';



require_once '../../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="homepage_container">
    <div class="slideshow">
        <div class="slides fade">
            <?php require '../../components/article.php';
            ?>
        </div>
        
        <div class="slides fade">
            <?php require '../../components/article.php';
            ?>
        </div> 
        <div class="slides fade">
            <?php require '../../components/article.php';
            ?>
        </div>
        <div class="line_container">
            <span class="line" onclick="currentSlide(1)"></span> 
            <span class="line" onclick="currentSlide(2)"></span> 
            <span class="line" onclick="currentSlide(3)"></span> 
</div>

    </div>
   
    <div class="all_articles">
        <h2>Tous mes articles</h2>
        <div class="article">
            <?php require '../../components/sub_article.php';
            ?>
            <?php require '../../components/sub_article.php';
            ?>
            <?php require '../../components/sub_article.php';
            ?>
        </div>
    </div>
    

  
</div>


<?php require_once '../../commons/footer.php' ?>