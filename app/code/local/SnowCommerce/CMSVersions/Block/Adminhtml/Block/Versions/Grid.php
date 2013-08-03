<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 25.07.13
 * Time: 16:19
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Block_Adminhtml_Block_Versions_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('BlockVersionsGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sc_cmsversions/block')->getCollection();
        $collection->addFieldToFilter('block_id',array(
            "eq" => $this->getRequest()->getParam('block_id')
        ));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('sc_cmsversions')->__('Version ID'),
            'align'     => 'left',
            'width'     => '50px',
            'index'     => 'entity_id',
        ));

        $this->addColumn('sc_page_id', array(
            'header'    => Mage::helper('sc_cmsversions')->__('Block ID'),
            'align'     => 'left',
            'width'     => '50px',
            'index'     => 'block_id',
        ));

        $this->addColumn('version', array(
            'header'    => Mage::helper('sc_cmsversions')->__('Created'),
            'align'     => 'left',
            'width'     => '100px',
            'index'     => 'version',
        ));

        $this->addColumn('admin_name', array(
            'header'    => Mage::helper('sc_cmsversions')->__('Admin Name'),
            'align'     => 'left',
            'index'     => 'admin_name',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/block/index', array('version_id' => $row->getId()));
    }
}