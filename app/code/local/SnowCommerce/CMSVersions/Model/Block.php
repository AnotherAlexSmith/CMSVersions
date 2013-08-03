<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 25.07.13
 * Time: 18:56
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Model_Block extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sc_cmsversions/block');
    }
}