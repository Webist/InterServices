<?php
/**
 * Info
 * Created: 15/02/2017 00:08
 *
 */

namespace Account;


class UserProfile
{
    private $input;

    public function __construct(UserProfileInput $input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        // .. save to persistence
    }
}