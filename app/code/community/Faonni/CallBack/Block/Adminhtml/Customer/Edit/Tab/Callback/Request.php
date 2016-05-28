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
class Faonni_CallBack_Block_Adminhtml_Customer_Edit_Tab_Callback_Request
	extends Mage_Adminhtml_Block_Widget_Grid
		implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Constructor
	 *
     * Prepare grid parameters
     */	
    public function __construct()
    {
        parent::__construct();
		
        $this->setId('customer_callback_request')
			->setDefaultSort('created_at')
			->setUseAjax(false);
    }

    /**
     * Prepare grid collection object
	 *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('faonni_callback/request')->getCollection();
		$collection->addCustomerFilter($this->getCustomer()->getId());
        $this->setCollection($collection);

        parent::_prepareCollection();
    }	

    /**
     * Prepare Grid columns
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('request_id', array(
			'header' => $this->__('Id'),
			'width' => '50px',
			'index' => 'request_id',
        ));

        $this->addColumn('firstname', array(
			'header' => $this->__('First Name'),
			'index'  => 'firstname',
			'escape' => true,			
        ));

        $this->addColumn('lastname', array(
			'header' => $this->__('Last Name'),
			'index'  => 'lastname',
			'escape' => true,			
        ));
		
        $this->addColumn('phone', array(
			'header' => $this->__('Phone'),
			'index'  => 'phone',
			'escape' => true,
        ));
		
        $this->addColumn('created_at', array(
            'header'        => $this->__('Created On'),
			'index'          => 'created_at',
            'align'         => 'left',
            'type'          => 'datetime',
            'width'         => '180px',
        ));		
		
		$this->addColumn('status', array(
			'header'         => $this->__('Status'),
			'index'          => 'status',
			'width'          => '100px',
			'type'           => 'options',
            'options'        => Mage::getModel('faonni_callback/adminhtml_system_config_source_status')->toArray(),
		));	
		
        return parent::_prepareColumns();
    }
	
    /**
     * Return row URL for js event handlers
     *
     * @param object $row row
     * @return bool|string
     */
    public function getRowUrl($row)
    {
        return false;
    }
	
    /**
     * Gets customer assigned to this block
     *
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer() 
	{
        return Mage::registry('current_customer');
    }	
	
    /**
     * Prepare label for tab
	 *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Call Backs');
    }

    /**
     * Prepare title for tab
	 *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Call Backs');
    }

    /**
     * Returns status flag about this tab can be shown or not
	 *
     * @return bool
     */
    public function canShowTab()
    {
		return $this->getCustomer() && $this->getCustomer()->getId();
    }

    /**
     * Returns status flag about this tab hidden or not
	 *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}