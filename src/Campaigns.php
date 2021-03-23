<?php

namespace Voucherify;

class Campaigns
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
     * @param stdClass $campaign
     *
     * Create campaign.
     *
     * @throws \Voucherify\ClientException
     */
    public function create($campaign)
    {
        return $this->client->post("/campaigns", $campaign);
    }

    /**
     * @param array|stdClass $filter
     *
     * Get a filtered list of campaigns. The filter can include following properties:
     * - limit         - number (default 100)
     * - page          - number (default 1)
     * - campaign_type - string
     *
     * @throws \Voucherify\ClientException
     */
    public function getList($filter = null)
    {
        return $this->client->get("/campaigns", $filter);
    }

    /**
     * @param string $name - campaign name
     * @param stdClass $params
     *
     * Add voucher to campaign.
     *
     * @throws \Voucherify\ClientException
     */
    public function addVoucher($name, $params = null)
    {
        return $this->client->post("/campaigns/" . rawurlencode($name) . "/vouchers/", $params);
    }

    /**
     * @param string $name - campaign name
     * @param string $code - voucher code
     * @param stdClass $params
     *
     * Add voucher with certain code to campaign.
     *
     * @throws \Voucherify\ClientException
     */
    public function addVoucherWithCode($name, $code, $params = null)
    {
        return $this->client->post("/campaigns/" . rawurlencode($name) . "/vouchers/" . rawurlencode($code), $params);
    }

    /**
     * @param string $name - campaign name
     * @param stdClass[] $vouchers
     *
     * Imports vouchers to an existing campaign.
     *
     * @throws \Voucherify\ClientException
     */
    public function importVouchers($name, $vouchers)
    {
        return $this->client->post("/campaigns/" . rawurlencode($name) . "/import", $vouchers);
    }

    /**
     * @param string $name
     * @param boolean|null $force
     *
     * Delete campaign.
     *
     * @throws \Voucherify\ClientException
     */
    public function delete($name, $force = null)
    {
        $options = (object)[];
        $options->qs = [ "force" => ($force ? "true" : "false") ];

        return $this->client->delete("/campaigns/" . rawurlencode($name), null, $options);
    }
}
