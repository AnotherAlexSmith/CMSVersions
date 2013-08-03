<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 25.07.13
 * Time: 16:21
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Adminhtml_BlockController extends Mage_Adminhtml_Controller_Action
{
    public function _initAction()
    {
        $this->loadLayout();
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('CMS'))
            ->_title($this->__('Block'))
            ->_title($this->__('Manage Versions'));

        $versionId = $this->getRequest()->getParam('version_id');
        $blockModel = Mage::getModel('cms/block');
        $versionModel = Mage::getModel('sc_cmsversions/block');

        if ($versionId) {
            $versionModel->load($versionId);
            $blockModel->setData(unserialize($versionModel->getContent()));
            if (!$blockModel->getblockId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('sc_cmsversions')->__('This block no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        Mage::register('cms_block_version', $blockModel);

        $this->_initAction()
            ->renderLayout();
    }

    public function confirmAction()
    {
        if ($id = $this->getRequest()->getParam('version_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('sc_cmsversions/block');
                $blockModel = Mage::getModel('cms/block');
                $model->load($id);
                $blockModel->setData(unserialize($model->getContent()));
                $model->delete();
                $blockModel->save();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('cms')->__('The version has been confirmed as actual.'));
                $this->_redirect('*/cms_block/edit', array('block_id' => $model->getData('block_id')));
                return;

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/cms_block/edit', array('block_id' => $model->getData('block_id')));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('cms')->__('Unable to find a block to delete.'));
        // go to grid

        $this->_redirect('*/*/*');
    }

    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('version_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('sc_cmsversions/block');
                $model->load($id);
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('cms')->__('The version has been deleted.'));
                $this->_redirect('*/cms_block/edit', array('block_id' => $model->getData('block_id')));
                return;

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/cms_block/edit', array('block_id' => $model->getData('block_id')));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sc_cmsversions')->__('Unable to find a block to delete.'));
        // go to grid

        $this->_redirect('*/*/*');
    }
}