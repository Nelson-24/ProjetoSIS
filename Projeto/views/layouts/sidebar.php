<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../" class="brand-link">
        <span class="brand-text font-weight-light">Crm Materiais</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?></a>
                <?php endif; ?>
            </div>
        </div>


        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [



                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],


                    ['label' => 'Faturação', 'header' => true],
                    ['label' => 'Fatura', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info',
                        'url' => ['faturas/index'],
                    ],

                    ['label' => 'Faturas Fornecedores', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info',
                        'url' => ['faturas-fornecedor/index'],
                    ],



                    ['label' => 'Listas de pessoas', 'header' => true],
                    [
                        'label' => 'Clientes',
                        'url' => ['user/index'],

                        'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'
                    ],
                    ['label' => 'Funcionarios', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger',
                        'url' => ['funcionarios/index'],
                    ],
                    ['label' => 'Fornecedores', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger',
                        'url' => ['fornecedores/index'],
                    ],


                    ['label' => 'Artigos', 'header' => true],




                    ['label' => 'Artigos', 'iconClass' => 'nav-icon far fa-circle text-warning',
                        'url' => ['artigos/index'],
                    ],
                    ['label' => 'Categorias', 'iconStyle' => 'nav-icon far fa-circle text-warning',
                        'url' => ['categoria/index'],
                    ],
                    ['label' => 'Ivas', 'iconStyle' => 'nav-icon far fa-circle text-warning',
                        'url' => ['iva/index'],
                    ],


                    ['label' => 'Entregas', 'header' => true],


                    ['label' => 'Entregas', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info',
                        'url' => ['entregas/index'],
                    ],



                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>