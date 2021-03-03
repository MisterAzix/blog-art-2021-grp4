<?php
//========================================//
//
//              contact.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Me contacter';
$page_description = "Tu veux me contacter, m'envoyer un doux message, alors c'est ici que ça se passe.";



require_once __DIR__ . '/../commons/header.php';
?>

<div class='sign_container layout'>
    <div class='illustration'>
        <img src="/front/assets/images/Cool Kids - High Tech.png" alt="loginImage">
        <!-- <img src="../../assets/images/Cool Kids - High Tech.png" alt="loginImage"> -->
    </div>
    <div class='contact'>
        <h2>Besoin de me contacter ?</h2>
        <p>Envoie-moi un mail ! </p>
        <div class="input_container">
            <form action="" method="POST">
                <div class="input-group">
                    <input class="input" name="email" type="email" placeholder="Renseigne ton email" required />
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <textarea class="input" name="message" placeholder="Renseigne ton message" required></textarea>
                    <label>Message</label>
                </div>
                <div class="input-group">
                    <button class="button contact_button">
                        Envoyer <img src="/front/assets/images/Vector.png" alt="loginImage">
                    </button>
                    <!-- <button class="button contact_button">
                        Envoyer <img src="../../assets/images/Vector.png" alt="loginImage">
                    </button> -->
                </div>
            </form>
        </div>
        <!--Insert Captcha here -->
        <div class="network_container">
            <p>Ou rejoins-moi sur mes réseaux :)</p>
            <div class="network">
                <a href="https://www.facebook.com/L%C3%A9copin-342594557080435"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/Lecopin_Blog"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../commons/footer.php' ?>