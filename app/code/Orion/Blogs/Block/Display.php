<?php
namespace Orion\Blogs\Block;

class Display extends \Magento\Framework\View\Element\Template
{
	protected $_customerSession;
	protected $_blogFactory;
	protected $_customer;
    protected $_customerFactory;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Orion\Blogs\Model\BlogsFactory $blogFactory,
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Customer\Model\CustomerFactory $customerFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Customer $customers,
		array $data = []
	)
	{
		$this->_blogFactory = $blogFactory;
		$this->_storeManager = $storeManager;
		$this->customerSession = $customerSession;
		$this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
		parent::__construct($context, $data);
	}

	public function getBlogCollection($id=null){
		if($id == null){
			$post = $this->_blogFactory->create();
			return $post->getCollection();
		}
		$post = $this->_blogFactory->create();
		return $post->getCollection()
		->addFieldToFilter('id',array('eq'=>$id));
	}

	public function getLoggedinCustomerId() {
        if ($this->customerSession->isLoggedIn()) {
            return $this->customerSession->getId();
        }
        return false;
    }

    public function getCustomerById($id) {
        return $this->_customerFactory->create()->load($id);
    }

    public function getSiteUrl()
    {
	    $pageurl = $this->_storeManager->getStore()->getBaseUrl();
	    return $pageurl."blogs/index/blogform/";
    }

    public function getDeleteUrl()
    {
	    $pageurl = $this->_storeManager->getStore()->getBaseUrl();
	    return $pageurl."blogs/index/delete/";
    }

    public function getFormAction()
    {
        return '/blogs/Index/Save';
    }
}