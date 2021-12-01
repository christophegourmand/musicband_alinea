<?php
/* ------------------------------------------------------------------------
    WHAT TO KNOW: 
        1-
            to use these functions in your 'anyPage.php' , please first use :
            (dont forget to ajust the path);
        
            require_once("../../debug_functions.php");

        2-
            the following functions are used in:
            ./views/pages/debug.php
        
            but you can access at:
            localhost/Cours-php/views/pages/debug.php

------------------------------------------------------------------------ */ 
namespace christophegourmand\debug;

// ###################################################
function showInHtml($variableTo_vardump , $wanted_title = "noTitle: but you can put one as second parameter") {
    echo "<h1 style='font-size:2rem; background: orange;'>{$wanted_title}</h1>";
    echo "<br>";
    var_dump($variableTo_vardump);
}

// ###################################################
function showInConsole($variableTo_vardump, $wanted_title = "'noTitle'") {
    $jsonToVardump = json_encode($variableTo_vardump);  
    
    echo "<script>";
    echo(  "console.log($wanted_title);"  );
    echo(  "console.log($jsonToVardump);"  );
    echo "</script>";
}