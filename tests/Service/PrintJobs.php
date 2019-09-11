<?php


namespace NovakSolutions\LuluPhpSdk\Service;


use NovakSolutions\RestSdkBase\Service\Traits\ListTrait;
use NovakSolutions\RestSdkBase\Service\Service;

class PrintJobs extends Service
{
    use ListTrait;

    public static $endPoint = '/print-jobs';
    public static $parameterToReplaceQuestionMark = 'contactId';
    public static $arrayKey = 'emails';
    public static $class = PrintJob::class;

    //Yes, both contactId and contact_id...  Silly Infusionsoft
    protected static $findByFields = array(
        'contactId',
        'contact_id',
        'email'
    );
}