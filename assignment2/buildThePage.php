<?php
require("functions.php");
// require("auxillary/default.css");
$header = printTitle();
$body = printBody();
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

"<body>$body</body></html>";

?>