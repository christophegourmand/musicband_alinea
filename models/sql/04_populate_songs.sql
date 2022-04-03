USE db_alinea;


-- insertion des noms de morceaux pour l'album "Madison" (rowid = 1)
INSERT INTO songs
(
    fk_album
    , name
    , image
)
VALUES
    (1 , "Madison" , "../img/photos/album_madison_backgrounds/madison_madison.jpg")
    , (1 , "Soif" , "../img/photos/album_madison_backgrounds/madison_soif.jpg")
    , (1 , "Le Placard" , "../img/photos/album_madison_backgrounds/madison_le-placard.jpg")
    , (1 , "L'Exil" , "../img/photos/album_madison_backgrounds/madison_lexil.jpg")
    , (1 , "Pas d'autre Monde" , "../img/photos/album_madison_backgrounds/madison_pas-dautre-monde.jpg")
    , (1 , "Post-It" , "../img/photos/album_madison_backgrounds/madison_post-it.jpg")
    , (1 , "Le Placard (instrumental)" , "../img/photos/album_madison_backgrounds/madison_le-placard-instru.jpg")
    , (1 , "Si tu vas bien" , "../img/photos/album_madison_backgrounds/madison_si-tu-vas-bien.jpg")
    , (1 , "Blanc et Noir" , "../img/photos/album_madison_backgrounds/madison_blanc-et-noir.jpg")
    , (1 , "Des foules de toi" , "../img/photos/album_madison_backgrounds/madison_des-foules-de-toi.jpg")
    , (1 , "J'ai pas les mots" , "../img/photos/album_madison_backgrounds/madison_jai-pas-les-mots.jpg")
    , (1 , "J'écrirais" , "https://source.unsplash.com/5_Ez6yEh8EE/500x300")
    , (1 , "Des bémols et des dièses" , "https://source.unsplash.com/rPOmLGwai2w/500x300")
;


-- insertion des noms de morceaux pour l'album "Nouveaux Morceaux" (rowid = 2)
INSERT INTO songs
(
    fk_album
    , name
    , image
)
VALUES
    (2 , "Y'a pas besoin" , "")
    , (2 , "Permettez!" , "")
;