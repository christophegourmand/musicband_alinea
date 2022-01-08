<?php 
namespace models\media;

// require_once($_SERVER['DOCUMENT_ROOT']."/"."models/Photo.php");


class Album {
    // PROPERTIES
    private string $title;          // DON'T FORGET TO CHANGE HTML TOO !
    private string $path_to_thumbnails; 
    private string $path_to_originals;
    private array $photos;
    private int $size;
    
    // CONSTRUCTOR ############################################
    public function __construct(string $title_param, string $path_to_thumbnails_param, string $path_to_originals_param)
    {
        $this->title = $title_param;
        $this->path_to_thumbnails = $path_to_thumbnails_param;
        $this->path_to_originals = $path_to_originals_param;
        $this->photos = array();
        $this->size = 0;
    }


    // GETTERS-SETTERS ############################################
    
    // title ----------------------------------------------------------
    public function setTitle(string $title_param): void 
    {
        $this->title = $title_param;
    }

    public function getTitle(): string 
    {
        return $this->title;
    }

    // path_to_thumbnails ----------------------------------------------------------
    public function setPath_to_thumbnails(string $path_to_thumbnails_param): void 
    {
        $this->path_to_thumbnails = $path_to_thumbnails_param;
    }

    public function getPath_to_thumbnails(): string 
    {
        return $this->path_to_thumbnails;
    }


    // path_to_originals ----------------------------------------------------------
    public function setPath_to_originals(string $path_to_originals_param): void 
    {
        $this->path_to_originals = $path_to_originals_param;
    }

    public function getPath_to_originals(): string 
    {
        return $this->path_to_originals;
    }

    // photos  ----------------------------------------------------------
    public function addPhoto(Photo $photo_param): void 
    {
        array_push( $this->photos, $photo_param);
        
        $this->increaseSize();
    }

    public function getPhotos(): array 
    {
        return $this->photos;
    }

    public function getPhoto(int $index_param): Photo 
    {
        $requestedPhoto = $this->photos[$index_param];
        return $requestedPhoto;
    }

    // size  ----------------------------------------------------------
    public function getSize(): int
    {
        return $this->size;
    }
    
    private function increaseSize() : void
    {
        $this->size = $this->size + 1;
    }

    /* might not be usefull, created in case */
    private function decreaseSize() : void
    {
        if ($this->size === 0 ) {
            return;
        }

        $this->size = $this->size - 1;
    }


    // METHODS ############################################
}