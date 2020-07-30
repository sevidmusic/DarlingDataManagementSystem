<?php

namespace UnitTests\interfaces\component\Factory\App\TestTraits;

use DarlingCms\classes\component\Web\App;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory;
use DarlingCms\interfaces\component\Factory\OutputComponentFactory;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Factory\RequestFactory;
use DarlingCms\interfaces\component\Factory\ResponseFactory;
use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingCms\interfaces\component\Factory\StoredComponentFactory;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\Web\Routing\Request;

trait AppComponentsFactoryTestTrait
{

    private $appComponentsFactory;
    private $testDomain;

    public function testAppComponentsFactoryImplementsOutputComponentFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                OutputComponentFactory::class
            )
        );
    }

    public function appComponentsFactoryImplementsExpectedInterface(
        string $expectedInterface
    ): bool
    {
        return $this->isProperImplementation(
            $expectedInterface,
            $this->getAppComponentsFactory()
        );
    }

    protected function getAppComponentsFactory(): AppComponentsFactory
    {
        return $this->appComponentsFactory;
    }

    protected function setAppComponentsFactory(AppComponentsFactory $appComponentsFactory): void
    {
        $this->appComponentsFactory = $appComponentsFactory;
    }

    public function testAppComponentsFactoryImplementsResponseFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                ResponseFactory::class
            )
        );
    }

    public function testAppComponentsFactoryImplementsStoredComponentFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                StoredComponentFactory::class
            )
        );
    }

    public function testAppComponentsFactoryImplementsStandardUITemplateFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                StandardUITemplateFactory::class
            )
        );
    }

    public function testAppComponentsFactoryImplementsRequestFactoryInterface(): void
    {
        $this->assertTrue(
            $this->appComponentsFactoryImplementsExpectedInterface(
                RequestFactory::class
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayWithExactlyThreeValues(): void
    {
        $this->assertEquals(
            3,
            count(
                $this->appComponentsFactory::buildConstructorArgs(
                    $this->getTestDomain()
                )
            )
        );
    }

    private function getTestDomain(): Request
    {
        if (!isset($this->testDomain) === true) {
            $this->testDomain = new CoreRequest(
                $this->getAppComponentsFactory()->getPrimaryFactory()->buildStorable(
                    'TestDomain',
                    'TestRequests'
                ),
                $this->getAppComponentsFactory()->getPrimaryFactory()->buildSwitchable()
            );
        }
        return $this->testDomain;
    }

    public function testBuildConstructorArgsReturnsAnArrayOfObjects(): void
    {
        foreach (
            $this->appComponentsFactory::buildConstructorArgs(
                $this->getTestDomain()
            )
            as $value
        ) {
            $this->assertTrue(is_object($value));
        }
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAPrimaryFactoryImplementationInstanceAtIndex0(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                PrimaryFactory::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[0]
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAComponentCrudImplementationInstanceAtIndex1(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                ComponentCrud::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[1]
            )
        );
    }

    public function testBuildConstructorArgsReturnsAnArrayAssignedAStoredComponentRegistryImplementationInstanceAtIndex2(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                StoredComponentRegistry::class,
                $this->getAppComponentsFactory()::buildConstructorArgs(
                    $this->getTestDomain()
                )[2]
            )
        );
    }

    public function testBuildDomainReturnsRequestWhoseNameMatchesExpectedAppNameLocation(): void
    {
        $this->assertEquals(
            App::deriveNameLocationFromRequest($this->getTestDomain()),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getName()
        );
    }

    public function testBuildDomainReturnsRequestWhoseLocationMatchesExpectedAppNameLocation(): void
    {
        $this->assertEquals(
            App::deriveNameLocationFromRequest($this->getTestDomain()),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getLocation()
        );
    }

    public function testBuildDomainReturnsRequestWhoseContainerMatchesExpectedAppNameLocation(): void
    {
        $this->assertEquals(
            App::deriveNameLocationFromRequest($this->getTestDomain()),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getContainer()
        );
    }

    public function testBuildDomainReturnsRequestWhoseUrlMatchesSuppliedUrl(): void
    {
        $this->assertEquals(
            $this->getTestDomain()->getUrl(),
            $this->getAppComponentsFactory()::buildDomain(
                $this->getTestDomain()->getUrl(),
            )->getUrl()
        );
    }

    public function testAppAssignedToPrimaryFactoryIsStoredAndRegisteredOnInstantiation(): void
    {
        $this->wasStoredAndRegistered(
            $this->getAppComponentsFactory()->getPrimaryFactory()->export()['app']
        );
    }

    private function wasStoredAndRegistered(Component $component): void
    {
        $this->assertEquals(
            $component,
            $this->getAppComponentsFactory()->getComponentCrud()->read(
                $component
            )
        );
    }

    public function testGetStoredComponentRegistryReturnsAStoredComponentRegistryWhoseAcceptedImplementationIsTheComponentInterface(): void
    {
        $this->assertEquals(
            Component::class,
            $this->getAppComponentsFactory()->getStoredComponentRegistry()->export()['acceptedImplementation']
        );
    }

    public function testBuildLogReturnsExpectedString(): void
    {
        $this->assertEquals(
            $this->expectedBuildLog(),
            $this->getAppComponentsFactory()->buildLog()
        );
    }

    private function expectedBuildLog(): string
    {
        $buildLog = "";
        foreach (
            $this->getAppComponentsFactory()->getStoredComponentRegistry()->getRegisteredComponents()
            as
            $storable
        ) {
            $message = sprintf(
                '%sBuilt %s:%s    Name: %s%s    Container: %s%s    Location: %s%s    Type: %s%s    UniqueId: %s%s',
                PHP_EOL,
                $storable->getType(),
                PHP_EOL,
                "\033[42m" . $storable->getName() . "\033[0m",
                PHP_EOL,
                "\033[1;32m" . $storable->getContainer() . "\033[0m",
                PHP_EOL,
                "\033[44m" . $storable->getLocation() . "\033[0m",
                PHP_EOL,
                "\033[1;34m" . $storable->getType() . "\033[0m",
                PHP_EOL,
                "\033[46m" . $storable->getUniqueId() . "\033[0m",
                PHP_EOL
            );
            $buildLog .= $message;
        }
        return $buildLog;
    }

    public function testBuildLogEchosBuildLogIfSHOW_LOGFlagIsSupplied(): void
    {
        $this->getAppComponentsFactory()->buildLog($this->getAppComponentsFactory()::SHOW_LOG);
        $this->expectOutputString($this->expectedBuildLog());
    }

    public function testBuildLogSavesBuildLogToExpectedLocationAndProducesExpectedOutputIfSAVE_LOGFlagIsSupplied(): void
    {
        $this->getAppComponentsFactory()->buildLog(
            $this->getAppComponentsFactory()::SAVE_LOG
        );
        $this->expectOutputString($this->expectedSAVE_LOGOutput());
        $this->assertTrue(file_exists($this->expectedBuildLogPath()));
    }

    private function expectedSAVE_LOGOutput(): string
    {
        return sprintf(
            '%sSaved build log to: %s',
            PHP_EOL,
            "\033[1;34m" . $this->expectedBuildLogPath() . "\033[0m" . PHP_EOL
        );
    }

    private function expectedBuildLogPath(): string
    {
        return str_replace(
            'Tests/Unit/interfaces/component/Factory/App/TestTraits',
            'Apps' .
            DIRECTORY_SEPARATOR .
            '.buildLogs' .
            DIRECTORY_SEPARATOR .
            $this->getAppComponentsFactory()->getPrimaryFactory()->export()['app']->getName(),
            __DIR__
        );

    }

    public function getOutputComponentFactory(): OutputComponentFactory
    {
        return $this->getAppComponentsFactory();
    }

    public function getStandardUITemplateFactory(): StandardUITemplateFactory
    {
        return $this->getAppComponentsFactory();
    }

    public function getRequestFactory(): RequestFactory
    {
        return $this->getAppComponentsFactory();
    }

    public function getResponseFactory(): RequestFactory
    {
        return $this->getAppComponentsFactory();
    }

    protected function setAppComponentsFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getAppComponentsFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

}
