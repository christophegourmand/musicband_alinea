<?php include($prefix_to_root_folder.'datas/allSongs_variables.php')?>

<main>
    <h2 class="page-title">Musiques</h2>
    
    <section class="album">
        <h2 class="album-title">Madison<sup class="album-title-mention">1er&nbsp;album</sup></h2>

        <img class="album-img" src="<?php echo($prefix_to_root_folder.'/assets/img/photos/album_madison_book/00_PochetteAvant.jpg');?>" title="Pochette de l'album Madison" alt="Pochette de l'album Madison">
        
        <aside class="album-songs-cards">
            <?php for($i=0 ; $i<count($allSongs_indArray) ; $i++): ?>
                <div class="horizontalCard <?='bg-song-'.$i?>" id="<?php echo('horizontalCard_song_'.$i);?>">
                    <a class="horizontalCard-link" href="<?php echo($prefix_to_root_folder.'views/pages/page_lyrics.php'.'?songClicked='.$i);?>">

                    <!-- .'/?song='.$i -->
                        <h3 class="horizontalCard-title"><?=$allSongs_indArray[$i]["song_title"]?></h3>
                    </a>
                </div>
            <?php endfor; ?>
        </aside>
    </section>
    
</main>