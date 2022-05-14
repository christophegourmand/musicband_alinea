<?php 
namespace models\music;
use christophegourmand\debug;

class AlbumContainer {

	// =========================================
	// PROPERTIES
	// =========================================
	private int $rowid;
    private array $listOfAlbums = [];

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

	public function get_rowid() { return $this->rowid; }

    public function get_listOfAlbums() {
        return $this->get_listOfAlbums();
    }

	// =========================================
	// METHODS
	// =========================================

    public function fetch_all_from_db($mysqli){
        $sql_query = "SELECT * FROM music_album";
        //$sql_query .= " WHERE can_be_displayed = true;"; // ACTIVATE LINE WHEN FIELD IS CREATED IN TABLE
        $mysqli_query_result = $mysqli->query($sql_query);
        // $mysqli_query_result__num_rows = $mysqli_query_result->num_rows;
        // $mysqli_query_result__field_count = $mysqli_query_result->field_count;
        $this->listOfAlbums = $mysqli_query_result->fetch_all(MYSQLI_ASSOC);

        // TODO : later , check if database return an error, if so, return false and throw an error.
        return true;
    }

}
?>