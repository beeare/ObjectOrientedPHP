<?php
namespace beeare\OOP\Example3;

class BaseClass
{
    public $publicProperty;

    protected $protectedProperty;

    private $privateProperty;

    public function publicMethod()
    {
        echo 'Method can be called from everywhere.';
    }

    protected function protectedMethod()
    {
        echo 'Method can be called from instances in the same class hierarchy only.';
    }

    private function privateMethod()
    {
        echo 'Method can be called from instances of the same class only.';
    }
}