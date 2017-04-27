<?php


namespace App\Spec;


interface Customer extends Controller, Main
{
    /**
     * Form data build definition
     */
    const CUSTOMER_FORM = ['userData', 'userProfileData', 'creditCardData'];
}