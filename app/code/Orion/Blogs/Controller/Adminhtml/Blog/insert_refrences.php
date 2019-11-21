<?php

namespace Veinteractive\Newsletter\Cron;


class Processemails
{
    /**
     * @var array
     */
    protected $_loadedData;

    protected $emailFactory;

    protected $collection;

    protected $logger;

    protected $subscriberFactory;


    public function __construct(
        \Psr\Log\LoggerInterface $loggerInterface,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        \Veinteractive\Newsletter\Model\Email $emailFactory,
        \Veinteractive\Newsletter\Model\ResourceModel\Email\CollectionFactory $collectionFactory
    )
    {
        $this->logger = $loggerInterface;
        $this->collection = $collectionFactory->create();
        $this->subscriberFactory = $subscriberFactory;
        $this->emailFactory = $emailFactory;
    }


    public function getCollection()
    {
        return $this->collection;

    }

    public function execute()
    {
        try {
            $this->getCollection()->addFieldToFilter('processed', array('eq' => 0));
            $this->getCollection()->load();
            $items = $this->collection->getItems();
            $collection = $this->getCollection()->count();
            $count = 0;
            foreach ($collection as $emails) {
                $processedEmail = $emails->getEmail();
                $subscribe = $this->subscriberFactory->create()->subscribe($processedEmail);
                if ($subscribe == 1 && $this->updateVeinte_newsletter($emails->getId())) {
                    $this->logger->info($processedEmail . ' Processed successfully');
                } else {
//                   STATUS_SUBSCRIBED = 1;
//                   STATUS_NOT_ACTIVE = 2;
//                   STATUS_UNSUBSCRIBED = 3;
//                   STATUS_UNCONFIRMED = 4;
                    $this->logger->info($processedEmail . ' Can not process. Status : ' . $subscribe);
                }
            }
        } catch (\Exception $e) {
            $this->logger->critical('Email API Error : ', ['exception' => $e]);
        }
    }

    private function updateVeinte_newsletter($id)
    {
        $model = $this->emailFactory->load($id);
        $model->setData('processed', 1);
        $model->save();
        return true;
    }
}