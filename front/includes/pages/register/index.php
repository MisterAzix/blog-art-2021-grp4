<?php
//========================================//
//
//          register/index.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Register';
$page_description = '';


require_once '../../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="sign_container layout">
    <div class="illustration">
        <img src="../../../assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage">
    </div>
    <div class="register">
        <h2>Hey ! Inscris-toi ici ! </h2>
             <div class="input_container">
                    <form action="" method="POST">
                        <div class="group">
                            <input class="input" name="firstname" type="text" placeholder="Renseigne ton prénom" required/>
                            <label>Prénom</label>
                        </div>
                        <div class="group">
                            <input class="input" name="lastname" type="text" placeholder="Renseigne ton nom" required/>
                            <label>Nom</label>
                        </div>
                        <div class="group">
                            <input class="input" name="pseudo" type="text" placeholder="Renseigne ton pseudo" required/>
                            <label>Pseudo *</label>
                        </div>
                        <div class="group">
                            <input class="input" name="etext" type="text" placeholder="Renseigne ton email" required/>
                            <label>Email *</label>
                        </div>
                        <div class="group">
                            <input class="input" name="password" type="text" placeholder="Renseigne ton mot de passe" required/>
                            <label>Mot de passe *</label>
                            <p class="tips">Le mot de passe doit contenir entre  8 et 64 caractères, des lettres minuscules et majuscules et au moins un caractère spécial.</p>
                        </div>
                    </form>
                    <div class="checkbox-container">
                        <div class="checkbox">
                            <input type="checkbox" id="accepter" name="accepter">
                            <label for="accepter">J'accepte les <a href="../cgu/index.php">conditions générales d'utilisations</a>.</label>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="newsletter" name="newsletter">
                            <label for="newsletter">J'adhère à la newsletter.</label>
                        </div>
                    </div>
                    
                    <?php 
                $buttonTitle='S\'inscrire';
                $buttonClass='login_button';
                require '../../components/button.php';
                ?>
                </div>
                    
               
    </div>
</div>


<?php require_once '../../commons/footer.php' ?>