<?php
namespace Mramirez\Shipping\Helper;


use Symfony\Component\HttpFoundation\Response;

class Connection extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @const RESPONSE_SHIPPING_RATE
     */
    const RESPONSE_SHIPPING_RATE = 'shipping_rate';

    /**
     * @var \Magento\Framework\HTTP\Client\Curl
     */
    protected $curl;

    /**
     * @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    protected $writerInterface;

    /**
     * @var \Magento\Framework\HTTP\ZendClientFactory
     */
    protected $zendClientFactory;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * Connection constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\HTTP\Client\Curl $curl
     * @param \Magento\Framework\HTTP\ZendClientFactory $zendClientFactory
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $writerInterface
     * @internal param \Magento\Framework\HTTP\ZendClient $zendClient
     * @internal param \Magento\Framework\App\Config\Storage\WriterInterface $configInterface
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Framework\HTTP\ZendClientFactory $zendClientFactory,
        \Magento\Framework\App\Config\Storage\WriterInterface $writerInterface,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    ) {
        $this->curl = $curl;
        $this->configInterface = $writerInterface;
        $this->zendClientFactory = $zendClientFactory;
        $this->jsonHelper = $jsonHelper;
        parent::__construct($context);
    }


    public function getShippingRate($params) 
    {
        // Logic
    }
}
