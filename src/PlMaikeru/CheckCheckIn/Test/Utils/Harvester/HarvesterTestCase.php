<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \Mockery as m;

abstract class HarvesterTestCase extends \PHPUnit_Framework_TestCase
{
    protected $executor;
    public function setUp()
    {
        $this->executor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor');
    }
    public function tearDown()
    {
        m::close();
    }
    abstract protected function getHarvester();
}
