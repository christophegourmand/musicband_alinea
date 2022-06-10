-- delete database first (comment line to not drop)
DROP DATABASE IF EXISTS db_alinea;

-- =====================================
-- create database
-- =====================================
CREATE DATABASE IF NOT EXISTS db_alinea
DEFAULT CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci';

USE db_alinea;

-- =====================================
-- table for group
-- =====================================
CREATE TABLE IF NOT EXISTS `group`
(
    `rowid` INT(3) NOT NULL AUTO_INCREMENT
    , `groupname` VARCHAR(50) NOT NULL

    , PRIMARY KEY (`rowid`)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

-- =====================================
-- table for right
-- =====================================
CREATE TABLE IF NOT EXISTS `right`
(
    `rowid` INT(3) NOT NULL AUTO_INCREMENT
    , `name` VARCHAR(100) NOT NULL
    , `description` VARCHAR(300)
    
    , PRIMARY KEY (`rowid`)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

-- =====================================
-- table for asso_group_right
-- =====================================
CREATE TABLE IF NOT EXISTS `asso_group_right`
(
    `rowid` INT(3) NOT NULL AUTO_INCREMENT
    , `fk_group_rowid` INT(4) NOT NULL
    , `fk_right_rowid` INT(4) NOT NULL

    , PRIMARY KEY (`rowid`)
    , FOREIGN KEY (`fk_group_rowid`) 
        REFERENCES `group` (`rowid`) 
        ON DELETE CASCADE
    , FOREIGN KEY (`fk_right_rowid`) 
        REFERENCES `right` (`rowid`) 
        ON DELETE CASCADE
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

ALTER TABLE `asso_group_right`
ADD UNIQUE INDEX `idx_rowid_groupid_rightid` (`rowid` , `fk_group_rowid` , `fk_right_rowid`);

-- =====================================
-- table for user
-- =====================================
CREATE TABLE IF NOT EXISTS `user`
(
    `rowid` INT(5) NOT NULL AUTO_INCREMENT
    , `active` BOOLEAN NOT NULL
    , `login` VARCHAR(50) NOT NULL UNIQUE
    , `pass` VARCHAR(128) NOT NULL
    , `pass_encoded` VARCHAR(128) NOT NULL DEFAULT ''
    , `fk_group_rowid` INT(4) NOT NULL
    , `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    , `date_last_connection` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    , `email` VARCHAR(100)

    , PRIMARY KEY (`rowid`)
    , FOREIGN KEY (`fk_group_rowid`) 
        REFERENCES `group` (`rowid`)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;
ALTER TABLE `user` 
ADD UNIQUE INDEX `idx_rowid_login` (`rowid`, `login`);

-- =====================================
-- table for preference
-- =====================================
CREATE TABLE IF NOT EXISTS `preference`
(
    `rowid` INT(3) NOT NULL AUTO_INCREMENT
    , `name` VARCHAR(100) NOT NULL
    , `description` VARCHAR(300)
    
    , PRIMARY KEY (`rowid`)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

-- =====================================
-- table for asso_user_preference
-- =====================================
CREATE TABLE IF NOT EXISTS `asso_user_preference`
(
    `rowid` INT(3) NOT NULL AUTO_INCREMENT
    , `fk_user_rowid` INT(4) NOT NULL
    , `fk_preference_rowid` INT(4) NOT NULL

    , PRIMARY KEY (`rowid`)
    , FOREIGN KEY (`fk_user_rowid`) 
        REFERENCES `user` (`rowid`) ON DELETE CASCADE
    , FOREIGN KEY (`fk_preference_rowid`) 
        REFERENCES `preference` (`rowid`) ON DELETE CASCADE
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

ALTER TABLE `asso_user_preference`
ADD UNIQUE INDEX `idx_rowid_userid_prefid` (`rowid` , `fk_user_rowid` , `fk_preference_rowid`);


-- =====================================
-- table for music_album
-- =====================================
CREATE TABLE IF NOT EXISTS `music_album`
(
    `rowid` INT(4) NOT NULL AUTO_INCREMENT
    , `active` BOOLEAN NOT NULL
    , `name` VARCHAR(50) NOT NULL UNIQUE
    , `path_image` VARCHAR(512)
    , `link_spotify` VARCHAR(512)
    , `link_applemusic` VARCHAR(512)
    , `link_itunes` VARCHAR(512)
    , `link_deezer` VARCHAR(512)
    , `link_amazonmusic` VARCHAR(512)
    , `link_googleplay` VARCHAR(512)
    , `link_tidal` VARCHAR(512)
    , PRIMARY KEY (`rowid`)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

ALTER TABLE `music_album` 
ADD UNIQUE INDEX `idx_music_album_rowid_name` (`rowid` , `name`);

-- =====================================
-- table for song
-- =====================================
CREATE TABLE IF NOT EXISTS `music_song`
(
    `rowid` INT(4) NOT NULL AUTO_INCREMENT
    , `active` BOOLEAN NOT NULL
    , `fk_album_rowid` INT(4) NOT NULL
    , `name` VARCHAR(50) NOT NULL
    , `path_image` VARCHAR(512)
    , `path_mp3` VARCHAR(512)
    , `lyrics` MEDIUMTEXT
    , PRIMARY KEY (`rowid`)
    , FOREIGN KEY (`fk_album_rowid`) REFERENCES `music_album` (`rowid`) ON DELETE NO ACTION
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

ALTER TABLE `music_song` 
ADD UNIQUE INDEX `idx_music_song_rowid_name` (`rowid` , `name`);


-- =====================================
-- table for product
-- =====================================
CREATE TABLE IF NOT EXISTS `product`
(
    `rowid` INT(4) NOT NULL AUTO_INCREMENT
    , `active` BOOLEAN NOT NULL
    , `name` VARCHAR(100) NOT NULL
    , `purchase_url` VARCHAR(512)
    , `price` DECIMAL(4 , 2)
    , `description` MEDIUMTEXT

    , PRIMARY KEY (`rowid`)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

ALTER TABLE `product`
ADD UNIQUE INDEX `idx_product_rowid_name` (`rowid` , `name`);

-- =====================================
-- table for productImage
-- =====================================
CREATE TABLE IF NOT EXISTS `productimage`
(
    `rowid` INT(4) NOT NULL AUTO_INCREMENT
    , `active` BOOLEAN NOT NULL
    , `fk_product_rowid` INT(4) NOT NULL
    , `path_image` VARCHAR(512)
    , `title` VARCHAR(200)
    , `alt_text` VARCHAR(200)

    , PRIMARY KEY (`rowid`)
    , FOREIGN KEY (`fk_product_rowid`) 
        REFERENCES `product` (`rowid`) 
        ON DELETE CASCADE
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

ALTER TABLE `productimage`
ADD UNIQUE INDEX `idx_rowid_title` (`rowid` , `title`);


-- =====================================
-- table for concert
-- =====================================
CREATE TABLE IF NOT EXISTS `concert`
(
    `rowid` INT(4) NOT NULL AUTO_INCREMENT
    , `active` BOOLEAN NOT NULL
    
    -- date [format date]
    , `date` DATE # peut être null si on ne sait pas encore quand
    -- heure debut
    , `hour_start` TIME
    -- heure fin
    , `hour_end` TIME
    
    -- nom du lieu [string] (peut être nom du bar, nom de la salle)
    , `venue_name` VARCHAR(100) NOT NULL
    
    -- ville
    , `city_name` VARCHAR(100)

    -- lien map
    , `url_map` VARCHAR(512)

    -- chemin vers affiche (jpg)
    , `path_image` VARCHAR(512)
    
    -- text de description
    , `description` MEDIUMTEXT

    # , `purchase_url` VARCHAR(512)
    # , `price` DECIMAL(4 , 2)

    , PRIMARY KEY (`rowid`)
)
ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 COLLATE 'utf8mb4_general_ci'
;

ALTER TABLE `concert`
ADD UNIQUE INDEX `idx_concert_rowid_venue_name` (`rowid` , `venue_name`);
