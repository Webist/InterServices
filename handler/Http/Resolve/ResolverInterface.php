<?php

namespace Http\Resolve;


interface ResolverInterface
{
    /**
     * (Web) Delivery model. Simple, MVC, MOM.
     */
    const DELIVERY_NAME = "delivery";
    const DELIVERY_MODEL_SIMPLE = 'simple';
    const DELIVERY_MODEL_MVC = 'MVC';
    const DELIVERY_MODEL_MOM = 'MOM';
    const DELIVERY_MODELS = ['simple', 'MVC', 'MOM'];

    const CLASS_FIELD_NAME = "class";
    const CLASS_ACTION_FIELD_NAME = "method";

    const INTER_FIELD_NAME = "config";
    const HANDLER_FIELD_NAME = "handler";

    const CLASS_HANDLER_NAME = "handler";

    const FORWARD_DESTINATION_NAME = 'filename';
}