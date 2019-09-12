<?php

namespace NovakSolutions\LuluPhpSdk\Service;

use NovakSolutions\LuluPhpSdk\Model\PrintJob;
use NovakSolutions\RestSdkBase\Service\Traits\CreateTrait;
use NovakSolutions\RestSdkBase\Service\Traits\ListTrait;

class PrintJobs extends LuluService
{
    use ListTrait;
    use CreateTrait;

    public static $endPoint = '/print-jobs/';
    public static $class = PrintJob::class;

    protected static $findByFields = array(
        'created_after',
        'created_before',
        'modified_after',
        'modified_before'
    );
}