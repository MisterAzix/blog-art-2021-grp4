<?php
//========================================//
//
//            login/index.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Login';
$page_description = '';



require_once '../../commons/header.php';
?>

<div class='sign_container'>
    <div class='illustration'>
        <img src="../../../assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage">
    </div>
    <div class='login'>
        <h2>Connexion</h2>
            <div class="input_container">
                <form action="" method="POST">
                    <div class="group">
                        <input class="input" name="email" type="mail" placeholder="Renseigne ton email" required/>
                        <label>Email</label>
                    </div>
                    <div class="group">
                        <input class="input" name="password" type="text" placeholder="Renseigne ton mot de passe" required/>
                        <label>Mot de passe</label>
                    </div>
                </form>
            </div>
        <a href="">Mot de passe oublié ?</a>
            <?php require_once '../../components/button.php' ?>
        <p>Pas de compte ? <a href="../../pages/register/index.php">Inscris-toi ! </a> </p> 
    </div>
</div>

<?php require_once '../../commons/footer.php' ?>