<?php

namespace Voucherify;

class Customers
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
     * @param stdClass $customer
     *
     * Create customer.
     *
     * @throws \Voucherify\ClientException
     */
    public function create($customer)
    {
        return $this->client->post("/customers/", $customer, null);
    }

    /**
     * @param string $customerId
     *
     * Get customer details.
     *
     * @throws \Voucherify\ClientException
     */
    public function get($customerId)
    {
        return $this->client->get("/customers/" . rawurlencode($customerId), null);
    }

    /**
     * @param array|stdClass $filter
     *
     * Get a filtered list of vouchers. The filter can include following properties:
     * - limit      - number (default 100)
     * - page       - number (default 1)
     * - email      - string
     * - city       - string
     * - name       - string
     *
     * @throws \Voucherify\ClientException
     */
    public function getList($filter = null)
    {
        return $this->client->get("/customers/", $filter);
    }

    /**
     * @param array|stdClass $customer Object with customer fields for update
     *
     * Update customer.
     *
     * @throws \Voucherify\ClientException
     */
    public function update($customer)
    {
        $customerId = "";

        if (is_array($customer)) {
            if (isset($customer["id"])) {
                $customerId = $customer["id"];
                unset($customer["id"]);
            }
            elseif (isset($customer["source_id"])) {
                $customerId = $customer["source_id"];
            }
        }
        elseif (is_object($customer)) {
            if (isset($customer->id)) {
                $customerId = $customer->id;
                unset($customer->id);
            }
            elseif (isset($customer->source_id)) {
                $customerId = $customer->source_id;
            }
        }

        if (\is_null($customerId)) {
            throw new VoucherifyException("ID is missing from the customer, specify either id and source_id");
        }

        return $this->client->put("/customers/" . rawurlencode($customerId), $customer, null);
    }

    /**
     * @param array[]|stdClass[] $customers Customer objects
     *
     * Update/insert customers in bulk.
     *
     * @throws \Voucherify\ClientException
     */
    public function bulkUpdate($customers)
    {
        // in one request it is possible to update 100 records
        $chunks = \array_chunk($customers, 100);
        $results = [];

        foreach ($chunks as $chunk) {
            $result = $this->client->post("/customers/bulk", $chunk);
            $results = \array_merge($results, $result);
        }

        return $results;
    }

    /**
     * @param string $customerId Customer ID to delete
     *
     * Delete customer.
     *
     * @throws \Voucherify\ClientException
     */
    public function delete($customerId)
    {
        return $this->client->delete("/customers/" . rawurlencode($customerId));
    }
}