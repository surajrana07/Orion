<?php
namespace Orion\Blogs\Model\ResourceModel\Blog;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'id';
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        
        $this->_init('Orion\Blogs\Model\Blogs', 'Orion\Blogs\Model\ResourceModel\Blog');
    }
}