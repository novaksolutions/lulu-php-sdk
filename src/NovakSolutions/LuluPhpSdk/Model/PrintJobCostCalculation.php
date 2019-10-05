<?php


namespace NovakSolutions\LuluPhpSdk\Model;

use NovakSolutions\LuluPhpSdk\Model\PoPo\PrintJobCostCalculationLineItem;
use NovakSolutions\LuluPhpSdk\Service\PrintJobCostCalculations;
use NovakSolutions\RestSdkBase\Exception\BadRequestException;
use NovakSolutions\RestSdkBase\Model\Model;
use NovakSolutions\RestSdkBase\Model\Traits\SavableTrait;

class PrintJobCostCalculation extends Model
{
    const SHIPPING_LEVEL_MAIL = "MAIL";
    const SHIPPING_LEVEL_PRIORITY = "PRIORITY_MAIL";
    const SHIPPING_LEVEL_GROUND_HD = "GROUND_HD";
    const SHIPPING_LEVEL_GROUND_BUS = "GROUND_BUS";
    const SHIPPING_LEVEL_GROUND = "GROUND";
    const SHIPPING_LEVEL_EXPEDITED = "EXPEDITED";
    const SHIPPING_LEVEL_EXPRESS = "EXPRESS";

    public static $allShippingMethods = [
      self::SHIPPING_LEVEL_MAIL,
      self::SHIPPING_LEVEL_PRIORITY,
      self::SHIPPING_LEVEL_GROUND_HD,
      self::SHIPPING_LEVEL_GROUND_BUS,
      self::SHIPPING_LEVEL_GROUND,
      self::SHIPPING_LEVEL_EXPEDITED,
      self::SHIPPING_LEVEL_EXPRESS
    ];

    public static $serviceClassName = PrintJobCostCalculations::class;
    public static $primaryKeyFieldName = null;

    use SavableTrait;

    /** @var PoPo\PrintJobCostCalculationLineItem[]  */
    public $line_items = [];

    /** @var PoPo\Address  */
    public $shipping_address = null;

    /** @var string */
    public $shipping_level;

    public $total_cost_incl_tax = null;

    public function fromPrintJob(PrintJob $printJob){
        foreach($printJob->line_items as $line_item){
            $lineItem = new PrintJobCostCalculationLineItem();
            $lineItem->quantity = $line_item->quantity;
            $lineItem->pod_package_id = $line_item->printable_normalization->pod_package_id;
            $lineItem->page_count = $line_item->pageCount;
            $this->line_items[] = $lineItem;
        }

        $this->shipping_address = $printJob->shipping_address;
        $this->shipping_level = $printJob->shipping_level;
    }

    public function getShippingLevelPrices(array $shippingLevelsToPrice){
        $originalShippingLevel = $this->shipping_level;
        $pricesByShippingLevel = [];

        foreach($shippingLevelsToPrice as $shippingLevelPrice){
            $this->shipping_level = $shippingLevelPrice;
            try{
                $this->save();
                $pricesByShippingLevel[$this->shipping_level] = $this->total_cost_incl_tax;
            } catch (BadRequestException $e){
                //Lulu will return a 400 Bad Request if "No shipping option found for ___ to __ with pod_packages ____
                //So we trap it here and convert it to null...
                if(strpos($e->getMessage(), "No shipping option found for") !== false){
                    $pricesByShippingLevel[$this->shipping_level] = null;
                } else {
                    throw $e;
                }
            }
        }

        $this->shipping_level = $originalShippingLevel;

        return $pricesByShippingLevel;
    }
}