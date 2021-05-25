<?php

namespace Voucherify;

class Loyalties
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
    public function redeemReward($campaignId, $memberId, $redemption)
    {
        return $this->client->post("/loyalties/" . $campaignId . "/members/" . $memberId . "/redemption/", $redemption, null);
    }
}
