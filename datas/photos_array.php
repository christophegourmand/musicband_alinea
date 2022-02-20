<?php

//! IMPORTS  ###########################################################

require_once($_SERVER['DOCUMENT_ROOT']."/"."models/media/Photo.php");
require_once($_SERVER['DOCUMENT_ROOT']."/"."models/media/Album.php"); // class Album need class Photo to be declared first !
require_once($_SERVER['DOCUMENT_ROOT']."/"."models/media/Gallery.php"); // class Album need class Photo to be declared first !
require_once($_SERVER['DOCUMENT_ROOT']."/"."debug/debug_functions.php");


use christophegourmand\debug as debug;

use models\media\Photo as Photo;
use models\media\Album as Album;
use models\media\Gallery as Gallery;



//! METHOD USING CLASSES  ##############################################

//* CREATION ALBUM 1  **********************************************


// METHOD USING CLASSES
// #####################################################################


// CREATION ALBUM 1
// --------------------------------------------------------------


/* $photo27 = new Photo( "alinea_00027_groupe.jpg", "les membres du groupe Alinéa",  "landscape"); */
// showInHtml($photo27 , "photo27");

/* $photo16 = new Photo( "alinea_00016_thierry-guitare.jpg", "Thierry à la guitare", "landscape"); */
// showInHtml($photo16 , "photo16");

$album1 = new Album(
    "2020.06.24",
    "/assets/img/photos/from-CoppaStudio/2020.06.24/Color/SD/thumbnails/",
    "/assets/img/photos/from-CoppaStudio/2020.06.24/Color/SD/"
);
/*
$album1->addPhoto($photo27);
$album1->addPhoto($photo16);
 */

$album1->addPhoto( new Photo("alinea_00027_groupe.jpg", "les membres du groupe Alinéa", "landscape") );
$album1->addPhoto( new Photo("alinea_00016_thierry-guitare.jpg", "Thierry à la guitare", "landscape") );
$album1->addPhoto( new Photo("alinea_00019_instrument_cajon.jpg", "Instrument Cajon","landscape") );
$album1->addPhoto( new Photo("alinea_00020_instrument_cajon.jpg", "Instrument Cajon", "landscape") );
$album1->addPhoto( new Photo("alinea_00021_nicole.jpg", "Nicole", "landscape") );
$album1->addPhoto( new Photo("alinea_00022_nico-tatouage.jpg", "Nico et son tatouage", "landscape") );
$album1->addPhoto( new Photo("alinea_00024_instrument_steel-tongue-drum.jpg", "instrument: steel tongue drum", "landscape") );
$album1->addPhoto( new Photo("alinea_00028_groupe.jpg", "Membres du groupe Alinéa", "landscape") );
$album1->addPhoto( new Photo("alinea_00029_groupe.jpg", "Membres du groupe Alinéa", "landscape") );
$album1->addPhoto( new Photo("alinea_00030_groupe.jpg", "Membres du groupe Alinéa", "landscape") );
$album1->addPhoto( new Photo("alinea_00032_instrument_steel-tongue-drum.jpg", "instrument: steel tongue drum", "portrait") );

$album1->addPhoto( new Photo("alinea_00034_instrument_guitare-thierry.jpg", "Instrument: guitare", "landscape") );
// $album1->addPhoto( new Photo("alinea_00035_instrument_guitare-thierry.jpg", "Instrument: guitare", "landscape") );
$album1->addPhoto( new Photo("alinea_00036_thierry.jpg", "Thierry chante", "landscape") );
$album1->addPhoto( new Photo("alinea_00038_instrument_steel-tongue-drum.jpg", "instrument: steel tongue drum", "landscape") );
$album1->addPhoto( new Photo("alinea_00039_arbre-raylight.jpg", "soleil dans les arbres", "landscape") );
$album1->addPhoto( new Photo("alinea_00040_thierry-play-guitare.jpg", "Thierry joue de la guitare", "landscape") );
$album1->addPhoto( new Photo("alinea_00041_nicole.jpg", "Nicole", "landscape") );
$album1->addPhoto( new Photo("alinea_00042_instrument_piano.jpg", "instrument: piano", "landscape") );
$album1->addPhoto( new Photo("alinea_00043_instrument_steel-tongue-drum.jpg", "instrument: steel tongue drum", "landscape") );
$album1->addPhoto( new Photo("alinea_00044_instrument_claves.jpg", "instrument: claves", "landscape") );
$album1->addPhoto( new Photo("alinea_00045_instrument_claves.jpg", "instrument: claves", "landscape") );
$album1->addPhoto( new Photo("alinea_00048_instrument_tambourin.jpg", "instrument: tambourin", "landscape") );
$album1->addPhoto( new Photo("alinea_00049_instrument_guitare-thierry.jpg", "instrument: accord de guitare", "landscape") );
$album1->addPhoto( new Photo("alinea_00050_instrument_guitare-thierry.jpg", "instrument: chevalet de guitare", "landscape") );

