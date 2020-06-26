<?php
namespace Mramirez\Shipping\Plugin;

use Magento\Quote\Model\Cart\ShippingMethodConverter;
use Magento\Quote\Api\Data\ShippingMethodInterface;
use Magento\Quote\Api\Data\ShippingMethodExtensionFactory;
use Mramirez\Shipping\Helper\Connection;
use Mramirez\Shipping\Model\Carrier\Shipping;
use Magento\Checkout\Model\Cart;

class Estimate
{
    /**
     * @var ShippingMethodExtensionFactory
     */
    protected $extensionFactory;

    /**
     * @var Shipping
     */
    protected $shippingMethod;

    /**
     * @var Connection
     */
    protected $connectionHelper;

    /**
     * @var Connection
     */
    protected $checkoutCart;

    /**
     * DeliveryDate constructor.
     *
     * @param ShippingMethodExtensionFactory $extensionFactory
     * @param Shipping $shippingMethod
     * @param Connection $connection
     * @param Cart $checkoutCart
     */
    public function __construct(
        ShippingMethodExtensionFactory $extensionFactory,
        Shipping $shippingMethod,
        Connection $connection,
        Cart $checkoutCart
    ){
        $this->extensionFactory = $extensionFactory;
        $this->shippingMethod = $shippingMethod;
        $this->connectionHelper = $connection;
        $this->checkoutCart = $checkoutCart;
    }

    /**
     * Add delivery date information to the carrier data object
     *
     * @param ShippingMethodConverter $subject
     * @param ShippingMethodInterface $shippingMethod
     * @return ShippingMethodInterface
     */
    public function afterModelToDataObject(ShippingMethodConverter $subject, ShippingMethodInterface $shippingMethod)
    {
        $extensibleAttribute =  ($shippingMethod->getExtensionAttributes())
            ? $shippingMethod->getExtensionAttributes()
            : $this->extensionFactory->create();

        if ($shippingMethod->getCarrierCode() == $this->shippingMethod->getCarrierCode()) {
            // Todo logic to the Estimate service
            $extensibleAttribute->setCarrierEstimate(rand(1,5) . " days");
        }

        $shippingMethod->setExtensionAttributes($extensibleAttribute);

        return $shippingMethod;
    }
}