<?php
namespace Orion\Hideprice\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_CONFIG_ENABLE = 'hideprice/configuration/enablehideprice';
    const XML_PRICE_TEXT = 'hideprice/configuration/price_text';
    const XML_EST_MESSAGE = 'hideprice/configuration/price_message';

    protected $_scopeConfig;
    protected $enable_config;
    protected $price_config;
    protected $customerSession;
    protected $estmessage;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->customerSession = $customerSession;
        $this->enable_config =  $this->_scopeConfig->getValue(self::XML_CONFIG_ENABLE);
        $this->price_config =  $this->_scopeConfig->getValue(self::XML_PRICE_TEXT);
        $this->estmessage =  $this->_scopeConfig->getValue(self::XML_EST_MESSAGE);
    }

    public function isenable()
    {
        return  $this->enable_config;
    }

    public function getbuttontext()
    {
        return  empty($this->price_config)?'login to see price':$this->price_config;
    }

    public function estmessage()
    {
        return  empty($this->estmessage)?'call at 842790****':$this->estmessage;
    }

    public function isCustomerlogin()
    {
        return $this->customerSession->isLoggedIn()?true:false;
    }
}
