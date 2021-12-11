<?php

namespace AHT\Pike\Model;

use AHT\Pike\Api\SaleAgentRepositoryInterface;
use AHT\Pike\Model\ResourceModel\SaleAgent as ResourceSaleAgent;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use AHT\Pike\Model\SaleAgentFactory;

class SaleAgentRepository implements SaleAgentRepositoryInterface
{

    protected $dataObjectProcessor;

    private $storeManager;

    protected $resource;

    protected $saleAgentFactory;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'saleagent_repository';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        ResourceSaleAgent $resource,
        SaleAgentFactory $saleAgentFactory,
        StoreManagerInterface $storeManager,
        DataObjectProcessor $dataObjectProcessor,
        array $data = []
    ) {
        $this->saleAgentFactory = $saleAgentFactory;
        $this->resource = $resource;
        $this->storeManager = $storeManager;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    public function save(\AHT\Pike\Api\Data\SaleAgentInterface $saleAgent)
    {
        try {
            $this->resource->save($saleAgent);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the salesagent: %1', $exception->getMessage()),
                $exception
            );
        }
        return $saleAgent;
    }

    public function getById($saleAgentId)
    {
        $saleAgent = $this->saleAgentFactory->create()->load($saleAgentId);
        if (!$saleAgent->getEntityId()) {
            throw new NoSuchEntityException(__('Salesagent with id "%1" does not exist.', $saleAgentId));
        }
        return $saleAgent;
    }

    public function delete(\AHT\Pike\Api\Data\SaleAgentInterface $saleAgent)
    {
        try {
            $this->resource->delete($saleAgent);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the salesagent: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($saleAgentId)
    {
        return $this->delete($this->getById($saleAgentId));
    }
}