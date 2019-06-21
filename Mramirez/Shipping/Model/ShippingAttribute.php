<?php

namespace Mramirez\Shipping\Model;

use \Mramirez\Shipping\Api\Data\ShippingAttributeInterface;

class ShippingAttribute implements ShippingAttributeInterface
{

    private $extenstionAttributes;

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(
        ShippingAttributeInterface $extensionAttributes
    )
    {
        $this->extenstionAttributes = $extensionAttributes;
        return $this;
    }
    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->extenstionAttributes;
    }
}