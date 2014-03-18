<?php

namespace IadvizeTest\ApiRestClient\Response;

use Iadvize\ApiRestClient\Response\Data;

/**
 * Class DataTest
 *
 * @package IadvizeTest\ApiRestClient\Response
 */
class DataTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iadvize\ApiRestClient\Response\Data $data */
    protected $data;

    /**
     * Set up
     */
    protected function setUp()
    {
        $this->data = new Data;
    }

    /**
     * Test: set/get data
     */
    public function testSetData()
    {
        // Simple string
        $this->data->setData('Some data');
        $this->assertTrue($this->data->getData() == 'Some data');

        // Simple array
        $this->data->setData(['Foo' => 'Bar']);
        $this->assertTrue($this->data->getData() == ['Foo' => 'Bar']);

        // Multi-dimensional array
        $data = [
            [
                'id'  => 1,
                'foo' => 'bar',
            ],
            [
                'id'  => [
                    'id' => 2
                ],
                'foo' => 'bar',
            ]
        ];
        $this->data->setData($data);
        $data[1]['id'] = $data[1]['id']['id'];
        $this->assertTrue($this->data->getData() == $data);
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        unset($this->data);
    }
}
