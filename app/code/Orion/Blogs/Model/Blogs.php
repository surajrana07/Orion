<?php

namespace Orion\Blogs\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Orion\Blogs\Api\Data\BlogInterface;

/**
 * Class File
 * @package Orion\Simple\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Blogs extends AbstractModel implements BlogInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'blogs';

    /**
     * Post Initialization
     * @return void
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        $field = $filter->getField();

        if (in_array($field, ['id','name'])) {
            $filter->setField($field);
        }

        parent::addFilter($filter);
    }
    protected function _construct()
    {
        $this->_init('Orion\Blogs\Model\ResourceModel\Blog');
    }


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::BLOG_ID);
    }

    public function getCustId()
    {
        return $this->getData(self::CUST_ID);
    }
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }
     public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function getApprovedAt()
        {
            return $this->getData(self::APPROVED_AT);
        }
    /**
     * Return identities
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }


    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::BLOG_ID, $id);
    }

    /**
     * Set Cust ID
     *
     * @param int $cust_id
     * @return $this
     */
    public function setCustId($cust_id)
    {
        return $this->setData(self::CUST_ID, $cust_id);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set Content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set Updated At
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Set Status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
    
    /**
     * Set Approved At
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setApproved($approvedAt)
    {
        return $this->setData(self::APPROVED_AT, $approvedAt);
    }
}