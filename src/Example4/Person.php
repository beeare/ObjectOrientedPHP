<?php
namespace beeare\OOP\Example4;

class Person
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var array
     */
    private $parents = [];

    /**
     * @var array
     */
    private $siblings = [];

    /**
     * @var array
     */
    private $children = [];

    public function __construct(string $firstName, string $lastName, string $gender)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;

        $this->ensureValidGender($gender);
        $this->gender = $gender;
    }

    private function ensureValidGender(string $gender)
    {
        if (!in_array($gender, [self::GENDER_FEMALE, self::GENDER_MALE])) {
            throw new \InvalidArgumentException('Invalid gender specified.');
        }
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender)
    {
        $this->ensureValidGender($gender);
        $this->gender = $gender;
    }

    public function getParents(): array
    {
        return $this->parents;
    }

    public function setParents(array $parents)
    {
        $this->ensureNotMoreThanTwoParents($parents);
        $this->parents = $parents;

        /** @var Person $parent */
        foreach ($parents as $parent) {
            $parent->addChild($this);
        }
    }

    private function ensureNotMoreThanTwoParents(array $parents)
    {
        if (count($parents) > 2) {
            throw new \InvalidArgumentException('More than two parents specified.');
        }
    }

    private function addChild(self $child)
    {
        if ($this === $child) {
            throw new \InvalidArgumentException('Person may not by its own child.');
        }

        if (in_array($child, $this->children)) {
            return;
        }

        $this->children[] = $child;
    }

    public function getSiblings(): array
    {
        return $this->siblings;
    }

    public function setSiblings(array $siblings)
    {
        $this->siblings = $siblings;

        /** @var Person $sibling */
        foreach ($siblings as $sibling) {
            $sibling->addSibling($this);
        }
    }

    private function addSibling(self $sibling)
    {
        if ($this === $sibling) {
            throw new \InvalidArgumentException('Person may not by its own sibling.');
        }

        if (in_array($sibling, $this->siblings)) {
            return;
        }

        $this->siblings[] = $sibling;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChildren(array $children)
    {
        $this->children = $children;

        /** @var Person $child */
        foreach ($children as $child) {
            $child->addParent($this);
        }
    }

    private function addParent(self $parent)
    {
        if ($this === $parent) {
            throw new \InvalidArgumentException('Person may not by its own parent.');
        }

        if (in_array($parent, $this->parents)) {
            return;
        }

        $parents = $this->getParents();
        array_push($parents, $parent);
        $this->setParents($parents);
    }

    public function getMother(): self
    {
        /** @var Person $parent */
        foreach ($this->parents as $parent) {
            if ($parent->getGender() == self::GENDER_FEMALE) {
                return $parent;
            }
        }

        return null;
    }

    public function getGrandfathers(): array
    {
        $grandfathers = [];

        /** @var Person $parent */
        foreach ($this->parents as $parent) {
            $grandparents = $parent->getParents();
            /** @var Person $grandparent */
            foreach ($grandparents as $grandparent) {
                if ($grandparent->getGender() == self::GENDER_MALE) {
                    $grandfathers[] = $grandparent;
                }
            }
        }

        return $grandfathers;
    }

    public function getSisters(): array
    {
        $sisters = [];

        /** @var Person $sibling */
        foreach ($this->siblings as $sibling) {
            if ($sibling->getGender() == self::GENDER_FEMALE) {
                $sisters[] = $sibling;
            }
        }

        return $sisters;
    }

    public function isCousinOf(self $cousin)
    {
        /** @var Person $parent */
        foreach ($this->parents as $parent) {
            $auntsAndUncles = $parent->getSiblings();
            /** @var Person $auntOrUncle */
            foreach ($auntsAndUncles as $auntOrUncle) {
                if (in_array($cousin, $auntOrUncle->getChildren())) {
                    return true;
                }
            }
        }

        return false;
    }
}
