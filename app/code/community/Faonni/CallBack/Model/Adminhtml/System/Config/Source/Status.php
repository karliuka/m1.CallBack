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
class Faonni_CallBack_Model_Adminhtml_System_Config_Source_Status
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
		return array(
			array('value' => Faonni_CallBack_Model_Request::STATUS_NEW, 'label' => Mage::helper('faonni_callback')->__('New')),
			array('value' => Faonni_CallBack_Model_Request::STATUS_PENDING, 'label' => Mage::helper('faonni_callback')->__('Pending')),
			array('value' => Faonni_CallBack_Model_Request::STATUS_COMPLETE, 'label' => Mage::helper('faonni_callback')->__('Complete'))
		);
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
		return array(
			Faonni_CallBack_Model_Request::STATUS_NEW => Mage::helper('faonni_callback')->__('New'),
			Faonni_CallBack_Model_Request::STATUS_PENDING => Mage::helper('faonni_callback')->__('Pending'),
			Faonni_CallBack_Model_Request::STATUS_COMPLETE => Mage::helper('faonni_callback')->__('Complete')
		);	
    }
}