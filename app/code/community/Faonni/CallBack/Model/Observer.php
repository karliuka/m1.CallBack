<?php
/**
 * Faonni
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_CallBack
 * @copyright   Copyright (c) 2016 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Faonni_CallBack_Model_Observer
{
    /**
     * Event after callback request has been submitted
     *
     * @param Varien_Event_Observer $observer observer
     * @return Faonni_CallBack_Model_Observer
     */
    public function sendAdminEmail(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('faonni_callback');
        if ($helper->isEmailEnabled()) {
			$request = $observer->getEvent()->getRequest();
			
			$translate = Mage::getSingleton('core/translate');
			$translate->setTranslateInline(false);	
					
			$template = Mage::getModel('core/email_template');           
			$template->setDesignConfig(array('area' => 'frontend', 'store' => Mage::app()->getStore()->getId()));	            
			try {		
				$template->sendTransactional($helper->getEmailTemplate(), $helper->getEmailSender(), $helper->getEmailRecipient(), null, array(
					'firstname' => $request->getFirstname(),
					'lastname'  => $request->getLastname(),
					'phone'     => $request->getPhone()
				));	
				
				if (!$template->getSentSuccess()) {
					throw new Exception('Callback request admin notification email send error.');
				}
            } catch (Exception $e) {
                Mage::logException($e);
            }
			$translate->setTranslateInline(true);	
        }
        return $this;
    }
}