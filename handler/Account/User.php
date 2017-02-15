<?php
/**
 * Info
 * Created: 14/02/2017 22:41
 *
 */

namespace Account;


class User
{
    private $input;

    public function __construct(UserInput $input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        // .. save to persistence
    }
}