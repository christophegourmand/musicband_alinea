-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour db_alinea
DROP DATABASE IF EXISTS `db_alinea`;
CREATE DATABASE IF NOT EXISTS `db_alinea` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_alinea`;

-- Listage de la structure de la table db_alinea. asso_group_right
DROP TABLE IF EXISTS `asso_group_right`;
CREATE TABLE IF NOT EXISTS `asso_group_right` (
  `rowid` int(3) NOT NULL AUTO_INCREMENT,
  `fk_group_rowid` int(4) NOT NULL,
  `fk_right_rowid` int(4) NOT NULL,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `idx_rowid_groupid_rightid` (`rowid`,`fk_group_rowid`,`fk_right_rowid`),
  KEY `fk_group_rowid` (`fk_group_rowid`),
  KEY `fk_right_rowid` (`fk_right_rowid`),
  CONSTRAINT `asso_group_right_ibfk_1` FOREIGN KEY (`fk_group_rowid`) REFERENCES `group` (`rowid`) ON DELETE CASCADE,
  CONSTRAINT `asso_group_right_ibfk_2` FOREIGN KEY (`fk_right_rowid`) REFERENCES `right` (`rowid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.asso_group_right : ~46 rows (environ)
/*!40000 ALTER TABLE `asso_group_right` DISABLE KEYS */;
INSERT INTO `asso_group_right` (`rowid`, `fk_group_rowid`, `fk_right_rowid`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 1, 3),
	(4, 1, 4),
	(5, 1, 5),
	(6, 1, 6),
	(7, 1, 7),
	(8, 1, 8),
	(9, 1, 9),
	(10, 1, 10),
	(11, 1, 11),
	(12, 1, 12),
	(13, 1, 13),
	(14, 1, 14),
	(15, 1, 15),
	(16, 1, 16),
	(17, 1, 17),
	(18, 1, 18),
	(19, 1, 19),
	(20, 1, 20),
	(21, 1, 21),
	(22, 1, 22),
	(23, 1, 23),
	(24, 2, 1),
	(25, 2, 2),
	(26, 2, 3),
	(27, 2, 5),
	(28, 2, 9),
	(29, 2, 10),
	(30, 2, 11),
	(31, 2, 12),
	(32, 2, 14),
	(33, 2, 15),
	(34, 2, 18),
	(35, 2, 20),
	(36, 2, 21),
	(37, 2, 22),
	(38, 2, 23),
	(39, 3, 3),
	(40, 3, 4),
	(41, 3, 5),
	(42, 3, 11),
	(43, 3, 14),
	(44, 3, 15),
	(45, 3, 18),
	(46, 3, 22);
/*!40000 ALTER TABLE `asso_group_right` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. asso_user_preference
DROP TABLE IF EXISTS `asso_user_preference`;
CREATE TABLE IF NOT EXISTS `asso_user_preference` (
  `rowid` int(3) NOT NULL AUTO_INCREMENT,
  `fk_user_rowid` int(4) NOT NULL,
  `fk_preference_rowid` int(4) NOT NULL,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `idx_rowid_userid_prefid` (`rowid`,`fk_user_rowid`,`fk_preference_rowid`),
  KEY `fk_user_rowid` (`fk_user_rowid`),
  KEY `fk_preference_rowid` (`fk_preference_rowid`),
  CONSTRAINT `asso_user_preference_ibfk_1` FOREIGN KEY (`fk_user_rowid`) REFERENCES `user` (`rowid`) ON DELETE CASCADE,
  CONSTRAINT `asso_user_preference_ibfk_2` FOREIGN KEY (`fk_preference_rowid`) REFERENCES `preference` (`rowid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.asso_user_preference : ~0 rows (environ)
/*!40000 ALTER TABLE `asso_user_preference` DISABLE KEYS */;
/*!40000 ALTER TABLE `asso_user_preference` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. concert
DROP TABLE IF EXISTS `concert`;
CREATE TABLE IF NOT EXISTS `concert` (
  `rowid` int(4) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `date` date DEFAULT NULL,
  `hour_start` time DEFAULT NULL,
  `hour_end` time DEFAULT NULL,
  `venue_name` varchar(100) NOT NULL,
  `city_name` varchar(100) DEFAULT NULL,
  `url_map` varchar(512) DEFAULT NULL,
  `path_image` varchar(512) DEFAULT NULL,
  `description` mediumtext,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `idx_concert_rowid_venue_name` (`rowid`,`venue_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.concert : ~0 rows (environ)
/*!40000 ALTER TABLE `concert` DISABLE KEYS */;
INSERT INTO `concert` (`rowid`, `active`, `date`, `hour_start`, `hour_end`, `venue_name`, `city_name`, `url_map`, `path_image`, `description`) VALUES
	(1, 1, '2022-04-09', '20:00:00', '22:00:00', 'Les Ursulines', 'Crémieux', 'https://goo.gl/maps/dfiKFMc7ahCrUYkUA', 'assets/img/concerts/2022-04-09_les-ursulines.jpeg', 'Ici apparaîtra un texte d\'accroche du concert. Venez nombreux pour boire de la bonne bière brassée dans ce lieu convivial, tout en assistant au concert que nous vous avons préparé !');
