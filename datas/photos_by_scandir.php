<?php
require_once($_SERVER['DOCUMENT_ROOT']."/"."debug/debug_functions.php");
use christophegourmand\debug as debug;

// METHOD USING `SCANDIR` 
// #####################################################################


/* OTHER METHOD ON TRY :    using `scandir` 
 scandir(string $directory, int $sorting_order = SCANDIR_SORT_ASCENDING, ?resource $context = null): array|false
*/


// can i scan directories       !! besoin de fonction recursive ?

$scanImgFolders_arr = scandir($_SERVER['DOCUMENT_ROOT']."/assets/img/photos");

for ($i=2; $i < count($scanImgFolders_arr) ; $i++) { // start at 2, to skip '.' and '..' values.
    print '<p>'.$scanImgFolders_arr[$i].'</p>';
}
print '<hr>';

foreach ($scanImgFolders_arr as /*$key=>*/$value) {
    print '<p>'.$value.'</p>';
}

debug\showInHtml(
    $scanImgFolders_arr,
    "scan img folder"
);

// photos of album 1
$PhotosScannedFromFolderAlbum1 = scandir($_SERVER['DOCUMENT_ROOT']."/"."assets/img/photos/from-CoppaStudio/2020.06.24/Color/SD/");

debug\showInHtml($PhotosScannedFromFolderAlbum1 , "PhotosScannedFromFolderAlbum1"); // 🟥 DEBUG