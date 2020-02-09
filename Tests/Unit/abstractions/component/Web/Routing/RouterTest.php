<?php

namespace UnitTests\abstractions\component\Web\Routing;

use DarlingCms\classes\component\Crud\ComponentCrud as Crud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Web\Routing\TestTraits\RouterTestTrait;

class RouterTest extends SwitchableComponentTest
{
    use RouterTestTrait;

    public function setUp(): void
    {
        $request = new Request(
            new Storable(
                'MockRequest',
                'MockRequestedLocation',
                'MockRequestContainer'
            ),
            new Switchable()
        );
        $crud = new Crud(
            new Storable(
                'MockCrudName',
                'MockCrudLocation',
                'MockCrudContainer'
            ),
            new Switchable(),
            new StorageDriver(
                new Storable(
                    'MockStorageDriverName',
                    'MockStorageDriverLocation',
                    'MockStorageDriverContainer'
                ),
                new Switchable()
            )
        );

        $this->setRouter(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Web\Routing\Router',
                [
                    new Storable(
                        'MockRouterName',
                        'MockRouterLocation',
                        'MockRouterContainer'
                    ),
                    new Switchable(),
                    $request,
                    $crud
                ]
            )
        );
        $this->setRouterParentTestInstances();
    }

}