<?php
require "predis/autoload.php";
Predis\Autoloader::register();

try {
    $redis = new Predis\Client(array(
        "scheme" => "tcp",
        "host" => "192.168.9.42",
        "port" => 6379
    ));
} catch (Exception $e) {
    die($e->getMessage());
}

$exist = $redis->exists('note');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($exist == 0) {
        $client_data = file_get_contents("php://input");
        $redis->lpush("note", array($client_data));
    } else {
        $client_data = file_get_contents("php://input");
        $id = $redis->lpushx("note",$client_data);
        echo ("l'identifiant pour le mémo ".$client_data." est : ".$id);

    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' and empty($_GET['id'])) {
    $all = $redis->lrange('note', 0, -1);
    $taille = count($all);
    echo ("Vous trouverez tous vos mémos ici");
    echo("</br>");
    echo("</br>");

    for ($i = 0; $i < $taille; $i++) {
        echo $i . ")" . " ". $all[$i];
        echo("</br>");

    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' and !empty($_GET['id'])) {
    $specificElement = $redis->lindex('note', $_GET['id']);
    echo("Voici votre mémo : " . $specificElement);
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $specificElement = $redis->lindex('note', $_GET['id']);
    $redis->lrem('note', $_GET['id'], $specificElement);
}
?>



