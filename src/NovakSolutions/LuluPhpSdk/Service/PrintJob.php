<?php

namespace NovakSolutions\LuluPhpSdk\Service;

use NovakSolutions\RestSdkBase\Service\Traits\ListTrait;

class PrintJob extends LuluService
{
    use ListTrait;

    public static $endPoint = '/print-jobs/';
    public static $class = PrintJob::class;

    //Yes, both contactId and contact_id...  Silly Infusionsoft
    protected static $findByFields = array(
        'created_after',
        'created_before',
        'modified_after',
        'modified_before'
    );
}