<?php

namespace AHT\Pike\Model;

use AHT\Pike\Api\Data\SaleAgentInterface;
use Magento\Framework\DataObject\IdentityInterface;

class SaleAgent extends \Magento\Framework\Model\AbstractModel implements SaleAgentInterface, IdentityInterface
{

    const CACHE_TAG = 'aht_saleAgents';

    public function _construct()
    {
        $this->_init('AHT\Pike\Model\ResourceModel\SaleAgent');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    public function getEntityId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    public function getOrderItemSku()
    {
        return $this->getData(self::ORDER_ITEM_SKU);
    }

    public function getOrderItemId()
    {
        return $this->getData(self::ORDER_ITEM_ID);
    }

    public function getCommissionValue()
    {
        return $this->getData(self::COMMISSION_VALUE);
    }
    public function getOrderItemPrice()
    {
        return $this->getData(self::ORDER_ITEM_PRICE);
    }

    public function getCommissionType()
    {
        return $this->getData(self::COMMISSION_TYPE);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setEntityId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    public function setOrderId($order_id)
    {
        return $this->setData(self::ORDER_ID, $order_id);
    }

    public function setOrderItemId($order_item_id)
    {
        return $this->setData(self::ORDER_ITEM_ID, $order_item_id);
    }

    public function setOrderItemPrice($order_item_price)
    {
        return $this->setData(self::ORDER_ITEM_PRICE, $order_item_price);
    }

    public function setOrderItemSku($order_item_sku)
    {
        return $this->setData(self::ORDER_ITEM_SKU, $order_item_sku);
    }

    public function setCommissionType($commission_type)
    {
        return $this->setData(self::COMMISSION_TYPE, $commission_type);
    }
    public function setCommissionValue($commission_value)
    {
        return $this->setData(self::COMMISSION_VALUE, $commission_value);
    }
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }
}