<?php


namespace NovakSolutions\LuluPhpSdk;

use NovakSolutions\RestSdkBase\SimpleWebRequester;

class LuluWebRequester extends SimpleWebRequester
{
    public $clientKey = null;
    public $clientSecret = null;
    public $baseUrl = null;

    public $accessTokenInfo = null;

    public function accessTokenStillFresh(){
        return false;
    }

    public function getAccessToken($forceGetNewToken = false){
        if(!$this->accessTokenStillFresh() || $forceGetNewToken){
            $ch = curl_init();

            $url = $this->baseUrl . '/auth/realms/glasstree/protocol/openid-connect/token';
            $urlParams = [];

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

            $payload = [];
            $payload['grant_type'] = 'client_credentials';

            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

            $headers = [
                'Accept: application/json, */*',
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ' . base64_encode($this->clientKey . ':' . $this->clientSecret)
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);

            $this->accessTokenInfo = json_decode($response, true);
        }

        return $this->accessTokenInfo['access_token'];
    }
}