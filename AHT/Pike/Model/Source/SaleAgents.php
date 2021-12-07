<?php
namespace AHT\Pike\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Data\OptionSourceInterface;

class SaleAgents extends AbstractSource implements OptionSourceInterface
{
    private $_customerFactory;
    public function __construct(
        CustomerFactory $customerFactory
    )
    {
        $this->_customerFactory=$customerFactory;
    }

    public function getAllOptions()
    {
        $_options[] = [
            'label'=>'none',
            'value'=>''
        ];
        $collection = $this->_customerFactory->create()->getCollection()->addFieldToFilter('is_sale_agent',1);
        foreach($collection as $item){
            $_options[]=[
                'label'=> $item->getName(),
                'value'=> $item->getEntityId()
            ];
        }
        return $_options;
    }
}
