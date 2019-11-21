<?php
namespace Orion\Blogs\Controller\Adminhtml\Blog;

use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Orion\Blogs\Model\ResourceModel\Blog as BlogResource;
use Orion\Blogs\Model\Blogs;

class Save extends \Magento\Backend\App\Action
{
    protected $blogFactory;
    /**
     * @var Page
     */
    protected $resultPageFactory;
    private $BlogResource;

    public function __construct(
        PageFactory $resultPageFactory,
        Context $context,
        BlogResource $BlogResource,
        Blogs  $blogFactory
    ){
        $this->resultPageFactory = $resultPageFactory;
        $this->blogFactory = $blogFactory;
        $this->BlogResource =$BlogResource;

        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        try{
            $request = $this->getRequest()->getParams();

            if($this->validateData($request)){
                if(isset($request['id']) && $request['id'] != NULL ){
                    //update blog
                    $this->updateBlog($request);
                    $this->messageManager->addSuccess( __('Your blog is updated successfully, Cheers!'));
                }
                else{
                    //save blog
                    $this->saveBlog($request);

                    $this->messageManager->addSuccess( __('Your blog is saved successfully, Cheers!'));

                }
            }
        }
        catch (\Exception $e){
            $this->messageManager->addException($e, __('Some thing went wrong..... '));
        }
        return $this->_redirect('*/*/');
    }
    private function saveBlog($request){
         $title = $request['title'];
         $content = $request['content'];
         $customerId=0;
        // $contactUs = $this->blogFactory->create();
        // $contactUs->setTitle($title);
        // $contactUs->setCustId($customerId);
        // $contactUs->setContent($content);
        // $contactUs->save();
           $blogFactory = $this->blogFactory;
           $blogFactory->setTitle($title);
           $blogFactory->setCustId($customerId);
           $blogFactory->setContent($content);

           $this->BlogResource->save($blogFactory);
           
    }
    private function updateBlog($request){
        $model = $this->blogFactory->load($request['id']);
        $model->setData('title',$request['title']);
        $model->setData('content',$request['content']);
        $model->setData('status',$request['status']);
        //$model->save();

        $model->save();
        
        
    }
    private function validateData($request){
        if($request['title'] == NULL || $request['content'] == NULL){
            $this->messageManager->addError( __('All fields are Required'));
            return false;
        }
        return true;
    }

}