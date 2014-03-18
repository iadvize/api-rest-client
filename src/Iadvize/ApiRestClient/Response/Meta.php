<?php

namespace Iadvize\ApiRestClient\Response;

/**
 * Response meta
 *
 * @package Iadvize\ApiRestClient\Response
 */
class Meta
{
    /** @const string Status success */
    const STATUS_SUCCESS = 'success';

    /** @const string Status fail */
    const STATUS_FAIL = 'fail';

    /** @const string Status error */
    const STATUS_ERROR = 'error';

    /** @var string Status */
    protected $status = self::STATUS_SUCCESS;

    /** @var string Message */
    protected $message = '';

    /** @var array Filters */
    protected $filters = [];

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set filters
     *
     * @param array $filters
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
