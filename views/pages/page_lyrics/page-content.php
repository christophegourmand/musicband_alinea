<?php include($prefix_to_root_folder.'datas/allSongs_variables.php');?>
<?php $songToDisplay_nbr = $_GET['songClicked'];?>

<main>
    <h2 class="page-title">Musique</h2>

    <button><a href="<?=$prefix_to_root_folder.'views/pages/page_musique.php';?>">RETOUR</a></button>
    
    <section class="songs">
        <aside class="songs-list horizontalCard-container">
        
                <div class="horizontalCard <?='bg-song-'.$songToDisplay_nbr;?>" id="<?='horizontalCard_song_'.$songToDisplay_nbr;?>">
                    <a class="horizontalCard-link" href="<?=$prefix_to_root_folder.'views/pages/page_lyrics.php';?>">
                        <h3 class="horizontalCard-title"><?=$allSongs_array[$songToDisplay_nbr]['song_title'];?></h3>
                    </a>
                </div>
            
        </aside>

        <pre class="white">
            <?php 
                // TEST DE LOOPING
                // print_r($allSongs_array[$songToDisplay_nbr]); // donne un array . 
                // print_r($allSongs_array[$songToDisplay_nbr]["song_lyrics_paragraphs"]); // donne un array . 

                // for($sentence_index = 0 ; $sentence_index <count($allSongs_array[$songToDisplay_nbr]["song_lyrics_paragraphs"]) ; $sentence_index++) {
                for ($paragraph_index = 0 ; $paragraph_index < 3 ; $paragraph_index++) {
                    print_r( $allSongs_array[$songToDisplay_nbr]["song_lyrics_paragraphs"][$paragraph_index] );
                }
            ?>
        </pre>

        ______________________________________________________________________________________________________
        <div class="lyrics">
            <h3 class="lyrics-title"><?=$allSongs_array[$songToDisplay_nbr]["song_title"]?></h3>
            <article class="lyrics-list">

                <?php for ($paragraph_index = 0 ; $paragraph_index < count($allSongs_array[$songToDisplay_nbr]["song_lyrics_paragraphs"]) ; $paragraph_index++): ?>
                    
                    <?php $sentences_array = $allSongs_array[$songToDisplay_nbr]["song_lyrics_paragraphs"][$paragraph_index]["sentences"];?>
                    
                    <p class="lyrics-paragraph <?=$allSongs_array[$songToDisplay_nbr]["song_lyrics_paragraphs"][$paragraph_index]["type"];?>">
                        <?php for($sentence_index = 0 ; $sentence_index < count($sentences_array) ; $sentence_index++): ?>
                            <span class="lyrics-sentence">$sentences_array[$sentence_index]</span>
                        <?php endfor; ?>
                    </p>
                <?php endfor; ?>

            </article>
            
        </div>
    </section>
    
</main>