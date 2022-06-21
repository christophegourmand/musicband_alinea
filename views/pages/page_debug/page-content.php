<?php

use models\music\MusicSong;

	// require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Group.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicSong.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Bio.class.php");

?>

<main>
	<h2 class="page-title">DEBUG</h2>

	<section class="debug">
		<pre>
			<?php 
	//--- TEST : Creer un user localement
	// FONCTIONNE
		# $user_thierry = new User();
	//--- TEST : charger les infos du User
	// FONCTIONNE
		# $user_thierry->load($mysqli , 2);
		# var_dump($user_thierry);
		# var_dump($user_thierry->get_tableName());


	//--- TEST : Creer un groupe
	// FONCTIONNE
		# $group1 = new Group();
	//--- TEST : charger les infos du groupe
	// FONCTIONNE
		# $group1->load($mysqli , 1);
		# var_dump($group1);
		# var_dump($group1->get_tableName());


	//--- TEST : vérifier que la fonctionne `set_groupname()` renvoi un erreur si le nom est de plus de 50 caractères:
	// TODO : À TESTER
		# $group_troplong = new Group();
		# $group_troplong->set_groupname($mysqli , 'je-suis-allé-au-marché-et-jai-acheté-des-carottes-et-des-poireaux'); //--- renvoi bien une erreur
		# $group_troplong->set_groupname($mysqli , 'fan-premium');

	//--- TEST : de la NOUVELLE fonction `create`
	// FONCTIONNE
		# $user_albert = new User();
		# $user_albert->set_active(1);
		# $user_albert->set_login('albert2');
		# $user_albert->set_pass('albert2_password');
		# $user_albert->set_pass_encoded('albertsadlfkj23987fknk2347fsdkjkhj3');
		# $user_albert->set_fk_group_rowid(4);
		# $user_albert->set_email('albert2@test.com');
		# $user_albert->create($mysqli); // FONCTIONNE  (nouveau)
		# var_dump($user_albert);
		# var_dump($user_albert->prepareRowDatas());


	//--- TEST : updater un user
	// FONCTIONNE
		# $user_simone = new User();
		# $user_simone->load($mysqli , 6);
	//--- j'update certaines infos
		# $user_simone->set_pass('simone_piano_modifié');
		# $user_simone->set_email('simone.piano@test.com');
		# $user_simone->set_pass_encoded('oiuyr7y34iury2734');
	//--- j'utilise la fonction `update`
		# $user_simone->update($mysqli);


	//--- TEST : supprimer un user
	// FONCTIONNE
		# $user_simone = new User();
		# $user_simone->load($mysqli , 6);
		# $user_simone->delete($mysqli);

	//--- TEST : créer un groupe
	// FONCTIONNE
		# $group_fan_premium = new Group();
		//--- remplir des donnees
		# $group_fan_premium->set_groupname($mysqli , "fan_premium"); // OK
		# $group_fan_premium->create($mysqli); // OK
	
	//--- TEST : updater un groupe
	// FONCTIONNE
		# $group_fan_premium = new Group();
		//--- je charge pour avoir le rowid
		# $group_fan_premium->load($mysqli , 5); // OK
		//--- je change le nom
		# $group_fan_premium->set_groupname($mysqli , "superfan"); // OK
		# $group_fan_premium->update($mysqli); // OK
	
	//--- TEST : supprimer un groupe
	// FONCTIONNE
		# $group_superfan = new Group();
		# $group_superfan->load($mysqli , 5); //PASS
		# $group_superfan->delete($mysqli); // PASS

	//--- TEST : get_groupname()
		# $group_fan = new Group();
		# $group_fan->load($mysqli, 4);
		# var_dump($group_fan->get_groupname()); // PASS

	//--- TEST : load_users() et get_users()
		# $group_musicians = new Group();
		# $group_musicians->load($mysqli, 2);
		# $group_musicians->load_users($mysqli);     // PASS
		# var_dump( $group_musicians->get_users() ); // PASS
	
	//--- TEST : containOnlyAuthorizedCharacters()
		require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
		// --- TEST 1 : mode "letters"
		// FONCTIONNE
			# $chaine_a_tester = "pierre";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters") ? 'oui' : 'non'; // PASS
		// --- TEST 2 : mode "letters+digits"
		// FONCTIONNE
			# $chaine_a_tester = "pierre75";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters") ? 'oui' : 'non'; // PASS
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters+digits") ? 'oui' : 'non'; // PASS
		// --- TEST 3 : mode "digits"		PASS
			# $chaine_a_tester = "23985a";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "digits") ? 'oui' : 'non'; // PASS

			# $chaine_a_tester = "23985";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "digits") ? 'oui' : 'non'; // PASS

			# $chaine_a_tester = "23 985";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "digits") ? 'oui' : 'non'; // PASS

			# $chaine_a_tester = "les 3 mousquetaires";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters+digits+spaces") ? 'oui' : 'non'; // PASS

			# $chaine_a_tester = "j'adore les fuits au sirop";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters+digits+spaces") ? 'oui' : 'non'; // PASS

			# $chaine_a_tester = "j adore les fuits au sirop";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters+digits+spaces") ? 'oui' : 'non'; // PASS
		// --- TEST 4 : mode "letters+digits+dash+underscore"
			# $chaine_a_tester = "jean-pierre_8";
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters+digits+dash+underscore") ? 'oui' : 'non'; // PASS

			# $chaine_a_tester = "jean-pierre.8";   // PASS
			# $chaine_a_tester = "jean-pierre!8";   // PASS
			# $chaine_a_tester = "jean-pierre@8";   // PASS
			# $chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters+digits+dash+underscore") ? 'oui' : 'non'; // PASS
		// --- TEST 5 : autres modes
			#$chaine_a_tester = "L'ardoise affiche l'en-tete du menu \"Super\" a 45_euros"; // PASS  mais pas avec les accents
			#$chain_est_clean = containOnlyAuthorizedCharacters($chaine_a_tester , "letters+digits+spaces+apostrophe+quote+dash+underscore") ? 'oui' : 'non';

		//--- à laisser actif pour tous les tests ci-dessus de containOnlyAuthorizedCharacters()
		#print "la chaine [ $chaine_a_tester ] contient seulement les caractères autorisés : $chain_est_clean";

	// TEST : charger un MusicAlbum
		# $musicAlbum1 = new MusicAlbum();
		# $musicAlbum1->load($mysqli , 1); // PASS
		# var_dump($musicAlbum1);	

	// TEST : Getters-setters de MusicAlbum
	// FONCTIONNE
		# $musicAlbum_test = new MusicAlbum();
	
		# $musicAlbum_test->set_active(0);
		# $musicAlbum_test->set_name('test2'); // NOTE : changer le nom à chaque test
		# $musicAlbum_test->set_path_image('/asset/img/photos/test.jpg');
		# $musicAlbum_test->set_link_spotify('https://spotify');
		# $musicAlbum_test->set_link_applemusic('https://applemusic');
		# $musicAlbum_test->set_link_itunes('https://itunes');
		# $musicAlbum_test->set_link_deezer('https://deezer');
		# $musicAlbum_test->set_link_amazonmusic('https://amazonmusic');
		# $musicAlbum_test->set_link_googleplay('https://googleplay');
		# $musicAlbum_test->set_link_tidal('https://tidal');
		# var_dump($musicAlbum_test);

	// TEST : creer un MusicAlbum
		# $musicAlbum_test->create($mysqli); // PASS
		# var_dump($musicAlbum_test);
	
	// TEST : updater un MusicAlbum
		# $musicAlbum2 = new MusicAlbum();
		# $musicAlbum2->load($mysqli , 2);
		# var_dump($musicAlbum2);

		# $musicAlbum2->set_path_image('/asset/img/photos/test.jpg');
		# $musicAlbum2->set_link_spotify('https://spotify');
		# $musicAlbum2->set_link_applemusic('https://applemusic');
		# $musicAlbum2->update($mysqli); // PASS

	// TEST : deleter un MusicAlbum
		# $musicAlbum3 = new MusicAlbum();
		# $musicAlbum3->load($mysqli , 3);
		# $musicAlbum3->delete($mysqli); // PASS

	// TEST : Model->get_rowid() depuis un User (au autre)
		# $user_ronron = new User();
		# $user_ronron->load($mysqli , 5);
		# var_dump( $user_ronron->get_rowid() ); // PASS

	// TEST : fonction Model->fill_from_array($rowDatas)
	// FONCTIONNE
		# $userFilled = new User();
		
		# $rowDatas_for_userFilled = [
		# 	'active' => 1,
		# 	'login' => 'userFilled',
		# 	'pass' => 'userFilled_pass',
		# 	'pass_encoded' => 'fsdl423j4lkfj234',
		# 	'fk_group_id' => 2
		# 	//--- je ne met pas 'email' volontairement
		# ];

		# $userFilled->fill_from_array($rowDatas_for_userFilled); // PASS
		# var_dump(   $userFilled     );

	// TEST : depuis un MusicAlbum , charger les MusicSongs
	// FONCTIONNE
		# $album_withSongs = new MusicAlbum();
		# $album_withSongs->load($mysqli , 1);
		# $album_withSongs->load_musicSongs($mysqli); // PASS
		# var_dump( $album_withSongs );

	//--- TEST : Bio >> setters
		# $bio = new Bio();
		# $bio->set_firstname("John"); // OK : accepté
		# $bio->set_firstname("John8"); // OK refusé
		# $bio->set_firstname("Jean-Émile"); // OK accepté
		
		# $bio->set_description("L' ê - _ , abc"); // OK accepté
		# $bio->set_description("L' ê - _ , abc @"); // OK refusé
		# $bio->set_description("L' ê - _ , abc #"); // OK refusé
		# $bio->set_description("L' ê - _ , abc (adf)."); // OK refusé
		
		# $bio->set_job("Guitare , ."); // OK
		// $bio->set_job("Guitare, piano, chants. Auteur/compositeur/interprète"); // OK

		//--- à utiliser pour tous les tests ci-dessus
		# var_dump($bio);

	//--- TEST : Bio >> load
		# $bio = new Bio();
		# $bio->load($mysqli, 4); // PASS
	//--- TEST : Bio >> update  (réactiver les 2 lignes ci dessus)
		# $bio->set_firstname('Ron Ron'); // OK
		# $bio->set_lastname('Hu Gon'); // OK
		# $bio->set_description(' '); // OK
		# $bio->update($mysqli); // PASS
		# var_dump($bio);
	//--- TEST : Bio >> create
		# $bio = new Bio();
		# $bio->set_active(0); // OK
		# $bio->set_firstname('Michael'); // OK
		# $bio->set_lastname('Jones'); // OK
		# $bio->set_path_image('/assets/img/photos/musicians/# photo_presentation_michael.jpg'); // OK
		# $bio->set_description("L'un des meilleurs guitariste de # France, référence en blues / rock / solos, et très doué au # chant !"); // OK
		# $bio->set_job('Guitariste / soliste / chant'); // OK
		# $bio->create($mysqli); // PASS


	//--- TEST : Bio >> delete
		# $bio = new Bio();
		# $bio->load($mysqli , 9); // OK
		# $bio->delete($mysqli); // PASS

			?>
		</pre>
	</section>
</main>