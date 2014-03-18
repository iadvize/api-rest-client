<?php

namespace Iadvize\ApiRestClient\Response;

/**
 * Response data
 *
 * @package Iadvize\ApiRestClient\Response
 */
class Data
{
    /** @var Mixed Data */
    protected $data = [];

    /**
     * Set data
     * (fix JSON Decode)
     *
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = null;

        if (is_array($data)) {
            foreach ($data as $index => $fields) {
                if (is_array($fields)) {
                    foreach ($fields as $key => $value) {
                        if ('id' == $key && is_array($value)) {
                            foreach ($value as $subKey => $subValue) {
                                $this->data[$index][$subKey] = $subValue;
                            }
                        } else {
                            $this->data[$index][$key] = $value;
                        }
                    }
                } else {
                    $this->data[$index] = $fields;
                }
            }
        } else {
            $this->data = $data;
        }
    }

    /**
     * Get data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
