<?php
require("util.php");
session_start();

echo "<b>Post data</b><br>";
var_dump($_POST);
echo "<br><br><b>Session data</b><br>";
var_dump($_SESSION);
echo "<br><br><b>Get data</b><br>";
var_dump($_GET);
echo "<br><br>";

//ln-55 util.php


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'] )) {
    $userId = isValidUser($_POST['username'], $_POST['password']);
    var_dump($userId);
    if($userId !== false) {
        // $_SESSION['currentUser'] = $_POST['username'];
        $_SESSION['currentUser'] = intval($userId); //casted to int value
    }else{
    $_SESSION['currentUser'] = 'guest';
    }
}

if(isset($_GET['logout'])) {
    unset($_SESSION['currentUser']);
}


$header = "";
$body = "";
$navigationHeader = htmlHeader();
$footer = footer();
switch($_GET["pg"]){
    case "Sign-in":
        $header = "Sign-in";
        $body = signIN();
        break;
    case "Sign-up":
        $header = "Sign-up";
        $body = signUP();
        break;
    case "signUP":
        if(prepareSIGNUP() == true){
            $header="Account Page";
            $body = accountDetails();
            break;
        }else{
            $header = "Sign-up";
            $body = signUP(); 
            break; 
        }
    case "account":
        if($_SESSION['currentUser'] == 'guest'){
            $header="404";
            $body = "404- page not found";
            break;
        }else{
            $header = "Account Page";
            $body = accountDetails();
            break;
        }
    case "artist":
        if(isset($_GET["artist"])){
            $artist = new artist($_GET["artist"]);
            $body = $artist->toHTML();
        }else{
            $header = "artists";
            $body = artistss();
        }
        break;
    case "aboutUs":
        $header = "About Us";
        $body = aboutUs();
        break;
    case "home":
        $header = "Landing page";
        $body = home();
        break;            
    case "artWorks":
        if(isset($_GET['action'])){
            if($_GET['action']=='cart'){
                addToCart($_GET['artwork']);
            }else if ($_GET['action'] == 'wishlist'){
                addtoWishlist($_GET['artwork']);
            }
        }
        if(isset($_GET["artwork"])){
            $artwork = new artwork($_GET["artwork"]);
            $body = $artwork->toHTML();
        }else{
            $header = "artworks";
            $body = artWorkss();
        }
        break;
    case "wishlist":
        if($_SESSION['currentUser'] == 'guest'){
            $header="404";
            $body = "404- page not found";
            break;
        }else if(isset($_POST) && isset($_POST['wish'])) { //fix this shit
            if($_POST['wish'] == "removeWishlist") {                            
                removeFromWishlist($_POST['artworkId']);
            }else if($_POST['wish'] == "addToCart") {
                moveFromWishToCart($_POST['artworkId']);
            }
        }
        $header="wish list";
        $body = buildWishlist();
        break;
    case "shoppingcart":
        if(isset($_POST) && isset($_POST['action'])) {
            if($_POST['action'] == "update") {                            
                updateCart($_POST['quantity'], $_POST['artworkId']);
            }else if($_POST['action'] == "remove") {
                removeFromCart($_POST['artworkId']);
            }else if($_POST['action'] == 'order'){
                placeOrder();
            }
        }
        $header="Shopping cart";
        $body = buildCart();
        break;
    case "review":
        $header="Reviewing an item";
        if(isset($_GET['artworkID'])){
          $body = reviewPage($_GET['artworkID']);  
        }else{
            $header = 'error returning to main page';
            $body = home();
        }
        break;
    case "Logout":
        unset($_SESSION['currentUser']);
        break;
    default:
        $header = 'home';
        $body = home();
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'.
    "<title>$header</title>".
    '<link rel="stylesheet" href="auxillary/default.css">
</head>'.

"<body>$navigationHeader $body $footer</body></html>";
//
?>
