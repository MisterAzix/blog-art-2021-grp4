<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>L'écopin <?= !empty($page_title) ? "- $page_title" : '' ?></title>
    <meta name="description" content="<?= !empty($page_title) ? $page_description : "Découvert de nombreux articles sur l'écologie !" ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="../../../assets/css/main.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="desktop">
                <img src="../../../assets/images/logo_lecopin.svg" alt="Logo du site avec écrit l'écopins" class="logo">
                <div class="header-right">
                    <div class="header-right-container">
                    <svg class="icon_recherche" width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" >
                    <path d="M19.0026 18.1601L29.76 28.9175M19.1044 3.65079C23.1789 7.72533 23.1853 14.3251 19.1186 18.3918C15.0519 22.4585 8.45213 22.4521 4.3776 18.3776C0.303063 14.3031 0.296708 7.70329 4.3634 3.6366C8.4301 -0.430098 15.0299 -0.423743 19.1044 3.65079Z" stroke="#1C1F1B"/>
                    </svg>

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



    <!-- <img src="../../../assets/images/search_icon.svg" alt="Icon de recherche" class="icon_recherche"> -->