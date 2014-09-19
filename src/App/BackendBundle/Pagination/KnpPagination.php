<?php

namespace App\BackendBundle\Pagination;


class KnpPagination
{
    private $paginator;
    private $request;
    private $perpage;
    private $query;

    public function __construct($paginator,$repository,$request)
    {
        $this->paginator = $paginator;
        $this->request = $request;
        $this->perpage = 20;

        $this->query = $repository->createQueryBuilder('p')
                                  ->select('p');
    }

    public function getPagination()
    {


        $this->query = $this->query->orderBy('p.id' , 'desc')
        ;

        $pagination = $this->paginator->paginate(
            $this->query,
            $this->request->getMasterRequest()->query->get('page', 1)/*page number*/,
            $this->perpage/*limit per page*/
        );

        return $pagination;
    }

    /**
     * @param [] $where
     * @return KnpPagination
     */
    public function where($where = [])
    {
        $count = 0;
        foreach($where as $key => $value)
        {
            if( $count == 0)
            {
                $this->query->where('p.'.$key.'='.$value);
            }else
            {
                $this->query->AndWhere('p.'.$key.'='.$value);
            }
            $count++;
        }
        return $this;
    }

    /**
     * @param int $perpage
     * @return KnpPagination
     */
    public function setPerpage($perpage)
    {
        $this->perpage = $perpage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerpage()
    {
        return $this->perpage;
    }
}