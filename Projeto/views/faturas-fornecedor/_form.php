<?php

use backend\models\Fatura;
use backend\models\Linhafatura;
use common\models\User;
use hail812\adminlte3\yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var backend\models\Faturasfornecedores $model */
/** @var backend\models\LinhaFatura $linhafatura */
/** @var common\models\User $cliente */
/** @var common\models\Profile $profile */
/** @var yii\data\ActiveDataProvider $dataProvider */





?>



<div class="faturas-form">

    <?php $form = ActiveForm::begin();
    ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="invoice p-3 mb-3">

                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Crm Materiais, Lda.
                                        <small class="float-right">Data: <?= date('d/m/Y') ?></small>
                                        <?= $form->field($model, 'data')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>

                                    </h4>
                                </div>

                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                </div>

                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        <?php
                                        if ($model->fornecedores !== null ) {

                                            echo '<strong>Nome:</strong> ' . $model->fornecedores->designacaoSocial. '<br>';
                                            echo '<strong>Morada:</strong> ' . $model->fornecedores->morada . '<br>';
                                            echo '<strong>Email:</strong> ' . $model->fornecedores->email . '<br>';
                                            echo '<strong>Capital Social:</strong> ' . $model->fornecedores->capitalSocial . '<br>';

                                        } else {
                                            echo 'Perfil do utilizador não encontrado.';
                                        }
                                        ?>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <?php
                                        echo '<strong>Nr Fatura:</strong> ' . $model->id . '<br>';
                                        echo '<strong>Estado:</strong> ' . $model->estado . '<br>';

                                        ?>
                                    </address>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>


                                        <tr>
                                            <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    'referencia',

                                                    [
                                                        'attribute' => 'decricao',
                                                        'label' => 'Descrição',
                                                        'value' => 'artigos.descricao',
                                                    ],
                                                    'quantidade',
                                                    'valor',


                                                    [
                                                        'class' => ActionColumn::className(),
                                                        'template' => ' {update} {delete}',
                                                        'urlCreator' => function ($action, $model, $key, $index) {
                                                            $url = '';
                                                            switch ($action) {

                                                                case 'update':
                                                                    $url = ['linha-fatura-fornecedores/update', 'id' => $model->id];
                                                                    break;
                                                                case 'delete':
                                                                    $url = ['linha-fatura-fornecedores/delete', 'id' => $model->id];
                                                                    break;

                                                            }
                                                            return $url;
                                                        },
                                                    ],
                                                ],
                                            ]); ?>
                                        </tr>




                                        <tbody>

                                        <tr>

                                            <?= Html::a('Selecionar Artigo', ['linha-fatura-fornecedores/selecionar-artigos'], ['class' => 'btn btn-primary']) ?>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-6">

                                </div>

                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th <?php  echo '<strong>Sub Total:</strong> ' . $model->valor;?>
                                                </th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th><?php  echo '<strong>Iva:</strong> ' . $model->valorIva;?></th>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <th><?php  echo '<strong>Total:</strong> ' . $model->valorTotal;?></th>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>


                            <div class="row no-print">
                                <div class="col-12">
                                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>



                                    <?php ActiveForm::end(); ?>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

</div>
