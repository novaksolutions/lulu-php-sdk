<?php

namespace NovakSolutions\LuluPhpSdk\Service;

use NovakSolutions\LuluPhpSdk\Model\Response\PrintJobStatusResponse;
use NovakSolutions\RestSdkBase\Service\Traits\RetrieveTrait;

class PrintJobsStatus extends LuluService
{
    use RetrieveTrait;

    public static $endPoint = '/print-jobs/?/status/';
    public static $class = PrintJobStatusResponse::class;

}