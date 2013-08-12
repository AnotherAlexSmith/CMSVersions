<?php
/**
 * Class SnowCommerce_CMSVersions_Adminhtml_BlockController
 */

class SnowCommerce_CMSVersions_Adminhtml_BlockController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return $this
     */
    public function _initAction()
    {
        $this->loadLayout();
        return $this;
    }

    /**
     * Index action
     */
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

    /**
     * Confirm action
     */
    public function confirmAction()
    {
        if ($id = $this->getRequest()->getParam('version_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('sc_cmsversions/block');
                $blockModel = Mage::getModel('cms/block');
                $model->load($id);
                $blockModel->setData(unserialize($model->getContent()));
                $blockModel->save();
                $model->delete();
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

    /**
     * Delete action
     */
    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('version_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('sc_cmsversions/block');
                $model->load($id);
                if($model->getIsActual() == 1)
                {
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('cms')->__("Actual version can't be deleted."));
                    $this->_redirect('*/block/index', array('version_id' => $this->getRequest()->getParam('version_id')));
                    return;
                }
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