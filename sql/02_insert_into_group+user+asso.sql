USE db_alinea;

-- SECTION : creation des roles pour les utilisateurs
INSERT INTO `group`
(`groupname`)
VALUES
    ('webadmin')
    , ('band_musicians')
    , ('band_staff')
    , ('fan')
;

-- SECTION : créer des droits pour les utilisateurs
    -- TODO : delete these insertions when php-code only use the sql-table called `group_right`

INSERT INTO `right`
    (`name`, `description`)
VALUES
    ('Ajouter des photos "dans" la gallerie', 'Permet d ajouter des photos dans la gallerie.')
    , ('Supprimer des photos de la gallerie', 'La photo sera alors supprimée du serveur. Faire attention.')
    , ('Modifier les informations de photos de la gallerie' , '')

    , ('Ajouter un membre du groupe ou du staff' , '')
    , ('Voir les comptes des membres du groupe ou du staff' , 'Permet de voir les informations (sauf sensibles) de ces comptes.')
    , ('Rendre inactif un membre du groupe ou du staff' , '')
    , ('Modifier les informations du compte d un membre du groupe un du staff' , '')
    , ('Supprimer un membre du groupe ou du staff' , '')

    , ('Ajouter un compte fan' , '')
    , ('Voir les informations d un compte fan' , '')
    , ('Rendre inactif un compte fan' , '')
    , ('Modifier les informations d un compte fan' , '')
    , ('Supprimer un compte fan' , '')

    
    , ('Ajouter des concerts' , 'Permet d ajouter des dates et informations pour les concerts à venir dans la page Tour.')
    , ('Supprimer des concerts' , 'Permet de supprimer des dates et informations de concerts dans la page Tour.')
    
    , ('Ajouter des Albums de musique' , '')
    , ('Rendre actif/inactif un album de musique' , '')
    , ('Modifier les informations d un album de musique' , '')
    , ('Supprimer un Album de musique' , 'Par mesure sécurité les morceaux/chansons liés ne seront pas supprimés de la base de données')

    , ('Ajouter des morceaux de musique' , '')
    , ('Rendre actif/inactif un morceau de musique' , '')
    , ('Modifier les informations d un morceau de musique' , 'Utile pour modifier les paroles , mais attention car permet aussi de modifier les images ou la vignette liées au morceau.')
    , ('Supprimer un morceau de musique' , 'Les fichiers physiques stockés sur le serveur ne seront pas supprimés, mais les chemins vers ces fichiers seront supprimés de la base de donnée.')
;

-- TODO : delete these insertions when php-code only use the sql-table called `group_right`
INSERT INTO `asso_group_right`
(`fk_group_rowid` , `fk_right_rowid`)
VALUES
-- group 1:webadmin
    (1,1)
    ,(1, 2)
    ,(1, 3)
    ,(1, 4)
    ,(1, 5)
    ,(1, 6)
    ,(1, 7)
    ,(1, 8)
    ,(1, 9)
    ,(1, 10)
    ,(1, 11)
    ,(1, 12)
    ,(1, 13)
    ,(1, 14)
    ,(1, 15)
    ,(1, 16)
    ,(1, 17)
    ,(1, 18)
    ,(1, 19)
    ,(1, 20)
    ,(1, 21)
    ,(1, 22)
    ,(1, 23)

-- group 2:musicien
    ,(2, 1) -- droits pour les comptes musiciens+staff 
    ,(2, 2)
    ,(2, 3)
    ,(2, 5)
    ,(2, 9) -- droits pour les comptes fan
    ,(2, 10)
    ,(2, 11)
    ,(2, 12)
    ,(2, 14) -- droits pour la gestion des concerts
    ,(2, 15)
    ,(2, 18) -- droits pour la gestion des albums musique
    ,(2, 20)
    ,(2, 21)
    ,(2, 22)
    ,(2, 23)

-- group 3:staff
    ,(3, 3)
    ,(3, 4)
    ,(3, 5)
    ,(3, 11)
    ,(3, 14)
    ,(3, 15)
    ,(3, 18)
    ,(3, 22)
-- group 4:fan
    -- aucun droit pour l'instant
;

-- SECTION : creation des droits 
INSERT INTO `group_right`
    (`fk_group_rowid`, `tablename`, `can_create`, `can_see`, `can_modify`, `can_delete`, `can_activate`)
