<?php
namespace models\music;
use christophegourmand\debug;
use \Exception;

class MusicAlbum {

	// =========================================
	// PROPERTIES
	// =========================================
	private int $rowid;
	private string $name;
	private string $path_image;
	private string $link_spotify;
	private string $link_applemusic;
	private string $link_itunes;
	private string $link_deezer;
	private string $link_amazonmusic;
	private string $link_googleplay;
	private string $link_tidal;

	// =========================================
	// CONSTRUCTOR
	// =========================================
	// public function __construct() {	
	// }
	
	public function __construct (string $name = "")
	{
		$this->name = $name;
		$this->path_image = "" ;
		$this->link_spotify = "" ;
		$this->link_applemusic = "" ;
		$this->link_itunes = "" ;
		$this->link_deezer = "" ;
		$this->link_amazonmusic = "" ;
		$this->link_googleplay = "" ;
		$this->link_tidal = "" ;
	}

	// =========================================
	// GETTERS-SETTERS
	// =========================================

	// Setters ----------------------------------

	public function set_rowid(int $rowid_given)
	{
		$this->rowid = $rowid_given;
	}

	public function set_name(string $name_given)
	{
		$this->name = $name_given;
	}

	public function set_path_image(string $path_image_given)
	{
		$this->path_image = $path_image_given;
	}

	public function set_link_spotify(string $link_spotify_given)
	{
		$this->link_spotify = $link_spotify_given;
	}

	public function set_link_applemusic(string $link_applemusic_given)
	{
		$this->link_applemusic = $link_applemusic_given;
	}

	public function set_link_itunes   (string $link_itunes_given)
	{
		$this->link_itunes = $link_itunes_given;
	}

	public function set_link_deezer(string $link_deezer_given)
	{
		$this->link_deezer = $link_deezer_given;
	}

	public function set_link_amazonmusic(string $link_amazonmusic_given)
	{
		$this->link_amazonmusic = $link_amazonmusic_given;
	}

	public function set_link_googleplay(string $link_googleplay_given)
	{
		$this->link_googleplay = $link_googleplay_given;
	}

	public function set_link_tidal(string $link_tidal_given)
	{
		$this->link_tidal = $link_tidal_given;
	}

	// Getters ----------------------------------

	public function get_rowid() { return $this->rowid; }
	public function get_name() { return $this->name; }
	public function get_path_image() { return $this->path_image; }
	public function get_link_spotify() { return $this->link_spotify; }
	public function get_link_applemusic() { return $this->link_applemusic; }
	public function get_link_itunes() { return $this->link_itunes; }
	public function get_link_deezer() { return $this->link_deezer; }
	public function get_link_amazonmusic() { return $this->link_amazonmusic; }
	public function get_link_googleplay() { return $this->link_googleplay; }
	public function get_link_tidal() { return $this->link_tidal; }

	// =========================================
	// METHODS
	// =========================================
	public function loadFromDbById($mysqli, $rowid)
	{
		$sql_query = "SELECT * FROM music_album WHERE (rowid = $rowid);";
		$mysqli_response = $mysqli->query($sql_query);

		$mysqli_nbOfRowsReceived = (int) $mysqli_response->num_rows;
		
		if ($mysqli_nbOfRowsReceived == 1) {
			$receivedMusicAlbumObject = $mysqli_response->fetch_object();

			// fonctionne si le nom des propriétés de cette classe sont nommés
			foreach($receivedMusicAlbumObject as $fieldname => $value) {
				$this->{$fieldname} = (string) $value;
			}		
		}
	}

	public function insertIntoDb($mysqli)
	{
		// verify if instance-object is full of data
		if ( isset($this->name) /*|| !empty($this->name) || $this->name != "" */) {
			// prepare request
			$sql_query = "INSERT INTO music_album";
			$sql_query .= " (name, path_image, link_spotify, link_applemusic, link_itunes, link_deezer, link_amazonmusic, link_googleplay, link_tidal)";
			$sql_query .= " VALUES ({$this->name}, {$this->path_image}, {$this->link_spotify}, {$this->link_applemusic}, {$this->link_itunes}, {$this->link_deezer}, {$this->link_amazonmusic}, {$this->link_googleplay}, {$this->link_tidal});";

			$mysqli_response = $mysqli->query($sql_query);
		}
	}

	public function updateIntoDb($mysqli)
	{
		// we check if the instance of MusicAlbum has at least a name and a rowid
		if ( !empty( $this->name) && !empty( $this->rowid ))
		{
			$sql_query = "UPDATE music_album";
			$sql_query .= " SET name = '$this->name'";
			$sql_query .= " , path_image = '$this->path_image'";
			$sql_query .= " , link_spotify = '$this->link_spotify'";
			$sql_query .= " , link_applemusic = '$this->link_applemusic'";
			$sql_query .= " , link_itunes = '$this->link_itunes'";
			$sql_query .= " , link_deezer = '$this->link_deezer'";
			$sql_query .= " , link_amazonmusic = '$this->link_amazonmusic'";
			$sql_query .= " , link_googleplay = '$this->link_googleplay'";
			$sql_query .= " , link_tidal = '$this->link_tidal'";
			$sql_query .= " WHERE rowid = $this->rowid";

			$mysqli_response = $mysqli->query($sql_query); // will be true or false

			if (!$mysqli_response)
			{
				throw new Exception("mysqli n'a pas réussi à updater l'instance d'album vers son homologue stocké en base de donnée. la Requete était : [$sql_query]");
			}

			return $mysqli_response;
			

		} else 
		{
			throw new Exception("ERREUR : L'instance d'album n'a pas de rowid ou n'a pas de nom, et donc ne peut pas mettre à jour celui stocké en base de donnée."); // to indicate that 
		}

	}


}
?>