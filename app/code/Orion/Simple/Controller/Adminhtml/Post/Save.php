<?php
namespace Orion\Simple\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;
use Orion\Simple\Model\PostFactory;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page

     */
    protected $PostFactory;
    protected $resultPageFactory;
    protected $contactUS;
    protected $contactUsFactory;
    public function __construct(
    \Magento\Framework\View\Result\PageFactory $resultPageFactory,
    \Magento\Backend\App\Action\Context $context, 
    \Orion\Simple\Model\PostFactory $contactUsFactory,
    PostFactory $PostFactory,
    \Orion\Simple\Model\Post $contactUs
    ){
        $this->_PostFactory = $PostFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->contactUsFactory = $contactUsFactory;
        $this->contactUS = $contactUs;
        parent::__construct($context);
    }
    public function execute()
    {
       $resultRedirect = $this->resultRedirectFactory->create();
        try{
            $request = $this->getRequest()->getParams();
            $model = $this->_PostFactory->create();
            if(isset($request['id']) && $request['id'] != NULL ){
              if($request['id'] == NULL || $request['title'] == NULL || $request['content'] == NULL){
                $this->messageManager->addSuccess( __('All fields are Required') );
              }
              else
              {
                $model->load($request['id']);
                $model->setData('title',$request['title']);
                $model->setData('content',$request['content']);
                $model->save();  
                $this->messageManager->addSuccess( __('successfully post Updated.') );
              }
            }
            else{
                if($request['title'] == NULL || $request['content'] == NULL){
                  $this->messageManager->addSuccess( __('All fields are Required') );
                }
                else
                {
                    $title = $request['title'];
                    $content = $request['content'];
                    $contactUs = $this->contactUsFactory->create();
                    $contactUs->setTitle($title);
                    $contactUs->setContent($content);
                    $contactUs->save();
                }
            }
          }
          catch (\Exception $e){
              $this->messageManager->addException($e, __('Some thing went wrong..... '));
          }
        $this->_redirect('*/*/');
        return;
    }
}