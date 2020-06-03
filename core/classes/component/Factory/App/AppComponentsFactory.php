<?php

namespace DarlingCms\classes\component\Factory\App;

use DarlingCms\abstractions\component\Factory\App\AppComponentsFactory as CoreAppComponentsFactory;
use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;

class AppComponentsFactory extends CoreAppComponentsFactory implements AppComponentsFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the AppComponentsFactoryBase class
     * fulfills the requirements of the AppComponentsFactoryInterface.
     */
}