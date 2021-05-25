<?php

namespace Voucherify;

class RewardAssignments
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
     * @param string $rewardId
     * @param stdClass $assignment
     *
     * Create reward.
     *
     * @throws \Voucherify\ClientException
     */
    public function create($rewardId, $assignment)
    {
        return $this->client->post("/rewards/" . $rewardId . "/assignments/", $assignment, null);
    }
}
