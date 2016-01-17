<?php
namespace beeare\OOP\Example2;

class SimpleClassTest extends \PHPUnit_Framework_TestCase
{
    public function testNewInstance()
    {
        $obj = new SimpleClass();
        $this->assertInstanceOf(SimpleClass::class, $obj);
    }

    public function testPublicPropertyAccess()
    {
        $obj = new SimpleClass();
        $this->assertClassHasAttribute('publicProperty', SimpleClass::class);

        $obj->publicProperty = 'test';
        $this->assertEquals('test', $obj->publicProperty);
    }

    /**
     * @requires PHP 7.0
     * @expectedException \Error
     * @expectedExceptionMessageRegExp /Cannot access protected property/
     */
    public function testProtectedPropertyAccess()
    {
        $this->expectOutputRegex('/Cannot access protected property/');

        $obj = new SimpleClass();
        $this->assertClassHasAttribute('protectedProperty', SimpleClass::class);

        $obj->protectedProperty = 'test';
    }

    /**
     * @requires PHP 7.0
     * @expectedException \Error
     * @expectedExceptionMessageRegExp /Cannot access private property/
     */
    public function testPrivatePropertyAccess()
    {
        $this->expectOutputRegex('/Cannot access private property/');

        $obj = new SimpleClass();
        $this->assertClassHasAttribute('privateProperty', SimpleClass::class);

        $obj->privateProperty = 'test';
    }

    public function testNonExistingPropertyAccess()
    {
        $obj = new SimpleClass();

        $this->assertClassNotHasAttribute('nonExistingProperty', SimpleClass::class);

        $obj->nonExistingProperty = 'test';
        $this->assertObjectHasAttribute('nonExistingProperty', $obj);
        $this->assertClassNotHasAttribute('nonExistingProperty', get_class($obj));

        $this->assertEquals('test', $obj->nonExistingProperty);
    }

    public function testPublicMethodCall()
    {
        $this->expectOutputString('Method can be called from everywhere.');

        $obj = new SimpleClass();
        $obj->publicMethod();
    }

    /**
     * @requires PHP 7.0
     * @expectedException \Error
     * @expectedExceptionMessageRegExp /Call to protected method.+from context/
     */
    public function testProtectedMethodCall()
    {
        $this->expectOutputRegex('/Call to protected method.+from context/');

        $obj = new SimpleClass();
        $obj->protectedMethod();
    }

    /**
     * @requires PHP 7.0
     * @expectedException \Error
     * @expectedExceptionMessageRegExp /Call to private method.+from context/
     */
    public function testPrivateMethodCall()
    {
        $this->expectOutputRegex('/Call to private method.+from context/');

        $obj = new SimpleClass();
        $obj->privateMethod();
    }

    /**
     * @requires PHP 7.0
     * @expectedException \Error
     * @expectedExceptionMessageRegExp /Call to undefined method/
     */
    public function testNonExistingMethodCall()
    {
        $this->expectOutputRegex('/Call to undefined method/');

        $obj = new SimpleClass();
        $obj->nonExistingMethod();
    }
}
