<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Pike\Block\Account;

use Magento\Framework\App\DefaultPathInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Block representing link with two possible states.
 * "Current" state means link leads to URL equivalent to URL of currently displayed page.
 *
 * @api
 * @method string                          getLabel()
 * @method string                          getPath()
 * @method string                          getTitle()
 * @method null|array                      getAttributes()
 * @method null|bool                       getCurrent()
 * @method \Magento\Framework\View\Element\Html\Link\Current setCurrent(bool $value)
 * @since 100.0.2
 */
class Products extends Template
{
    /**
     * Search redundant /index and / in url
     */
    private const REGEX_INDEX_URL_PATTERN = '/(\/index|(\/))+($|\/$)/';

    /**
     * Default path
     *
     * @var DefaultPathInterface
     */
    protected $_defaultPath;
    /**
     *
     * @var \Magento\Customer\Model\Session
     */
    protected $customer;
    /**
     * 
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * Constructor
     *
     * @param Context $context
     * @param DefaultPathInterface $defaultPath
     * @param array $data
     */
    public function __construct(
        Context $context,
        DefaultPathInterface $defaultPath,
        \Magento\Customer\Model\Session $customer,
        CustomerRepositoryInterface $customerRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_defaultPath = $defaultPath;
        $this->customer = $customer;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Get href URL
     *
     * @return string
     */
    public function getHref()
    {
        return $this->getUrl($this->getPath());
    }

    /**
     * Get current mca
     *
     * @return string
     * @SuppressWarnings(PHPMD.RequestAwareBlockMethod)
     */
    private function getMca()
    {
        $routeParts = [
            (string)$this->_request->getModuleName(),
            (string)$this->_request->getControllerName(),
            (string)$this->_request->getActionName(),
        ];

        $parts = [];
        $pathParts = explode('/', trim($this->_request->getPathInfo(), '/'));
        foreach ($routeParts as $key => $value) {
            if (isset($pathParts[$key]) && $pathParts[$key] === $value) {
                $parts[] = $value;
            }
        }
        return implode('/', $parts);
    }

    /**
     * Check if link leads to URL equivalent to URL of currently displayed page
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->getCurrent() ||
            preg_replace(self::REGEX_INDEX_URL_PATTERN, '', $this->getUrl($this->getPath()))
            == preg_replace(self::REGEX_INDEX_URL_PATTERN, '', $this->getUrl($this->getMca()));
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }

        $highlight = '';

        if ($this->getIsHighlighted()) {
            $highlight = ' current';
        }

        if ($this->isCurrent()) {
            $html = '<li class="nav item current">';
            $html .= '<strong>'
                . $this->escapeHtml(__($this->getLabel()))
                . '</strong>';
            $html .= '</li>';
        } else {
            $html = '<li class="nav item' . $highlight . '"><a href="' . $this->escapeHtml($this->getHref()) . '"';
            $html .= $this->getTitle()
                ? ' title="' . $this->escapeHtml(__($this->getTitle())) . '"'
                : '';
            $html .= $this->getAttributesHtml() . '>';

            if ($this->getIsHighlighted()) {
                $html .= '<strong>';
            }

            $html .= $this->escapeHtml(__($this->getLabel()));

            if ($this->getIsHighlighted()) {
                $html .= '</strong>';
            }

            $html .= '</a></li>';
        }

        $customerId  = $this->customer->getCustomer()->getId();
        $customer = $this->customerRepository->getById($customerId);
        $customer_sa = $customer->getCustomAttribute('is_sale_agent');

        if (!$customer_sa) {
            $html = '';
        } else {
            if ($customer_sa->getValue() == \Magento\Eav\Model\Entity\Attribute\Source\Boolean::VALUE_NO) {
                $html = '';
            }
        }

        return $html;
    }

    /**
     * Generate attributes' HTML code
     *
     * @return string
     */
    private function getAttributesHtml()
    {
        $attributesHtml = '';
        $attributes = $this->getAttributes();
        if ($attributes) {
            foreach ($attributes as $attribute => $value) {
                $attributesHtml .= ' ' . $attribute . '="' . $this->escapeHtml($value) . '"';
            }
        }

        return $attributesHtml;
    }
}