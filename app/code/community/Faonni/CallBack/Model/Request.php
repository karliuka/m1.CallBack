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
class Faonni_CallBack_Model_Request 
	extends Mage_Core_Model_Abstract
{
    /**
     * Status new constant
	 *
     * @var int 
     */
    const STATUS_NEW = 1;

    /**
     * Status pending constant
	 *
     * @var int 
     */
    const STATUS_PENDING = 2;

    /**
     * Status complete constant
	 *
     * @var int 
     */
    const STATUS_COMPLETE = 3;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faonni_callback/request');
    }
	
    /**
     * Validate request
     *
     * @return bool|array
     */
    public function validate()
    {
        return $this->getResource()->validate($this);
    }	
}