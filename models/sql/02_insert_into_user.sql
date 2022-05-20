USE db_alinea;

-- creation des utilisateurs qui pourront se connecter sur le site
INSERT INTO user 
(login, pass, active)
VALUES 
    ('thierry','thierry_guitare' , 1)
    , ('nini','nini_micro' , 1)
    , ('nico','nico_batterie' , 1)
    , ('ronron','ronron_basse' , 0)
    , ('simone','simone_piano' , 0)
    , ('olivier','olivier_clavier' , 1)
    , ('anthony','anthony_guitare' , 1)
;