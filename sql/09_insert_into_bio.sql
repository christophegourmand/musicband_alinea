USE db_alinea;

-- insertion des bios des musiciens
INSERT INTO `bio`
	(
		`active`
		, `firstname`
		, `lastname`
		, `path_image`
		, `description`
		, `job`
	)
VALUES
	(
		1
		, "Le Groupe"
		, ""
		, ""
		, "Formation du groupe Alinéa: été 2019"
		, ""
	),
	(
		1
		, "Thierry"
		, "Cividino"
		, "/assets/img/photos/musicians/photo_presentation_thierry2.jpg"
		, "Oh! Comme nous aimons parler de nous!\r\nIsérois d’origine, né le 21 Novembre 1979.\r\nUne chouette année, j’imagine.\r\nPère. Et Paire.\r\nDistordu par l’attraction gravitationnel de l’Art.\r\nContaminé par le besoin de manquer et d’être utile.\r\nGravement irrécupérable pour cause d’abus de «Blues ».\r\n
Adepte des Dimanches de procrastination, et du café fumant."
		, "Guitare, piano, chants.\r\nAuteur/compositeur/interprète"
	),
	(
		1
		, "Nico"
		, "Cividino"
		, "/assets/img/photos/musicians/photo_presentation_nico.jpg"
		, "Originaire du Nord Isère. Né le 08 Mai 1985 dans les bras de sa bonne étoile.\r\nFrère du compositeur.\r\nNe devant sa place qu’a un pauvre concours de circonstances: être venu au monde dans une famille de musiciens.\r\nToujours dispo, maitre du tempo, maitre du tant pis, pour le meilleur, et surtout, pour le pire."
		, "Batteur/Percussionniste"
	),
	(
		0
		, "Romain"
		, "Hugon"
		, "/assets/img/photos/musicians/photo_presentation_romain.jpg"
		, "Romain Hugon dit Ronron\r\nNé pour l'apéro du 19 février 1986 au Bronx 69.\r\nToujours prêt à faire ronronner son combi pour délirer en musique avec les potes.\r\nForce tranquille qui sait se faire entendre avec sa petite voix fluette....\r\n\"Roots Rock Reggae dis a reggae music\" "
		, "Bassiste"
	),
	(
		1
		, "Nicky"
		, "Rafidinanahary"
		, "/assets/img/photos/musicians/photo_presentation_nicole.jpg"
		, "Originaire de Lyon. Née un soir de 21 Juillet 1978, de parents choristes Malgaches.\r\nMère d’une lutine, et d’un lutin. Carnassière de littérature, de café chaud et d’esprit curieux à la connaissance.\r\nSes passions musicales n’ont, pour frontière, que l’amitié, la positivité et la confiance.\r\nTimide, utopiste, optimiste, fragile.\r\nConstruit uniquement avec son coeur et prend de la vie ce qu’elle lui offre, sans jamais demander en retour.\r\nSon Credo? …Carpe diem."
		, "Chanteuse/Choriste"
	),
	(
		0
		, "Simone"
		, "Candian"
		, "/assets/img/photos/musicians/photo_presentation_simone2.jpg"
		, "Originaire de Latina, banlieue Romaine.\r\nNé le 23/01/1984
A l’aube d’un froid matin d’après tempête.\r\nHeureux Père d’un petit garçon fabuleux.\r\nMusicien aux multiples influences et à l’esprit rock Inconditionnel.\r\nApporte ses improvisations généreuses sur touches noires et blanches, pour le bonheur d’Alinea.\r\nAime à jouer au chat et à la souris avec le batteur."
		, "Pianiste"
	),
	(
		1
		, "Anthony"
		, "Plaisir"
		, "/assets/img/photos/musicians/photo_presentation_anthony.jpg"
		, "Originaire d’Angers, Guitariste électro-acoustique depuis sa plus tendre enfance, ses arpèges et rythmiques font de lui le compagnon idéal d’intégration dans cette belle aventure.\r\nStudio ou Scènes, il s’adapte et maîtrise son instrument.\r\nUn parfait musicien comme on les aime …"
		, "Guitariste"
	),
	(
		1
		, "Olivier"
		, "Berton"
		, "/assets/img/photos/musicians/photo_presentation_olivier.jpg"
		, "Doyen jusqu’à la première note de clavier. Né en février 1970 quelque part sur Terre. Autodidacte insatiable, sensible au grain de l'orgue B3, accro aux couleurs chaudes et froides des synthés d'hier, véritable ado devant un son numérique d'aujourd'hui. Il ose et propose pour des proses musicales, intercalaire des partitions écrites, le contre-temps est son tempo."
		, "Synthés, Orgues, Soundesign"
	)
;