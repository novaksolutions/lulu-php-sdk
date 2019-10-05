<?php


namespace NovakSolutions\LuluPhpSdk\Service;


use NovakSolutions\LuluPhpSdk\Lulu;
use NovakSolutions\RestSdkBase\Service\Service;

class LuluService extends Service
{
    public static $webRequesterRegistryKeyPrefix = Lulu::LULU_REGISTRY_PREFIX;
    public static $arrayKey = 'results';
}