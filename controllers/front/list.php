<?php

class fopmembersListModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        // Loading of association members up to date with current year's fees
        $customers = $this->module->getFoPMembers();

        // Assign customers to the template
        $this->context->smarty->assign('customers', $customers);

        // Set template
        $this->setTemplate('module:fopmembers/views/templates/front/list.tpl');
    }
}
