<?php
//========================================//
//
//              register.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Inscription';
$page_description = '';


require_once __DIR__ . '/../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="sign_container layout">
    <div class="illustration">
        <img src="./front/assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage">
    </div>
    <div class="register">
        <h2>Hey ! Inscris-toi ici ! </h2>
        <div class="input_container">
            <form action="" method="POST">
                <div class="input-group">
                    <input class="input" name="firstname" type="text" placeholder="Renseigne ton prénom" required />
                    <label>Prénom</label>
                </div>
                <div class="input-group">
                    <input class="input" name="lastname" type="text" placeholder="Renseigne ton nom" required />
                    <label>Nom</label>
                </div>
                <div class="input-group">
                    <input class="input" name="pseudo" type="text" placeholder="Renseigne ton pseudo" required />
                    <label>Pseudo *</label>
                </div>
                <div class="input-group">
                    <input class="input" name="etext" type="text" placeholder="Renseigne ton email" required />
                    <label>Email *</label>
                </div>
                <div class="input-group">
                    <input class="input" name="password" type="text" placeholder="Renseigne ton mot de passe" required />
                    <label>Mot de passe *</label>
                    <span class="tips">Le mot de passe doit contenir entre 8 et 64 caractères, des lettres minuscules et majuscules et au moins un caractère spécial.</span>
                </div>

                <div class="checkbox-container">
                    <div class="checkbox">
                        <input type="checkbox" id="cgu" name="cgu">
                        <label for="cgu">J'accepte les <a href="/cgu">conditions générales d'utilisations</a>.</label>
                    </div>

                    <div class="checkbox">
                        <input type="checkbox" id="newsletter" name="newsletter">
                        <label for="newsletter">J'adhère à la newsletter.</label>
                    </div>
                </div>
                <div class="input-group">
                    <button class="button button-submit">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/../commons/footer.php' ?>