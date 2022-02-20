<?php

//! IMPORTS  ###########################################################

require_once($_SERVER['DOCUMENT_ROOT']."/"."models/media/Photo.php");
require_once($_SERVER['DOCUMENT_ROOT']."/"."models/media/Album.php"); // class Album need class Photo to be declared first !
require_once($_SERVER['DOCUMENT_ROOT']."/"."models/media/Gallery.php"); // class Album need class Photo to be declared first !
require_once($_SERVER['DOCUMENT_ROOT']."/"."debug/debug_functions.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/controller/Photosexplorer.php');


//! NAMESPACES   ########################################################
use christophegourmand\debug as debug;

use models\media\Photo as Photo;
use models\media\Album as Album;
use models\media\Gallery as Gallery;


//! BUILD ARRAY OF ALBUM + PHOTOS WITH CLASSES   ##################

// create an array of Album and Photos by scanning a base folder
$photosExplorer = new Photosexplorer($_SERVER['DOCUMENT_ROOT'].'/assets/img/photos/gallery/');
$photosExplorer->scanBaseFolder();
$tree_albums_and_photos = $photosExplorer->getScannedElements();

// create a Gallery from class
$gallery1 = new Gallery();

// create albums from class -- for each album
foreach($tree_albums_and_photos as $albumName => $arrayOfPhotos ){
    $album_instance = new Album(
        $albumName , 
        $photosExplorer->getBaseFolderRelative().$albumName."/thumbnails/" ,    // path to thumbnails
        $photosExplorer->getBaseFolderRelative().$albumName."/"       // path to photos
    );

    // ajouter les photos à l'album
    foreach ($arrayOfPhotos as $photoName) {
        // parameter for 'new Photo' :  photoName (string) , alt text (string) , orientation (string)
            // orientation can only be 'portrait' or 'landscape' or 'square' or '' .
        $photoDescription = str_replace('alinea_', '', $photoName);
        $photoDescription = str_replace('_',' ', $photoDescription);
        $photoDescription = str_replace('-',' ', $photoDescription);
        $album_instance->addPhoto( new Photo($photoName ,$photoDescription, '') );
    }

    // ajouter l'album à la Gallerie
    $gallery1->addAlbums($album_instance);
}

?>