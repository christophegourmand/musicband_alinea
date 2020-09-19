<?php include($prefix_to_root_folder.'datas/allSongs_variables.php')?>

<main>
    <h2 class="page-title">Musique</h2>
    
    <section class="songs split_30_70">
        <aside class="songs-list horizontalCard-container">
            <?php for($i=0 ; $i<count($allSongs_indArray) ; $i++): ?>
                <div class="horizontalCard <?='bg-song-'.$i?>" id="<?php echo('horizontalCard_song_'.$i);?>">
                    <a class="horizontalCard-link" href="<?php echo($prefix_to_root_folder.'views/pages/page_lyrics.php'.'?songClicked='.$i);?>">

                    <!-- .'/?song='.$i -->
                        <h3 class="horizontalCard-title"><?=$allSongs_indArray[$i]["song_title"]?></h3>
                    </a>
                </div>
            <?php endfor; ?>
        </aside>

        <div class="lyric">
            <!-- plus tard changer la valeur de [0] selon le click -->
            <!--
            <h3 class="lyric-title"><?=$allSongs_indArray[0]["song_title"]?></h3>
            <article class="lyric-list">
                <p class="lyric-paragraph">
                    <span class="lyric-sentence">Not by way of an apology</span>
                    <span class="lyric-sentence">For the things that I have done</span>
                    <span class="lyric-sentence">Do I set my boat upon the sea</span>
                </p>
                <p class="lyric-paragraph">
                    <span class="lyric-sentence">So like thunder I am breaking free</span>
                    <span class="lyric-sentence">In the landscape of the heart</span>
                    <span class="lyric-sentence">It's hard to tell what's really taken me</span>
                </p>
                <p class="lyric-paragraph chorus">
                    <span class="lyric-sentence">Now I see it all through different eyes</span>
                    <span class="lyric-sentence">This emotion can't be wrong</span>
                    <span class="lyric-sentence">Past the mountains under empy skies</span>
                    <span class="lyric-sentence">And the road goes on and on...</span>
                </p>
                <p class="lyric-paragraph">
                    <span class="lyric-sentence">I've been living through this poetry</span>
                    <span class="lyric-sentence">Tangled words and worn out prose</span>
                    <span class="lyric-sentence">Love is needing, love is bleeding me</span>
                </p>
            </article>
            -->
        </div>
    </section>
    
</main>