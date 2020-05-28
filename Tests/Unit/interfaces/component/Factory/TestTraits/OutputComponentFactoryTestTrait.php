<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;

use DarlingCms\interfaces\component\Factory\OutputComponentFactory;

trait OutputComponentFactoryTestTrait
{

    private $outputComponentFactory;

    protected function setOutputComponentFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getOutputComponentFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getOutputComponentFactory(): OutputComponentFactory
    {
        return $this->outputComponentFactory;
    }

    protected function setOutputComponentFactory(OutputComponentFactory $outputComponentFactory): void
    {
        $this->outputComponentFactory = $outputComponentFactory;
    }

    protected function getMockStoredComponentRegistry(): StoredComponentRegistry
    {
        $mockStoredComponentRegistry = new CoreStoredComponentRegistry(
            $this->getMockPrimaryFactory()->buildStorable('t','t'),
            $this->getMockCrud()
        );
        $mockStoredComponentRegistry->import(['acceptedImplementation' => 'DarlingCms\interfaces\component\OutputComponent']);
        return $mockStoredComponentRegistry;
    }

    public function testBuildOutputComponentReturnsAnOutputComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\OutputComponent',
                $this->getOutputComponentFactory()->buildOutputComponent(
                    'AssignedName',
                    'AssignedContainer',
                    'Assigned Output', 420.87
                )
            )
        );
    }

/*
    public function testDev(): void
    {
        $this->getOutputComponentFactory()->buildOutputComponent('AssignedName', 'AssignedContainer', 'Assigned Output', 420.87);
    }
 */

}