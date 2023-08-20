<?php


/**
* @baseFolder : beginning of path containing folder of photos 
* @scannedElements : array of folders, or photos.
*/
class PhotosExplorer {

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
		$folderToScan = /*$_SERVER['SERVER_NAME'].*/$this->getBaseFolder();

		$elementsInBaseFolder = scandir($folderToScan, 1);
                // showInHtml($elementsInBaseFolder, "elementsInBaseFolder"); // DEBUG  

		
		for ($i=0; $i < count($elementsInBaseFolder) ; $i++)
		{
            // on skip '.' et '..'
            if ($elementsInBaseFolder[$i] === '.' || $elementsInBaseFolder[$i] === '..')
                continue;

			$element = $elementsInBaseFolder[$i];

			if ($this->isFolder($folderToScan.$element)) { 
				$this->scannedElements[$element] = []; // add empty array for contained photos
			}
		}


		foreach ($this->scannedElements as $key_folder => $value_empyArray) {
			$elementsInSubFolder = scandir($folderToScan.$key_folder , 1);

			foreach ($elementsInSubFolder as $file) { 
				
				if ($this->isPhoto($file)) {
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