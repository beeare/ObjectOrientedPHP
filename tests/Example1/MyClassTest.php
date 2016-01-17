<?php
namespace beeare\OOP\Example1;

class MyClassTest extends \PHPUnit_Framework_TestCase
{
    public function testNewInstance()
    {
        $this->expectOutputString('Constructor called.' . PHP_EOL . 'Destructor called.' . PHP_EOL);

        $obj = new MyClass();
        $this->assertInstanceOf(MyClass::class, $obj);
    }

    /**
     * Test shows that destructor is called immediately on implicit unset,
     * if no circular reference exists.
     */
    public function testImplicitUnsetWithoutSelfReference()
    {
        $this->expectOutputString('Constructor called.' . PHP_EOL . 'Destructor called.' . PHP_EOL);

        /** @noinspection PhpUnusedLocalVariableInspection */
        $obj = new MyClass();

        $obj = null;
        $this->assertNull($obj);
    }

    /**
     * Test shows that destructor is called immediately on explicit unset,
     * if no circular reference exists.
     */
    public function testExplicitUnsetWithoutSelfReference()
    {
        $this->expectOutputString('Constructor called.' . PHP_EOL . 'Destructor called.' . PHP_EOL);

        $obj = new MyClass();
        unset($obj);
    }

    /**
     * Test shows that destructor is not called immediately on implicit unset,
     * if a circular reference exists. Destructor is called later during shutdown process.
     */
    public function testImplicitUnsetWithSelfReference()
    {
        $this->expectOutputString('Constructor called.' . PHP_EOL);

        $obj = new MyClass();

        $obj->self = $obj;
        $this->assertSame($obj, $obj->self);

        $obj = null;
        $this->assertNull($obj);
    }

    /**
     * Test shows that destructor is not called immediately on explicit unset,
     * if a circular reference exists. Destructor is called later during shutdown process.
     */
    public function testExplicitUnsetWithSelfReference()
    {
        $this->expectOutputString('Constructor called.' . PHP_EOL);

        $obj = new MyClass();

        $obj->self = $obj;
        $this->assertSame($obj, $obj->self);

        unset($obj);
    }
}
