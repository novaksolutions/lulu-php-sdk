<?php

namespace NovakSolutions\LuluPhpSdk\Service;

use NovakSolutions\LuluPhpSdk\Model\PrintJobCostCalculation;
use NovakSolutions\LuluPhpSdk\Model\PrintJobCostCalculationResponse;
use NovakSolutions\RestSdkBase\Service\Traits\CreateTrait;
use NovakSolutions\RestSdkBase\Service\Traits\ListTrait;

class PrintJobCostCalculations extends LuluService
{
    use ListTrait;
    use CreateTrait;

    public static $endPoint = '/print-job-cost-calculations/';
    public static $class = PrintJobCostCalculation::class;
    public static $responseClass = PrintJobCostCalculationResponse::class;

    protected static $findByFields = array(

    );
}