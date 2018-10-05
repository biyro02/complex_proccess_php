<?php
/**
 * Created by PhpStorm.
 * User: bayram
 * Date: 05.10.2018
 * Time: 10:35
 */
$pages = [
    "index",
    "calculate",
    "goodbye"
];
$open = (isset($_GET['page']) && in_array($_GET['page'],$pages)) ? $_GET['page'] : $pages[0];
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rastgele sayı üret - Yüzde hesapla</title>
    <link rel="stylesheet" href="<?=__DIR__."/../vendor/css/stil.css"?>">
    <script src="<?=__DIR__."/../vendor/js/script.js"?>" type="text/javascript"></script>
</head>
<body>