/*!40000 ALTER TABLE `concert` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. group
DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `rowid` int(3) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(50) NOT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.group : ~4 rows (environ)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`rowid`, `groupname`) VALUES
	(1, 'webadmin'),
	(2, 'band_musicians'),
	(3, 'band_staff'),
	(4, 'fan');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. music_album
DROP TABLE IF EXISTS `music_album`;
CREATE TABLE IF NOT EXISTS `music_album` (
  `rowid` int(4) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path_image` varchar(512) DEFAULT NULL,
  `link_spotify` varchar(512) DEFAULT NULL,
  `link_applemusic` varchar(512) DEFAULT NULL,
  `link_itunes` varchar(512) DEFAULT NULL,
  `link_deezer` varchar(512) DEFAULT NULL,
  `link_amazonmusic` varchar(512) DEFAULT NULL,
  `link_googleplay` varchar(512) DEFAULT NULL,
  `link_tidal` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `idx_music_album_rowid_name` (`rowid`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.music_album : ~2 rows (environ)
/*!40000 ALTER TABLE `music_album` DISABLE KEYS */;
INSERT INTO `music_album` (`rowid`, `active`, `name`, `path_image`, `link_spotify`, `link_applemusic`, `link_itunes`, `link_deezer`, `link_amazonmusic`, `link_googleplay`, `link_tidal`) VALUES
	(1, 1, 'Madison', '/assets/img/photos/album_madison_book/00_PochetteAvant.jpg', 'https://open.spotify.com/album/5tUsiwIBO4IZFMte8EkkcO?si=28KYkyTjSXebE2GWhxlysQ', 'https://music.apple.com/fr/album/1531322642?uo=4&app=music&at=1001l34Ux&lId=22318004&cId=none&sr=1&src=Linkfire&itscg=30440&itsct=catchall_p1&ct=LFV_2805aead92b6e14097073b3071c592dd&ls=1', 'https://itunes.apple.com/fr/album/1531322642?uo=4&app=itunes&at=1001l34Ux&lId=22318004&cId=none&sr=3&src=Linkfire&itscg=30440&itsct=catchall_p3&ct=LFV_2805aead92b6e14097073b3071c592dd&ls=1', 'https://www.deezer.com/album/172483402?app_id=140685&utm_source=partner_linkfire&utm_campaign=2805aead92b6e14097073b3071c592dd&utm_medium=Original&utm_term=objective-stream&utm_content=album-172483402', 'https://amazon.fr/dp/B08HSDWK6X?tag=imusician05-21&ie=UTF8&linkCode=as2&ascsubtag=2805aead92b6e14097073b3071c592dd', 'https://play.google.com/store/music/album/Alin%C3%A9a_Madison?id=Ba4yvl3rhoeyh4o6kjnsc2pwh3y&PCamRefID=LFV_1c459a9ca8eb5ef05589b2ae73a5fece&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1', 'http://listen.tidalhifi.com/album/154990559'),
	(2, 1, 'Nouveaux Morceaux', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `music_album` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. music_song
DROP TABLE IF EXISTS `music_song`;
CREATE TABLE IF NOT EXISTS `music_song` (
  `rowid` int(4) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `fk_album_rowid` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path_image` varchar(512) DEFAULT NULL,
  `path_mp3` varchar(512) DEFAULT NULL,
  `lyrics` mediumtext,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `idx_music_song_rowid_name` (`rowid`,`name`),
  KEY `fk_album_rowid` (`fk_album_rowid`),
  CONSTRAINT `music_song_ibfk_1` FOREIGN KEY (`fk_album_rowid`) REFERENCES `music_album` (`rowid`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.music_song : ~26 rows (environ)
/*!40000 ALTER TABLE `music_song` DISABLE KEYS */;
INSERT INTO `music_song` (`rowid`, `active`, `fk_album_rowid`, `name`, `path_image`, `path_mp3`, `lyrics`) VALUES
	(1, 1, 1, 'Madison', '../img/photos/album_madison_backgrounds/madison_madison.jpg', '', 'Madison dans son camion, bandana sur le front\r\nElle sillonne le canton, en chantant "Holiday"\r\nEt sa clope et son blouson, c\'est l\'Américaine "Bombers"\r\nElle fait le job sans question, en chantant du Buckley\r\n\r\nMadison ne demande pas, "qui tu es? Où tu vas?"\r\nFils de rien ou fils de roi, et d\'un coup elle t\'embrasse !\r\nEt les bagues sur ses doigts, quand elle te caresse,\r\nDans les rads, ou sous les croix, les ombres disparaissent.\r\n\r\n__Madison,__\r\n__Les matins des nuits d\'ivresses,__\r\n__Madison,__\r\n__Comme une idée qui traverse,__\r\n__Madison,__\r\n__Plus de mensonge ni promesse,__\r\n__Madison, (Aller! Donne!)__\r\n__Jusqu\'à quand la nuit nous laisse ?__\r\n\r\nMadison dans son appart\', des fumées et des cartes\r\nElle vit dans son monde à part, en écoutant du\r\nBrahms, Avec ses potes et son chat, de la bière au\r\ncafé noir, Et moi j\'perds à chaque fois, que je croise\r\nson regard !\r\n\r\n__Madison,__\r\n__Les matins des nuits d\'ivresses,__\r\n__Madison,__\r\n__Comme une idée qui traverse,__\r\n__Madison,__\r\n__Plus de mensonge ni promesse,__\r\n__Madison,__\r\n__Jusqu\'à quand la nuit nous blesse?__\r\n\r\n__Madison,__\r\n__Quand ton corps se colle et reste,__\r\n__Madison,__\r\n__Dans tes couleurs, ma faiblesse,__\r\n__Madison,__\r\n__Pour qu\'enfin on disparaisse,__\r\n__Madison,__\r\n__Jusqu\'à quand la nuit nous laisse ?__\r\n'),
	(2, 1, 1, 'Soif', '../img/photos/album_madison_backgrounds/madison_soif.jpg', '', 'J\'avais soif, d\'effacer les graines de la réalité\r\nSoif. J\'ai crié, hurlé, mille fois "inachevé"\r\nJ\'avais faim.\r\nFaim de richesses, de caresses, de paresses, de prouesses.\r\nFaim.\r\nFaim de péter des liasses, dans une paires d\'godasses\r\nDe plaquer mon taf, d\'exploser des faces,\r\nDe m\'envoyer le foie dans l\'"rad" d\'en face,\r\n\r\n__De m\'envoler.__\r\n\r\nJ\'avais soif, soif de fréquentations, de monter d\'un ton\r\nSoif. J\'ai prié, supplié, nos dieux éphémères\r\nMais rien.\r\nRien, ni richesse, ni tendresse, noblesse, prouesse\r\nRien.\r\nRien que des catins en grâce, dans les grandes surfaces,\r\nRien qu\'un p\'tit humain, perdu dans l\'espace\r\nUne épave au loin, fondue dans la masse,\r\n\r\n__J\'veux m\'envoler!__\r\n\r\n__Soif!__\r\n__D\'un instinct de celles, d\'un instant si belles,__\r\n__D\'un printemps français, d\'altérer le ciel,__\r\n__D\'inspirer des rêves, de désirs funèbres,__\r\n__L\'appétit au ventre, de pulsions mortelles,__\r\n__Soif!__\r\n__De toi dans ma couche, de moi sur ta bouche__\r\n__D\'étancher ma Brune, d\'allumer la lune__\r\n__D\'assombrir mes envies qu\'ont dansées ma vie__\r\n__D\'épancher ma soif, d\'épancher ma soif!__\r\n__De plus croire en rien, de lâcher les chiens__\r\n__De détonateurs, d\'aller voir ailleurs__\r\n__De briser ma cage, de crier ma rage...__\r\n'),
	(3, 1, 1, 'Le Placard', '../img/photos/album_madison_backgrounds/madison_le-placard.jpg', '', 'J\'ai fait l\'inventaire, des petites choses, de nos affaires\r\nJ\'ai pris ma guitare, déposé des roses sur ton placard.\r\n\r\nJ\'ai fait le bilan, des états d\'âmes, des sentiments\r\nJ\'écris des chansons comme thérapie des émotions.\r\n\r\nJ\'ai fait le silence aux aléas de ma conscience\r\nJ\'ai pris ma guitare, déposé les clés sur le placard.\r\n'),
	(4, 1, 1, 'L\'Exil', '../img/photos/album_madison_backgrounds/madison_lexil.jpg', '', 'Qui a pris ma mémoire?\r\nJ\'ai un prix!\r\nMon Karma, mon histoire\r\nEt mes nuits\r\nComme un jeu de hasard\r\nQui me suit\r\n\r\nQui a pris ma conscience?\r\nJ\'imagine\r\nQu\'il faut croire à la chance\r\nC\'est logique\r\n\r\nQui a plongé les miens,\r\nDans l\'oubli\r\nC\'est la foire aux destins\r\nMais j\'ai un prix!\r\n\r\nQui a piqué demain\r\nD\'inutile\r\nDes hommes qui n\'rêvent de rien\r\nQue la ruine\r\n\r\n__Moi je m\'exile, je m\'exile, je m\'exile__\r\n__Dans ce mon à l\'envers, dans ce monde à l\'enfer,__\r\n__Je m\'exile, je m\'exile, je m\'exile__\r\n__Si c\'était à refaire, et si c\'était à faire?__\r\n\r\n__Moi je m\'exile, je m\'exile, je m\'exile,__\r\n__Je ne sais plus quoi faire, de nos imaginaires__\r\n__Je m\'exile, je m\'exile, je m\'exile__\r\n__Bat mon solitaire dans ce monde à l\'envers__\r\n'),
	(5, 1, 1, 'Pas d\'autre Monde', '../img/photos/album_madison_backgrounds/madison_pas-dautre-monde.jpg', '', 'Voyager dans d\'autres temps, pour oublier ses problèmes\r\nPardonner les bons moments, éteindre les systèmes\r\nS\'évader, je ne sais comment, quand c\'est toujours la même\r\nTournent la vie et les vents, et tout n\'est que poèmes\r\n\r\nPurifiés de nos tourments, quand plus rien ne saigne\r\nDans les spirales du temps, quand plus rien ne s\'aime\r\nAbîmés de nos images, quand le bonheur succombe\r\nEt annoter en bout de marges, qu\'il n\'y a pas d\'autres mondes\r\n\r\n__Pas d\'autre monde__\r\n__Pas d\'autre monde__\r\n\r\nToi qui restes vigilant, ne perds pas tes secondes\r\nToi qui ne sais pas vraiment, mais qui est ta Joconde?\r\nSi je me traîne à l\'enfant, que je m\'attarde en somme\r\nC\'est pour prendre le temps de comprendre, qu\'il n\'y a pas d\'autres mondes\r\n\r\n__Pas d\'autre monde__\r\n__Pas d\'autre monde__\r\n'),
	(6, 1, 1, 'Post-It', '../img/photos/album_madison_backgrounds/madison_post-it.jpg', '', 'Il faudra bien se dire merci, le taire mais le dire, mon ami\r\n\r\nIl faudra bien se dire je t\'aime, le taire mais le dire quand même\r\n\r\nIl faudra bien se dire un jour, il faudra bien le dire, mon amour!\r\n\r\nFaudra bien le dire! Le dire un jour!\r\n\r\nFaudra bien le dire, mon amour\r\n'),
	(7, 1, 1, 'Le Placard (instrumental)', '../img/photos/album_madison_backgrounds/madison_le-placard-instru.jpg', '', '...'),
	(8, 1, 1, 'Si tu vas bien', '../img/photos/album_madison_backgrounds/madison_si-tu-vas-bien.jpg', '', 'Je revois ta lumière et j\'y serai demain\r\nOn sort enfin du désert mais toujours on y revient\r\nC\'est l\'enfer avant un point, c\'est une issue sans fin\r\nOn connait l\'entrée du désert mais jamais on en revient\r\n\r\n__Tu partiras tout-à-l\'heure, tu reviendras demain__\r\n__Pour mes brûlures d\'accord, mais si toi tu vas bien__\r\n__Tu partiras tout-à-l\'heure, tu reviendras demain__\r\n__Quand mes blessures se ferment, déjà, tu me reviens__\r\n\r\nJe repars en arrière, et j\'y serai demain\r\nJe reviendrai au désert comme on revient aux siens\r\nJe garde les bras ouverts, sans me tenir trop bien\r\nQuand on sort d\'une misère, une autre vient\r\n\r\n__Tu partiras tout-à-l\'heure, tu reviendras demain__\r\n__Quand mes blessures se ferment, déjà, tu me reviens__\r\n__Tu partiras tout-à-l\'heure, tu reviendras demain__\r\n__Pour mes brûlures d\'accord, mais si toi tu t\'en tires bien__\r\n\r\nJe reprendrai mes repères, garderai les même trains\r\nEngendrerai mes hivers, harmoniserai mes vieux refrains\r\nMais la source d\'une rivière, est-elle ou n\'est-elle point ?\r\nFaibles larmes dans la mer comme au désert le simple grain\r\n\r\n__Tu partiras tout-à-l\'heure, tu reviendras demain__\r\n__Pour mes brûlures d\'accord, si toi tu t\'en tires bien__\r\n__Tu partiras tout-à-l\'heure, tu reviendras demain__\r\n__Pour mes brûlures d\'accord, mais si toi tu vas bien__\r\n'),
	(9, 1, 1, 'Blanc et Noir', '../img/photos/album_madison_backgrounds/madison_blanc-et-noir.jpg', '', 'Distinguer le blanc du noir\r\nDes panoplies de songes, et chacun son histoire\r\nAfficher, en blanc et noir\r\nDes plaisirs illustrés, des rêves ou des cauchemars\r\n\r\nVoir les choses, en blanc ou noir\r\nPour effacer les gestes, encaisser l\'espoir\r\nDiluer, en blanc ou noir\r\nLe bonheur encadré, jusqu\'à la petite mort\r\n\r\nMélanger en blanc et noir\r\nNos ambitions croissantes, noyées dans le miroir\r\nEffacer, le blanc, le noir\r\nDiluer les nuances du fond de ton regard\r\n\r\n__Ou blanc ou noir__\r\n__Distinguer le blanc du noir__\r\n'),
	(10, 1, 1, 'Des foules de toi', '../img/photos/album_madison_backgrounds/madison_des-foules-de-toi.jpg', '', 'Encore un temps pour penser, on aurait donné nos vies jusqu\'au dernier souffle\r\nEncore faut-il accepter, que le temps qui est promis est bien trop court\r\nEncore le temps de rêver, je vais penser à toi jusqu\'au petit jour\r\nAlors faut-il accepter les chiens aux abois ou les poupées sourdes?\r\n\r\nC\'est full en toi, tu sais, ces foules en toi\r\nDes foules de toi, partout, que des full de toi.\r\n\r\nEncore un temps pour oser, ce matin mes Amis, je deviens sourd\r\nEncore faut-il traverser la folie, la peur, les armures,\r\nToujours, pourtant je le sais, que tous nos démons ne sont que nos atours,\r\nUnis vers la liberté, de choisir les nuits, les nuits de nos jours.\r\n\r\nC\'est full en toi, tu sais, ces foules en toi\r\nDes foules de toi, partout, que des full de toi.\r\n\r\nQuand nos rêves nous échappent, comme une réalité\r\nQuand le temps nous rattrape, pour tous nous effacer\r\nQuand les lèvres trahissent, quand on comprend l\'esquisse\r\nQuand les rêves nous réveillent.\r\n\r\nC\'est full en toi, tu sais depuis, que c\'est full en toi\r\nC\'est foules en toi, tu sais depuis, que des foules de toi\r\nCes foules, c\'est full, partout, des foules de toi. Tu sais déjà ?\r\nCes foules de toi\r\nFull de toi\r\nFull de toi.\r\n'),
	(11, 1, 1, 'J\'ai pas les mots', '../img/photos/album_madison_backgrounds/madison_jai-pas-les-mots.jpg', '', 'J\'ai pas vraiment les mots qu\'il faut\r\nJ\'ai pas vraiment les idées claires\r\nPas expert en la matière\r\nJ\'ai pas les mots, j\'ai pas les mots qu\'il faut\r\n\r\nJ\'ai pas toujours le nécessaire\r\nPour affronter mes idéaux\r\nLes mains tendues en revolver\r\nJ\'ai pas les mots; j\'ai pas les mots qu\'il faut\r\n\r\n__Y\'a mes envies, mes envers, dans des puits de lumière__\r\n__De vie en vies, de verres en vers, dans mes nuits de poussière__\r\n\r\nJ\'ai pas compris mon dictionnaire\r\nJ\'fais d\'l\'audimate dans mon studio\r\nJ\'traine des liasses le nez en l\'air\r\nJ\'ai pas les mots, j\'ai pas les mots qu\'il faut\r\n\r\n__Y\'a mes envies, mes envers, dans des puits de lumière__\r\n__De vie en vies, de verres en vers, dans mes nuits de poussière__\r\n__Y\'a mes envies, mes envers, dans des puits de lumière__\r\n__De vie en vies, de verres en vers, dans mes nuits de poussière__\r\n\r\nQu\'est-ce que tu vois?\r\nDans ces nuits là, qu\'est-ce que tu vois?\r\nDans mes nuits de poussières\r\n'),
	(12, 1, 1, 'J\'écrirais', 'https://source.unsplash.com/5_Ez6yEh8EE/500x300', '', 'J\'écrirais bien quelques poèmes,\r\nJ\'écrirais bien quelques amours\r\nPourquoi pas un vieux requiem,\r\nUne histoire à dormir debout\r\nJ\'écrirais bien un carpe diem avec du bleu un peu partout\r\nEt si tu me dis que tu m\'aimes,\r\nJe veux bien redevenir fou.\r\n\r\nJ\'écrirais bien quelques poèmes,\r\nJ\'écrirais bien quelques amours\r\nPuisque les rimes restent les mêmes,\r\nPuisque le temps joue contre nous\r\nJ\'écrirais bien un carpe diem avec du rouge un peu partout\r\nPuisqu\'elles sont mortes mes bohèmes,\r\nPuisque c\'est ici qu\'on s\'échoue.\r\n\r\nJ\'écrirais bien quelques poèmes,\r\nJ\'écrirais bien quelques amours\r\nPuisqu\'elles sont mortes mes bohèmes,\r\nPuisque c\'est ici qu\'on s\'échoue…\r\n'),
	(13, 1, 1, 'Des bémols et des dièses', 'https://source.unsplash.com/rPOmLGwai2w/500x300', '/assets/audio/ALINEA_des-bemoles-et-des-dieses.mp3', 'Au fil des SOS,\r\nCes vagues à l\'âme qui nous enfumes\r\nDes sociétés en laisse,\r\nLa face cachée de sa plume\r\nImpatient de jeunesse. Il invente, il résume\r\n\r\nAu fil de ses ivresses,\r\nCes états d\'âmes qui nous bousculent\r\nDes amours qui s\'affaissent,\r\nPour colorer ses amertumes\r\nL\'imminente promesse. Il crée, il présume\r\n\r\n__Solo__\r\n\r\nEntre les parenthèses,\r\nLe prestige de ses vertus\r\nComme soufflant dans la braise,\r\nIl parle à des statues\r\nAppauvri de sa faiblesse. Il arpente, se consume\r\n\r\nDes bémols et des dièses,\r\nAux moments incongrus\r\nDes deux mains que l\'on baise,\r\nDes temps inattendus\r\nSon bock de Bordelaise à la main, il s\'imagine un futur…\r\n\r\n__Solo__\r\n'),
	(14, 1, 2, 'Y\'a pas besoin', '', '/assets/audio/ALINEA_ya-pas-besoin.mp3', 'Y\'a pas besoin\r\n\r\nY\'a pas besoin, d\'un scénario\r\nY\'a pas besoin, de stéréo\r\nY\'a pas besoin, d\'ouvrir mes yeux\r\nY\'a pas besoin, de nos aveux\r\n\r\nY\'a pas besoin de parler fort\r\nY\'a pas besoin de faire semblant\r\nY\'a pas besoin d\'être en accord\r\nY\'a pas besoin d\'un dominant\r\nY\'a pas besoin que tu me blesses\r\nY\'a pas besoin que tu me testes\r\nY\'a pas besoin de forteresse\r\nY\'a pas besoin d\'autre jeunesse\r\n\r\nY\'a pas besoin de formulaire\r\nY\'a pas besoin que l\'on soit beau\r\nY\'a pas besoin de voir la mer\r\nY\'a pas besoin d\'écrire des mots\r\n\r\nY\'a pas besoin des autoroutes\r\nY\'a pas besoin qu\'on en rajoute\r\nY\'a pas besoin d\'être intello\r\nY\'a pas besoin contre ta peau\r\n\r\nContre ta peau, y\'a pas besoin\r\nContre ta peau, y\'a pas besoin\r\nY\'a pas besoin,\r\nContre ta peau\r\n'),
	(15, 1, 2, 'Permettez!', '', '/assets/audio/ALINEA_permettez!.mp3', 'Il me vient, certains soirs, des idées\r\nMesdames, et Messieurs, permettez...\r\nJe ne suis pas du genre à m\'étaler\r\nMais si ça vous dit d\'en parler\r\nIl me vient, certains soirs, des pensées\r\n\r\nJe m\'attarde, certains soirs, à penser\r\nMesdames, et messieurs permettez...\r\nJ\'ai perdu au jeu de l\'égalité\r\nDes morceaux de moi ont sombré\r\nIl me vient certains soirs, des pensées\r\n\r\nJe me charme, au matin, de verser\r\nMesdames, et Messieurs, permettez!\r\nQuelques larmes aux heures d\'exquises libertés\r\n\r\nMoi qui ne sais plus où aller...\r\nIl me vient, par moments, des pensées\r\n');
/*!40000 ALTER TABLE `music_song` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. preference
DROP TABLE IF EXISTS `preference`;
CREATE TABLE IF NOT EXISTS `preference` (
  `rowid` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.preference : ~0 rows (environ)
/*!40000 ALTER TABLE `preference` DISABLE KEYS */;
/*!40000 ALTER TABLE `preference` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `rowid` int(4) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `purchase_url` varchar(512) DEFAULT NULL,
  `price` decimal(4,2) DEFAULT NULL,
  `description` mediumtext,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `idx_product_rowid_name` (`rowid`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.product : ~0 rows (environ)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`rowid`, `active`, `name`, `purchase_url`, `price`, `description`) VALUES
	(1, 1, 'Hoodie - blanc', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=1305', 50.33, 'Coupe décontractée, 100% coton éponge française, capuche non doublée, épaules tombantes, poche kangourou, cordon de serrage en métal de couleur assortie, ourlet et poignets côtelés, pré-rétréci pour minimiser le rétrécissement. N (tailles : XS , S , M , L , XL) (couleur : blanc)'),
	(2, 1, 'Sweat manches longues - gris', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=756&variation=103344&size=4375', 29.99, 'Coupe \'Slim fit\', unisexe. Matériaux : 100% coton doux premium. \n (tailles : S , M , L , XL , 2XL) (couleur: gris)'),
	(3, 1, 'Sweat manches longues - blanc', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=756&variation=103355&size=4375', 29.99, 'Coupe \'Slim fit\', unisexe. Matériaux : 100% coton doux premium. \n (tailles : S , M , L , XL , 2XL) (couleur: blanc)'),
	(4, 1, 'Débardeur femme - blanc', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=536', 28.99, 'Coupe drapée décontractée, ourlet inférieur froncé, style dos nageur. Matériaux : 65% poly / 35% viscose. \n (tailles : S , M , L , XL) (couleur: blanc)'),
	(5, 1, 'Chaussettes - noires', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=655&variation=102829&size=4201', 19.98, 'Matériaux : 100% polyester. (Taille unique) (couleur : noir).'),
	(6, 1, 'Chaussettes - blanches', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=655&variation=102848&size=4201', 19.98, 'Matériaux : 100% polyester. (Taille unique) (couleur : noir).'),
	(7, 1, 'Sac écologique - noir', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=932&variation=103878&size=4816', 29.99, 'Les sacs à main écologiques ont une capacité de stockage de 18 litres et une grande ouverture parfaite pour transporter et accéder aux articles. Ces sacs à main de la collection Conscious sont certifiés par la norme Global Organic Textile Standard. Matériaux : 100% coton organique. (Taille : 38cm x 35cm) (couleur : noir).'),
	(8, 1, 'Sac écologique - beige', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=932&variation=103878&size=4816', 29.99, 'Les sacs à main écologiques ont une capacité de stockage de 18 litres et une grande ouverture parfaite pour transporter et accéder aux articles. Ces sacs à main de la collection Conscious sont certifiés par la norme Global Organic Textile Standard. Matériaux : 100% coton organique. (Taille : 38cm x 35cm) (couleur : beige).'),
	(9, 1, 'Sticker - noir', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=661&variation=102915&size=4211', 8.99, '(Tailles : 9.15 x 12.7 cm  ou  12.7 x 17.8 cm) (couleur : noir).'),
	(10, 1, 'Sticker - blanc', 'https://alina-musique.creator-spring.com/listing/alinea-musique?product=661&variation=102914&size=4211', 8.99, '(Tailles : 9.15 x 12.7 cm  ou  12.7 x 17.8 cm) (couleur : blanc).');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. productimage
DROP TABLE IF EXISTS `productimage`;
CREATE TABLE IF NOT EXISTS `productimage` (
  `rowid` int(4) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `fk_product_rowid` int(4) NOT NULL,
  `path_image` varchar(512) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `alt_text` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `idx_rowid_title` (`rowid`,`title`),
  KEY `fk_product_rowid` (`fk_product_rowid`),
  CONSTRAINT `productimage_ibfk_1` FOREIGN KEY (`fk_product_rowid`) REFERENCES `product` (`rowid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.productimage : ~0 rows (environ)
/*!40000 ALTER TABLE `productimage` DISABLE KEYS */;
INSERT INTO `productimage` (`rowid`, `active`, `fk_product_rowid`, `path_image`, `title`, `alt_text`) VALUES
	(1, 1, 1, 'assets/img/products/hoodie-white/front.jpg', 'Hoodie Blanc - devant', 'Hoodie Blanc - devant'),
	(2, 1, 1, 'assets/img/products/hoodie-white/back.jpg', 'Hoodie Blanc - au dos', 'Hoodie Blanc - au dos'),
	(3, 1, 2, 'assets/img/products/longsleeve-black/front.jpg', 'Sweat manches longues - gris - devant', 'Sweat manches longues - gris - devant'),
	(4, 1, 2, 'assets/img/products/longsleeve-black/back.jpg', 'Sweat manches longues - gris - au dos', 'Sweat manches longues - gris - au dos'),
	(5, 1, 3, 'assets/img/products/longsleeve-white/front.jpg', 'Sweat manches longues - blanc - devant', 'Sweat manches longues - blanc - devant'),
	(6, 1, 3, 'assets/img/products/longsleeve-white/back.jpg', 'Sweat manches longues - blanc - au dos', 'Sweat manches longues - blanc - au dos'),
	(7, 1, 4, 'assets/img/products/women-flowy-tank-top/front.jpg', 'Débardeur femme - blanc - devant', 'Débardeur femme - blanc - devant'),
	(8, 1, 4, 'assets/img/products/women-flowy-tank-top/back.jpg', 'Débardeur femme - blanc - au dos', 'Débardeur femme - blanc - au dos'),
	(9, 1, 5, 'assets/img/products/socks-black/front.jpg', 'Chaussettes - noires', 'Chaussettes - noires'),
	(10, 1, 6, 'assets/img/products/socks-white/front.jpg', 'Chaussettes - blanches', 'Chaussettes - blanches'),
	(11, 1, 7, 'assets/img/products/bag-black/front.jpg', 'Sac écologique - noir - devant', 'Sac écologique - noir - devant'),
	(12, 1, 7, 'assets/img/products/bag-black/back.jpg', 'Sac écologique - noir - derrière', 'Sac écologique - noir - derrière'),
	(13, 1, 8, 'assets/img/products/bag-white/front.jpg', 'Sac écologique - beige - devant', 'Sac écologique - beige - devant'),
	(14, 1, 8, 'assets/img/products/bag-white/back.jpg', 'Sac écologique - beige - derrière', 'Sac écologique - beige - derrière'),
	(15, 1, 9, 'assets/img/products/sticker-black/front.jpg', 'Sticker - noir', 'Sticker - noir'),
	(16, 1, 10, 'assets/img/products/sticker-white/white.jpg', 'Sticker - blanc', 'Sticker - blanc');
/*!40000 ALTER TABLE `productimage` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. right
DROP TABLE IF EXISTS `right`;
CREATE TABLE IF NOT EXISTS `right` (
  `rowid` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.right : ~23 rows (environ)
/*!40000 ALTER TABLE `right` DISABLE KEYS */;
INSERT INTO `right` (`rowid`, `name`, `description`) VALUES
	(1, 'Ajouter des photos "dans" la gallerie', 'Permet d ajouter des photos dans la gallerie.'),
	(2, 'Supprimer des photos de la gallerie', 'La photo sera alors supprimée du serveur. Faire attention.'),
	(3, 'Modifier les informations de photos de la gallerie', ''),
	(4, 'Ajouter un membre du groupe ou du staff', ''),
	(5, 'Voir les comptes des membres du groupe ou du staff', 'Permet de voir les informations (sauf sensibles) de ces comptes.'),
	(6, 'Rendre inactif un membre du groupe ou du staff', ''),
	(7, 'Modifier les informations du compte d un membre du groupe un du staff', ''),
	(8, 'Supprimer un membre du groupe ou du staff', ''),
	(9, 'Ajouter un compte fan', ''),
	(10, 'Voir les informations d un compte fan', ''),
	(11, 'Rendre inactif un compte fan', ''),
	(12, 'Modifier les informations d un compte fan', ''),
	(13, 'Supprimer un compte fan', ''),
	(14, 'Ajouter des concerts', 'Permet d ajouter des dates et informations pour les concerts à venir dans la page Tour.'),
	(15, 'Supprimer des concerts', 'Permet de supprimer des dates et informations de concerts dans la page Tour.'),
	(16, 'Ajouter des Albums de musique', ''),
	(17, 'Rendre actif/inactif un album de musique', ''),
	(18, 'Modifier les informations d un album de musique', ''),
	(19, 'Supprimer un Album de musique', 'Par mesure sécurité les morceaux/chansons liés ne seront pas supprimés de la base de données'),
	(20, 'Ajouter des morceaux de musique', ''),
	(21, 'Rendre actif/inactif un morceau de musique', ''),
	(22, 'Modifier les informations d un morceau de musique', 'Utile pour modifier les paroles , mais attention car permet aussi de modifier les images ou la vignette liées au morceau.'),
	(23, 'Supprimer un morceau de musique', 'Les fichiers physiques stockés sur le serveur ne seront pas supprimés, mais les chemins vers ces fichiers seront supprimés de la base de donnée.');
/*!40000 ALTER TABLE `right` ENABLE KEYS */;

-- Listage de la structure de la table db_alinea. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `rowid` int(5) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `pass_encoded` varchar(128) NOT NULL DEFAULT '',
  `fk_group_rowid` int(4) NOT NULL,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datelastconnection` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `idx_rowid_login` (`rowid`,`login`),
  KEY `fk_group_rowid` (`fk_group_rowid`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`fk_group_rowid`) REFERENCES `group` (`rowid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table db_alinea.user : ~8 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`rowid`, `active`, `login`, `pass`, `pass_encoded`, `fk_group_rowid`, `datecreation`, `datelastconnection`, `email`) VALUES
	(1, 1, 'christophe', '0uvreToi!ali', '', 1, '2022-05-29 09:17:25', '2022-05-29 09:17:25', 'christophe.gourmand@gmail.com'),
	(2, 1, 'thierry', 'thierry_guitare', '', 1, '2022-05-29 09:17:25', '2022-05-29 09:17:25', 'alineamusique@gmail.com'),
	(3, 1, 'nini', 'nini_micro', '', 2, '2022-05-29 09:17:25', '2022-05-29 09:17:25', ''),
	(4, 1, 'nico', 'nico_batterie', '', 1, '2022-05-29 09:17:25', '2022-05-29 09:17:25', 'civifrance8@gmail.com'),
	(5, 0, 'ronron', 'ronron_basse', '', 2, '2022-05-29 09:17:25', '2022-05-29 09:17:25', ''),
	(6, 0, 'simone', 'simone_piano', '', 2, '2022-05-29 09:17:25', '2022-05-29 09:17:25', ''),
	(7, 1, 'olivier', 'olivier_clavier', '', 2, '2022-05-29 09:17:25', '2022-05-29 09:17:25', ''),
	(8, 1, 'anthony', 'anthony_guitare', '', 2, '2022-05-29 09:17:25', '2022-05-29 09:17:25', '');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
