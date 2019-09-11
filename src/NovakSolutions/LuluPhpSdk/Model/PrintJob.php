<?php
namespace NovakSolutions\LuluPhpSdk\Model;

use NovakSolutions\RestSdkBase\Model\Model;

class PrintJob extends Model
{
    protected static $fields = [
        "country_code" => Model::FIELD_TYPE_STRING,
        "line1" =>  Model::FIELD_TYPE_STRING,
        "line2" =>  Model::FIELD_TYPE_STRING,
        "locality" =>  Model::FIELD_TYPE_STRING,
        "region" =>  Model::FIELD_TYPE_STRING,
        "zip_code" =>  Model::FIELD_TYPE_STRING,
        "zip_four" =>  Model::FIELD_TYPE_STRING
    ];
}