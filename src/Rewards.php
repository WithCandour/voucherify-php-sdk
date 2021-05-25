<?php

namespace Voucherify;

class Rewards
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
     * @param stdClass $reward
     *
     * Create reward.
     *
     * @throws \Voucherify\ClientException
     */
    public function create($reward)
    {
        return $this->client->post("/rewards/", $reward, null);
    }
}
