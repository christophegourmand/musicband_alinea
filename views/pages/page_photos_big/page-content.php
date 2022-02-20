<main class="">
    <?php
        include($_SERVER['DOCUMENT_ROOT']."/".'datas/photos_array2.php');
        
        require_once($_SERVER['DOCUMENT_ROOT']."/"."debug/debug_functions.php");
        use christophegourmand\debug as debug;

        // on page_photos , when user click a photo thumbnail, the url pass 2 variables that we collect here : 
        $album_id_from_url = intval( $_GET['album_id'] );
        $photo_id_from_url = intval( $_GET['photo_id'] );
        
        $album_obj = $gallery1->getAlbum($album_id_from_url);
        $photo_obj = $album_obj->getPhoto($photo_id_from_url);
        // $photo_previous = $album_obj->getPhoto($photo_id_from_url - 1);
        // $photo_next = $album_obj->getPhoto($photo_id_from_url + 1);

        // Definition of photo path (previous): 
            if ( intval($photo_id_from_url) === 0 ) {
                $path_to_previous_photo = '/views/pages/page_photos.php';
            } else {
                $path_to_previous_photo = '/views/pages/page_photos_big.php'.'?album_id='.$album_id_from_url.'&photo_id='.($photo_id_from_url - 1);
            }

        // Definition of photo path (next): 
            if ( intval($photo_id_from_url) >= $album_obj->getSize() - 1 ) {
                $path_to_next_photo = '/views/pages/page_photos.php';
            } else {
                $path_to_next_photo = '/views/pages/page_photos_big.php'.'?album_id='.$album_id_from_url.'&photo_id='.($photo_id_from_url + 1);
            }
    ?>

    <h1 class="page-title">Photos</h1>

    <div class="gallery">
        <a class="gallery-img-btn img-btn--back" href="<?= '/views/pages/page_photos.php';?>">
            <i class="fas fa-th"></i>
        </a>
        <h3 class="gallery-title"><?= $album_obj->getTitle(); ?></h3>
        <div class="gallery-body-big">
            <figure class="gallery-img-container">
                <a class="gallery-img-btn img-btn--previous" href="<?= $path_to_previous_photo; ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>

                
                <img 
                    class="gallery-img-big" 
                    src="<?= $album_obj->getPath_to_originals().$photo_obj->getFilename()?>" 
                    alt="<?= $photo_obj->getDescription(); ?>"
                >
                
                <a class="gallery-img-btn img-btn--next" href="<?= $path_to_next_photo; ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>

                <figcaption class="gallery-img-description"><?= $photo_obj->getDescription(); ?></figcaption>
            </figure>
        </div>
    </div>

</main>