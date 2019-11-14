<?php
require __DIR__ . '/vendor/autoload.php';


use NovakSolutions\LuluPhpSdk\Lulu;
use NovakSolutions\LuluPhpSdk\Model\PoPo\Address;
use NovakSolutions\LuluPhpSdk\Model\PoPo\LineItem;
use NovakSolutions\LuluPhpSdk\Model\PrintJob;
use NovakSolutions\LuluPhpSdk\Service\PrintJobs;
use NovakSolutions\LuluPhpSdk\Service\PrintJobsStatus;

Lulu::connectLive('397e9b3e-bf62-4154-b2a9-ff712da39052', '08d2f33e-819d-44a1-977f-d3a72621dc9f');
//Lulu::connectSandbox($_ENV['CLIENT_KEY'], $_ENV['CLIENT_SECRET']);



$printJob = createPrintJobGB();

//Test Print Job Cost Calcuation
$printJobCostCalculation = new \NovakSolutions\LuluPhpSdk\Model\PrintJobCostCalculation();
$printJobCostCalculation->fromPrintJob($printJob);
//Ground used to throw an exception...
$results = $printJobCostCalculation->getShippingLevelPrices(array("MAIL","PRIORITY_MAIL","GROUND","GROUND_HD","GROUND_BUS","EXPEDITED","EXPRESS"));
var_dump($results);

function createPrintJobGB(): PrintJob
{
    $printJob = new PrintJob();
    $printJob->line_items[] = new LineItem("", 1, "Test Book", "http://google.com", "http://www.google.com", "1100X0850BWSTDCO080CW444GXX", 20);
    $printJob->contact_email = 'jon.doe@gmail.com';
    $printJob->shipping_address = new Address();

    $printJob->shipping_address->city = 'Rugby';
    $printJob->shipping_address->postcode = 'CV21 1BS';
    $printJob->shipping_address->state_code = 'Warwickshire';
    $printJob->shipping_address->street1 = '21 Houston Road';
    $printJob->shipping_address->phone_number = '503-719-2169';

    $printJob->shipping_address->name = 'Jim Bob';
    $printJob->shipping_address->country_code = 'GB';

    $printJob->shipping_level = 'MAIL';
    return $printJob;
}
?>