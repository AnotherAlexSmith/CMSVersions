<?php
/**
 * Class SnowCommerce_CMSVersions_Model_Mysql4_Block
 */

class SnowCommerce_CMSVersions_Model_Mysql4_Block extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('sc_cmsversions/sc_cmsversions_block','entity_id');
    }
}