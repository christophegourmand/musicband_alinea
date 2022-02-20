<?php 
namespace models\media;

class Photo {
    // PROPERTIES
    private string $filename;
    private string $description; 
    private string $orientation; // (can only be 'portrait' or 'landscape' or 'square' or '')
    protected static array $authorizedOrientationValues = ['portrait', 'landscape' , 'square' , ''];

    // CONSTRUCTOR
    public function __construct(string $filename_param, string $description_param, string $orientation_param)
    {
        $this->filename = $filename_param;
        $this->description = $description_param;
        $this->orientation = $orientation_param;
    }


    // GETTERS-SETTERS
    
    public function setFilename(string $filename_param): void {
        $this->filename = $filename_param;
    }
    
    public function setDescription(string $description_param): void {
        $this->description = $description_param;
    }
    
    public function setOrientation(string $orientation_param): void {
        if ( !in_array($orientation_param, $this->authorizedOrientationValues, true) ) {

            /* here i use '\' before 'Exception' as the classe 'Exception' belong to global namespace.
                and I enclosed this file in a namespace 'models\Media' , so if I use just 'Exception' ,
                PHP will think that I talk about 'models\Media\Exception' , which doesn't exist !
             */
            throw new \Exception("You must choose a photo orientation being 'portrait' or 'landscape' or 'square'", 1);
        }
        $this->orientation = $orientation_param;
    }

    // ------------ 
    public function getFilename(): string {
        return $this->filename;
    }
    
    public function getDescription(): string {
        return $this->description;
    }
    
    public function getOrientation(): string {
        return $this->orientation;
    }

    // METHODS

    // TODO :  CREATE A METHOD `.previous()` and `.next()`
    /* these methods must check if the Photo instance is inside : `class Album -> getPhotos()` which is an array.
    
     */

}