<?php

namespace Orion\Blogs\Api\Data;

interface BlogInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const BLOG_ID               = 'id';
    const CUST_ID               = 'cust_id';
    const TITLE                 = 'title';
    const CONTENT               = 'content';
    const CREATED_AT            = 'created_at';
    const UPDATED_AT            = 'updated_at';
    const STATUS                = 'status';
    const APPROVED_AT           = 'approved_at';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Customer ID
     *
     * @return int|null
     */
    public function getCustId();

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Get Updated At
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Get Status
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Get Approved At
     *
     * @return int|null
     */
    public function getApprovedAt();


    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setCustId($custId);

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set Content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content);

    /**
     * Set Crated At
     *
     * @param int $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Set Updated At
     *
     * @param int $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Set Status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set Approved At
     *
     * @param int $approvedAt
     * @return $this
     */
    public function setApproved($approvedAt);

    
}