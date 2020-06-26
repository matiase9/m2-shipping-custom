<?php

namespace Mramirez\Shipping\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;


interface ShippingAttributeInterface extends ExtensibleDataInterface
{
    /**
     * @return ShippingAttributeInterface|null
     */
    public function getExtensionAttributes();
    /**
     * @param ShippingAttributeInterface $extensionAttributes
     * @return self
     */
    public function setExtensionAttributes
    (
        ShippingAttributeInterface $extensionAttributes
    );
}