<?php

namespace App\Controller;


use App\Helpers\Pagination;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{

    protected function getPagination(Request $request)
    {
        $currentPage = $request->query->get("page");
        $itensPerPage = $request->query->get("qtdItens");
        $pagination = new Pagination();
        $pagination->setCurrentPage($currentPage);
        $pagination->setQuantityItensPage($itensPerPage);
        return $pagination;
    }

    protected function getFilters(Request $request)
    {
        $filters = $request->query->all();
        unset($filters["sort"]);
        unset($filters["page"]);
        unset($filters["qtdItensPage"]);
        return $filters;
    }

    protected function getOrdernation(Request $request) {
        return $request->query->get("sort") ?? [];
    }

    protected function getDatasBodyRequest(Request $request) {
        $datas = $request->getContent();
        return json_decode($datas, true);
    }

    protected function displayError(\Exception $exception) {
        return new JsonResponse([
            "statusCode" => $exception->getCode(),
            "message" => $exception->getMessage()
        ], $exception->getCode());
    }
}