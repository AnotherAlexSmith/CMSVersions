<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 30.07.13
 * Time: 14:21
 * To change this template use File | Settings | File Templates.
 */

class SnowCommerce_CMSVersions_Block_Adminhtml_Block_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
        ));

        $this->setForm($form);
        $form->setUseContainer(true);
        return parent::_prepareForm();
    }
}