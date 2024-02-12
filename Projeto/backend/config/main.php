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
                    'api/artigo',
                    'api/iva',
                    'api/categoria',
                    'api/carrinho',
                    'api/matematica',
                ],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //user
                        'GET login' => 'login',
                        'PUT dados'=>'puteditardados',




                        //artigos
                        'GET descricoes' => 'getdescricoes',
                        'GET preco/{referencia}' => 'getprecoporreferencia',
                        'DELETE referencia/{referencia}' => 'deleteporreferencia',
                        'PUT referencia/{referencia}' => 'putprecoporreferencia',
                        'POST adicionarartigo' => 'postartigo',
                        'PUT editarartigo/{id}' => 'putartigo',

                        //categoria
                        'POST adicionarcategoria' => 'postcategoria',
                        'PUT editarcategoria/{id}'=>'putdescricaoporid',
                        'DELETE eliminarcategoria/{id}'=>'deletecategoria',

                        //iva
                        'POST adicionariva' => 'postiva',
                        'PUT editariva/{id}'=> 'putpercentagemporid',
                        'DELETE eliminariva/{id}'=>'deleteiva',

                        //carrinho
                        'GET carrinho/{id}'=>'getcarrinhoporid',
                        'POST adicionarcarrinho' =>'postcarrinho',
                        'DELETE eliminarcarrinho/{id}' =>'deletecarrinho',
                        'PUT finalizar/{id}' =>'putfinalizarcarrinho',

                        //linhas carrinho
                        'GET linhas/{id}'=>'getlinhasporcarrinho',
                        'POST adicionarlinha' =>'postlinha',
                        'DELETE eliminarlinha/{id}'=>'deletelinha',
                        'PUT linha/{id}'=>'putquantidadeporlinha',

                        //fatura
                        'POST fatura/{id}' => 'postfaturaporcarrinho',
                        'PUT anularfatura/{id}' => 'putanularfatura',



                        'GET raizdois' =>'raizdois',
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