VALUES
    (1,'actu',1,1,1,1,1),
    (2,'actu',1,1,1,1,1),
    (3,'actu',1,1,1,1,1),
    (4,'actu',0,0,0,0,0),
    (1,'albumphoto',1,1,1,1,null),
    (2,'albumphoto',1,1,1,0,null),
    (3,'albumphoto',1,1,1,0,null),
    (4,'albumphoto',0,0,0,0,null),
    (1,'ass_user_preference',1,1,1,1,null),
    (2,'ass_user_preference',0,0,0,0,null),
    (3,'ass_user_preference',0,0,0,0,null),
    (4,'ass_user_preference',0,0,0,0,null),
    (1,'asso_group_right',1,1,1,1,null),
    (2,'asso_group_right',0,1,0,0,null),
    (3,'asso_group_right',0,1,0,0,null),
    (4,'asso_group_right',0,0,0,0,null),
    (1,'bio',1,1,1,1,1),
    (2,'bio',0,1,1,0,1),
    (3,'bio',0,0,0,0,0),
    (4,'bio',0,0,0,0,0),
    (1,'concert',1,1,1,1,1),
    (2,'concert',1,1,1,1,1),
    (3,'concert',1,1,1,1,1),
    (4,'concert',0,0,0,0,0),
    (1,'group',1,1,1,1,1),
    (2,'group',0,1,0,0,0),
    (3,'group',0,1,0,0,0),
    (4,'group',0,0,0,0,0),
    (1,'music_album',1,1,1,1,1),
    (2,'music_album',0,1,1,0,0),
    (3,'music_album',0,1,1,0,0),
    (4,'music_album',0,0,0,0,0),
    (1,'music_song',1,1,1,1,1),
    (2,'music_song',1,1,1,1,1),
    (3,'music_song',0,1,1,0,0),
    (4,'music_song',0,0,0,0,0),
    (1,'photo',1,1,1,1,1),
    (2,'photo',1,1,1,1,1),
    (3,'photo',1,1,1,0,1),
    (4,'photo',0,0,0,0,0),
    (1,'preference',1,1,1,1,1),
    (2,'preference',0,1,0,0,0),
    (3,'preference',0,1,0,0,0),
    (4,'preference',0,0,0,0,0),
    (1,'product',1,1,1,1,1),
    (2,'product',0,1,0,0,0),
    (3,'product',0,1,0,0,0),
    (4,'product',0,0,0,0,0),
    (1,'product_image',1,1,1,1,1),
    (2,'product_image',0,1,0,0,0),
    (3,'product_image',0,1,0,0,0),
    (4,'product_image',0,0,0,0,0),
    (1,'right',1,1,1,1,1),
    (2,'right',0,0,0,0,0),
    (3,'right',0,0,0,0,0),
    (4,'right',0,0,0,0,0),
    (1,'user.webadmin',1,1,1,1,1),
    (2,'user.webadmin',0,1,0,0,0),
    (3,'user.webadmin',0,1,0,0,0),
    (4,'user.webadmin',0,0,0,0,0),
    (1,'user.band_musicians',1,1,1,1,1),
    (2,'user.band_musicians',0,1,0,0,0),
    (3,'user.band_musicians',1,1,0,0,0),
    (4,'user.band_musicians',1,0,0,0,0),
    (1,'user.band_staff',1,1,1,1,1),
    (2,'user.band_staff',0,1,0,0,0),
    (3,'user.band_staff',1,1,0,0,0),
    (4,'user.band_staff',1,0,0,0,0),
    (1,'user.fan',1,1,1,1,1),
    (2,'user.fan',1,1,1,0,1),
    (3,'user.fan',0,0,0,0,1),
    (4,'user.fan',0,0,0,0,0)
;



-- SECTION : creation des utilisateurs qui pourront se connecter sur le site
-- INSERT INTO `user` 
-- (`active` , `login` , `pass` , `fk_group_rowid`, `email`)
-- VALUES 
--     (1, 'christophe', '0uvreToi!ali', 1 , 'christophe.gourmand@gmail.com')
--     , (1 , 'thierry' , 'thierry_guitare' , 1 , 'alineamusique@gmail.com')
--     , (1 , 'nini' , 'nini_micro' , 2 , '') -- nicki.rafidy@wanadoo.fr (avoir son accord)
--     , (1 , 'nico' , 'nico_batterie' , 1 , 'civifrance8@gmail.com')
--     , (0 , 'ronron' , 'ronron_basse' , 2 , '')
--     , (0 , 'simone' , 'simone_piano' , 2 , '')
--     , (1 , 'olivier' , 'olivier_clavier' , 2 , '') -- berton.olivier@yahoo.com (avoir son accord)
--     , (1 , 'anthony' , 'anthony_guitare' , 2 , '') -- anthonyplaisir@hotmail.com (avoir son accord)
-- ;