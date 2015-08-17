<?php
/**
 * Created by PhpStorm.
 * User: rtwf6589
 * Date: 29/10/13
 * Time: 12:11
 */

namespace GraphNews\PaginatorBundle\Pagination;


class Pagination {

    /**
     *
     */
    public function __construct(){

    }

    /**
     * @param $page
     * @param $limit
     * @param $pageCount
     * @param $routing
     * @return array
     */
    public function pagination($page, $limit, $totalCount, $routing){

        $startPage = $endPage = null;
        $pageCount = intval(ceil($totalCount / $limit));
        return $pagination = array(
            'pageCount' => $pageCount,
            'first'     => 1,
            'prev'      => $page - 1,
            'current'   => $page,
            'next'      => $page + 1,
            'last'      => $pageCount,
            'totalCount'=> $totalCount,
            'startPage' => $startPage,
            'endPage'   => $endPage,
            'routing'   => $routing);
    }
} 