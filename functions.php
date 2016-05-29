<?php

function kuvaAvaleht() {
    include_once("head.html");
    include("avaleht.html");
}

function kuvaTooted() {
    include_once("head.html");
    include("tooted.html");
}
function kuvaLogin() {
    if(!empty($_POST)) {
        $errors = array();
        if(!empty($_POST["kasutajanimi"])) {

        } else {
            $errors[] = "Sisesta kasutajanimi!";
        }
        if(!empty($_POST["parool"])) {
            //..
        } else {
            $errors[] = "Sisesta parool!";
        }

        if(empty($errors)) {
            if ($_POST["kasutajanimi"] == "kasutaja" && $_POST["parool"] == "parool"){
                $_SESSION["user"] = $_POST["kasutajanimi"];
                $_SESSION["teade"] = "Sisselogimine õnnestus!";
                header("Location: kontroller.php?mode=tooted");
                exit(0);
            } else {
                $errors[] = "Kasutajanimi või parool on vale";
            }
        }
    }
    include_once("head.html");
    include("loginaken.html");
}
function kuvaRegistreeri() {
    include_once("head.html");
    include("register.html");
}
function reg(){
        if(!empty($_POST)){
            $errors=array();
            if (empty($_POST['username'])){
                $errors[]="Kasutajanimi on vajalik!";
            }
            if (empty($_POST['password'])){
                $errors[]="Parool on vajalik!";
            }
            if (empty($_POST['password2'])){
                $errors[]="Parooli peab 2 korda sisestama!";
            }
            if(!empty($_POST['password']) && !empty($_POST['password2']) && $_POST['password']!=$_POST['password2']) {
                //paroolid ei ole v6rdsed
                $errors[]="Paroolid ei ole identsed!";
            }
            if (empty($errors)){
                // turvalisus
                $user=mysqli_real_escape_string($L,$_POST['username']);
                $pass=mysqli_real_escape_string($L,$_POST['password']);

                $sql="INSERT INTO kasutajad (username, passwd) VALUES ('$user', SHA1('$pass'))";
                $result = mysqli_query($L, $sql);
                if ($result){
                    // kÃµik ok, 
                    $_SESSION['message']="Registreerumine õnnestus, logi sisse";
                    header("Location: ?page=login");
                    exit(0);
                } else {
                    $errors[]="Registreerumine luhtus, proovi hiljem jälle...";
                }
        }
    include_once("views/head.html");
    include("views/register.html");
    include_once("views/foot.html");
}

function logivalja() {
    lopeta_sessioon();
    header("Location: kontroller.php?mode=avaleht");
    exit(0);
}

function alusta_sessioon(){
    // siin ees võiks muuta ka sessiooni kehtivusaega, aga see pole hetkel tähtis
    session_start();
}

function lopeta_sessioon(){
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
}

?>