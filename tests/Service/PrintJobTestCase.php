<?php


namespace NovakSolutions\LuluPhpSdk\Service;


use NovakSolutions\RestSdkBase\Service\Traits\ListTrait;
use NovakSolutions\RestSdkBase\Service\Service;

class PrintJobTestCase extends TestCase
{
    use ListTrait;

    public static $endPoint = '/print-jobs';
    public static $parameterToReplaceQuestionMark = 'contactId';
    public static $arrayKey = 'emails';
    public static $class = PrintJobs::class;

    //Yes, both contactId and contact_id...  Silly Infusionsoft
    protected static $findByFields = array(
        'contactId',
        'contact_id',
        'email'
    );
}