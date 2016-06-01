<?php
ini_set("display_errors", 1);
function connect_db(){
    global $L;
    $host="localhost";
    $user="test";
    $pass="t3st3r123";
    $db="test";
    $L = mysqli_connect($host, $user, $pass, $db) or die("Ei saa mootoriga ühendust");
    mysqli_query($L, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($L));
}

function login() {
    global $L;
    if(!empty($_POST)) {
        $errors = array();
        if (empty($_POST['username'])){
            $errors[]="Sisesta kasutajanimi!";
        }
        if (empty($_POST['password'])){
            $errors[]="Sisesta parool!";
        }
        if(empty($errors)) {
            // turva
            $user=mysqli_real_escape_string($L,$_POST['username']);
            $pass=mysqli_real_escape_string($L,$_POST['password']);

            $sql="SELECT id, username FROM kinarusk_kasutajad WHERE username = '$user' AND passwd = SHA1('$pass')";
            $result = mysqli_query($L, $sql);

            if ($result && $user = mysqli_fetch_assoc($result)){
                // ok, muutjas $user on massiiv
                $_SESSION['user']=$user;
                $_SESSION['message']="Sisselogimine õnnestus";
                header("Location: http://enos.itcollege.ee/~kinarusk/kontroller.php?mode=welcome");
                exit(0);
            }
            else {
                $errors[]="Sisselogimine ebaõnnestus?";
            }
        }
    }
    include("views/loginaken.html");
}

function reg(){
    global $L;
    if (!empty($_POST)) {
        $errors = array();
        if (empty($_POST['username'])) {
            $errors[] = "Sisesta kasutajanimi!";
        }
        if (empty($_POST['passwd'])) {
            $errors[] = "Sisesta parool!";
        }
        if (empty($_POST['passwd2'])) {
            $errors[] = "Parooli peab 2 korda sisestama!";
        }
        if (!empty($_POST['passwd']) && !empty($_POST['passwd2']) && $_POST['passwd'] != $_POST['passwd2']) {
            //paroolid ei ole v6rdsed
            $errors[] = "Paroolid ei ole identsed!";
        }

        if (empty($errors)) {
            global $L;
            // turvalisus
            $user = mysqli_real_escape_string($L, $_POST['username']);
            $pass = mysqli_real_escape_string($L, $_POST['passwd']);

            $sql = "INSERT INTO kinarusk_kasutajad (username, passwd) VALUES ('$user', SHA1('$pass'))";
            $result = mysqli_query($L, $sql);
            if ($result) {
                // korras
                $_SESSION['message'] = "Registreerumine õnnestus, logi sisse!";
                header("Location: ?mode=login");
                exit(0);
            } else {
                $errors[] = "Registreerumine ebaõnnestus, proovi uuesti!";
            }
        }
    }
    include("views/register.html");
}

function logivalja() {
    lopeta_sessioon();
    header("Location: kontroller.php?mode=avaleht");
    exit(0);
}

function alusta_sessioon(){
    session_set_cookie_params(30*60);
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