-- delete database first (comment line to not drop)
DROP DATABASE IF EXISTS db_alinea;

-- =====================================
-- create database
-- =====================================
CREATE DATABASE IF NOT EXISTS db_alinea
COLLATE = 'utf8mb4_general_ci';

USE db_alinea;

-- =====================================
-- table for user
-- =====================================
CREATE TABLE IF NOT EXISTS user
(
    rowid INT(3) NOT NULL AUTO_INCREMENT
    , login VARCHAR(50) NOT NULL
    , pass VARCHAR(128) NOT NULL
    , pass_encoded VARCHAR(128) NOT NULL DEFAULT ''
    , datecreation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    , datelastconnection DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    , PRIMARY KEY (rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- CREATE INDEX idx_rowid ON user (rowid);

-- =====================================
-- table for music_album
-- =====================================
CREATE TABLE IF NOT EXISTS music_album
(
    rowid INT(4) NOT NULL AUTO_INCREMENT
    , name VARCHAR(50) NOT NULL UNIQUE
    , path_image VARCHAR(512)
    , link_spotify VARCHAR(512)
    , link_applemusic VARCHAR(512)
    , link_itunes VARCHAR(512)
    , link_deezer VARCHAR(512)
    , link_amazonmusic VARCHAR(512)
    , link_googleplay VARCHAR(512)
    , link_tidal VARCHAR(512)
    , PRIMARY KEY (rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- CREATE INDEX idx_rowid ON music_album (rowid);

-- =====================================
-- table for song
-- =====================================
CREATE TABLE IF NOT EXISTS music_song
(
    rowid INT(4) NOT NULL AUTO_INCREMENT
    , fk_album INT(4) NOT NULL
    , name VARCHAR(50) NOT NULL
    , path_image VARCHAR(512)
    , path_mp3 VARCHAR(512)
    , lyrics MEDIUMTEXT
    , PRIMARY KEY (rowid)
    , FOREIGN KEY (fk_album) REFERENCES music_album(rowid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- CREATE INDEX idx_rowid ON song (rowid);

