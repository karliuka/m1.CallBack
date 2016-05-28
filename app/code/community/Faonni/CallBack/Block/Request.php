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
class Faonni_CallBack_Block_Request 
	extends Mage_Core_Block_Template
{
    /**
     * Retrieve form posting url
     *
     * @return string
     */
    public function getPostActionUrl()
    {
        return $this->getHelper()->getRequestPostUrl();
    }
	
    /**
     * Check customer is logged in
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        return $this->getSession()->isLoggedIn();
    }	

    /**
     * Get form key
     *
     * @return string
     */
    public function getFormKey()
    {
        return Mage::getSingleton('core/session')->getFormKey();
    }

    /**
     * Get customer session
     *
     * @return Mage_Customer_Model_Session
     */
    public function getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    /**
     * Get helper
     *
     * @return Mage_Core_Helper_Abstract
     */
    public function getHelper()
    {
        return Mage::helper('faonni_callback');
    }
	
    /**
     * Prevent displaying if the block is not available
     *
     * @return string
     */
    protected function _toHtml()
    {	
        if (!$this->getHelper()->isEnabled()) {
			return '';
		}
        return parent::_toHtml();
    }		
}