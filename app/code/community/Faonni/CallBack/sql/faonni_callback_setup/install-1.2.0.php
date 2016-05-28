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
$installer = $this;

/**
 * Create table 'faonni_callback/request'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('faonni_callback/request'))
    ->addColumn('request_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned' => true,
		'identity' => true,
		'nullable' => false,
		'primary'  => true,
		), 'Request id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
		'unsigned' => true,
        ), 'Customer Id')		
    ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => false,
		'default'  => '',
		), 'First Name')
    ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => false,
		'default'  => '',
		), 'Last Name')		
	->addColumn('phone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => false,
		), 'Phone')
	->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable' => false,
		'default' => Faonni_CallBack_Model_Request::STATUS_NEW,
		), 'Status')
	->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned' => true,
		'nullable' => false,
		), 'Store Id')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => true,
		'default' => null,
		), 'Created Time')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => true,
		'default' => null,
		), 'Update Time')		
		
    ->addIndex($installer->getIdxName($installer->getTable('faonni_callback/request'), array('created_at')),
		array('created_at')
	)
    ->addIndex($installer->getIdxName($installer->getTable('faonni_callback/request'), array('updated_at')),
		array('updated_at')
	)	
	->addIndex($installer->getIdxName('faonni_callback/request', array('customer_id')),
        array('customer_id')
	)
	->addIndex($installer->getIdxName('faonni_callback/request', array('status')),
        array('status')
	)
	
    ->addForeignKey($installer->getFkName('faonni_callback/request', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
		
    ->addForeignKey($installer->getFkName('faonni_callback/request', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id', $installer->getTable('customer/entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

    ->setComment('Faonni Callback Request');

$installer->getConnection()->createTable($table);
$installer->endSetup();