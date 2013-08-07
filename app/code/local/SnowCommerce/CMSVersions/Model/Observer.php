<?php
/**
 * Class SnowCommerce_CMSVersions_Model_Observer
 */

class SnowCommerce_CMSVersions_Model_Observer
{
    /**
     * Puts page's saving version to the database
     * @param $observer
     */
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

    /**
     * Puts block's saving version to the database
     * @param $observer
     */
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

    /**
     * Saves default pages' versions
     * @param $observer
     */
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

    /**
     * Saves default blocks' versions
     * @param $observer
     */
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