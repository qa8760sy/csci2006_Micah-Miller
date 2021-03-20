<?php
require("util.php");
// require("auxillary/default.css");

$header = "";
$body = "";
$navigationHeader = htmlHeader();
$footer = footer();
switch($_GET["pg"]){
    case "account":
        $header = "Account Page";
        $body = accountDetails();
        break;
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
        $header = "Account Page";
        $body = aboutUs();
        break;
    case "home":
        $header = "Account Page";
        $body = home();
        break;            
    case "artWorks":
        if(isset($_GET["artwork"])){
            $artwork = new artwork($_GET["artwork"]);
            $body = $artwork->toHTML();
        }else{
            $header = "artworks";
            $body = artWorkss();
        }
        break;
    default:
        $header = printTitle();
        $body = printBody();
}

// $stringConcat = $header.$body;
// echo"$stringConcat";
// echo"$concatenation.$body;
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