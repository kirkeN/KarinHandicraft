<?php
require_once("functions.php");
connect_db();
session_start();

$pildid=array(
    array("big"=>"suurpilt/korvarongad1.jpg", "small"=>"pisipilt/korvarongad1.jpg", "alt"=>"kõrvarõngad"),
    array("big"=>"suurpilt/lilled1.jpg", "small"=>"pisipilt/lilled1.jpg", "alt"=>"lilled"),
    array("big"=>"suurpilt/kindad1.jpg", "small"=>"pisipilt/kindad1.jpg", "alt"=>"kindad"),
    array("big"=>"suurpilt/sokid1.jpg", "small"=>"pisipilt/sokid1.jpg", "alt"=>"sokid"),
    array("big"=>"suurpilt/pudelisuuvoo.jpg", "small"=>"pisipilt/pudelisuuvoo.jpg", "alt"=>"pudelisuuvöö"),
    array("big"=>"suurpilt/kangasteljed1.jpg", "small"=>"pisipilt/kangasteljed1.jpg", "alt"=>"kangastelje tööd")
);
$mode="";
if(!empty($_GET["mode"])) {
    $mode = $_GET["mode"];
} else {
    $mode = "empty";
}

switch($mode){
    case "avaleht":
        include_once("views/head2.html");
        include("views/avaleht.html");
        include_once("views/footer.html");
        break;
    case "tooted":
        include_once("views/head.html");
        include("views/tooted.html");
        include_once("views/footer.html");
        break;
    case "register":
        reg();
        break;
    case "login":
        login();
        break;
    case "welcome":
        include("views/sisselogitud.html");
        break;
    case "logout":
        logout();
        break;
    case "hinnad":
        include_once("views/head.html");
        include("views/tabel.html");
        include_once("views/footer.html");
        break;
    default:
        include_once("views/head2.html");
        include("views/avaleht.html");
        include_once("views/footer.html");
        break;
}
?>

