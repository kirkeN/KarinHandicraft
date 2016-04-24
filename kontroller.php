<?php
require_once("functions.php");
//alusta_sessioon();

$pildid=array(
    array("big"=>"korvarongad1.jpg", "small"=>"pisipilt/korvarongad1.jpg", "alt"=>"kõrvarõngad"),
    array("big"=>"lilled1.jpg", "small"=>"pisipilt/lilled1.jpg", "alt"=>"lilled"),
    array("big"=>"kindad1.jpg", "small"=>"pisipilt/kindad1.jpg", "alt"=>"kindad"),
    array("big"=>"sokid1.jpg", "small"=>"pisipilt/sokid1.jpg", "alt"=>"sokid"),
    array("big"=>"pudelisuuvoo.jpg", "small"=>"pisipilt/pudelisuuvoo.jpg", "alt"=>"pudelisuuvöö"),
    array("big"=>"kangasteljed1.jpg", "small"=>"pisipilt/kangasteljed1.jpg", "alt"=>"kangastelje tööd")
);

if(!empty($_GET["mode"])) {
    $mode = $_GET["mode"];
} else {
    $mode = "empty";
}

switch($mode){
    case "avaleht":
        kuvaAvaleht();
        break;
    case "tooted":
        kuvaTooted();
        break;
    case "loginvorm":
        kuvaLogin();
        break;
    case "logout":
        logivalja();
        break;
    default:
        kuvaAvaleht();
        break;
}
?>

