<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>L'écopin <?= !empty($page_title) ? "- $page_title" : '' ?></title>
    <meta name="description" content="<?= !empty($page_title) ? $page_description : "Découvert de nombreux articles sur l'écologie !" ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" >
    <link rel="stylesheet" href="../../../assets/css/main.css">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="desktop">
                <img src="../../../assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo">
                <div class="header-right">
                    <div class="header-right-container">
                        <img src="../../../assets/images/search_icon.svg" alt="Icon de recherche" class="icon_recherche">
                        <div class="button-container">
                            <?php 
                            $buttonTitle = "Inscription";
                            $buttonHref = '';
                            $buttonClass ='nav_button';
                            require '../../components/button.php';
                            ?>
                            <?php 
                            $buttonTitle = "Connexion";
                            $buttonHref = '';
                            $buttonClass = 'connect-button';
                            require '../../components/button.php';
                            ?>
                        </div>
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