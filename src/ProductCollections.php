<?php

namespace Voucherify;

class ProductCollections
{
    /**
     * @var \Voucherify\ApiClient
     */
    private $client;

    /**
     * @param \Voucherify\ApiClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param string $collectionId
     *
     * Get product collection.
     *
     * @throws \Voucherify\ClientException
     */
    public function get($collectionId)
    {
        return $this->client->get("/product-collections/" . rawurlencode($collectionId));
    }

    /**
     * @param string $collectionId
     * @param array|stdClass $params
     *
     * List products in the collection.
     *
     * @throws \Voucherify\ClientException
     */
    public function listProducts($collectionId, $params = null)
    {
        return $this->client->get("/product-collections/" . rawurlencode($collectionId) . "/products", $params);
    }

    /**
     * @param string $collectionId
     *
     * Delete product collection.
     *
     * @throws \Voucherify\ClientException
     */
    public function delete($collectionId)
    {
        return $this->client->delete("/product-collections/" . rawurlencode($collectionId));
    }
}


