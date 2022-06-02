<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Group.class.php");
	
	//--- TEST : Creer un user						FONCTIONNE
	# $user_thierry = new User();
	//--- TEST : charger les infos du User			FONCTIONNE
	# $user_thierry->load($mysqli , 2);


	//--- TEST : Creer un groupe					FONCTIONNE
	# $group1 = new Group();
	//--- TEST : charger les infos du groupe		FONCTIONNE
	# $group1->load($mysqli , 1);


	//--- TEST : vérifier que la fonctionne `set_groupname()` renvoi un erreur si le nom est de plus de 50 caractères:	FONCTIONNE
	# $group_troplong = new Group();
	# $group_troplong->set_groupname($mysqli , 'je-suis-allé-au-marché-et-jai-acheté-des-carottes-et-des-poireaux'); //--- renvoi bien une erreur
	# $group_troplong->set_groupname($mysqli , 'fan-premium');


	//--- TEST : de la fonction `create`			FONCTIONNE
	# $user_nouveau = new User();
	# $user_nouveau->set_rowDatas( $mysqli, [
	# 		'active' => 1,
	# 		'login' => 'john',
	# 		'pass' => 'john_test',
	# 		'pass_encoded' => '',
	# 		'fk_group_rowid' => 2,
	# 		'email' => 'john@test.com WHERE rowid = "1"' //--- test d'injection SQL (devrait être bloqué)
	# 	]
	# );
	# $user_nouveau->create($mysqli);

	//--- TEST : updater un user
	$user_john = new User();
	$user_john->load($mysqli , 9);

	//--- j'update certaines infos ---
#	$user_john->set_rowDatas( $mysqli, [
#			'pass' => 'john_test_modifié',
#			'email' => 'john@test.com'
#		]
#	);

	//--- j'utilise la fonction `update`
	# $user_john->update($mysqli , 9);  //---  le rowid 9 est pour John (à supprimer plus tard)


	//--- TEST : supprimer un user
?>

<main>
	<h2 class="page-title">DEBUG</h2>

	<section class="debug">
		<pre>
			<?php 

				// var_dump($user_thierry);
				// var_dump($user_thierry->get_tableName());
				
				// var_dump($group1);
				// var_dump($group1->get_tableName());
				
				// var_dump($user_nouveau);

				var_dump($user_john);
			?>
		</pre>
	</section>
</main>