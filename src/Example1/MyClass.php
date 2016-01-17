<?php
namespace beeare\OOP\Example1;

class MyClass
{
    public $self;

    public function __construct()
    {
        echo "Constructor called." . PHP_EOL;
    }

    public function __destruct()
    {
        echo "Destructor called." . PHP_EOL;
    }
}
