<?php
namespace Mramirez\Shipping\Controller\Shipping;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class Rate extends Action
{

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * @var \Magento\Catalog\Model\Session
     */
    protected $catalogSession;

    /**
     *  @var \Magento\Catalog\Model\ProductRepository
     */
    protected $product;

    /**
     * @var \Mramirez\Shipping\Helper\Connection
     */
    protected $connectionHelper;

    /**
     * View constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     * @param \Magento\Catalog\Model\Session $catalogSession
     * @param \Magento\Catalog\Model\ProductRepository $product
     * @param \Mramirez\Shipping\Helper\Connection $connectionHelper
     * @internal param \Magento\Catalog\Model\Session $registry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Catalog\Model\ProductRepository $product,
        \Mramirez\Shipping\Helper\Connection $connectionHelper
    ) {

        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->catalogSession = $catalogSession;
        $this->product = $product;
        $this->connectionHelper = $connectionHelper;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        // Logic
    }

}
