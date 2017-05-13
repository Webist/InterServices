<?php

require_once 'PHPUnit/Extensions/Story/TestCase.php';
require_once '../app/InterActor/Customer.php';


class customerSpec extends PHPUnit_Extensions_Story_TestCase
{
  /**
   * @scenario
   */
  public function postDataEmailIsInDatabase()
  {
     $this->given('postData')
          ->when('uuid is empty')
          ->then('postData email value should be fetched from database');

  }

    protected function runGiven(&$world, $action, $arguments)
    {
        $world['uuid'] = null;
        $world['customer'] = [
            'email' => 'test@test.eu'
        ];
    }

    protected function runWhen(&$world, $action, $arguments)
    {
        return empty($world['uuid']);
    }

    protected function runThen(&$world, $action, $arguments)
    {
        $world['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();

        $this->assertNotEmpty($world['uuid']);
    }

}
