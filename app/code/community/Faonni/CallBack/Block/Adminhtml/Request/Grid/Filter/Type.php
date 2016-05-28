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
class Faonni_CallBack_Block_Adminhtml_Request_Grid_Filter_Type 
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Select
{
    /**
     * Retrieve options array
     *
     * @return array
     */
    protected function _getOptions()
    {
        return array(
              array('label' => '', 'value' => ''),
              array('label' => Mage::helper('faonni_callback')->__('Customer'), 'value' => 1),
              array('label' => Mage::helper('faonni_callback')->__('Guest'), 'value' => 2)
        );
    }
	
    /**
     * Retrieve condition
     *
     * @return array
     */
    public function getCondition()
    {
        return (1 == $this->getValue()) 
			? array('notnull' => true) 
			: array('null' => true);
    }
}