<?php 
    include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main>
    <h2 class="page-title">Contact</h2>
	<?php 
        // temporary : 
        $_GET['messageKey'] = 'formContactWorksSoon';

		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>

    <div class="form-container">
        <form id="formContact" method="POST" action="/controller/controller_contact_form.php" class="form">
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
                <textarea id="formContact_message" name="formContact_message" placeholder="" class="form-input" rows="6" required></textarea>
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