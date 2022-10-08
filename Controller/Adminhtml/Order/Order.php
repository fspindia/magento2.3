<?php

namespace Bss\EmailDemo\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Bss\EmailDemo\Helper\Email;
use Magento\Sales\Controller\Adminhtml\Order as AdminOrder;

class Order extends AdminOrder implements HttpPostActionInterface
{

	
    /**
     * pradeep thakur
     * Changes ACL Resource Id
     */
    const ADMIN_RESOURCE = 'Magento_Sales::hold';
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        //$resultRedirect = $this->resultRedirectFactory->create();

        $order = $this->_initOrder();
        if ($order) {
            $post = $this->getRequest()->getPostValue();
       //   echo "<pre>";
       //  print_r($order->getId());
       //   exit;
       //  return $this->helperEmail->sendEmail();
	   
	   	
		   try {
			   $order = $this->_objectManager->create('Magento\Sales\Model\Order')->load($order->getId()); // this is entity id
				 $this->_objectManager->create('\Magento\Sales\Model\OrderNotifier')
               ->notify($order);
		
                // TODO: Do something with the order
                $this->messageManager->addSuccessMessage(__('You sent the order delay email'));
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('We can\'t process your request' . $e->getMessage()));
                $this->logger->critical($e);
            }
			
			
			
			 $resultRedirect->setPath('sales/order/view', ['order_id' => $order->getId()]);
			 return $resultRedirect;
        }
		
	
        $resultRedirect->setPath('sales/*/');
        return $resultRedirect;
    }
}
