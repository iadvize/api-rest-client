<?php

namespace IadvizeTest\ApiRestClient\Response;

use Iadvize\ApiRestClient\Response\Pagination;

/**
 * Class PaginationTest
 *
 * @package IadvizeTest\ApiRestClient\Response
 */
class PaginationTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iadvize\ApiRestClient\Response\Pagination $pagination */
    protected $pagination;

    /**
     * Set up
     */
    protected function setUp()
    {
        $this->pagination = new Pagination;
    }

    /**
     * Test: set/get page
     */
    public function testSetPage()
    {
        $this->pagination->setPage(123);
        $this->assertTrue($this->pagination->getPage() == 123);
    }

    /**
     * Test: set/get pages
     */
    public function testSetPages()
    {
        $this->pagination->setPages(123);
        $this->assertTrue($this->pagination->getPages() == 123);
    }

    /**
     * Test: set/get limit
     */
    public function testSetLimit()
    {
        $this->pagination->setLimit(123);
        $this->assertTrue($this->pagination->getLimit() == 123);
    }

    /**
     * Test: set/get count
     */
    public function testSetCount()
    {
        $this->pagination->setCount(123);
        $this->assertTrue($this->pagination->getCount() == 123);
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        unset($this->pagination);
    }
}
