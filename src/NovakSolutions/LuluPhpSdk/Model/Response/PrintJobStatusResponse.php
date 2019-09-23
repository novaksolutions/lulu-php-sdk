<?php


namespace NovakSolutions\LuluPhpSdk\Model\Response;

use NovakSolutions\RestSdkBase\Model\Response\Response;

class PrintJobStatusResponse extends Response
{
    public $changed = null;
    public $message = null;
    public $name = null;
}