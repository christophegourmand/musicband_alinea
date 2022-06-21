<?php 
    include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main>
    <h2 class="page-title">Contact</h2>
    
    <div style="margin: 1.5rem; border:1px solid red; color: red; text-align:center;">
        <h5>Ce formulaire sera bientôt opérationnel, en attendant veuillez nous contacter par l'adresse suivante:</h5>
        <a style="color: #ffbaba; text-decoration:underline;" href="mailto:alineamusique@gmail.com">alineamusique@gmail.com</a>
    </div>


    <div class="form-container">
        <form id="formContact" method="POST" action="<?= '/controller/controller_contact_form.php'?>" class="form">
            <div class="form-group">
                <label for="formContact_senderMail" class="form-label">Email</label>
                <input type="email" id="formContact_senderMail" name="formContact_senderMail" placeholder="" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="formContact_senderName" class="form-label">Nom</label>
                <input type="text" id="formContact_senderName" name="formContact_senderName" placeholder="" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="formContact_message" class="form-label">Message</label>
                <textarea id="formContact_message" name="formContact_message" placeholder="" class="form-input" cols="50" rows="6" required></textarea>
            </div>
            <!-- <div class="form-group">
                <label for="formContact_senderWantCopy" class="form-label">Recevoir une copie</label>
                <input type="checkbox" id="formContact_senderWantCopy" name="formContact_senderWantCopy" placeholder="" class="form-input">
            </div> -->
            <div class="form-group">
                <input type="submit" id="formContact_submit" name="formContact_submit" class="btn btn-outline-white" value="Envoyer">
            </div>
        </form>
    </div>
</main>