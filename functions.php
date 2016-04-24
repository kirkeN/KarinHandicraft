<?php

function kuvaAvaleht() {
    include_once("head.html");
    include_once("avaleht.html");
}

function kuvaTooted() {
    include_once("head.html");
    include_once("tooted.html");
}

function logivalja() {
    header("Location: kontroller.php?mode=avaleht");
    exit(0);
}

?>