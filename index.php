<?php
require __DIR__ . '/vendor/autoload.php';


use NovakSolutions\LuluPhpSdk\Lulu;
use NovakSolutions\LuluPhpSdk\Model\PoPo\Address;
use NovakSolutions\LuluPhpSdk\Model\PoPo\LineItem;
use NovakSolutions\LuluPhpSdk\Model\PrintJob;
use NovakSolutions\LuluPhpSdk\Service\PrintJobs;

//Lulu::connectLive($_ENV['CLIENT_KEY'], $_ENV['CLIENT_SECRET']);
Lulu::connectSandbox($_ENV['CLIENT_KEY'], $_ENV['CLIENT_SECRET']);

//Get all print jobs...
$results = PrintJobs::find();

//Create a print job...
$printJob = new PrintJob();
$printJob->line_items[] = new LineItem("", 1, "Test Book", "http://google.com", "http://www.google.com", "1100X0850BWSTDCO080CW444GXX");
$printJob->contact_email = 'jon.doe@gmail.com';
$printJob->shipping_address = new Address();


$printJob->shipping_address->name = 'Jim Bob';
$printJob->shipping_address->country_code = 'US';

$printJob->shipping_level = 'MAIL';

$printJob->save();


var_dump($results);


//$liveResults = PrintJob::find([], null, null, 'live');
//var_dump($liveResults);
?>