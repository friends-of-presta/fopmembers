<?php

class fopmembersListModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        // Load customers of group ID 4
        $customers = $this->module->getFoPMembers();

        // Assign customers to the template
        $this->context->smarty->assign('customers', $customers);

        // Set template
        $this->setTemplate('module:fopmembers/views/templates/front/list.tpl');
    }
}
