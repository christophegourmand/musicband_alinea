<?php
require_once($_SERVER['DOCUMENT_ROOT']."/"."debug/debug_functions.php");
use christophegourmand\debug as debug;

// METHOD USING `SCANDIR` 
// #####################################################################


/* OTHER METHOD ON TRY :    using `scandir` 
 scandir(string $directory, int $sorting_order = SCANDIR_SORT_ASCENDING, ?resource $context = null): array|false
*/

$PhotosScannedFromFolderAlbum1 = scandir($_SERVER['DOCUMENT_ROOT']."/"."assets/img/photos/from-CoppaStudio/2020.06.24/Color/SD/");

debug\showInHtml($PhotosScannedFromFolderAlbum1 , "PhotosScannedFromFolderAlbum1"); // 🟥 DEBUG