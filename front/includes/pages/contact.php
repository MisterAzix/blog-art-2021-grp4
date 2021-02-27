<?php
//========================================//
//
//              contact.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Me contacter';
$page_description = '';



require_once __DIR__ . '/../commons/header.php';
?>

<div class='sign_container layout'>
    <div class='illustration'>
        <img src="/front/assets/images/Cool Kids - High Tech.png" alt="loginImage">
    </div>
    <div class='contact'>
        <h2>Besoin de me contacter ?</h2>
            <p>Envoie-moi un mail ! </p>
                <div class="input_container">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input class="input" name="email" type="mail" placeholder="Renseigne ton email" required/>
                            <label>Email</label>
                        </div>
                        <div class="input-group">
                            <textarea class="input"name="message" placeholder="Renseigne ton message" required></textarea>
                            <label>Message</label>
                        </div>
                        <div class="input-group">
                            <button class="button contact_button">
                                Envoyer  <img src="/front/assets/images/Vector.png" alt="loginImage">
                            </button>
                        </div>
                    </form>
                </div>
                <!--Insert Captcha here -->
                <div class="network_container">
                    <p>Ou rejoins-moi sur mes réseaux :)</p> 
                        <div class="network">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-twitter"></i>
                        </div>
                </div>
          
        </div>
</div>

<?php require_once __DIR__ . '/../commons/footer.php' ?>