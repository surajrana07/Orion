<?php
namespace Orion\Simple\Block\Adminhtml\Edit\Address;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

/**
 * Class SaveButton
 */

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Contact'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'post_form.post_form',
                                'actionName' => 'save',
                                'params' => [
                                    false
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            'sort_order' => 90,
        ];
    }
}