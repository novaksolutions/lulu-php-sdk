<?php

namespace NovakSolutions\LuluPhpSdk\Model\PoPo;

class Printable
{
    /** @var SourceUrl */
    public $cover;

    /** @var SourceUrl */
    public $interior;
    public $pod_package_id;

    public function __construct($cover_pdf_url = null, $interior_pdf_url = null, $pod_package_id = null){
        if($cover_pdf_url != null) {
            $this->cover = new SourceUrl($cover_pdf_url);
        }

        if($interior_pdf_url != null){
            $this->interior = new SourceUrl($interior_pdf_url);
        }

        if($pod_package_id != null){
            $this->pod_package_id = $pod_package_id;
        }
    }
}