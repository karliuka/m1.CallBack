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
class Faonni_CallBack_Adminhtml_Callback_RequestController 
	extends Mage_Adminhtml_Controller_Action
{
    /**
     * Init actions
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('customer/callback')
            ->_addBreadcrumb(
                Mage::helper('faonni_callback')->__('Manage Call Back Request'),
                Mage::helper('faonni_callback')->__('Manage Call Back Request')
            );
        return $this;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_title($this->__('Manage Call Back Request'));

        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * New action
     *
     * @return void
     */
    public function newAction()
    {
        Mage::register('useNewFilter', true);
		$this->_title($this->__('Manage Call Back Request'));

        $this->_initAction();
        $this->renderLayout();
    }
	
    /**
     * Mass update status action
     *
     * @return void
     */
    public function massUpdateStatusAction()
    {
        $status = $this->getRequest()->getParam('status');
        $requestIds = $this->getRequest()->getParam('requestIds');

        if (!is_array($requestIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select request(s)'));
        } else {
            try {
                foreach ($requestIds as $requestId) {
                    $request = Mage::getModel('faonni_callback/request')->load($requestId);
                    $request->setStatus($status);
                    $request->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Total of %d record(s) were updated', count($requestIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    /**
     * Mass delete action
     *
     * @return void
     */
    public function massDeleteAction()
    {
        $requestIds = $this->getRequest()->getParam('requestIds');

        if (!is_array($requestIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select request(s)'));
        } else {
            try {
                foreach ($requestIds as $requestId) {
                    $request = Mage::getModel('faonni_callback/request')->load($requestId);
                    $request->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Total of %d record(s) were deleted', count($requestIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Export callback request to CSV format
     */
    public function exportCsvAction()
    {
        $fileName = 'callback.csv';
        $content = $this->getLayout()->createBlock('faonni_callback/adminhtml_request_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }
	
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
		return Mage::getSingleton('admin/session')->isAllowed('customer/callback');
    }	
}