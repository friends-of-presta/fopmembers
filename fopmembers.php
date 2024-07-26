<?php
/**
 * Copyright (c) Since 2020 Friends of Presta
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file docs/licenses/LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to infos@friendsofpresta.org so we can send you a copy immediately.
 *
 * @author    Friends of Presta <infos@friendsofpresta.org>
 * @copyright since 2020 Friends of Presta
 * @license   https://opensource.org/licenses/AFL-3.0  Academic Free License ("AFL") v. 3.0
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class FopMembers extends Module
{
    public function __construct()
    {
        $this->name = 'fopmembers';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Friends of Presta';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Fop Members Display');
        $this->description = $this->l('Display customers of group adherents.');
    }

    public function getFoPMembers()
    {
        $customerIds = $this->getCustomersByGroupId(6);
        // Load customer objects
        $customers = [];
        if ($customerIds) {
            foreach ($customerIds as $customerId) {
                $customer = new Customer($customerId);
                $customers[$customerId] = $customer->getFields();
                $id_address = Address::getFirstCustomerAddressId($customerId);
                if((int)$id_address>0){
                    $address = new Address($id_address);
                    $customers[$customerId]['postcode'] = substr($address->postcode, 0,2);
                    $customers[$customerId]['city'] = $address->city;
                    $customers[$customerId]['country'] = Country::getNameById(Context::getContext()->language->id, $address->id_country);
                    unset($address);
                }
            }
        }

        return $customers;
    }

    public function getCustomersByGroupId($groupId)
    {
        $sql = new DbQuery();
        $sql->select('c.id_customer');
        $sql->from('customer_group', 'cg');
        $sql->leftJoin('customer', 'c', 'c.id_customer = cg.id_customer');
        $sql->where('cg.id_group = ' . (int) $groupId);
        $sql->where('c.optin = 1'); // Only include customers with opt_in = 1
        $sql->orderby('c.company, c.lastname');

        $result = Db::getInstance()->executeS($sql);

        $customerIds = [];
        if ($result) {
            foreach ($result as $row) {
                $customerIds[] = $row['id_customer'];
            }
        }

        return $customerIds;
    }
}
