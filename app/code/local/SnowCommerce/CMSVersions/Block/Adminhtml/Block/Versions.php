<?php
/**
 * Class SnowCommerce_CMSVersions_Block_Adminhtml_Block_Versions
 */

class SnowCommerce_CMSVersions_Block_Adminhtml_Block_Versions extends Mage_Adminhtml_Block_Widget_Grid_Container
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_block_versions';
        $this->_blockGroup = 'sc_cmsversions';
        $this->_headerText = Mage::helper('sc_cmsversions')->__('Versions available. Actual version is always at the bottom of the list.');

        parent::__construct();

        $this->_removeButton('add');
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('sc_cmsversions')->__('Versions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('sc_cmsversions')->__('Versions');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }
}