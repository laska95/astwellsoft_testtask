<?php

/*
 * Return url rules to this module
 */

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'v1/shop',
        'prefix' => 'api',
        'extraPatterns' => [
            'POST search' => 'search',
        ],
    ],
];