// debug\showInHtml($album1 , "album1"); // 🟥 DEBUG 



// CREATION ALBUM 2
// --------------------------------------------------------------

$album2 = new Album(
    "2020.10.23",
    "/assets/img/photos/from-facebook/2020.10.23/thumbnails/",
    "/assets/img/photos/from-facebook/2020.10.23/"
);


$album2->addPhoto( new Photo("alinea_00069_nicole.jpg", "Nicole, souriante.", "landscape") );
$album2->addPhoto( new Photo("alinea_00070_thierry-play-guitare.jpg", "Thierry sur sa guitare électrique", "landscape") );
$album2->addPhoto( new Photo("alinea_00071_nico-play-drums.jpg", "Nico, en plein riff de batterie", "landscape") );
// $album2->addPhoto( new Photo("alinea_00072_romain-play-bass-bw.jpg", "Romain à la basse", "landscape") );
$album2->addPhoto( new Photo("alinea_00073_romain-play-bass-color.jpg", "Romain à la basse", "landscape") );
// $album2->addPhoto( new Photo("alinea_00074_simone-play-piano.jpg", "Simone au piano", "landscape") );
// $album2->addPhoto( new Photo("alinea_00075_simone-play-piano-bw.jpg", "Simone au piano", "landscape") );
$album2->addPhoto( new Photo("alinea_00076_thierry-play-guitare.jpg", "Thierry à la guitare", "landscape") );
$album2->addPhoto( new Photo("alinea_00077_nico-play-drums.jpg", "Nico à la batterie", "landscape") );

// debug\showInHtml($album2 , "album2");// 🟥 DEBUG

// CREATION ALBUM 3
// --------------------------------------------------------------
$album3 = new Album(
    "2021.01.12 Répétition",
    "/assets/img/photos/from-facebook/2021.01.12/thumbnails/",
    "/assets/img/photos/from-facebook/2021.01.12/"
);

$album3->addPhoto( new Photo("alinea_00078_romain-play-saxo.jpeg", "Romain joue du saxo", "portrait") );
$album3->addPhoto( new Photo("alinea_00079_nicole-sing.jpeg", "Nicole au chant", "portrait") );
$album3->addPhoto( new Photo("alinea_00081_instrument_piano.jpeg", "Piano de Simone", "portrait") );
$album3->addPhoto( new Photo("alinea_00082_instrument_drums.jpeg", "nouvelle batterie de Nico", "portrait") );
$album3->addPhoto( new Photo("alinea_00084_nico-with-headphones.jpeg", "Nico écoute au casque", "portrait") );
$album3->addPhoto( new Photo("alinea_00085_thierry-play-guitar.jpeg", "Thierry sur sa guitare SG", "square") );
$album3->addPhoto( new Photo("alinea_00086_romain-play-drums.jpeg", "Romain à la batterie", "portrait") );
$album3->addPhoto( new Photo("alinea_00080_instrument_drums.jpeg", "La nouvelle batterie de Nico, rayonnante", "landscape") );

// CREATION ALBUM 4
// --------------------------------------------------------------
$album4 = new Album(
    "2021.07.08 Répétition",
    "/assets/img/photos/from-facebook/2021.07.08/thumbnails/",
    "/assets/img/photos/from-facebook/2021.07.08/"
);

