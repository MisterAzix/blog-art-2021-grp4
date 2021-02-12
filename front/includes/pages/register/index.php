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
<div class="signUp_container">
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
                        <input class="input" name="etext" type="text" placeholder="Renseigne ton etext" required/>
                        <label>Email *</label>
                    </div>
                    <div class="group info">
                        <input class="input" name="password" type="text" placeholder="Renseigne ton mot de passe" required/>
                        <label>Mot de passe *</label>
                        <p>Le mot de passe doit contenir entre  8 et 64 caractères, des lettres minuscules et majuscules et au moins un caractère spécial.</p>
                    </div>
                </form>
            </div>
</div>


<?php require_once '../../commons/footer.php' ?>