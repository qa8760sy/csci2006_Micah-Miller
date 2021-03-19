<?php
require("functions.php");
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
        $artist = new artist(null);
        $body = $artist->toHTML();
        // set header to artist name. $header = $artist->getName();
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
        $artwork = new artwork(null);
        $body = $artwork->toHTML();
        // set header to artwork name. $header = $artist->getName();
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