$album4->addPhoto( new Photo("alinea_00087_romain-playing-bass-and-nico-playing-drums.jpg", "", "portrait") );
$album4->addPhoto( new Photo("alinea_00088_thierry-guitar-nicole-sing.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00089_romain-bass.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00090_romain-bass-blackwhite.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00091_thierry-playing-guitar-and-nico-playing-drums.jpg", "", "portrait") );
$album4->addPhoto( new Photo("alinea_00092_nicole-singing.jpg", "", "portrait") );
$album4->addPhoto( new Photo("alinea_00093_instruments-cables.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00094_nicole-smiling.jpg", "", "portrait") );
$album4->addPhoto( new Photo("alinea_00095_thierry_smiling.jpg", "", "portrait") );
$album4->addPhoto( new Photo("alinea_00096_thierry-and-nico-playing-guitar-and-drums.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00097_nicole_singing.jpg", "", "portrait") );
// $album4->addPhoto( new Photo("alinea_00098_thierry-playing-guitar-and-nicole-singing.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00099_thierry-playing-guitar-and-nicole-singing.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00100_instruments-cables.jpg", "", "landscape") );
$album4->addPhoto( new Photo("alinea_00101_nicole_singing.jpg", "", "portrait") );
$album4->addPhoto( new Photo("alinea_00102_romain-playing-bass-and-nico-playing-drums.jpg", "", "portrait") );
$album4->addPhoto( new Photo("alinea_00103_nicole_singing.jpg", "", "portrait") );


// ADD ALBUM 1 AND 2 INTO GALLERY
// --------------------------------------------------------------

$gallery1 = new Gallery();
$gallery1->addAlbums($album1, $album2, $album3, $album4);

// debug\showInHtml($gallery1 , "gallery1");// 🟥 DEBUG 


// OLD METHOD (using arrays)
// #####################################################################


