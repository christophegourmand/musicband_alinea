-- delete database first (comment line to not drop)
DROP DATABASE IF EXISTS db_alinea;

-- create database
CREATE DATABASE IF NOT EXISTS db_alinea
COLLATE = 'utf8mb4_general_ci';

USE db_alinea;
-- table for users
CREATE TABLE IF NOT EXISTS users
(
    rowid INT(3) NOT NULL AUTO_INCREMENT
    , login VARCHAR(50) NOT NULL
    , pass VARCHAR(128) NOT NULL
    , pass_encoded VARCHAR(128) NOT NULL DEFAULT ''
    , datecreation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    , datelastconnection DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    , PRIMARY KEY (rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- CREATE INDEX idx_rowid ON users (rowid);

-- table for albums
CREATE TABLE IF NOT EXISTS albums
(
    rowid INT(4) NOT NULL AUTO_INCREMENT
    , name VARCHAR(50) NOT NULL UNIQUE
    , image VARCHAR(512)
    , link_spotify VARCHAR(512)
    , link_applemusic VARCHAR(512)
    , link_itunes VARCHAR(512)
    , link_deezer VARCHAR(512)
    , link_amazonmusic VARCHAR(512)
    , link_googleplay VARCHAR(512)
    , link_tidal VARCHAR(512)
    , PRIMARY KEY (rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- CREATE INDEX idx_rowid ON albums (rowid);

-- table for songs
CREATE TABLE IF NOT EXISTS songs
(
    rowid INT(4) NOT NULL AUTO_INCREMENT
    , fk_album INT(4) NOT NULL
    , name VARCHAR(50) NOT NULL
    , image VARCHAR(512)
    , PRIMARY KEY (rowid)
    , FOREIGN KEY (fk_album) REFERENCES albums(rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- CREATE INDEX idx_rowid ON songs (rowid);

-- table for lyrics
CREATE TABLE IF NOT EXISTS lyrics
(
    rowid INT(4) NOT NULL AUTO_INCREMENT
    , lyrics MEDIUMTEXT
    , fk_song_id INT(4)
    , PRIMARY KEY (rowid)
    , FOREIGN KEY (fk_song_id) REFERENCES songs(rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- CREATE INDEX idx_rowid ON lyrics (rowid);


-- table for song_mp3
CREATE TABLE IF NOT EXISTS song_mp3
(
    rowid INT(4) NOT NULL AUTO_INCREMENT
    , song_mp3 VARCHAR(512)
    , fk_song_id INT(4)
    , PRIMARY KEY (rowid)
    , FOREIGN KEY (fk_song_id) REFERENCES songs(rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- CREATE INDEX idx_rowid ON song_mp3 (rowid);
