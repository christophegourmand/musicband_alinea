<main class="">
    <?php include($prefix_to_root_folder.'datas/photos_array.php'); ?>

    <?php
        // on page_photos , when user click a photo thumbnail, the url pass 2 variables that we collect here : 
        $album_id = intval( $_GET['album_id'] );
        $photo_id = intval( $_GET['photo_id'] );

        $photoAlbum_albumName = $photoAlbums_indArray[$album_id]['album_name'];
        $photoAlbum_path_to_thumbmails = $photoAlbums_indArray[$album_id]['path_to_thumbnails'];
        $photoAlbum_path_to_originals = $photoAlbums_indArray[$album_id]['path_to_originals'];
        $photos_of_album_indArr = $photoAlbums_indArray[$album_id]['photos_of_album_indArr'];

        // Definition of photo path (previous): 
            if ( intval($photo_id) === 0 ) {
                $path_to_previous_photo = $prefix_to_root_folder.'views/pages/page_photos.php';
            } else {
                $path_to_previous_photo = $prefix_to_root_folder.'views/pages/page_photos_big.php'.'?album_id='.$album_id.'&photo_id='.($photo_id-1);
            }

        // Definition of photo path (next): 
            if ( intval($photo_id) === intval(array_key_last($photos_of_album_indArr)) ) {
                $path_to_next_photo =  $prefix_to_root_folder.'views/pages/page_photos.php';
                
            } else {
                $path_to_next_photo =  $prefix_to_root_folder.'views/pages/page_photos_big.php'.'?album_id='.$album_id.'&photo_id='.($photo_id+1);
            }
    ?>

    <h1 class="page-title">Photos</h1>

    <div class="gallery">
        <h3 class="gallery-title"><?=$photoAlbum_albumName?></h3>
        <div class="gallery-body-big">
            <figure class="gallery-img-container">
                <a class="gallery-img-btn img-btn--previous" href="<?= $path_to_previous_photo ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>
                
                <img class="gallery-img-big" src="<?=$photoAlbum_path_to_originals.$photos_of_album_indArr[$photo_id]['filename']?>" alt="<?= $photos_of_album_indArr[$photo_id]['description']?>">
                
                <a class="gallery-img-btn img-btn--next" href="<?= $path_to_next_photo ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>

                <figcaption class="gallery-img-description"><?= $photos_of_album_indArr[$photo_id]['description']?></figcaption>
            </figure>
        </div>
    </div>

</main>