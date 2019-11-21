<?php
namespace Orion\Blogs\Controller\Index;

use Magento\Customer\Model\Session;

class Display extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	/**
     * @var Session
     */
    protected $session;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
        Session $customerSession,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
        $this->session = $customerSession;
		$this->_pageFactory = $pageFactory;
		parent::__construct($context);
	}

	public function execute()
	{
		 if ($this->session->isLoggedIn()) {
            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->_pageFactory->create();
            //$resultRedirect->setPath('*/*/');
            return $resultRedirect;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
         $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/account/login/');
        return $resultRedirect;
	}
}