<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 26.07.13
 * Time: 13:10
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Model_Observer
{
    public function SavePageVersion($observer)
    {
        $user = Mage::getSingleton('admin/session')->getUser();
        if($user)
        {
            $page = $observer->getObject();
            $model = Mage::getModel('sc_cmsversions/page');
            $data = array(
                'page_id'       => $page['page_id'],
                'version'       => $time = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time())),
                'content'       => serialize($page->getData()),
                'admin_name'    => $user->getUsername(),
                'identifier'    => $page['identifier'],
            );
            $model->setData($data);
            $model->save();
        }
    }

    public function SaveBlockVersion($observer)
    {
        $user = Mage::getSingleton('admin/session')->getUser();
        if($user)
        {
            $block = $observer->getObject();
            if(get_class($block) == "Mage_Cms_Model_Block")
            {
                $model = Mage::getModel('sc_cmsversions/block');
                $data = array(
                    'block_id'       => $block['block_id'],
                    'version'       => $time = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time())),
                    'content'       => serialize($block->getData()),
                    'admin_name'    => Mage::getSingleton('admin/session')->getUser()->getUsername(),
                );
                $model->setData($data);
                $model->save();
            }
        }
    }

    public function DefaultPageVersion($observer)
    {
        $collection = Mage::getModel('sc_cmsversions/page')->getCollection();
        $collection->addFieldToFilter('page_id',array(
            "eq" => $observer->getObject()->getPageId()
        ));
        if(count($collection) == 0)
        {
            $this->SavePageVersion($observer);
        }
    }

    public function DefaultBlockVersion($observer)
    {
        $block = $observer->getObject();
        if(get_class($block) == "Mage_Cms_Model_Block")
        {
            $collection = Mage::getModel('sc_cmsversions/block')->getCollection();
            $collection->addFieldToFilter('block_id',array(
                "eq" => $observer->getObject()->getBlockId()
            ));
            if(count($collection) == 0)
            {
                $this->SaveBlockVersion($observer);
            }
        }
    }
}