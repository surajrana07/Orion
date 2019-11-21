<?php
namespace Orion\Blogs\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Orion\Blogs\Model\BlogsFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    
    /**
     * @return \Magento\Backend\Model\View\Result\Page

     */
    protected $BlogFactory;
    protected $resultPageFactory;
    public function __construct(
    \Magento\Framework\View\Result\PageFactory $resultPageFactory,
    \Magento\Framework\App\Action\Context $context, 
    \Orion\Blogs\Model\BlogsFactory  $blogFactory,
    BlogsFactory $BlogFactory
    ){
        $this->_BlogFactory = $BlogFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->blogFactory = $blogFactory;
        parent::__construct($context);
    }
    public function execute()
    {
       $resultRedirect = $this->resultRedirectFactory->create();
        try{
                $request = $this->getRequest()->getParams();
                
                if($this->validateData($request)){
                    if($this->validateData($request)){
                        if(isset($request['id']) && $request['id'] != NULL ){
                            //update blog
                            $this->updateBlogData($request);
                            $this->messageManager->addSuccess( __('Your blog is updated successfully, Cheers!'));
                        }
                        else{
                            //save blog
                            $this->saveBlogData($request);
                            $this->messageManager->addSuccess( __('Your blog is saved successfully, Cheers!'));
                        }
                    }
                }
          }
          catch (\Exception $e){
              $this->messageManager->addException($e, __('Some thing went wrong..... '));
          }
        $this->_redirect('*/*/display/');
        return;
    }
    private function validateData($request){
        if($request['title'] == NULL || $request['content'] == NULL){
            $this->messageManager->addError( __('All fields are Required'));
            return false;
        }
        return true;
    }
    private function saveBlogData($request){
        $title = $request['title'];   
        $content = $request['content'];
        $customerId = $request['cust_id'];
        $blogdata = $this->blogFactory->create();
        $blogdata->setTitle($title);
        $blogdata->setCustId($customerId);
        $blogdata->setContent($content);
        $blogdata->save();
    }
    private function updateBlogData($request){
        $model = $this->_BlogFactory->create();
        $currentDateTime = date('Y-m-d H:i:s');
        $model->load($request['id']);
        $model->setData('title',$request['title']);
        $model->setData('content',$request['content']);
        $model->setData('updated_at',$currentDateTime);
        $model->save();
    }
}