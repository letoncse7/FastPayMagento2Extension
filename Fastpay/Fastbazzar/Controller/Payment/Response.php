<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Fastpay\Fastbazzar\Controller\Payment;
use Magento\Framework\Controller\ResultFactory;

/**
 * Responsible for loading page content.
 *
 * This is a basic controller that only loads the corresponding layout file. It may duplicate other such
 * controllers, and thus it is considered tech debt. This code duplication will be resolved in future releases.
 */
class Response extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * Load the page defined in view/frontend/layout/samplenewpage_index_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {   //load model
        /* @var $paymentMethod \Magento\Authorizenet\Model\DirectPost */
        $paymentMethod = $this->_objectManager->create('Fastpay\Fastbazzar\Model\Fastbazzar');

        //get request data
        $data = $this->getRequest()->getPostValue();
        // print_r($data);

        // $paymentMethod->process($data);
        //return $this->resultPageFactory->create();
        $paymentMethod->responseAction($data);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        // return $resultRedirect->setPath('checkout/onepage/success', ['_secure' => true]);
        return $resultRedirect->setPath('fastbazzar/payment/success', ['_secure' => true]);
    }
}
