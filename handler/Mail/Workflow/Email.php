<?php


namespace App\Contract\Workflow;


interface Email
{
    const BASIC = [
        'places' => [
            'initial', // storage
            'firewall', // spam-check
            'blacklisted', // internal logs, bad words
            'approved',
            'new', // accepted
            'rejected', // end-point 0
            'sent' // dispatched, end-point 1
        ],
        'transitions' => [
            'to_firewall' => ['from' => 'initial', 'to' => 'firewall'],
            'to_rejected' => ['from' => ['firewall', 'blacklisted'], 'to' => 'rejected'],
            'to_approved' => ['from' => ['firewall', 'blacklisted'], 'to' => 'approved'],
            'to_new' => ['from' => 'approved', 'to' => 'new'],
            'to_sent' => ['from' => 'new', 'to' => 'sent'],
        ]
    ];
}