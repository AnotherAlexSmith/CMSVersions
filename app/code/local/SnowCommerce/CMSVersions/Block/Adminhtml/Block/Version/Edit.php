<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 30.07.13
 * Time: 14:18
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Block_Adminhtml_Block_Version_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'sc_cmsversions';
        $this->_controller = 'adminhtml_block_version';
        $this->_headerText = Mage::helper('sc_cmsversions')->__('Block versions');
        parent::__construct();

        $this->addButton('delete', array(
            'label'     => Mage::helper('sc_cmsversions')->__('Delete Version'),
            'onclick'   => "setLocation('".$this->getDeleteVersionUrl()."')",
            'class'     => 'delete',
        ),100);

        $this->_addButton('go_back', array(
            'label'     => Mage::helper('sc_cmsversions')->__('Back'),
            'onclick'   => "setLocation('".$this->getBlockUrl()."')",
            'class'     => 'back',
        ),0);

        $this->_addButton('confirm', array(
            'label'     => Mage::helper('sc_cmsversions')->__('Set as Actual'),
            'onclick'   => "setLocation('".$this->getConfirmVersionUrl()."')",
            'class'     => 'save',
        ),1);

        $this->_removeButton('back');
        $this->_removeButton('reset');
        $this->_removeButton('save');
    }

    public function getDeleteVersionUrl()
    {
        return $this->getUrl('*/block/delete', array('version_id' => $this->getRequest()->getParam('version_id')));
    }

    public function getConfirmVersionUrl()
    {
        return $this->getUrl('*/block/confirm', array('version_id' => $this->getRequest()->getParam('version_id')));
    }

    public function getBlockUrl()
    {
        $blockModel = Mage::registry('cms_block_version');
        return $this->getUrl('*/cms_block/edit', array('block_id' => $blockModel->getData('block_id')));
    }
}