<?php
namespace beeare\OOP;

class MyClassTest extends \PHPUnit_Framework_TestCase
{
    public function testNewInstance()
    {
        $this->assertInstanceOf(MyClass::class, new MyClass());
    }
}
