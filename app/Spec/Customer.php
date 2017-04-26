<?php


namespace App\Spec;


interface Customer extends Controller
{
    /**
     * Edit data build definition of a customer
     */
    const CUSTOMER_EDIT = ['userData', 'userProfileData', 'creditCardData'];
}