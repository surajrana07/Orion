<?php
namespace Orion\Simple\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
    $this->_init('Orion\Simple\Model\Post','Orion\Simple\Model\ResourceModel\Post');
        
    }
}