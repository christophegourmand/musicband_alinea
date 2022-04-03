USE db_alinea;

-- creation des utilisateurs qui pourront se connecter sur le site
INSERT INTO user 
(login, pass)
VALUES 
    ('thierry','thierry_guitare')
    , ('nini','nini_micro')
    , ('nico','nico_batterie')
    , ('ronron','ronron_bass')
    , ('simone','simone_piano')
    , ('olivier','olivier_clavier')
    , ('anthony','anthony_guitare')
;