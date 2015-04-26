<?php

namespace Iadvize\ApiRestClient;

use Buzz\Browser;
use Buzz\Client\Curl;

/**
 * Client
 *
 * @package Iadvize\ApiRestClient
 */
class Client
{
    /** @const string Default base URI */
    const DEFAULT_BASE_URI = 'https://www.iadvize.com/api/2/';

    /** @const string High  */
    const HA_BASE_URI = 'https://ha.iadvize.com/api/2/';

    /** @var string Base URI */
    protected $baseUri = self::DEFAULT_BASE_URI;

    /** @var string Authentication API Key */
    protected $authenticationKey = '';

    /** @var Request $lastRequest Last request */
    protected $lastRequest;

    /** @var Response $lastResponse Last response */
    protected $lastResponse;

    /** @var Browser $browser Browser */
    protected $browser;

    /**
     * Constructor
     * Set default timeout to 24h
     *
     * @param string       $authenticationKey Authentication API Key
     * @param null|Browser $browser
     */
    public function __construct($authenticationKey = '', $browser = null)
    {
        $this->setAuthenticationKey($authenticationKey);
        if (null == $browser) {
            $client = new Curl();
            $client->setTimeout(60 * 60 * 24);
            $this->setBrowser(new Browser($client));
        }
    }

    /**
     * Set authentication API key
     *
     * @param $authenticationKey
     */
    public function setAuthenticationKey($authenticationKey)
    {
        $this->authenticationKey = $authenticationKey;
    }

    /**
     * Get authentication API key
     *
     * @return string
     */
    public function getAuthenticationKey()
    {
        return $this->authenticationKey;
    }

    /**
     * Set request
     *
     * @param Request $request
     */
    public function setLastRequest(Request $request)
    {
        $this->lastRequest = $request;
    }

    /**
     * Get request
     *
     * @return Request
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * Set response
     *
     * @param Response $response
     */
    public function setLastResponse(Response $response)
    {
        $this->lastResponse = $response;
    }

    /**
     * Get response
     *
     * @return Response
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * Set base URI
     *
     * @param string $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * Get base URI
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Set browser
     *
     * @param Browser $browser
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }

    /**
     * Get browser
     *
     * @return Browser
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Get resource
     *
     * @param string $name       Name
     * @param int    $identifier Identifier
     *
     * @return Response\Data
     */
    public function getResource($name, $identifier)
    {
        $this->lastRequest = new Request;
        $this->lastRequest->setMode(Request::MODE_READ);
        $this->lastRequest->setResourceName($name);
        $this->lastRequest->setIdentifier($identifier);

        $response = $this->proceed();

        return $response->getData()->getData();
    }

    /**
     * Get resources
     *
     * @param string     $name    Name
     * @param bool       $full    Display full data
     * @param array      $filters Use filter (E.g. ['website_id' => 123]
     * @param array      $fields  Fields selected to display
     * @param int | null $page    The page to request
     * @param int | null $limit   The pagination limit
     *
     * @return Response\Data
     */
    public function getResources(
        $name,
        $full = false,
        array $filters = [],
        array $fields = [],
        $page = null,
        $limit = null
    ) {
        $this->lastRequest = new Request;
        $this->lastRequest->setMode(Request::MODE_READ);
        $this->lastRequest->setResourceName($name);

        if ($full) {
            $this->lastRequest->enableFullResults();
        }
        $this->lastRequest->setFilters($filters);
        $this->lastRequest->setFields($fields);

        if (!is_null($page)) {
            $this->lastRequest->setCurrentPage($page);
        }
        if (!is_null($limit)) {
            $this->lastRequest->setPaginationLimit($limit);
        }

        $response = $this->proceed();

        return $response->getData()->getData();
    }

    /**
     * Create resource
     *
     * @param string $name   Name
     * @param array  $fields Fields
     *
     * @return Response\Data
     */
    public function createResource($name, array $fields = [])
    {
        $this->lastRequest = new Request();
        $this->lastRequest->setMode(Request::MODE_CREATE);
        $this->lastRequest->setResourceName($name);
        $this->lastRequest->setFields($fields);

        $response = $this->proceed();

        return $response;
    }

