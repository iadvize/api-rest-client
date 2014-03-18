<?php

namespace Iadvize\ApiRestClient;

use Iadvize\ApiRestClient\Response\Meta;
use Iadvize\ApiRestClient\Response\Data;
use Iadvize\ApiRestClient\Response\Pagination;

/**
 * Response
 *
 * @package Iadvize\ApiRestClient
 */
class Response
{
    /** @var Meta Meta information */
    protected $meta;

    /** @var Data Data information */
    protected $data;

    /** @var Pagination Pagination information */
    protected $pagination;

    /**
     * Set meta
     *
     * @param Meta $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * Get meta
     *
     * @return Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set data
     *
     * @param Data $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get data
     *
     * @return Data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set pagination
     *
     * @param Pagination $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * Get pagination
     *
     * @return Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }
}
