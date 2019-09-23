<?php
namespace NovakSolutions\LuluPhpSdk\Model\PoPo;

use NovakSolutions\RestSdkBase\Model\Traits\IgnoreIgnoreOnJsonSerialize;

class LineItem implements \JsonSerializable
{
    use IgnoreIgnoreOnJsonSerialize;

    /** @var string|null  */
    public $external_id = null;

    /** @var Printable|null  */
    public $printable_normalization = null;

    /** @var int|null  */
    public $quantity = 0;

    /** @var string|null */
    public $title = null;

    /** @var int:null
     ** @ignoreOnJsonSerialize
     ** This is used for cost calculations
     */
    public $pageCount = null;

    public function __construct($external_id = null, $quantity = null, $title = null, $printable_cover_pdf_url = null, $printable_interior_pdf_cover_url = null, $printable_pod_package_id = null, $pageCount = 0){
        if($external_id != null){
            $this->external_id = $external_id;
        }

        if($quantity != null){
            $this->quantity = $quantity;
        }

        if($title != null){
            $this->title = $title;
        }

        if($printable_cover_pdf_url != null){
            $this->printable_normalization = new Printable($printable_cover_pdf_url, $printable_interior_pdf_cover_url, $printable_pod_package_id);
        }

        $this->pageCount = $pageCount;
    }
}