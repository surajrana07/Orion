<?php
namespace Orion\Blogs\Controller\Adminhtml\Blog;

use Magento\Framework\Controller\ResultFactory;


class newBlog extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend((__('Add New Blog')));
        return $resultPage;
    }
}