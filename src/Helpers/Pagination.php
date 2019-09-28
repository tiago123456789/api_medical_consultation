<?php

namespace App\Helpers;

class Pagination
{

    private $currentPage = 1;

    private $quantityItensPage = 10;

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return ($this->currentPage - 1) * $this->quantityItensPage;
    }

    /**
     * @param mixed $currentPage
     */
    public function setCurrentPage($currentPage)
    {
        if (is_null($currentPage)) {
            $currentPage = 1;
        }
        $this->currentPage = $currentPage;
    }

    /**
     * @return mixed
     */
    public function getQuantityItensPage()
    {
        return $this->quantityItensPage;
    }

    /**
     * @param mixed $quantityItensPage
     */
    public function setQuantityItensPage($quantityItensPage)
    {
        if (is_null($quantityItensPage)) {
            $quantityItensPage = 10;
        }
        $this->quantityItensPage = $quantityItensPage;
    }
}