<?php

namespace Voucherify;

class AsyncActions
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
     * @param string $asyncActionId
     *
     * Get a single async action.
     *
     * @throws \Voucherify\ClientException
     */
    public function get($asyncActionId)
    {
        return $this->client->get("/async-actions/" . rawurlencode($asyncActionId));
    }

    /**
     * Get a list of all async actions.
     *
     * @throws \Voucherify\ClientException
     */
    public function getList()
    {
        return $this->client->get("/async-actions/");
    }
}
