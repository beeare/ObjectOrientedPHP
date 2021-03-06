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

    public function testGetPublicPropertyFromSubClass()
    {
        $obj = new SubClass();

        $publicProperty = $obj->getPublicProperty();
        $this->assertEquals('Public property default value of BaseClass', $publicProperty);
    }

    public function testGetProtectedPropertyFromSubClass()
    {
        $obj = new SubClass();

        $publicProperty = $obj->getProtectedProperty();
        $this->assertEquals('Protected property default value of BaseClass', $publicProperty);
    }

    public function testGetPrivateProperty()
    {
        $obj = new BaseClass();
        $this->assertEquals('Private property default value of BaseClass', $obj->getPrivateProperty());

        $obj = new SubClass();
        $this->assertEquals('Private property default value of BaseClass', $obj->getPrivateProperty());

        $obj = new SubClass();
        $this->assertEquals('Private property default value of SubClass', $obj->getOwnPrivateProperty());
    }

    public function testSetPrivateProperty()
    {
        $obj = new BaseClass();
        $obj->setPrivateProperty('Modified private property value of BaseClass');
        $this->assertEquals('Modified private property value of BaseClass', $obj->getPrivateProperty());

        $obj = new SubClass();
        $obj->setPrivateProperty('Modified private property value of BaseClass');
        $this->assertEquals('Modified private property value of BaseClass', $obj->getPrivateProperty());
    }

    public function testCopyPrivatePropertyFromBaseClassObject()
    {
        $obj1 = new BaseClass();
        $obj1->setPrivateProperty('Modified private property value of BaseClass');

        $obj2 = new BaseClass();
        $obj2->copyPrivateProperty($obj1);
        $this->assertEquals('Modified private property value of BaseClass', $obj2->getPrivateProperty());

        $obj3 = new SubClass();
        $obj3->copyPrivateProperty($obj1);
        $this->assertEquals('Modified private property value of BaseClass', $obj3->getPrivateProperty());
    }

    public function testCopyPrivatePropertyFromSubClassObject()
    {
        $obj1 = new SubClass();
        $obj1->setPrivateProperty('Modified private property value of BaseClass');

        $obj2 = new BaseClass();
        $obj2->copyPrivateProperty($obj1);
        $this->assertEquals('Modified private property value of BaseClass', $obj2->getPrivateProperty());

        $obj3 = new SubClass();
        $obj3->copyPrivateProperty($obj1);
        $this->assertEquals('Modified private property value of BaseClass', $obj3->getPrivateProperty());
    }

    /**
     * @requires PHP 7.0
     * @expectedException \Error
     * @expectedExceptionMessageRegExp /Cannot access private property/
     */
    public function testGetParentPrivatePropertyFromSubClass()
    {
        $this->expectOutputRegex('/Cannot access private property/');

        $obj = new SubClass();
        $obj->getParentPrivateProperty();
    }

    public function testCallParentPublicMethodFromSubClass()
    {
        $this->expectOutputString('Method can be called from everywhere.');

        $obj = new SubClass();
        $obj->callParentPublicMethod();
    }

    public function testCallParentProtectedMethodFromSubClass()
    {
        $this->expectOutputString('Method can be called from instances of the same class hierarchy only.');

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
