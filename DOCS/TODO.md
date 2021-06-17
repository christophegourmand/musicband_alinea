usefull icons in this file: 
❌⭕⛔🆘❓❗✅♻🆗🔀🔜
🔴🟠🟡🟢🔵🟣🟤⚫⚪
🟥🟧🟨🟩🟦🟪🟫⬛⬜
🔶🔸🔷🔹🔺💭🔲🔳👁‍🗨👾🕷


ÉTAPES :
    [✅] diviser le fichier HTML en fichier PHP
        [✅] créer les fichiers PHP.
        [✅] couper-coller le html dans ces fichiers.


    [✅] créer le comportement pour que les blocks de html aient le bon comportement une fois imbriqués.
        [✅] chaque menu de la navbar doit pointer vers les bons fichiers, bien que cette navbar soit utilisée dans des pages différentes. 
        [✅] il faut que les pages charges toutes le même fichier mainPage.js

    [✅] commencer à rédiger le reste des pages web du site.
        [✅] faire que le body des pages soit différent pour chacune.
        [✅] faire que le header-body des pages soit différent pour chacune.


    [❎] ajouter le déclenchement au 'touch', pas seulement au 'click' (dans mainPage.js) >> fonctionne déjà ! (Chrome sur android)

    [✅] PAGE MUSIQUES : get icons for other musicPlateforms.
    [✅] PAGE MUSIQUES : modify size (height) for each plateform-logo, different size for each ! >> solution was (width 30%  & min-width & max-width)

    [✅] PAGE MUSIQUES : implement url-to-album for each musicPlateforms.
    [✅] PAGE MUSIQUES : maybe remove button 'Ecouter' ??

    [✅] PAGE ACTU :  add : 
        the album photo 
        + album name 
        + sentence "Lancement de notre 1er album, nous espérons .... "

    [✅] on PAGE INDEX : the header image (a guitare) should have a 'height' equal to all the viewport. 
    
    [✅] PAGE BIO : implement the paragraph when Romain send it by WhatsApp.

    [✅] PAGE LYRICS : centrer le titre dans la 'banner' de classe 'horizontalCard-title'. 🔷 Done, using position:relative;

    [✅] NAVBAR : add a red underline on the menu ('.nav-link') of the current page.

    [✅] PAGE INDEX : social-medias 
        [✅] Add logo 
        [✅] Add links.

    [✅] PAGE PHOTOS : create some thumbnail versions of all photos.
    [✅] PAGE PHOTOS : create a 2nd view for the big version of photo when clicked.fs

    [ ] PAGE MUSIQUES: implement this player : https://codepen.io/vanderzak/pen/BayjVep 
                (found from this website : https://freefrontend.com/javascript-music-players/  )

    [✅] page index : add some margin between logos in mobile view.


    [✅] remove every  '@include bordure()'  in scss files

    -------------------------------------------------------------

    [ ] traiter la possibilité d'une erreur pour le require_once(dans /pages_photos.php :ligne33 )

    [ ] Pour les variables. utiliser plutôt les variables traditionnelles.  Ainsi : 
        ___si je modifie une variable de couleur depuis la palette de l'inspecteur web,  =>  je verrai en temps réel cette couleur changer pour tous les éléments qui l'utilisent.
        ___si je veux plu tard modifier la couleur de cette variable, => je peux même le faire depuis le fichier css si je veux.


    [ ] VÉRIFIER ET TRAITER LES PROBLÈMES DANS L'ONGLET "COMPATIBILITÉ" DE FIREFOX.
        exemple : 

                    PROBLEME : 
                            grid-auto-columns
                                            (préfixe nécessaire)

                            Firefox 60(esr), 79(current), 80(beta), 81(nightly)
                            Firefox Android 60(esr), 68(current)
                            Chrome 84(current), 85(beta), 86(nightly)
                            Chrome Android 84(current), 85(beta), 86(nightly)
                            Safari 14(beta), 13.1(current)
                            iOS Safari 14(beta), 13.4(current)

                            -ms-grid-columns

                            ul.navfooter-menus