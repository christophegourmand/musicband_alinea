<?php 
// namespace models\music;

use christophegourmand\debug;

require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");


class AlbumsContainer {

	// =========================================
	// PROPERTIES
	// =========================================
	private array $albums = [];

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct() {
	}
	

	// =========================================
	// GETTERS-SETTERS
	// =========================================

	// Setters ----------------------------------

	// Getters ----------------------------------
	public function get_albums() {
		return $this->albums;
	}

	// =========================================
	// METHODS
	// =========================================

	public function loadMusicAlbumsFromDb($mysqli){
		$sql_query = "SELECT rowid FROM music_album";
		# $sql_query .= " WHERE can_be_displayed = true;"; // ACTIVATE LINE WHEN FIELD IS CREATED IN TABLE
		
		$mysqli_response = $mysqli->query($sql_query);
		
		if ($mysqli_response == false )
		{
			throw new Exception("mysqli n'a pas réussi à charger les lignes d'album de musique stockés en base de donnée. la Requete était : [$sql_query]");
		} else
		{
			$listOfRowid = [];
			$listOfRowid = $mysqli_response->fetch_all(MYSQLI_ASSOC); // MYSQLI_ASSOC to precise we want result as an array only
			
			foreach ($listOfRowid as $index => $arrayWithKeyRowid) {
				$rowidOfLoopingAlbum = (int) $arrayWithKeyRowid['rowid'];
				
				// locally create an instance of MusicAlbum and fill if from db:
				$loopinguMusicAlbum = new MusicAlbum();

				$loopinguMusicAlbum->load($mysqli, $rowidOfLoopingAlbum);

				// load locally created album in array:
				$this->albums[] = $loopinguMusicAlbum;
			}

			return true;
		}
		


		// TODO : later , check if database return an error, if so, return false and throw an error.
	}

}
?>