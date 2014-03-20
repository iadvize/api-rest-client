<?php

namespace IadvizeTest\ApiRestClient;

use Iadvize\ApiRestClient\Request;

/**
 * Class RequestTest
 *
 * @package IadvizeTest\ApiRestClient
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iadvize\ApiRestClient\Request $request */
    protected $request;

    /**
     * Set up
     */
    protected function setUp()
    {
        $this->request = new Request;
    }

    /**
     * Test: set/get resource name
     */
    public function testSetResourceName()
    {
        $this->request->setResourceName('client');
        $this->assertTrue($this->request->getResourceName() == 'client');
    }

    /**
     * Test: set/get filters
     */
    public function testFilters()
    {
        $this->request->setFilters(['Foo' => 'Bar']);

        $this->request->addFilter('Baz', 'Qux');
        $this->request->addFilter('Quux', 'Corge');

        $this->request->removeFilter('Baz');
        $this->request->removeFilter('Unknown');

        $this->assertTrue($this->request->getFilters() == ['Foo' => 'Bar', 'Quux' => 'Corge']);
    }

    /**
     * Test: Display full Results
     */
    public function testDisplayFullResults()
    {
        $this->request->disableFullResults();
        $this->request->enableFullResults();

        $this->assertTrue($this->request->getFullResults());
    }

    /**
     * Test: Use live mode
     */
    public function testUseLiveMode()
    {
        $this->request->disableLive();
        $this->request->enableLive();

        $this->assertTrue($this->request->getLive());
    }

    /**
     * Test: Display fields
     */
    public function testDisplayFields()
    {
        $this->request->setDisplayFields(['Foo']);

        $this->request->addDisplayField('Bar');
        $this->request->addDisplayField('Baz');

        $this->request->removeDisplayField('Bar');
        $this->request->removeDisplayField('Unknown');

        $this->assertTrue($this->request->getDisplayFields() == ['Foo', 'Baz']);
    }

    /**
     * Test: set/get fields
     */
    public function testFields()
    {
        $this->request->setFields(['Foo' => 'Bar']);

        $this->request->addField('Baz', 'Qux');
        $this->request->addField('Quux', 'Corge');

        $this->request->removeField('Baz');
        $this->request->removeField('Unknown');

        $this->assertTrue($this->request->getFields() == ['Foo' => 'Bar', 'Quux' => 'Corge']);
    }

    /**
     * Test: set/get mode
     */
    public function testMode()
    {
        $this->request->setMode(Request::MODE_CREATE);

        $this->assertTrue($this->request->getMode() == Request::MODE_CREATE);
    }

    /**
     * Test: set/get pagination limit
     */
    public function testPaginationLimit()
    {
        $this->request->setPaginationLimit(Request::DEFAULT_PAGINATION_LIMIT);

        $this->assertTrue($this->request->getPaginationLimit() == Request::DEFAULT_PAGINATION_LIMIT);
    }

    /**
     * Test: set/get current page
     */
    public function testCurrentPage()
    {
        $this->request->setCurrentPage(123);

        $this->assertTrue($this->request->getCurrentPage() == 123);
    }

    /**
     * Test: set/get identifier
     */
    public function testIdentifier()
    {
        $this->request->setIdentifier(123);

        $this->assertTrue($this->request->getIdentifier() == 123);
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        unset($this->request);
    }
}
