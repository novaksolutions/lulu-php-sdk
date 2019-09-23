<?php


namespace NovakSolutions\LuluPhpSdk\Model;

use NovakSolutions\LuluPhpSdk\Model\PoPo\LineItemCosts;
use NovakSolutions\LuluPhpSdk\Model\PoPo\ShippingCost;
use NovakSolutions\LuluPhpSdk\Service\PrintJobCostCalculations;
use NovakSolutions\RestSdkBase\Model\Model;
use NovakSolutions\RestSdkBase\Model\Response\Response;
use NovakSolutions\RestSdkBase\Model\Traits\SavableTrait;

class PrintJobCostCalculationResponse extends Response
{
    public $currency = null;
    public $line_item_costs = null;
    public $shipping_cost = null;
    public $total_cost_excl_tax = null;
    public $total_cost_incl_tax = null;
    public $total_discount_amount = null;
    public $total_tax = null;
}