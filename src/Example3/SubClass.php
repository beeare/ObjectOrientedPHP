<?php
namespace beeare\OOP\Example3;

class SubClass extends BaseClass
{
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