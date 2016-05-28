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
class Faonni_CallBack_Model_Resource_Request_Collection 
	extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faonni_callback/request');
    }
	
    /**
     * Add status filter
     *
     * @param int|string $status
     * @return Mage_Core_Model_Resource_Db_Collection_Abstract
     */
    public function addStatusFilter($status)
    {
		$this->addFilter('status',
			$this->getConnection()->quoteInto('main_table.status=?', $status),
			'string');
			
        return $this;
    }
	
    /**
     * Add customer filter
     *
     * @param integer $customerId
     * @return Mage_Core_Model_Resource_Db_Collection_Abstract
     */
    public function addCustomerFilter($customerId)
    {
        $this->addFilter('customer',
            $this->getConnection()->quoteInto('main_table.customer_id=?', $customerId),
            'string');
        return $this;
    }	
}
