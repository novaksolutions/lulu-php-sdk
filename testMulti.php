<?php
require __DIR__ . '/vendor/autoload.php';


use NovakSolutions\LuluPhpSdk\Lulu;
use NovakSolutions\LuluPhpSdk\Model\PoPo\Address;
use NovakSolutions\LuluPhpSdk\Model\PoPo\LineItem;
use NovakSolutions\LuluPhpSdk\Model\PrintJob;
use NovakSolutions\LuluPhpSdk\Service\PrintJobs;
use NovakSolutions\LuluPhpSdk\Service\PrintJobsStatus;

//Lulu::connectLive($_ENV['CLIENT_KEY'], $_ENV['CLIENT_SECRET']);
Lulu::connectSandbox($_ENV['CLIENT_KEY'], $_ENV['CLIENT_SECRET']);

//Get all print jobs...
$results = PrintJobs::find();




$printJob = createPrintJob();

//Test Print Job Cost Calcuation
$printJobCostCalculation = new \NovakSolutions\LuluPhpSdk\Model\PrintJobCostCalculation();
$printJobCostCalculation->fromPrintJob($printJob);
//Ground used to throw an exception...
$results = $printJobCostCalculation->getShippingLevelPrices(array('MAIL', 'GROUND'));
var_dump($results);

//Test PrintJob Creation
$printJob->save();
var_dump($printJob);

new \NovakSolutions\LuluPhpSdk\Model\Response\PrintJobStatusResponse();
$results = PrintJobsStatus::get($printJob->id);
var_dump($results);

//$liveResults = PrintJob::find([], null, null, 'live');
//var_dump($liveResults);
//Create a print job...
/**
 * @return PrintJob
 */
function createPrintJob(): PrintJob
{
    $printJob = new PrintJob();
    $printJob->line_items[] = new LineItem("", 1, "Test Book", "http://google.com", "http://www.google.com", "1100X0850BWSTDCO080CW444GXX", 20);
    $printJob->contact_email = 'jon.doe@gmail.com';
    $printJob->shipping_address = new Address();

    $printJob->shipping_address->city = 'Aiken';
    $printJob->shipping_address->postcode = '29803';
    $printJob->shipping_address->state_code = 'SC';
    $printJob->shipping_address->street1 = '650 Kimball Pond Rd';
    $printJob->shipping_address->phone_number = '503-719-2169';

    $printJob->shipping_address->name = 'Jim Bob';
    $printJob->shipping_address->country_code = 'US';

    $printJob->shipping_level = 'MAIL';
    return $printJob;
}
?>