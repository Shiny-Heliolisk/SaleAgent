<?php

namespace AHT\Pike\Api;

interface SaleAgentRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param \AHT\Pike\Api\Data\SaleAgentInterface $saleagent
     * @return \AHT\Pike\Api\Data\SaleAgentInterface
     */
    public function save(\AHT\Pike\Api\Data\SaleAgentInterface $saleAgent);

    /**
     * Undocument function
     *
     * @param int $saleagentId
     * @return \AHT\Pike\Api\Data\SaleAgentInterface
     */
    public function getById($saleAgentId);

    /**
     * Undocumented function
     *
     * @param \AHT\Pike\Api\Data\SaleAgentInterface $saleagent
     * @return \AHT\Pike\Api\Data\SaleAgentInterface
     */
    public function delete(\AHT\Pike\Api\Data\SaleAgentInterface $saleAgent);

    /**
     * Undocument function
     *
     * @param int $saleagentId
     * @return \AHT\Pike\Api\Data\SaleAgentInterface
     */
    public function deleteById($saleAgentId);
}