<main class="">
    <h1 class="page-title">Photos</h1>

    <?php include($prefix_to_root_folder.'datas/photos_array.php'); ?>

    <div class="gallery">
        <!-- div class gallery-album -->
            <?php for($album_index = 0 ; $album_index < sizeof($photoAlbums_indArray) ; $album_index++): ?>
                <?php
                    $photoAlbum_albumName = $photoAlbums_indArray[$album_index]['album_name'];
                    $photoAlbum_path_to_thumbmails = $photoAlbums_indArray[$album_index]['path_to_thumbnails'];
                    $photoAlbum_path_to_originals = $photoAlbums_indArray[$album_index]['path_to_originals'];
                    $photos_of_album_indArr = $photoAlbums_indArray[$album_index]['photos_of_album_indArr'];
                ?>
                <h3 class="gallery-title"><?=$photoAlbum_albumName?></h3>
                
                <div class="gallery-body">
                    <?php for($index_img=0 ; $index_img < sizeof($photos_of_album_indArr) ; $index_img++): ?>
                        <a class="gallery-img-link" href="<?=$prefix_to_root_folder.'views/pages/page_photos_big.php'.'?album_id='.$album_index.'&photo_id='.$index_img?>">
                            <img class="gallery-img" src="<?=$photoAlbum_path_to_thumbmails.$photos_of_album_indArr[$index_img]['filename']?>" alt="<?= $photos_of_album_indArr[$index_img]['description']?>">
                        </a>
                    <?php endfor ?>
                </div>
            <?php endfor ?>
        <!-- </div> -->
    </div>

</main>
