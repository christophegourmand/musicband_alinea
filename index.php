<?php
    include("common_variables.php"); // In order to use the variable $website_prefix_url . (but later)

    $prefix_to_root_folder = "./";

    include($prefix_to_root_folder."views/pages/page_index.php");

?>



<pre>
    <?php print_r($_SERVER); ?>
</pre>