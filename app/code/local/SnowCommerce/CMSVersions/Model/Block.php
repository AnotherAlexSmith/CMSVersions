<?php
/**
 * Class SnowCommerce_CMSVersions_Model_Block
 */

class SnowCommerce_CMSVersions_Model_Block extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sc_cmsversions/block');
    }
}