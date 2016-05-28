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
class Faonni_CallBack_Helper_Data 
	extends Mage_Core_Helper_Data
{
    /**
     * Path to store config if front-end output is active
     *
     * @var string
     */
    const XML_PATH_ENABLED = 'promo/callback/active';

    /**
     * Path to store config email sending enabled
     *
     * @var string
     */
    const XML_PATH_EMAIL_ENABLED = 'promo/callback/enabled_email';

    /**
     * Path to store config recipient email address
     *
     * @var string
     */
    const XML_PATH_EMAIL_RECIPIENT = 'promo/callback/recipient_email';

    /**
     * Path to store config sender email
     *
     * @var string
     */
    const XML_PATH_EMAIL_SENDER = 'promo/callback/sender_email_identity';

    /**
     * Path to store config email template
     *
     * @var string
     */
    const XML_PATH_EMAIL_TEMPLATE = 'promo/callback/email_template';

    /**
     * Checks whether extension is enabled
     *
     * @param Mage_Core_Model_Store $store store
     * @return bool
     */
    public function isEnabled($store=null)
    {
        return Mage::helper('Core')->isModuleEnabled('Faonni_CallBack') && 
			Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
    }

    /**
     * Checks whether extension is enabled
     *
     * @param Mage_Core_Model_Store $store store
     * @return bool
     */
    public function isEmailEnabled($store=null)
    {
        return $this->isEnabled($store) && Mage::getStoreConfigFlag(self::XML_PATH_EMAIL_ENABLED, $store);
    }

    /**
     * Get email recipient
     *
     * @param Mage_Core_Model_Store $store store
     * @return bool
     */
    public function getEmailRecipient($store=null)
    {
        return Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT, $store);
    }

    /**
     * Get email sender
     *
     * @param Mage_Core_Model_Store $store store
     * @return bool
     */
    public function getEmailSender($store=null)
    {
        return Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER, $store);
    }

    /**
     * Get email template
     *
     * @param Mage_Core_Model_Store $store store
     * @return bool
     */
    public function getEmailTemplate($store=null)
    {
        return Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE, $store);
    }
	
    /**
     * Retrieve request callback POST URL
     *
     * @return string
     */
    public function getRequestPostUrl()
    {
        return $this->_getUrl('callback/request/save');
    }	
}