<?php

namespace Mramirez\Shipping\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;


interface ShippingAttributeInterface extends ExtensibleDataInterface
{
    /**
     * @return ShippingAttributeInterface|null
     */
    public function getCarrierOptions();
    /**
     * @param ShippingAttributeInterface $extensionAttributes
     * @return self
     */
    public function setCarrierOptions
    (
        ShippingAttributeInterface $extensionAttributes
    );
}