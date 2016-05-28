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
class Faonni_CallBack_Model_Resource_Request 
	extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize connection and define main table and primary key
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faonni_callback/request', 'request_id');
    }
	
    /**
     * Prepare data for save
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        $currentTime = Varien_Date::now();

		if ((!$object->getId() || $object->isObjectNew()) && !$object->getCreatedAt()) {
			$object->setCreatedAt($currentTime);			
		}
		$object->setUpdatedAt($currentTime);
		
		return parent::_beforeSave($object);
    }
	
    /**
     * Validate process
     *
     * @param Faonni_CallBack_Model_Request $request
     * @return bool
     */
    public function validate(Faonni_CallBack_Model_Request $request)
    {
		$errors = array();
		
		if (!Zend_Validate::is(trim($request->getFirstname()), 'NotEmpty')) {
			$errors[] = Mage::helper('adminhtml')->__('Firstname is required field.');
		}
		if (!Zend_Validate::is(trim($request->getLastname()), 'NotEmpty')) {
			$errors[] = Mage::helper('adminhtml')->__('Lastname is required field.');
		}	
		if (!Zend_Validate::is(trim($request->getPhone()), 'NotEmpty')) {
			$errors[] = Mage::helper('adminhtml')->__('Phone is required field.');
		}	

        return empty($errors) ? true : $errors;		
	}	
}