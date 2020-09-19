<?php 
    include($prefix_to_root_folder.'datas/allSongs_variables.php');
    
    $songToDisplay_nbr = $_GET['songClicked'];
    
    $song_assoArr = $allSongs_indArray[$songToDisplay_nbr];
    $song_title_str = $song_assoArr['song_title'];
    $lyrics_paragraphs_indArr = $song_assoArr["song_lyrics_paragraphs"];

?>

<main>
    <h2 class="page-title">Musique</h2>

    <button><a href="<?=$prefix_to_root_folder.'views/pages/page_musique.php';?>">RETOUR</a></button>
    
    <section class="songs">
        <aside class="songs-list horizontalCard-container">
        
                <div class="horizontalCard <?='bg-song-'.$songToDisplay_nbr;?>" id="<?='horizontalCard_song_'.$songToDisplay_nbr;?>">
                    <a class="horizontalCard-link" href="<?=$prefix_to_root_folder.'views/pages/page_lyrics.php';?>">
                        <h3 class="horizontalCard-title"><?=$song_title_str?></h3>
                    </a>
                </div>
            
        </aside>

        <div class="lyrics">
            <h3 class="lyrics-title"><?=$song_title_str?></h3>
            <article class="lyrics-list white">
                <?php for ($paragraph_index = 0 ; $paragraph_index < count($lyrics_paragraphs_indArr) ; $paragraph_index++): ?>
                    <?php $paragraph_sentences_indArr = $lyrics_paragraphs_indArr[$paragraph_index]['sentences']; ?>
                    <?php $paragraph_type_str = $lyrics_paragraphs_indArr[$paragraph_index]['type']; ?>

                                                            <!-- <pre> -->
                                                                <?php // print_r($paragraph_sentences_indArr);?>
                                                            <!-- </pre> -->
    
                    <p class="lyrics-paragraph <?=$paragraph_type_str;?> ">
                        <?php for($sentence_index = 0 ; $sentence_index < count($paragraph_sentences_indArr) ; $sentence_index++): ?>
                            <span class="lyrics-sentence"> <?php echo($paragraph_sentences_indArr[$sentence_index]);?> </span>
                            <br>
                        <?php endfor; ?>
                    </p>
                    <br>
                    <br>

                <?php endfor; ?>
                

            </article>
            
        </div>
    </section>
    
</main>