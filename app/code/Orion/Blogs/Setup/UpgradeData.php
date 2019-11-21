<?php

namespace Orion\Blogs\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 *
 * @package Orion\Simple\Setup
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * Creates sample simple posts
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion()
            && version_compare($context->getVersion(), '0.1.1') < 0
        ) {
            $tableName = $setup->getTable('blogs');

            $data = [
                [
                    'title' => 'Blog 1',
                    'content' => 'Content of the first Blog.',
                ],
                [
                    'title' => 'Blog 2',
                    'content' => 'Content of the second Blog.',
                ],
            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }
        $setup->endSetup();
    }
}