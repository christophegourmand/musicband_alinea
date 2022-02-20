<!-- div class gallery-album -->
    <?php #include($_SERVER['DOCUMENT_ROOT']."/".'datas/photos_array.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT']."/".'datas/photos_array2.php'); ?>
        
    <?php foreach($gallery1->getAlbums() as $albumIndex => $album): ?>
        <h3 class="gallery-title"><?=$album->getTitle()?></h3>

        <?php 
            // $pathToOriginals = $album->getPath_to_thumbnails();
            // print $pathToOriginals;
        ?>
        
        <div class="gallery-body-flex2">

            <?php foreach($album->getPhotos() as $photoIndex => $photo): ?>
                <!-- ci dessous, leur appliquer la classe animation-appearsFromBottom -->
                <a class="gallery-img-link <?= $photo->getOrientation() ?>" href="<?= '/views/pages/page_photos_big.php'.'?album_id='.$albumIndex.'&photo_id='.$photoIndex ?>">
                    <img 
                        class="gallery-img"
                        src="<?= $album->getPath_to_thumbnails().$photo->getFilename()?>" 
                        alt="<?= $photo->getDescription()?>"
                        title="<?= $photo->getDescription()?>"
                    >
                    <!-- C:/Users/sarag/Dropbox/PROGRAMMATION/MES_SITES/SITE_ALINEA/www/assets/img/photos/from-facebook/2019.10.22/thumbnails/IMG_0558_facebook.JPG -->
                </a>
            <?php endforeach ?>
                <!-- EMPTY ELEMENT TO IMPROVE FLEXBOX SPACE OPTIMIZATTION -->
                <a class="gallery-img-link" href="">
                    
                </a>
        </div>

    <?php endforeach ?>

<!-- </div> -->