<?php

require 'vendor/autoload.php';

$i = 0;

$app = function ($request, $response) use (&$i) {
    $i++;

    $text = "This is request number $i.\n";
    $headers = array('Content-Type' => 'text/plain');

    $response->writeHead(200, $headers);
    $response->end($text);
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket);

$http->on('request', $app);
$socket->listen(1337, "0.0.0.0");

echo "Server running at http://127.0.0.1:1337\n";
$loop->run();
