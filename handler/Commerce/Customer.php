<?php

namespace Commerce;



class Customer implements CustomerSpec
{
    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        foreach($this->input as $operation){
            $operation->handle();
        }
    }
}