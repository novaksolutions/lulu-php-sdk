<?php
namespace NovakSolutions\LuluPhpSdk\Model;

use NovakSolutions\LuluPhpSdk\Service\PrintJobs;
use NovakSolutions\RestSdkBase\Model\Model;
use NovakSolutions\RestSdkBase\Model\Traits\IgnoreIgnoreOnJsonSerialize;
use NovakSolutions\RestSdkBase\Model\Traits\SavableTrait;

class PrintJob extends Model implements \JsonSerializable
{
    use IgnoreIgnoreOnJsonSerialize;
    /** @var string  */
    public $contact_email = null;

    /** @var PoPo\LineItem[]  */
    public $line_items = [];

    public $production_delay = 120;

    /** @var PoPo\Address  */
    public $shipping_address = null;

    /** @var string */
    public $shipping_level;

    /** @var string
     *  @ignoreOnJsonSerialize
     */
    public $rando = ';lkjasdf';
    public static $serviceClassName = PrintJobs::class;

    use SavableTrait;
}