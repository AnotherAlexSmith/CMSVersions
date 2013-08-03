<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 25.07.13
 * Time: 19:01
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Model_Mysql4_Page_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sc_cmsversions/page');
    }
}