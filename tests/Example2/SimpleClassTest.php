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

        $obj->publicProperty = 'test';
        $this->assertEquals('test', $obj->publicProperty);
    }

    /**
     * @requires PHP 7.0
     */
    public function testProtectedPropertyAccess()
    {
        $this->expectOutputRegex('/.+Cannot access protected property.+/');

        $obj = new SimpleClass();

        try {
            $obj->protectedProperty = 'test';
        } catch (\Error $e) {
            $this->assertRegExp('/.+Cannot access protected property.+/', $this->getActualOutput());
        }
    }

    /**
     * @requires PHP 7.0
     */
    public function testPrivatePropertyAccess()
    {
        $this->expectOutputRegex('/.+Cannot access private property.+/');

        $obj = new SimpleClass();

        try {
            $obj->privateProperty = 'test';
        } catch (\Error $e) {
            $this->assertRegExp('/.+Cannot access private property.+/', $this->getActualOutput());
        }
    }

    public function testNonExistingPropertyAccess()
    {
        $obj = new SimpleClass();

        $obj->nonExistingProperty = 'test';
        $this->assertEquals('test', $obj->nonExistingProperty);
    }

    public function testPublicMethodCall()
    {
        $this->expectOutputString('Method can be called from everywhere.');

        $obj = new SimpleClass();
        $obj->publicMethod();

        $this->assertEquals('Method can be called from everywhere.', $this->getActualOutput());
    }

    /**
     * @requires PHP 7.0
     */
    public function testProtectedMethodCall()
    {
        $this->expectOutputRegex('/.+Call to protected method.+from context.+/');

        $obj = new SimpleClass();

        try {
            $obj->protectedMethod();
        } catch (\Error $e) {
            $this->assertRegExp('/.+Call to protected method.+from context.+/', $this->getActualOutput());
        }
    }

    /**
     * @requires PHP 7.0
     */
    public function testPrivateMethodCall()
    {
        $this->expectOutputRegex('/.+Call to private method.+from context.+/');

        $obj = new SimpleClass();

        try {
            $obj->privateMethod();
        } catch (\Error $e) {
            $this->assertRegExp('/.+Call to private method.+from context.+/', $this->getActualOutput());
        }
    }

    /**
     * @requires PHP 7.0
     */
    public function testNonExistingMethodCall()
    {
        $this->expectOutputRegex('/.+Call to undefined method.+/');

        $obj = new SimpleClass();

        try {
            $obj->nonExistingMethod();
        } catch (\Error $e) {
            $this->assertRegExp('/.+Call to undefined method.+/', $this->getActualOutput());
        }
    }
}
