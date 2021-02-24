<?php
require_once __DIR__ . '/../../../CLASS_CRUD/auth.class.php';
$auth = new AUTH();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>L'écopin <?= !empty($page_title) ? "- $page_title" : '' ?></title>
    <meta name="description" content="<?= !empty($page_title) ? $page_description : "Découvert de nombreux articles sur l'écologie !" ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="../../../assets/css/main.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="desktop">
                <img src="../../../assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo">
                <div class="header-right">
                    <div class="header-right-container">
                        <div class="example">
                            <div id="inputSearch" class="inputSuggestion" style="display: none;">
                                <input type="text" placeholder="Search..." name="search">
                                <div class="suggestion">
                                    <a href="">Ecologique et insolite, c’est possible !</a> 
                                    <a href="">Bordeaux, écologie et environnement</a>
                                    <a href="">Philippe Barre, anticonformiste et créateur d’un écosystème</a>
                                </div>
                            </div>
                            <button id="searchIcon" class="boutonSearch">
                                <svg class="icon_recherche" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.0026 18.1601L29.76 28.9175M19.1044 3.65079C23.1789 7.72533 23.1853 14.3251 19.1186 18.3918C15.0519 22.4585 8.45213 22.4521 4.3776 18.3776C0.303063 14.3031 0.296708 7.70329 4.3634 3.6366C8.4301 -0.430098 15.0299 -0.423743 19.1044 3.65079Z" stroke="#1C1F1B" />
                                </svg>
                            </button>
                            <button id="crossIcon" class="boutonSearch" style="display: none;">
                                <svg class="icon_recherche" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.1299 0.870117L1.00006 19.9999" stroke="#1C1F1B"/>
                                    <path d="M20.1299 20L1.00006 0.870173" stroke="#1C1F1B"/>
                                </svg>
                            </button>
                        </div>
                       
                        <?php if ($auth->is_connected()) : ?>
                            <?php if ($auth->is_admin()) : ?>
                                <div class="button-container">
                                    <a href="../../../../index1.php">ADMIN</a>
                                </div>
                            <?php endif ?>
                        <?php else : ?>
                            <div class="button-container">
                                <a class="button" href="../pages/register/">Inscription</a>
                                <a class="button button-empty" href="../pages/login/">Connexion</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="mobile">
                <img src="../../../assets/images/search_icon.svg" alt="Icon de recherche" class="icon_recherche">
                <img src="../../../assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo">
                <img src="../../../assets/images/account.svg" alt="Icon de compte" class="icon_account">
            </div>
        </div>
    </header>
    <main>



        <!-- <img src="../../../assets/images/search_icon.svg" alt="Icon de recherche" class="icon_recherche"> -->