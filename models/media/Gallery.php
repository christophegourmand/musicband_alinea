<?php 
namespace models\media;
use christophegourmand\debug;


// require_once($_SERVER['DOCUMENT_ROOT']."/"."models/media/Album.php");

// use models\media\Album as Album;

class Gallery {

    // PROPERTIES
    private array $albums;

    // CONSTRUCTOR
    public function __construct () 
    {
        $this->albums = array();
    }

    // GETTERS-SETTERS
    public function getAlbums() :array
    {
        return $this->albums;
    }

    public function getAlbum(int $index_param) :Album
    {
        $requestedAlbum = $this->albums[$index_param];
        return $requestedAlbum;
    }

    // METHODS

    /* Add albums passed as parameters to the $albums array.
        About params:
        Even if no parameters are defined here, it is possible to pass multiple parameters, as they will be received by the method `func_get_args()` who catch all parameters passed to the function, and create an array with it.
    */
    public function addAlbums (Album ...$arrayAlbums_param) :void
    {
        $allParamsAreAlbums = true;
        
        foreach($arrayAlbums_param as $album_in_array_param) {

            array_push($this->albums, $album_in_array_param);
        }

    }



}
