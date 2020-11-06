<?php

$appComponentsFactory->buildGlobalResponse(
    'GlobalResponse',
    0,
    $appComponentsFactory->buildStandardUITemplate(
        'StandardUITemplate',
        'Components',
        0,
        $appComponentsFactory->buildOutputComponent(
            'OutputComponent',
            'Components',
            '',
            0
        )
    ),
    $appComponentsFactory->buildOutputComponent(
        'Doctype',
        'Components',
        '<!DOCTYPE html>',
        0
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningHtmlTag',
        'Components',
        '<html lang="en">',
        0.1
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningHeadTag',
        'Components',
        '<head>',
        0.2
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Title',
        'Components',
        0.3,
        'helloUniverse',
        'Title.php'
    ),
    $appComponentsFactory->buildDynamicOutputComponent(
        'Meta',
        'Components',
        0.4,
        'helloUniverse',
        'Meta.php'
    ),
    $appComponentsFactory->buildOutputComponent(
        'Styles',
        'Components',
        '<link rel="stylesheet" href="' . $appComponentsFactory->getAppDomain()->getUrl() . '/Apps/helloWorld/css/styles.css">',
        0.5
    ),
    $appComponentsFactory->buildOutputComponent(
        'ClosingHeadTag',
        'Components',
        '</head>',
        0.6
    ),
    $appComponentsFactory->buildOutputComponent(
        'OpeningBodyTag',
        'Components',
        '<body style="background: #000000;">',
        0.7
    ),
);

