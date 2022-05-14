<?php 
namespace models\music;
use christophegourmand\debug;

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
	public function fill_from_db($mysqli, $rowid)
	{
		$sql_query = "SELECT * FROM music_album WHERE (rowid = $rowid);";
		$mysqli_query_result = $mysqli->query($sql_query);
		// $mysqli_query_result__num_rows = $mysqli_query_result->num_rows;
		// $mysqli_query_result__field_count = $mysqli_query_result->field_count;

		$row_arrayAssoc = $mysqli_query_result->fetch_assoc();

		// fonctionne si le nom des propriétés de cette classe sont nommés
		foreach($row_arrayAssoc as $fieldname => $value) {
			$this->{$fieldname} = $value;
		}
	}

	public function insert_into_db($mysqli){
		// verify if instance-object is full of data
		if ( isset($this->name) /*|| !empty($this->name) || $this->name != "" */) {
			// prepare request
			$sql_query = "INSERT INTO music_album";
			$sql_query .= " (name, path_image, link_spotify, link_applemusic, link_itunes, link_deezer, link_amazonmusic, link_googleplay, link_tidal)";
			$sql_query .= " VALUES ({$this->name}, {$this->path_image}, {$this->link_spotify}, {$this->link_applemusic}, {$this->link_itunes}, {$this->link_deezer}, {$this->link_amazonmusic}, {$this->link_googleplay}, {$this->link_tidal});";

			$mysqli_query_result = $mysqli->query($sql_query);

		}


		// get database
		// prepare request
		// push it to database.


    }


}
?>