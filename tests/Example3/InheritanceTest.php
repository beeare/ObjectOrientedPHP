<?php
namespace beeare\OOP\Example3;

class InheritanceTest extends \PHPUnit_Framework_TestCase
{
    public function testBaseClassObjectInstanceOfOwnClass()
    {
        $obj = new BaseClass();
        $this->assertInstanceOf(BaseClass::class, $obj);
    }

    public function testSubClassObjectInstanceOfOwnClass()
    {
        $obj = new SubClass();
        $this->assertInstanceOf(SubClass::class, $obj);
    }

    public function testBaseClassObjectNotInstanceOfSubClass()
    {
        $obj = new BaseClass();
        $this->assertNotInstanceOf(SubClass::class, $obj);
    }

    public function testSubClassObjectInstanceOfBaseClass()
    {
        $obj = new SubClass();
        $this->assertInstanceOf(BaseClass::class, $obj);
    }

    public function testCallParentPublicMethodFromSubClass()
    {
        $this->expectOutputString('Method can be called from everywhere.');

        $obj = new SubClass();
        $obj->callParentPublicMethod();
    }

    public function testCallParentProtectedMethodFromSubClass()
    {
        $this->expectOutputString('Method can be called from instances in the same class hierarchy only.');

        $subObj = new SubClass();
        $subObj->callParentProtectedMethod();
    }

    /**
     * @requires PHP 7.0
     * @expectedException \Error
     * @expectedExceptionMessageRegExp /Call to private method.+from context/
     */
    public function testCallParentPrivateMethodFromSubClass()
    {
        $this->expectOutputRegex('/Call to private method.+from context/');

        $obj = new SubClass();
        $obj->callParentPrivateMethod();
    }
}
