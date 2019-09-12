<?php
namespace NovakSolutions\LuluPhpSdk\Model\PoPo;


class SourceUrl
{
    /** @var string */
    public $source_url;

    public function __construct($source_url = null){
        if($source_url != null){
            $this->source_url = $source_url;
        }
    }
}