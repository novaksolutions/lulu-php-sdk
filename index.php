<?php
require __DIR__ . '/vendor/autoload.php';


use NovakSolutions\LuluPhpSdk\Lulu;
use NovakSolutions\LuluPhpSdk\Service\PrintJob;

Lulu::connectLive($_ENV['CLIENT_KEY'], $_ENV['CLIENT_SECRET']);
Lulu::connectSandbox($_ENV['CLIENT_KEY'], $_ENV['CLIENT_SECRET']);
$results = PrintJob::find();
var_dump($results);


//$liveResults = PrintJob::find([], null, null, 'live');
//var_dump($liveResults);
?>