    /**
     * Update resource
     *
     * @param string $name       Name
     * @param int    $identifier Identifier
     * @param array  $fields     Fields
     *
     * @return Response\Data
     */
    public function updateResource($name, $identifier, array $fields = [])
    {
        $this->lastRequest = new Request();
        $this->lastRequest->setMode(Request::MODE_UPDATE);
        $this->lastRequest->setResourceName($name);
        $this->lastRequest->setIdentifier($identifier);
        $this->lastRequest->setFields($fields);

        $response = $this->proceed();

        return $response;
    }

    /**
     * Delete resource
     *
     * @param string $name       Name
     * @param int    $identifier Identifier
     *
     * @return bool
     */
    public function deleteResource($name, $identifier)
    {
        $this->lastRequest = new Request();
        $this->lastRequest->setMode(Request::MODE_DELETE);
        $this->lastRequest->setResourceName($name);
        $this->lastRequest->setIdentifier($identifier);

        $response = $this->proceed();

        return $response->getMeta()->getStatus() == Response\Meta::STATUS_SUCCESS;
    }

    /**
     * Send request
     *
     * @return Response
     */
    public function proceed()
    {
        // Get request
        $request = $this->getLastRequest();

        // Build parameters
        $parameters = [];
        if ($request->getFullResults()) {
            $parameters['full'] = true;
        }
        if ($request->getFilters()) {
            $parameters['filters'] = $request->getFilters();
        }
        if ($request->getFields()) {
            $parameters['fields'] = $request->getFields();
        }
        if ($request->getCurrentPage()) {
            $parameters['page'] = $request->getCurrentPage();
        }
        if ($request->getPaginationLimit()) {
            $parameters['limit'] = $request->getPaginationLimit();
        }

        // Create browser
        $browser = $this->getBrowser();
        $headers = ['X-API-Key' => $this->getAuthenticationKey()];
        $url     = $this->getBaseUri() . $request->getResourceName();
        if ($request->getIdentifier()) {
            $url .= '/' . $request->getIdentifier();
        }
        if ($parameters) {
            $url .= '?' . http_build_query($parameters);
        }

        $content = http_build_query($request->getFields());

        switch ($request->getMode()) {
            default:
            case Request::MODE_READ:
                $response = $browser->get($url, $headers);
                break;
            case Request::MODE_CREATE:
                $response = $browser->post($url, $headers, $content);
                break;
            case Request::MODE_UPDATE:
                $response = $browser->put($url, $headers, $content);
                break;
            case Request::MODE_DELETE:
                $response = $browser->delete($url, $headers);
                break;
        }

        // Content
        $content = $response->getContent();
        $content = json_decode($content, true);

        // Create meta
        $meta = new Response\Meta;
        if (!empty($content['meta'])) {
            if (isset($content['meta']['status'])) {
                $meta->setStatus($content['meta']['status']);
            }
            if (isset($content['meta']['message'])) {
                $meta->setMessage($content['meta']['message']);
            }
            if (isset($content['meta']['filters'])) {
                $meta->setFilters($content['meta']['filters']);
            }
        }

        // Create data
        $data = new Response\Data;
        if (!empty($content['data'])) {
            $data->setData($content['data']);
        }

        // Create pagination
        $pagination = new Response\Pagination;
        if (!empty($content['pagination'])) {

            if (!empty($content['pagination']['page'])) {
                $pagination->setPage($content['pagination']['page']);
            }
            if (!empty($content['pagination']['pages'])) {
                $pagination->setPages($content['pagination']['pages']);
            }
            if (!empty($content['pagination']['limit'])) {
                $pagination->setLimit($content['pagination']['limit']);
            }
            if (!empty($content['pagination']['count'])) {
                $pagination->setCount($content['pagination']['count']);
            }
        }

        // Create response
        $response = new Response;
        $response->setMeta($meta);
        $response->setData($data);
        $response->setPagination($pagination);

        // Set to current response
        $this->setLastResponse($response);

        return $response;
    }
}
