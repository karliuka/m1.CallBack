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
class Faonni_CallBack_Block_Adminhtml_Request_Grid 
	extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     */
    public function __construct()
    {
        parent::__construct();
		
        $this->setId('callback_request_grid');
        $this->setDefaultSort('request_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection for Grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('faonni_callback/request')->getCollection();
		if (true === Mage::registry('useNewFilter')) {
			$collection->addStatusFilter(Faonni_CallBack_Model_Request::STATUS_NEW);
		}		
        $this->setCollection($collection);
		
        return parent::_prepareCollection();
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
		
        $this->addColumn('customer_id', array(
            'header'   => $this->__('Type'),
            'type'     => 'select',
            'index'    => 'customer_id',
            'filter'   => 'faonni_callback/adminhtml_request_grid_filter_type',
            'renderer' => 'faonni_callback/adminhtml_request_grid_renderer_type'
        ));		

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'    => $this->__('Visible In'),
                'index'     => 'store_id',
                'type'      => 'store',
                'store_view' => true,
            ));
        }		

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
		
        $this->addColumn('action', array(
            'header'   => $this->__('Action'),
			'filter'   => false,
			'sortable' => false,
			'is_system'=> true,
            'renderer' => 'faonni_callback/adminhtml_request_grid_renderer_profile'
        ));	
		
		$this->addExportType('*/*/exportCsv', $this->__('CSV'));
		
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
     * Add grid mass action
	 *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */		
	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('id');
		$this->getMassactionBlock()->setFormFieldName('requestIds');
		$this->getMassactionBlock()->setUseSelectAll(true);

		if (true !== Mage::registry('useNewFilter')) {
			$this->getMassactionBlock()->addItem('delete', array(
				'label'   => $this->__('Delete'),
				'url'     => $this->getUrl('*/*/massDelete'),
				'confirm' => $this->__('Are you sure?')
			));
		}
		
        $statuses = Mage::getModel('faonni_callback/adminhtml_system_config_source_status')->toOptionArray();
        array_unshift($statuses, array('label' => '', 'value' => ''));
		
        $this->getMassactionBlock()->addItem('update', array(
            'label'  => $this->__('Update Status'),
            'url'    => $this->getUrl('*/*/massUpdateStatus'),
            'additional'    => array(
                'status'    => array(
                    'name'      => 'status',
                    'type'      => 'select',
                    'class'     => 'required-entry',
                    'label'     => $this->__('Status'),
                    'values'    => $statuses
                )
            )
        ));
		
		return $this;
	}	
}