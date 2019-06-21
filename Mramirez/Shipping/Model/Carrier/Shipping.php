<?php
namespace Mramirez\Shipping\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

class Shipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'shipping_custom';

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $_rateMethodFactory;

    /**
     * @var \Magento\Checkout\Model\Cart
     */
    protected $checkoutCart;

    /**
     * @var \Mramirez\Shipping\Helper\Connection
     */
    protected $connectionHelper;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * Shipping constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param \Magento\Checkout\Model\Cart $checkoutCart
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Checkout\Model\Cart $checkoutCart,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Mramirez\Shipping\Helper\Connection $connectionHelper,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->checkoutCart = $checkoutCart;
        $this->messageManager = $messageManager;
        $this->connectionHelper = $connectionHelper;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * get allowed methods
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }

    /**
     * @return float
     */
    private function getShippingPrice()
    {

        $quote = $this->checkoutCart->getQuote();

        if (!empty($quote)) {
            $billingAddressInformation = $quote->getBillingAddress()->getData();

            $itemsQuote = $quote->getAllVisibleItems();

            $size = 0;
            foreach ($itemsQuote as $item) {
                $product = $item->getProduct();

                if (!empty($product->getWeight())) {
                    $size =+ $product->getWeight();
                }
            }

            $zipCode = $quote->getShippingAddress()->getPostcode();

            $params = array (
                'zipcode' => isset($zipCode) ? $zipCode : '',
                'city' => isset($billingAddressInformation['city']) ? $billingAddressInformation['city'] : '',
                'street' => isset($billingAddressInformation['street']) ? $billingAddressInformation['street'] : '',
                'region' => isset($billingAddressInformation['region']) ? $billingAddressInformation['region'] : '',
                'weight' => $size
            );

            $shippingPrice = json_decode($this->connectionHelper->getShippingRate($params));

            if (!empty($shippingPrice)) {
                return $shippingPrice;
            }
        }

        return null;
    }

    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod($this->_code);
        $method->setMethodTitle($this->getConfigData('name'));

        $amount = $this->getShippingPrice();

        $method->setPrice($amount);
        $method->setCost($amount);

        $result->append($method);

        return $result;
    }
}
