<?php
namespace Bss\EmailDemo\Plugin\Magento\Sales\Block\Adminhtml\Order;


class View
{

    public function beforeSetLayout(
        \Magento\Sales\Block\Adminhtml\Order\View $subject,
        $layout
    ) {
        $subject->addButton(
            'sendorderDelayEmail',
            [
                'label' => __('Send Order Delay Email '),
                'onclick' => "",
                'class' => 'send-order-delay-email',
            ]
        );
        return [$layout];
    }

    public function afterToHtml(
        \Magento\Sales\Block\Adminhtml\Order\View $subject,
        $result
    ) {
        if($subject->getNameInLayout() == 'sales_order_edit'){
            $customBlockHtml = $subject->getLayout()->createBlock(
                \Bss\EmailDemo\Block\Adminhtml\Order\ModalBox::class,
                $subject->getNameInLayout().'_modal_box'
            )->setOrder($subject->getOrder())
                ->setTemplate('Bss_EmailDemo::order/modalbox.phtml')
                ->toHtml();
            return $result.$customBlockHtml;
        }
        return $result;
    }
}

