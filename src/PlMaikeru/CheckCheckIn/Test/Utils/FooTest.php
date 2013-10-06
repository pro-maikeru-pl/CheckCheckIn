<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils;
use \PlMaikeru\CheckCheckIn\Utils\Foo;

/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Foo
 *
 */
class FooTest extends \PHPUnit_Framework_TestCase
{
    public function testFoo()
    {
        $foo = new Foo();
        $this->assertSame('foo', $foo->foo());
    }
}
