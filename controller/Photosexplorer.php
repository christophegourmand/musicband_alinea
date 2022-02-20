<?php


/**
* @baseFolder : beginning of path containing folder of photos 
* @scannedElements : array of folders, or photos.
*/
class Photosexplorer {

    // variables d'environnement ---------------------------------------------
    private $baseFolder;
    private $scannedElements;


    // constructeur ---------------------------------------------
    public function __construct(string $baseFolder_arg)
    {
        //
        $this->baseFolder = $baseFolder_arg;

        // initialize array who will contain folders and photos
        $this->scannedElements = [];
    }

    // getters - setteurs ---------------------------------------------
    
    // recuperer le dossier racine (absolu) pour cette classe
    public function getBaseFolder () :string
    {
        return (string) $this->baseFolder;
    }

    // recuperer le dossier racine (relatif) pour cette classe
    public function getBaseFolderRelative () :string
    {
        // replace THIS by THAT in THISSTRING
        $relativeBaseFolder = str_replace($_SERVER['DOCUMENT_ROOT'] , '' , $this->baseFolder);

        return $relativeBaseFolder;
    }

    // recuperer l'array contenant dossiers et photos scannés
    public function getScannedElements () 
    {
        return $this->scannedElements;
    }

    // methodes ---------------------------------------------
    public function scanBaseFolder() // : array
    {
        //$mainArray = [];
                                //$result_test = [];

        $folderToScan = /*$_SERVER['SERVER_NAME'].*/$this->getBaseFolder();

        $elementsInBaseFolder = scandir($folderToScan);
                                // $result_test["elements"] = $elementsInBaseFolder;
        
        for ($i=2; $i < count($elementsInBaseFolder) ; $i++) // start at 2, to skip '.' and '..' values.
        {
            $element = $elementsInBaseFolder[$i];
                                // $result_test["isfolder"][] = $this->isFolder($folderToScan.$element) ? 'is folder' : 'is not folder';
            
            if ($this->isFolder($folderToScan.$element)) { 
                $this->scannedElements[$element] = [];
            }
            /*
            
            */
        }
        
        // print '<h1>result</h1>';
        // print_r($this->scannedElements);

        // print '<h1 style="color:red;">FOREACH --------- </h1>';
        foreach ($this->scannedElements as $key_folder => $value_empyArray) {
            //print_r($key_folder); print "\n";
            $elementsInSubFolder = scandir($folderToScan.$key_folder);
            // print "<h1 style='color:orange;'>scandir de $key_folder</h1>";
            // print_r(  $elementsInSubFolder  );

            foreach ($elementsInSubFolder as $file) { 
            // (on suppose que c'est un fichier)
                
                // print "<h4 style='color:blue;'>scandir de $key_folder</h4>";
                // print_r($file);
                
                if ($this->isPhoto($file)) {
                    //print " :: is photo\n";

                    // if filename doesn't contain 'hide' (regadless of caps)
                    if( ! stristr($file, 'HIDE')){
                        $this->scannedElements[$key_folder][] = $file;
                    }
                }
            }
        }
        return true;
    }

    public function isFolder(string $pathToFolder) : bool
    {
        if (is_dir($pathToFolder)) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
    * return true if the element is a file, and his extension is a photo.
    */
    public function isPhoto(string $pathToPhoto) : bool
    {
        $filenameAndExtension_str = basename($pathToPhoto);
        // print "\t\t filename : $filenameAndExtension_str";
        $fileAndExtension_arr = explode('.' , $filenameAndExtension_str); // ['toto','jpg']
        if (count($fileAndExtension_arr) === 2){
            $filename = $fileAndExtension_arr[0];
            $extension = $fileAndExtension_arr[1];
            if ($this->extensionIsImage($extension)){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function extensionIsImage($extension)
    {
        // sorted by probability (not alphabetically), for performance.
        switch($extension) {
            case 'jpg':
                return true;
                break;
            case 'JPG':
                return true;
                break;
            case 'jpeg':
                return true;
                break;
            case 'gif':
                return true;
                break;
            case 'tiff':
                return true;
                break;
            case 'png':
                return true;
                break;
            case 'bmp':
                return true;
                break;
            case 'svg':
                return true;
                break;
            default:
                return false;
        }

    }


    

}