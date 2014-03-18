<?php

namespace Test\Iadvize\Api\Response;

use Iadvize\ApiRestClient\Response\Meta;

/**
 * Class MetaTest
 *
 * @package Test\Iadvize\Api\Response
 */
class MetaTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iadvize\ApiRestClient\Response\Meta $meta */
    protected $meta;

    /**
     * Set up
     */
    protected function setUp()
    {
        $this->meta = new Meta;
    }

    /**
     * Test: set/get status
     */
    public function testSetStatus()
    {
        $this->meta->setStatus(Meta::STATUS_SUCCESS);
        $this->assertTrue($this->meta->getStatus() == Meta::STATUS_SUCCESS);
    }

    /**
     * Test: set/get message
     */
    public function testSetMessage()
    {
        $this->meta->setMessage('No error.');
        $this->assertTrue($this->meta->getMessage() == 'No error.');
    }

    /**
     * Test: set/get filters
     */
    public function testSetFilters()
    {
        $this->meta->setFilters(['Foo' => 'Bar', 'Baz' => 'Qux']);
        $this->assertTrue($this->meta->getFilters() == ['Foo' => 'Bar', 'Baz' => 'Qux']);
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        unset($this->meta);
    }
}
