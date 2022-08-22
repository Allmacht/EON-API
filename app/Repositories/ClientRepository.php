<?php

namespace App\Repositories;

use App\Interfaces\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function store(array $params): Client
    {
        $client = new Client();

        $client->_resource_state = $params['_resource_state'];
        $client->slug = $params['slug'];
        $client->name = $params['general']['name'];
        $client->business_name = $params['general']['business_name'];
        $client->contact_name = $params['general']['contact_name'];
        $client->phone = $params['general']['phone'];
        $client->service_phone = $params['general']['service_phone'];
        $client->email = $params['general']['email'];
        $client->rfid = $params['general']['rfid'];

        $client->country = $params['address']['country'];
        $client->state = $params['address']['state'];
        $client->city = $params['address']['city'];
        $client->neighborhood = $params['address']['neighborhood'];
        $client->street = $params['address']['street'];
        $client->ext_number = $params['address']['ext_number'];
        $client->int_number = $params['address']['int_number'];
        $client->zipcode = $params['address']['zipcode'];

        if ($params['require_expt_impt']['active']) {
            $client->ssn = $params['require_expt_impt']['ssn'];
            $client->idc = $params['require_expt_impt']['idc'];
            $client->rfe = null;
            $client->immex = null;
        } else {
            $client->ssn = null;
            $client->idc = null;
            $client->rfe = $params['require_expt_impt']['rfe'];
            $client->immex = $params['require_expt_impt']['immex'];
        }

        if (! $params['notifications']['active']) {
            $client->email_notification = null;
            $client->notification_concept = null;
        } else {
            $client->email_notification = $params['notifications']['email_notification'];
            $client->notification_concept = $params['notifications']['notification_concept'];
        }

        if ($params['fulfillment']['active']) {
            $client->services = $params['fulfillment']['services'];
        }

        $client->save();

        return $client;
    }
}
