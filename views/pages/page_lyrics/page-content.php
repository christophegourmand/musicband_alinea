<?php 
    if ( !isset($_GET['songClicked']) || $_GET['songClicked'] == null )
    {
        $songToDisplay_nbr = 0;
    }
    else 
    {        
        $songToDisplay_nbr = $_GET['songClicked'];
    }

    include($prefix_to_root_folder.'datas/allSongs_variables.php');
    
    $song_assoArr = $allSongs_indArray[$songToDisplay_nbr];
    $song_title_str = $song_assoArr['song_title'];
    $lyrics_paragraphs_indArr = $song_assoArr["song_lyrics_paragraphs"];

?>

<main>
    <h2 class="page-title">Musiques</h2>

    
    <section class="album">
        <h2 class="album-title">Madison</h2>
    </section>

    <section class="songs">

        <aside class="songs-song-banner">
                <div class="horizontalCard <?='bg-song-'.$songToDisplay_nbr;?>" id="<?='horizontalCard_song_'.$songToDisplay_nbr;?>">
                    <a class="horizontalCard-btn btn-outline-white" href="<?=$prefix_to_root_folder.'views/pages/page_musiques.php';?>">
                        <span class="btn-txt">&lt;</span>
                    </a>
                    <a class="horizontalCard-link" href="<?=$prefix_to_root_folder.'views/pages/page_musiques.php';?>">
                        <h3 class="horizontalCard-title horizontalCard-title--big"><?=$song_title_str?></h3>
                    </a>
                </div>
        </aside>

        <div>

        </div>

        <article class="lyrics white">
            <?php for ($paragraph_index = 0 ; $paragraph_index < count($lyrics_paragraphs_indArr) ; $paragraph_index++): ?>
                <?php $paragraph_sentences_indArr = $lyrics_paragraphs_indArr[$paragraph_index]['sentences']; ?>
                <?php $paragraph_type_str = $lyrics_paragraphs_indArr[$paragraph_index]['type']; ?>

                <p class="lyrics-paragraph <?=$paragraph_type_str;?> ">
                    <?php for($sentence_index = 0 ; $sentence_index < count($paragraph_sentences_indArr) ; $sentence_index++): ?>
                        <span class="lyrics-sentence"> <?php echo($paragraph_sentences_indArr[$sentence_index]);?> </span>
                        <br>
                    <?php endfor; ?>
                </p>
                <br>
            <?php endfor; ?>

        </article>
    </section>

</main>