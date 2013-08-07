<?php
/**
 * Class SnowCommerce_CMSVersions_Model_Mysql4_Page
 */

class SnowCommerce_CMSVersions_Model_Mysql4_Page extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('sc_cmsversions/sc_cmsversions_pages','entity_id');
    }
}