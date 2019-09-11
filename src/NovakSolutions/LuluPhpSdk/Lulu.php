<?php
namespace NovakSolutions\LuluPhpSdk;

use NovakSolutions\RestSdkBase\WebRequesterRegistry;

class Lulu
{
    const LULU_REGISTRY_PREFIX = 'lulu-php-sdk';

    /**
     * @param $authToken
     * @param string $key
     * @throws \Exception
     */
    public static function connectLive($clientKey, $clientSecret, $key = 'default')
    {
        static::connect($clientKey, $clientSecret, 'https://api.lulu.com', $key);
    }

    /**
     * @param $authToken
     * @param string $key
     * @throws \Exception
     */
    public static function connectSandbox($clientKey, $clientSecret, $key = 'default')
    {
        static::connect($clientKey, $clientSecret, 'https://api.sandbox.lulu.com', $key);
    }

    /**
     * @param $authToken
     * @param $key
     * @param $baseUrl
     * @throws \Exception
     */
    public static function connect($clientKey, $clientSecret, $baseUrl, $key){
        $webRequester = WebRequesterRegistry::createAndRegisterWebRequester(static::LULU_REGISTRY_PREFIX . '-' . $key, $baseUrl, LuluWebRequester::class);
        /** @var LuluWebRequester $webRequester */
        $webRequester->clientKey = $clientKey;
        $webRequester->clientSecret = $clientSecret;
        $webRequester->baseUrl = $baseUrl;
    }
}