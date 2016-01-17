<?php
namespace beeare\OOP\Example4;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    public function testNewPerson()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $this->assertInstanceOf(Person::class, $max);

        $this->assertEquals('Max', $max->getFirstName());
        $this->assertEquals('Mustermann', $max->getLastName());
        $this->assertEquals(Person::GENDER_MALE, $max->getGender());
    }

    public function testSettersAndGetters()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $max->setFirstName('Max');
        $this->assertEquals('Max', $max->getFirstName());

        $max->setLastName('Mustermann');
        $this->assertEquals('Mustermann', $max->getLastName());

        $max->setGender(Person::GENDER_MALE);
        $this->assertEquals(Person::GENDER_MALE, $max->getGender());
    }

    public function testSetValidGender()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $max->setGender(Person::GENDER_MALE);
        $this->assertEquals(Person::GENDER_MALE, $max->getGender());

        $max->setGender(Person::GENDER_FEMALE);
        $this->assertEquals(Person::GENDER_FEMALE, $max->getGender());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid gender specified.
     */
    public function testSetInvalidGender()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);
        $max->setGender('invalid');
    }

    public function testSetAndGetParents()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $parents = [
            new Person('Peter', 'Mustermann', Person::GENDER_MALE),
        ];
        $max->setParents($parents);
        $this->assertEquals($parents, $max->getParents());

        $parents = [
            new Person('Petra', 'Mustermann', Person::GENDER_FEMALE),
        ];
        $max->setParents($parents);
        $this->assertEquals($parents, $max->getParents());

        $parents = [
            new Person('Peter', 'Mustermann', Person::GENDER_MALE),
            new Person('Petra', 'Mustermann', Person::GENDER_FEMALE),
        ];
        $max->setParents($parents);
        $this->assertEquals($parents, $max->getParents());

        $max->setParents([]);
        $this->assertEquals([], $max->getParents());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage More than two parents specified.
     */
    public function testSetTooManyParents()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $parents = [
            new Person('Peter', 'Mustermann', Person::GENDER_MALE),
            new Person('Petra', 'Mustermann', Person::GENDER_FEMALE),
            new Person('Paul', 'Meier', Person::GENDER_MALE),
        ];
        $max->setParents($parents);
    }

    public function testSetAndGetSiblings()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $siblings = [
            new Person('Marie', 'Mustermann', Person::GENDER_FEMALE),
        ];
        $max->setSiblings($siblings);
        $this->assertEquals($siblings, $max->getSiblings());

        $max->setSiblings([]);
        $this->assertEquals([], $max->getSiblings());
    }

    public function testSetAndGetChildren()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $children = [
            new Person('Julie', 'Mustermann', Person::GENDER_FEMALE),
            new Person('Jean', 'Mustermann', Person::GENDER_MALE),
            new Person('Beatrice', 'Mustermann', Person::GENDER_FEMALE),
        ];
        $max->setChildren($children);
        $this->assertEquals($children, $max->getChildren());

        $max->setChildren([]);
        $this->assertEquals([], $max->getChildren());
    }

    public function testSetParentsGetChildren()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $peter = new Person('Peter', 'Mustermann', Person::GENDER_MALE);
        $petra = new Person('Petra', 'Mustermann', Person::GENDER_FEMALE);

        $max->setParents([$peter, $petra]);

        $this->assertArraySubset([$max], $peter->getChildren());
        $this->assertArraySubset([$max], $petra->getChildren());
    }

    public function testSetSiblingsGetSiblings()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $marie = new Person('Marie', 'Mustermann', Person::GENDER_FEMALE);
        $manuel = new Person('Manuel', 'Mustermann', Person::GENDER_MALE);

        $max->setSiblings([$marie, $manuel]);

        $this->assertEquals([$max], $marie->getSiblings());
        $this->assertEquals([$max], $manuel->getSiblings());
    }

    public function testSetChildrenGetParents()
    {
        $peter = new Person('Peter', 'Mustermann', Person::GENDER_MALE);
        $petra = new Person('Petra', 'Mustermann', Person::GENDER_FEMALE);
        $parents = [$peter, $petra];

        $julie = new Person('Julie', 'Mustermann', Person::GENDER_FEMALE);
        $jean = new Person('Jean', 'Mustermann', Person::GENDER_MALE);
        $children = [$julie, $jean];

        $peter->setChildren($children);
        $petra->setChildren($children);

        $this->assertEquals($parents, $julie->getParents());
        $this->assertEquals($parents, $jean->getParents());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Person may not by its own child.
     */
    public function testSetInvalidParents()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);
        $max->setParents([$max]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Person may not by its own sibling.
     */
    public function testSetInvalidSiblings()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);
        $max->setSiblings([$max]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Person may not by its own parent.
     */
    public function testSetInvalidChildren()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);
        $max->setChildren([$max]);
    }

    public function testGetMother()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $peter = new Person('Peter', 'Mustermann', Person::GENDER_MALE);
        $petra = new Person('Petra', 'Mustermann', Person::GENDER_FEMALE);

        $max->setParents([$peter, $petra]);

        $this->assertEquals($petra, $max->getMother());
    }

    public function testGetGrandfathers()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $peter = new Person('Peter', 'Mustermann', Person::GENDER_MALE);
        $marta = new Person('Marta', 'Mustermann', Person::GENDER_FEMALE);
        $rudolf = new Person('Rudolf', 'Mustermann', Person::GENDER_MALE);
        $peter->setParents([$marta, $rudolf]);

        $petra = new Person('Petra', 'Mustermann', Person::GENDER_FEMALE);
        $richard = new Person('Richard', 'Mustermann', Person::GENDER_MALE);
        $elisabeth = new Person('Elisabeth', 'Mustermann', Person::GENDER_FEMALE);
        $petra->setParents([$richard, $elisabeth]);

        $max->setParents([$peter, $petra]);

        $this->assertEquals([$rudolf, $richard], $max->getGrandfathers());
    }

    public function testGetSisters()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);

        $marie = new Person('Marie', 'Mustermann', Person::GENDER_FEMALE);
        $manuel = new Person('Manuel', 'Mustermann', Person::GENDER_MALE);
        $anna = new Person('Anna', 'Mustermann', Person::GENDER_FEMALE);

        $max->setSiblings([$marie, $manuel, $anna]);

        $this->assertEquals([$marie, $anna], $max->getSisters());
    }

    public function testIsCousinOf()
    {
        $max = new Person('Max', 'Mustermann', Person::GENDER_MALE);
        $petra = new Person('Petra', 'Mustermann', Person::GENDER_FEMALE);
        $jean = new Person('Jean', 'Mustermann', Person::GENDER_MALE);
        $manuel = new Person('Manuel', 'Mustermann', Person::GENDER_MALE);
        $anna = new Person('Anna', 'Mustermann', Person::GENDER_FEMALE);

        $max->setParents([$petra]);
        $petra->setSiblings([$jean]);
        $jean->setChildren([$manuel, $anna]);

        $this->assertTrue($max->isCousinOf($manuel));
        $this->assertTrue($max->isCousinOf($anna));
    }
}
