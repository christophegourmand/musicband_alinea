<?php
		// #################################################### 
		// MUSIC ALBUM
		// #################################################### 

		//--- load musicAlbum and musicSongs
		if( in_array($user_group->get_groupname(), ["webadmin", "band_musicians"]) )
		{
			$albumsRowsFromDb = $dbHandler->loadManyRows($mysqli, 'music_album');

			//--- create array of MusicAlbum instances and fill them with datas
			$musicAlbums_list = [];
			foreach ($albumsRowsFromDb as $albumRowFromDb) {
				# var_dump($albumRowFromDb);
				$musicAlbum = new MusicAlbum();
				$musicAlbum->fill_from_array($albumRowFromDb);
				$musicAlbum->load_musicSongs($mysqli);
				array_push($musicAlbums_list , $musicAlbum);
			}

			foreach ($musicAlbum->get_musicSongs() as $musicSongindex => $musicSong)
			{
				// TODO : faire queluechose de ces infos :
				$musicSong->get_rowid();
				$musicSong->get_path_image();
			}
		}
?>