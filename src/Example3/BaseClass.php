<?php
namespace beeare\OOP\Example3;

class BaseClass
{
    public $publicProperty = 'Public property default value of BaseClass';

    protected $protectedProperty = 'Protected property default value of BaseClass';

    private $privateProperty = 'Private property default value of BaseClass';

    public function getPrivateProperty()
    {
        return $this->privateProperty;
    }

    public function setPrivateProperty($value)
    {
        $this->privateProperty = $value;
    }

    public function copyPrivateProperty(BaseClass $obj)
    {
        $this->privateProperty = $obj->privateProperty;
    }

    public function publicMethod()
    {
        echo 'Method can be called from everywhere.';
    }

    protected function protectedMethod()
    {
        echo 'Method can be called from instances of the same class hierarchy only.';
    }

    private function privateMethod()
    {
        echo 'Method can be called from instances of the same class only.';
    }
}
