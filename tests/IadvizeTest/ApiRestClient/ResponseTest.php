<?php

namespace IadvizeTest\ApiRestClient;

use Iadvize\ApiRestClient\Response;

/**
 * Class ResponseTest
 *
 * @package IadvizeTest\ApiRestClient
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iadvize\ApiRestClient\Response $response */
    protected $response;

    /**
     * Set up
     */
    protected function setUp()
    {
        $this->response = new Response;
    }

    /**
     * Test: set/get meta
     */
    public function testSetMeta()
    {
        $this->response->setMeta(new Response\Meta);

        $this->assertTrue($this->response->getMeta() instanceof Response\Meta);
    }

    /**
     * Test: set/get data
     */
    public function testSetData()
    {
        $this->response->setData(new Response\Data);

        $this->assertTrue($this->response->getData() instanceof Response\Data);
    }

    /**
     * Test: set/get pagination
     */
    public function testSetPagination()
    {
        $this->response->setPagination(new Response\Pagination);

        $this->assertTrue($this->response->getPagination() instanceof Response\Pagination);
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        unset($this->request);
    }
}
