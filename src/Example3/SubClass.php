<?php
namespace beeare\OOP\Example3;

class SubClass extends BaseClass
{
    private $privateProperty = 'Private property default value of SubClass';

    public function getPublicProperty()
    {
        return $this->publicProperty;
    }

    public function getProtectedProperty()
    {
        return $this->protectedProperty;
    }

    public function getOwnPrivateProperty()
    {
        return $this->privateProperty;
    }

    public function getParentPrivateProperty()
    {
        return parent::$privateProperty;
    }

    public function callParentPublicMethod()
    {
        $this->publicMethod();
    }

    public function callParentProtectedMethod()
    {
        $this->protectedMethod();
    }

    public function callParentPrivateMethod()
    {
        $this->privateMethod();
    }
}
