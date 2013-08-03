<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 25.07.13
 * Time: 16:08
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Block_Adminhtml_Pages_Versions extends Mage_Adminhtml_Block_Widget_Grid_Container
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_pages_versions';
        $this->_blockGroup = 'sc_cmsversions';
        $this->_headerText = Mage::helper('sc_cmsversions')->__('Versions available');

        parent::__construct();

        $this->_removeButton('add');
    }

    public function getTabLabel()
    {
        return Mage::helper('cms')->__('Versions');
    }

    public function getTabTitle()
    {
        return Mage::helper('cms')->__('Versions');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}