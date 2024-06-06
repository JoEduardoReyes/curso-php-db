<?php

$server = "localhost";
$database = "finanzas_personales";
$username = "joedu";
$password = "toor";

$connection = new PDO("mysql:host=$server;dbname=$database", $username, $password);

$setnames = $connection->prepare("SET NAMES 'utf8'");
$setnames->execute();

var_dump($setnames);