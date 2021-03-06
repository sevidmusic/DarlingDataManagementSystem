<?php

namespace UnitTests\abstractions\utility;

use DarlingDataManagementSystem\interfaces\utility\ReflectionUtility as ReflectionUtilityInterface;
use PHPUnit\Framework\TestCase;
use UnitTests\interfaces\utility\TestTraits\ReflectionUtilityTestTrait;

class ReflectionUtilityTest extends TestCase implements ReflectionUtilityInterface
{
    use ReflectionUtilityTestTrait;

    public function setUp(): void
    {
        $this->setReflectionUtility(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\utility\ReflectionUtility'
            )
        );
    }

}

