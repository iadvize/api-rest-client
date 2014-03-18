<?php

namespace Iadvize\ApiRestClient\Response;

/**
 * Response pagination
 *
 * @package Iadvize\ApiRestClient\Response
 */
class Pagination
{
    /** @const int Default pagination limit */
    const DEFAULT_PAGINATION_LIMIT = 20;

    /** @var int Page */
    protected $page = 1;

    /** @var int Pages (number of) */
    protected $pages = 1;

    /** @var int Limit (of rows per page) */
    protected $limit = self::DEFAULT_PAGINATION_LIMIT;

    /** @var int Count (total of rows) */
    protected $count = 0;

    /**
     * Set page
     *
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * Get page
     *
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set pages
     *
     * @param int $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * Get pages
     *
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set limit
     *
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * Get limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set count
     *
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
