<?php

namespace App\BackendBundle\Pagination;


class KnpPagination
{
    private $paginator;
    private $repository;
    private $request;
    private $perpage;

    public function __construct($paginator,$repository,$request)
    {
        $this->paginator = $paginator;
        $this->repository = $repository;
        $this->request = $request;
        $this->perpage = 20;
    }

    public function getPagination()
    {
        $query = $this->repository
                      ->createQueryBuilder('p')
                      ->select('p')
                      ->orderBy('p.id' , 'desc')
        ;

        $pagination = $this->paginator->paginate(
            $query,
            $this->request->getMasterRequest()->query->get('page', 1)/*page number*/,
            $this->perpage/*limit per page*/
        );

        return $pagination;
    }

    /**
     * @param int $perpage
     */
    public function setPerpage($perpage)
    {
        $this->perpage = $perpage;
    }

    /**
     * @return int
     */
    public function getPerpage()
    {
        return $this->perpage;
    }
}