<?php

namespace IadvizeTest\ApiRestClient;

use Iadvize\ApiRestClient\Client;
use Iadvize\ApiRestClient\Request;
use Iadvize\ApiRestClient\Response;

use \Mockery as m;

/**
 * Class ClientTest
 *
 * @package IadvizeTest\ApiRestClient
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iadvize\ApiRestClient\Client $client */
    protected $client;

    /**
     * Set up
     */
    protected function setUp()
    {
        $this->client = new Client();

        $this->client->setBrowser($this->client->getBrowser());
    }

    /**
     * Test: set/get base uri
     */
    public function testSetBaseUri()
    {
        $this->client->setBaseUri('http://foo.bar');

        $this->assertTrue($this->client->getBaseUri() == 'http://foo.bar');
    }

    /**
     * Test: set/get authentication key
     */
    public function testSetAuthenticationKey()
    {
        $this->client->setAuthenticationKey('ITS_MY_KEY');

        $this->assertTrue($this->client->getAuthenticationKey() == 'ITS_MY_KEY');
    }

    /**
     * Test: set/get last request
     */
    public function testSetLastRequest()
    {
        $this->client->setLastRequest(new Request);

        $this->assertTrue($this->client->getLastRequest() instanceof Request);
    }

    /**
     * Test: set/get last response
     */
    public function testSetLastResponse()
    {
        $this->client->setLastResponse(new Response);

        $this->assertTrue($this->client->getLastResponse() instanceof Response);
    }

    /**
     * Test: get resources
     */
    public function testGetResources()
    {
        // Mock response
        $response = m::mock('Response');
        $response->shouldReceive('getContent')->times(1)->andReturn(
            '{"meta":{"status":"success","filters":["name"]},"data":[{"id":1,"name":"Test","_link":"/group/1"}],"pagination":{"page":1,"pages":1,"limit":20,"count":1}}'
        );

        // Mock browser
        $browser = m::mock('Browser');
        $browser->shouldReceive('get')->andReturn($response);
        $this->client->setBrowser($browser);
        $this->client->getResources('group', true, ['name' => 'Test']);
    }

    /**
     * Test: get resource
     */
    public function testGetResource()
    {
        // Mock response
        $response = m::mock('Response');
        $response->shouldReceive('getContent')->times(1)->andReturn(
            '{"meta":{"status":"success"},"data":[{"id":1,"name":"Test","_link":"/group/1"}]}'
        );

        // Mock browser
        $browser = m::mock('Browser');
        $browser->shouldReceive('get')->andReturn($response);
        $this->client->setBrowser($browser);
        $this->client->getResource('group', 1);

        $this->assertTrue($this->client->getLastResponse()->getMeta()->getStatus() == 'success');
    }

    /**
     * Test: get live resources
     */
    public function testGetLiveResources()
    {
        // Mock response
        $response = m::mock('Response');
        $response->shouldReceive('getContent')->times(1)->andReturn(
            '{"meta":{"status":"success","filters":["name"]},"data":[{"id":1,"name":"Test","_link":"/group/1"}],"pagination":{"page":1,"pages":1,"limit":20,"count":1}}'
        );

        // Mock browser
        $browser = m::mock('Browser');
        $browser->shouldReceive('get')->andReturn($response);
        $this->client->setBrowser($browser);
        $this->client->getLiveResources('group', true, ['name' => 'Test']);
    }

    /**
     * Test: get live resource
     */
    public function testGetLiveResource()
    {
        // Mock response
        $response = m::mock('Response');
        $response->shouldReceive('getContent')->times(1)->andReturn(
            '{"meta":{"status":"success"},"data":[{"id":1,"name":"Test","_link":"/group/1"}]}'
        );

        // Mock browser
        $browser = m::mock('Browser');
        $browser->shouldReceive('get')->andReturn($response);
        $this->client->setBrowser($browser);
        $this->client->getLiveResource('group', 1);

        $this->assertTrue($this->client->getLastResponse()->getMeta()->getStatus() == 'success');
    }

    /**
     * Test: create resource
     */
    public function testCreateResource()
    {
        $response = m::mock('Response');
        $response->shouldReceive('getContent')->andReturn(
            '{"meta":{"status":"success"},"data":[{"id":1,"name":"Test","_link":"/group/1"}],"pagination":{"page":1,"pages":1,"limit":20,"count":1}}'
        );

        // Mock browser
        $browser = m::mock('Browser');
        $browser->shouldReceive('post')->times(1)->andReturn($response);
        $this->client->setBrowser($browser);
        $this->client->createResource('group', ['name' => 'test']);

        $this->assertTrue($this->client->getLastResponse()->getMeta()->getStatus() == 'success');
    }

    /**
     * Test: update resource
     */
    public function testUpdateResource()
    {
        // Mock browser response
        $response = m::mock('Response');
        $response->shouldReceive('getContent')->andReturn(
            '{"meta":{"status":"success"},"data":[{"id":1,"name":"Test new","_link":"/group/1"}],"pagination":{"page":1,"pages":1,"limit":20,"count":1}}'
        );

        // Mock browser
        $browser = m::mock('Browser');
        $browser->shouldReceive('put')->andReturn($response);
        $this->client->setBrowser($browser);

        $this->client->updateResource('group', 1, ['name' => 'Test new']);
        $this->assertTrue($this->client->getLastResponse()->getMeta()->getStatus() == 'success');
    }

    /**
     * Test: delete resource
     */
    public function testDeleteResource()
    {
        // Mock browser response
        $responseSuccess = m::mock('Response');
        $responseSuccess->shouldReceive('getContent')->andReturn(
            '{"meta":{"status":"success"}}'
        );
        $responseFail = m::mock('Response');
        $responseFail->shouldReceive('getContent')->andReturn(
            '{"meta":{"status":"fail","message":"Unknown \'group\' with \'id\' 2"}}'
        );

        // Mock browser
        $browser = m::mock('Browser');
        $browser->shouldReceive('delete')->times(2)->andReturn($responseSuccess, $responseFail);
        $this->client->setBrowser($browser);

        $this->client->deleteResource('group', 1);
        $this->assertTrue($this->client->getLastResponse()->getMeta()->getStatus() == 'success');

        $this->client->deleteResource('group', 2);
        $this->assertTrue($this->client->getLastResponse()->getMeta()->getStatus() == 'fail');
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        m::close();
        unset($this->client);
    }
}
