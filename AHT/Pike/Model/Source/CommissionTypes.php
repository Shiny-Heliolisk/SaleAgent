<?php

namespace AHT\Pike\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Data\OptionSourceInterface;

class CommissionTypes extends AbstractSource implements OptionSourceInterface
{
    private $_customerFactory;
    public function __construct(
        CustomerFactory $customerFactory
    ) {
        $this->_customerFactory = $customerFactory;
    }

    public function getAllOptions()
    {
        $_options = [
            [
                'label' => 'none',
                'value' => ''
            ],
            [
                'label' => 'Fixed',
                'value' => 1
            ],
            [
                'label' => 'Percent',
                'value' => 2
            ],
        ];

        return $_options;
    }
}
