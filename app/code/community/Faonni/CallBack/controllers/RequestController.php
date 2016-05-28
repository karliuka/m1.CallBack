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
class Faonni_CallBack_RequestController 
	extends Mage_Core_Controller_Front_Action
{
    /**
     * Pre dispatch action that allows to redirect to no route page in case of disabled extension 
	 * through admin panel
     *
     * @return void
     */
    public function preDispatch()
    {
        parent::preDispatch();

        if (!Mage::helper('faonni_callback')->isEnabled()) {
            $this->norouteAction();
        }
    }
	
    /**
     * Initialize Session object
	 *
     * @return Mage_Model_Customer_Session
     */ 	
    public function getSession()
    {
       	return Mage::getSingleton('customer/session');
    }	

    /**
     * save action
     *
     * @throws Exception
     * @return void
     */
    public function saveAction()
    {
        if (!$this->_validateFormKey()) {
            $this->_redirect('*/*/');
            return;
        }
		
		if ($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			try {
				$request = Mage::getModel('faonni_callback/request');	
				$request->addData($data);
				$request->setStoreId(Mage::app()->getStore()->getStoreId());
				
				if ($this->getSession()->isLoggedIn()) {
					$customer = $this->getSession()->getCustomer();
					$request->setCustomerId($customer->getId());
					$request->setFirstname($customer->getFirstname());
					$request->setLastname($customer->getLastname());
				}
				
				$result = $request->validate();
				if (true === $result){
					$request->save();
					
					Mage::dispatchEvent('faonni_callback_request_create', array('request' => $request));
					
					Mage::getSingleton('core/session')->addSuccess($this->__('Thank you! Your request is accepted, and in the near future our experts will call you.'));
				} elseif (is_array($result)) {
					foreach ($result as $error) {
						Mage::getSingleton('core/session')->addError($error);
					}
				}
				
			} catch (Exception $e) {
				Mage::logException($e);
				Mage::getSingleton('core/session')->addError($this->__('An error occurred while saving the request.'));
			}		
		}
		$this->_redirectReferer();
    }
}