$photoAlbums_indArray = [
    // - - - - - - - - - - - - - - - - - - - - - - - - - NEW ALBUM
    [
        "album_name"=> "2020.06.24",
        "path_to_thumbnails"=>"/assets/img/photos/from-CoppaStudio/2020.06.24/Color/SD/thumbnails/",
        "path_to_originals"=>"/assets/img/photos/from-CoppaStudio/2020.06.24/Color/SD/",
        "photos_of_album_indArr"=> [
            // ["filename"=>"alinea_00014_nico-and-simone-piano.jpg", "description"=>"Nico et Simone au Piano"],
            ["filename"=>"alinea_00027_groupe.jpg", "description"=>"les membres du groupe Alinéa"],
            // ["filename"=>"alinea_00015_nico-and-simone-piano.jpg", "description"=>"Simone au piano"],
            ["filename"=>"alinea_00016_thierry-guitare.jpg", "description"=>"Thierry à la guitare"],
            // ["filename"=>"alinea_00017_nicole-lyrics.jpg", "description"=>""],
            // ["filename"=>"alinea_00018_simone-lyrics.jpg", "description"=>""],
            ["filename"=>"alinea_00019_instrument_cajon.jpg", "description"=>"Instrument Cajon"],
            ["filename"=>"alinea_00020_instrument_cajon.jpg", "description"=>"Instrument Cajon"],
            ["filename"=>"alinea_00021_nicole.jpg", "description"=>"Nicole"],
            ["filename"=>"alinea_00022_nico-tatouage.jpg", "description"=>"Nico et son tatouage"],
            // ["filename"=>"alinea_00023_instrument_steel-tongue-drum.jpg", "description"=>""],
            ["filename"=>"alinea_00024_instrument_steel-tongue-drum.jpg", "description"=>"instrument: steel tongue drum"],
            // ["filename"=>"alinea_00025_groupe.jpg", "description"=>"Membres du groupe Alinéa"],
            // ["filename"=>"alinea_00026_groupe.jpg", "description"=>"Membres du groupe Alinéa"],
            ["filename"=>"alinea_00028_groupe.jpg", "description"=>"Membres du groupe Alinéa"],
            ["filename"=>"alinea_00029_groupe.jpg", "description"=>"Membres du groupe Alinéa"],
            ["filename"=>"alinea_00030_groupe.jpg", "description"=>"Membres du groupe Alinéa"],
            // ["filename"=>"alinea_00031_main-shaker.jpg", "description"=>"Instrument: shaker"],
            // ["filename"=>"alinea_00032_instrument_steel-tongue-drum.jpg", "description"=>"instrument: steel tongue drum"],

            // ["filename"=>"alinea_00033_main-shaker.jpg", "description"=>"Instrument: shaker"],
            ["filename"=>"alinea_00034_instrument_guitare-thierry.jpg", "description"=>"Instrument: guitare"],
            ["filename"=>"alinea_00035_instrument_guitare-thierry.jpg", "description"=>"Instrument: guitare"],
            ["filename"=>"alinea_00036_thierry.jpg", "description"=>"Thierry chante"],
            // ["filename"=>"alinea_00037_thierry.jpg", "description"=>"Thierry chante"],
            ["filename"=>"alinea_00038_instrument_steel-tongue-drum.jpg", "description"=>"instrument: steel tongue drum"],
            ["filename"=>"alinea_00039_arbre-raylight.jpg", "description"=>"soleil dans les arbres"],
            ["filename"=>"alinea_00040_thierry-play-guitare.jpg", "description"=>"Thierry joue de la guitare"],
            ["filename"=>"alinea_00041_nicole.jpg", "description"=>"Nicole"],
            ["filename"=>"alinea_00042_instrument_piano.jpg", "description"=>"instrument: piano"],
            ["filename"=>"alinea_00043_instrument_steel-tongue-drum.jpg", "description"=>"instrument: steel tongue drum"],
            ["filename"=>"alinea_00044_instrument_claves.jpg", "description"=>"instrument: claves"],
            ["filename"=>"alinea_00045_instrument_claves.jpg", "description"=>"instrument: claves"],
            ["filename"=>"alinea_00048_instrument_tambourin.jpg", "description"=>"instrument: tambourin"],
            ["filename"=>"alinea_00049_instrument_guitare-thierry.jpg", "description"=>"instrument: accord de guitare"],
            ["filename"=>"alinea_00050_instrument_guitare-thierry.jpg", "description"=>"instrument: chevalet de guitare"]
        ]
    ],
    // - - - - - - - - - - - - - - - - - - - - - - - - - NEW ALBUM
    [
        "album_name"=> "2020.10.24",
        "path_to_thumbnails"=>"/assets/img/photos/from-facebook/2020.10.23/thumbnails/",
        "path_to_originals"=>"/assets/img/photos/from-facebook/2020.10.23/",
        "photos_of_album_indArr"=> [
            ["filename"=>"alinea_00069_nicole.jpg", "description"=>"Nicole, souriante."],
            ["filename"=>"alinea_00070_thierry-play-guitare.jpg", "description"=>"Thierry sur sa guitare électrique"],
            ["filename"=>"alinea_00071_nico-play-drums.jpg", "description"=>"Nico, en plein riff de batterie"],
            // ["filename"=>"alinea_00072_romain-play-bass-bw.jpg", "description"=>"Romain à la basse"],
            ["filename"=>"alinea_00073_romain-play-bass-color.jpg", "description"=>"Romain à la basse"],
            // ["filename"=>"alinea_00074_simone-play-piano.jpg", "description"=>"Simone au piano"],
            // ["filename"=>"alinea_00075_simone-play-piano-bw.jpg", "description"=>"Simone au piano"],
            ["filename"=>"alinea_00076_thierry-play-guitare.jpg", "description"=>"Thierry à la guitare"],
            ["filename"=>"alinea_00077_nico-play-drums.jpg", "description"=>"Nico à la batterie"]
        ]
    ],
    // - - - - - - - - - - - - - - - - - - - - - - - - - NEW ALBUM
    [
        "album_name"=> "2021.01.12 Répétition",
        "path_to_thumbnails"=>"/assets/img/photos/from-facebook/2021.01.12/thumbnails/",
        "path_to_originals"=>"/assets/img/photos/from-facebook/2021.01.12/",
        "photos_of_album_indArr"=> [
            ["filename"=>"alinea_00078_romain-play-saxo.jpeg", "description"=>"Romain joue du saxo"],
            ["filename"=>"alinea_00079_nicole-sing.jpeg", "description"=>"Nicole au chant"],
            ["filename"=>"alinea_00081_instrument_piano.jpeg", "description"=>"Piano de Simone"],
            ["filename"=>"alinea_00082_instrument_drums.jpeg", "description"=>"nouvelle batterie de Nico"],
            // ["filename"=>"alinea_00083_simone-on-phone.jpeg", "description"=>"Simone joue du smartphone"],
            ["filename"=>"alinea_00084_nico-with-headphones.jpeg", "description"=>"Nico écoute au casque"],
            ["filename"=>"alinea_00085_thierry-play-guitar.jpeg", "description"=>"Thierry sur sa guitare SG"],
            ["filename"=>"alinea_00086_romain-play-drums.jpeg", "description"=>"Romain à la batterie"],
            ["filename"=>"alinea_00080_instrument_drums.jpeg", "description"=>"La nouvelle batterie de Nico, rayonnante"]
        ]
    ],
    // - - - - - - - - - - - - - - - - - - - - - - - - - NEW ALBUM
    [
        "album_name"=> "2021.07.08 Répétition",
        "path_to_thumbnails"=>"/assets/img/photos/from-facebook/2021.07.08/thumbnails/",
        //                     assets/img/photos/from-facebook/2021.07.08
        "path_to_originals"=>"/assets/img/photos/from-facebook/2021.07.08/",
        "photos_of_album_indArr"=> [
            ["filename"=>"alinea_00087_romain-playing-bass-and-nico-playing-drums.jpg", "description"=>""],
            ["filename"=>"alinea_00088_thierry-guitar-nicole-sing.jpg", "description"=>""],
            ["filename"=>"alinea_00089_romain-bass.jpg", "description"=>""],
            ["filename"=>"alinea_00090_romain-bass-blackwhite.jpg", "description"=>""],
            ["filename"=>"alinea_00091_thierry-playing-guitar-and-nico-playing-drums.jpg", "description"=>""],
            ["filename"=>"alinea_00092_nicole-singing.jpg", "description"=>""],
            ["filename"=>"alinea_00093_instruments-cables.jpg", "description"=>""],
            ["filename"=>"alinea_00094_nicole-smiling.jpg", "description"=>""],
            ["filename"=>"alinea_00095_thierry_smiling.jpg", "description"=>""],
            ["filename"=>"alinea_00096_thierry-and-nico-playing-guitar-and-drums.jpg", "description"=>""],
            ["filename"=>"alinea_00097_nicole_singing.jpg", "description"=>""],
            ["filename"=>"alinea_00098_thierry-playing-guitar-and-nicole-singing.jpg", "description"=>""],
            ["filename"=>"alinea_00099_thierry-playing-guitar-and-nicole-singing.jpg", "description"=>""],
            ["filename"=>"alinea_00100_instruments-cables.jpg", "description"=>""],
            ["filename"=>"alinea_00101_nicole_singing.jpg", "description"=>""],
            ["filename"=>"alinea_00102_romain-playing-bass-and-nico-playing-drums.jpg", "description"=>""],
            ["filename"=>"alinea_00103_nicole_singing.jpg", "description"=>""]
        ]
    ]
    // - - - - - - - - - - - - - - - - - - - - - - - - - NEW ALBUM
    // [
        // "album_name"=> "",
        // "path_to_thumbnails"=>"",
        // "path_to_originals"=>"",
        // "photos_of_album_indArr"=> [
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
        // ]
    // ],
    // - - - - - - - - - - - - - - - - - - - - - - - - - NEW ALBUM
    // [
        // "album_name"=> "",
        // "path_to_thumbnails"=>"",
        // "path_to_originals"=>"",
        // "photos_of_album_indArr"=> [
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
        // ]
    // ],
    // - - - - - - - - - - - - - - - - - - - - - - - - - NEW ALBUM
    // [
        // "album_name"=> "",
        // "path_to_thumbnails"=>"",
        // "path_to_originals"=>"",
        // "photos_of_album_indArr"=> [
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
            // ["filename"=>"", "description"=>""],
        // ]
    // ],
];


                    // Photos that we don't want are commented with '//'