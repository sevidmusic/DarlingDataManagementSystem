<?php

ini_set('display_errors', true);
require_once __DIR__ . DIRECTORY_SEPARATOR . '/Apps/WorkingDemo/Settings.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard;
use DarlingCms\classes\component\UserInterface\StandardUI;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;

$crud = new ComponentCrud(
    new Storable(
        DEMO_SITE_NAME . "IndexCrud",
        DEMO_SITE_NAME,
        DEMO_SITE_CRUD_CONTAINER
    ),
    new Switchable(),
    new Standard(
        new Storable(
            DEMO_SITE_NAME . "StandardStorageDriver",
            DEMO_SITE_NAME,
            DEMO_SITE_STORAGE_DRIVER_CONTAINER
        ),
        new Switchable()
    )
);

$currentRequest = new Request(
    new Storable(
        DEMO_SITE_NAME . 'CurrentRequest',
        DEMO_SITE_NAME,
        DEMO_SITE_REQUEST_CONTAINER
    ),
    new Switchable()
);

$router = new Router(
    new Storable(
        DEMO_SITE_NAME . 'Router',
        DEMO_SITE_NAME,
        DEMO_SITE_ROUTER_CONTAINER
    ),
    new Switchable(),
    $currentRequest,
    $crud
);

$userInterface = new StandardUI(
    new Storable(
        DEMO_SITE_NAME . 'IndexUserInterface',
        DEMO_SITE_NAME,
        DEMO_SITE_OUTPUT_COMPONENT_CONTAINER
    ),
    new Switchable(),
    new Positionable(),
    $router,
    DEMO_SITE_NAME,
    DEMO_SITE_RESPONSE_CONTAINER
);

echo $userInterface->getOutput();