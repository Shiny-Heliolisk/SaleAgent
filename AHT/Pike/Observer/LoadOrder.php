<?php

namespace AHT\Pike\Observer;

class LoadOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \AHT\Salesagents\Model\SalesagentFactory
     */
    protected $_saleAgentFactory;

    public function __construct(\AHT\Pike\Model\SaleAgentFactory $saleAgentFactory)
    {
        $this->_saleAgentFactory = $saleAgentFactory;
    }

    /**
     * Save data to aht_sales_agent
     *
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();
        $saleAgentModel = $this->_saleAgentFactory->create();

        $items = $order->getAllItems();
        foreach ($items as $item) {
            $saleAgentsId = $item->getProduct()->getSaleAgentId();

            if (($saleAgentsId != '') && ($saleAgentsId != null)) {
                $orderData = [
                    'order_id' => $order->getIncrementId(),
                    'agent_id' => $saleAgentsId,
                    'order_item_id' => $item->getProductId(),
                    'order_item_sku' => $item->getSku(),
                    'order_item_price' => $item->getPrice(),
                    'commission_type' => $item->getProduct()->getCommissionType(),
                    'commission_value' => $item->getProduct()->getCommissionValue()
                ];
                $saleAgentModel->setData($orderData);
                $saleAgentModel->save();
            }
        }
    }
}