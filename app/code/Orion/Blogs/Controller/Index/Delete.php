<?php
namespace Orion\Blogs\Controller\Index;

use Orion\Blogs\Model\BlogsFactory;

class Delete extends \Magento\Framework\App\Action\Action {

    /**
     * @var CommentFactory
     */
    protected $_blogFactory;
    protected $messageManager;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,   
        BlogsFactory $blogFactory
    ) {
        $this->_blogFactory = $blogFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute() 
    {
        $id = $this->getRequest()->getParam('blog_id');
        try {
            $model = $this->_blogFactory->create();
            $model->load($id);
            $model->delete();
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $this->_redirect('*/*/display/');
        return;
    }

}