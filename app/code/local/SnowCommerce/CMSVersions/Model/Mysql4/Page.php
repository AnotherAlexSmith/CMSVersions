<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 25.07.13
 * Time: 18:56
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Model_Mysql4_Page extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('sc_cmsversions/sc_cmsversions_pages','entity_id');
    }
}