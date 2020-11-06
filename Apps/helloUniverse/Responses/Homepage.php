<?php

$appComponentsFactory->buildResponse(
    'Homepage',
    0,
    $appComponentsFactory->buildRequest(
        'HomepageRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildRequest(
        'HomepageRequest',
        'Requests',
        $appComponentsFactory->getApp()->getAppDomain()->getUrl() . '/index.php', // @todo possibly create new issue: Response should match getUrl() and getUrl() . '/', i.e. with or without trailing slash, or getUrl() should include trailing slash, either way this is annoying because getUrl() and getUrl() . '/' are different...
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Welcome',
        'Components',
        0,
        'helloUniverse',
        'Welcome.php'
    ),
);

