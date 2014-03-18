<?php

namespace Iadvize\ApiRestClient;

/**
 * Request
 *
 * @package Iadvize\ApiRestClient
 */
class Request
{
    /** @const int Default pagination limit */
    const DEFAULT_PAGINATION_LIMIT = 20;

    /** @const string Mode read */
    const MODE_READ = 0;

    /** @const string Mode create */
    const MODE_CREATE = 1;

    /** @const string Mode update */
    const MODE_UPDATE = 2;

    /** @const string Mode delete */
    const MODE_DELETE = 3;

    /** @var string Resource name */
    protected $resourceName = '';

    /** @var array Filters list */
    protected $filters = [];

    /** @var bool Display full results */
    protected $displayFullResults = false;

    /** @var array Display fields list */
    protected $displayFields = [];

    /** @var array Fields (create or update) */
    protected $fields = [];

    /** @var string Mode */
    protected $mode = self::MODE_READ;

    /** @var int Pagination limit */
    protected $paginationLimit = self::DEFAULT_PAGINATION_LIMIT;

    /** @var int Current page */
    protected $currentPage = 1;

    /** @var int Identifier */
    protected $identifier;

    /**
     * @param string $resourceName Resource name
     * @param bool $displayFullResult Display full result
     * @param int $currentPage Current page
     */
    public function __construct($resourceName = '', $displayFullResult = false, $currentPage = 1)
    {
        $this->resourceName       = $resourceName;
        $this->displayFullResults = $displayFullResult;
        $this->currentPage        = $currentPage;
    }

    /**
     * Set resource name
     *
     * @param string $resourceName
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * Get resource name
     *
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
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
     * Add filter
     *
     * @param string $filter
     * @param mixed $value
     */
    public function addFilter($filter, $value)
    {
        if (!in_array($filter, $this->filters)) {
            $this->filters[$filter] = $value;
        }
    }

    /**
     * Remove filter
     *
     * @param string $filter Filter
     */
    public function removeFilter($filter)
    {
        if (array_key_exists($filter, $this->filters)) {
            unset($this->filters[$filter]);
        }
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

    /**
     * Enable full results
     */
    public function enableFullResults()
    {
        $this->displayFullResults = true;
    }

    /**
     * Disable full results
     */
    public function disableFullResults()
    {
        $this->displayFullResults = false;
    }

    /**
     * Get full results
     *
     * @return bool
     */
    public function getFullResults()
    {
        return $this->displayFullResults;
    }

    /**
     * Set display fields
     *
     * @param array $displayFields
     */
    public function setDisplayFields(array $displayFields)
    {
        $this->displayFields = $displayFields;
    }

    /**
     * Add display field
     *
     * @param string $displayField
     */
    public function addDisplayField($displayField)
    {
        if (!in_array($displayField, $this->displayFields)) {
            $this->displayFields[] = $displayField;
        }
    }

    /**
     * Remove display field
     *
     * @param string $displayField
     */
    public function removeDisplayField($displayField)
    {
        $key = array_search($displayField, $this->displayFields);
        if ($key) {
            unset($this->displayFields[$key]);
            $this->displayFields = array_values($this->displayFields);
        }
    }

    /**
     * Get display fields
     *
     * @return array
     */
    public function getDisplayFields()
    {
        return $this->displayFields;
    }

    /**
     * Set fields
     *
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Add field
     *
     * @param string $field Field
     * @param mixed $value Value
     */
    public function addField($field, $value)
    {
        if (!in_array($field, $this->fields)) {
            $this->fields[$field] = $value;
        }
    }

    /**
     * Remove field
     *
     * @param string $field Field
     */
    public function removeField($field)
    {
        if (array_key_exists($field, $this->fields)) {
            unset($this->fields[$field]);
        }
    }

    /**
     * Get fields
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set mode
     *
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set pagination limit
     *
     * @param int $paginationLimit
     */
    public function setPaginationLimit($paginationLimit)
    {
        $this->paginationLimit = $paginationLimit;
    }

    /**
     * Get pagination limit
     *
     * @return int
     */
    public function getPaginationLimit()
    {
        return $this->paginationLimit;
    }

    /**
     * Set current page
     *
     * @param int $currentPage
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    /**
     * Get current page
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * Set identifier
     *
     * @param int $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier
     *
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
