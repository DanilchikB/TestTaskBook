<?php

namespace app\PageElement;

class Pagination{
    private $countElementsPage;

    public function __construct($countElementsPage)
    {
        $this->countElementsPage = $countElementsPage;
    }
    public function getCountPages($countElements):int{
        $countPages = (int)$countElements/$this->countElementsPage;
        if(($countElements % $this->countElementsPage)!=0){
            $countPages++;
        }
        return $countPages;
    }
} 