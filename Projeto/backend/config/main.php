<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'loginUrl' => ['site/login'],
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'as authenticator' => [
                'class' => 'backend\modules\api\components\CustomAuth',
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule','controller' => [
                    'api/user',
                    'api/register',
                    'api/artigo',
                    'api/iva',
                    'api/categoria',
                    'api/carrinho',
                    'api/linha',
                    'api/fatura',
                    'api/matematica',
                ],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //matematica
                        'GET raizdois' =>'raizdois',

                        //user
                        'GET login' => 'login',

                        //register
                        'POST signup' => 'register',

                        //artigos
                        'GET descricoes' => 'getdescricoes',
                        'GET preco/{referencia}' => 'getprecoporreferencia',
                        'PUT editarartigo/{id}' => 'putartigo',
                        'POST adicionarartigo' => 'postartigo',
                        'DELETE eliminarartigo/{id}' => 'deleteartigo',

                        //categoria
                        'POST adicionarcategoria' => 'postcategoria',
                        'PUT editarcategoria/{id}'=>'putcategoria',
                        'DELETE eliminarcategoria/{id}'=>'deletecategoria',

                        //iva
                        'POST adicionariva' => 'postiva',
                        'PUT editariva/{id}'=> 'putiva',
                        'DELETE eliminariva/{id}'=>'deleteiva',

                        //carrinho
                        'GET carrinho/{id}'=>'getcarrinho', 
                        'GET ativo/{id}'=>'getativo',
                        'GET finalizado/{id}'=>'getfinalizado',
                        'POST adicionarcarrinho/{id}' =>'postcarrinho',
                        'DELETE eliminarcarrinho/{id}' =>'deletecarrinho',
                        'PUT finalizar/{id}' =>'putfinalizarcarrinho',

                        //linhas carrinho
                        'GET linhas/{id}'=>'getlinhasporcarrinho',
                        'POST adicionarlinha' =>'postlinha',
                        'DELETE eliminarlinha/{id}'=>'deletelinha',
                        'PUT linha/{id}'=>'putquantidadeporlinha',

                        //fatura
                        'POST adicionarfatura/{id}' => 'postfaturaporcarrinho',
                        'PUT anularfatura/{id}' => 'putanularfatura',
                        'GET faturas/{id}' => 'getfaturas',

                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{referencia}' => '<referencia:\\w+>', //[a-zA-Z0-9_] 1 ou + vezes (char)
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
