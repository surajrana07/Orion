<?php

namespace Orion\Simple\Setup;

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
            $tableName = $setup->getTable('orion_simple_post');

            $data = [
                [
                    'title' => 'Magento 1',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'Magento 2',
                    'content' => 'Content of the second post.',
                ],
            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }
        $setup->endSetup();
    }
}