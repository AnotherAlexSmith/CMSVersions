<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 25.07.13
 * Time: 16:19
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Block_Adminhtml_Pages_Versions_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('PagesVersionsGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sc_cmsversions/page')->getCollection();
        $collection->addFieldToFilter('page_id',array(
            "eq" => $this->getRequest()->getParam('page_id')
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
            'header'    => Mage::helper('sc_cmsversions')->__('Page ID'),
            'align'     => 'left',
            'width'     => '50px',
            'index'     => 'page_id',
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

        $this->addColumn('sc_identifier', array(
            'header'    => Mage::helper('sc_cmsversions')->__('URL Key'),
            'align'     => 'left',
            'index'     => 'identifier'
        ));

        $this->addColumn('page_actions', array(
            'header'    => Mage::helper('sc_cmsversions')->__('Action'),
            'width'     => 10,
            'sortable'  => false,
            'filter'    => false,
            'renderer'  => 'sc_cmsversions/adminhtml_pages_versions_grid_renderer_action',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/page/index', array('version_id' => $row->getId()));
    }
}