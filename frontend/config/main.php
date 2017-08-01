<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
    'authClientCollection'=>[
    'class'=> 'yii\authclient\Collection',
    'clients'=>[
    'twitter'=>[
    'class'=>'yii\authclient\clients\Twitter',
    'consumerKey'=>'3SlNcJQW8EYbaLMVk7C4HKXXP',
    'consumerSecret'=>'eVvJIAeMZ78AgszvHlIq4oA6rgyXamYxOIEHUcONmJwQKBJAtG',
    ],
     'facebook'=>[
    'class'=>'yii\authclient\clients\Facebook',
    'clientId'=>'127150461174800',
    'clientSecret'=>'e4830b23dfd7a7e35e7abcf395527168',
    ],


'google'=>[
    'class'=>'yii\authclient\clients\Google',
    'clientId'=>'1086186388100-fbktj3sv5icj1ltpvlmoam4rh1vmudqj.apps.googleusercontent.com',
    'clientSecret'=>'sqMBZCWrbKhANBv567A5ZBc4',
     //'returnUrl'=>'http://localhost/oauth/advanced/frontend/web/index.php?r=site%2Fauth&authclient=google'
    ],

'github'=>[
    'class'=>'yii\authclient\clients\Github',
    'clientId'=>'1591aef329f2e409c0b9',
    'clientSecret'=>'0decb56cb5e0cb1e9ca7089fd1b7bbf7908723f0',
    ],


    ],],



        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
        'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
    'params' => $params,
];
