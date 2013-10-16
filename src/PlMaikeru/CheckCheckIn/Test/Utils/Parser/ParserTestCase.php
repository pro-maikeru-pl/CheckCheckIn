<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Parser;
use \Mockery as m;

abstract class ParserTestCase extends \PHPUnit_Framework_TestCase
{
    protected $executor;
    public function setUp()
    {
        $this->executor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor\Executor');
    }
    public function tearDown()
    {
        m::close();
    }
    abstract protected function getParser();
}
