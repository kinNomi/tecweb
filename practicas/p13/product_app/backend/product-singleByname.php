<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use TECWEB\MYAPI\Read\Read;

    $productos = new Read('marketzone');
    $productos->singleByName( $_GET['name'] );
    echo $productos->getData();


?>