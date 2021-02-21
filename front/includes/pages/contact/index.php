<?php
// WRITE YOUR PHP LOGIC HERE
$page_title = 'Home';
$page_description = '';



require_once '../../commons/header.php';
?>
<!-- WRITE HTML CODE BELOW -->

<!--<div class='sign_container layout'>
    <div class='illustration'>
        <img src="../../../assets/images/Cool Kids - High Tech.png" alt="loginImage">
    </div>
    <div class='contact'>
        <h2>Besoin de me contacter ?</h2>
            <p>Envoie-moi un mail ! </p>
                <div class="input_container">
                    <form action="" method="POST">
                        <div class="group">
                            <input class="input" name="email" type="mail" placeholder="Renseigne ton email" required/>
                            <label>Email</label>
                        </div>
                        <div class="group">
                            <input class="input" name="password" type="text" placeholder="Renseigne ton mot de passe" required/>
                            <label>Message</label>
                        </div>
                    </form>
                </div>
           // <?php 
             //$buttonTitle='Envoyer';
             //$buttonClass='login_button';
             require '../../components/button.php';
             ?>//
             <div class="network">
                <p>Ou rejoins-moi sur les réseaux :)  </p> 
                <a href="../../pages/register/index.php">Inscris-toi ! </a>
             </div>
      
    </div>
</div> -->


<div class='sign_container layout'>
    <div class='illustration'>
        <img src="../../../assets/images/Cool Kids - High Tech.png" alt="loginImage">
    </div>
    <div class='contact'>
        <h2>Besoin de me contacter ?</h2>
            <p>Envoie-moi un mail ! </p>
                <div class="input_container">
                    <form action="" method="POST">
                        <div class="group">
                            <input class="input" name="email" type="mail" placeholder="Renseigne ton email" required/>
                            <label>Email</label>
                        </div>
                        <div class="group">
                            <textarea class="input"name="message" placeholder="Renseigne ton message" required></textarea>
                            <label>Message</label>
                        </div>
                        <?php 
                            $buttonTitle='Envoyer  <img src="../../../assets/images/Vector.png" alt="loginImage">';
                            $buttonClass='contact_button';
                            require '../../components/button.php';
                        ?>
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

<?php require_once '../../commons/footer.php' ?>