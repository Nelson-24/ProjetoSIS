<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Faturasfornecedores $model */
/** @var backend\models\Linhasfaturasfornecedores $linhafatura */
/** @var common\models\User $cliente */
/** @var common\models\Profile $profile */
/** @var yii\data\ActiveDataProvider $dataProvider */


?>
<div class="faturas-form">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Crm Materiais, Lda.
                                    <small class="float-right"><?php  echo '<strong>Data/Hora:</strong> ' . $model->data . '<br>'; ?></small>


                                </h4>
                            </div>

                        </div>

                        <div class="row invoice-info">


                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <?php


                                    echo '<strong>Nome:</strong> ' . $model->fornecedores->designacaoSocial . '<br>';
                                    echo '<strong>Morada:</strong> ' . $model->fornecedores->morada . '<br>';
                                    echo '<strong>NIF:</strong> ' . $model->fornecedores->nif . '<br>';
                                    echo '<strong>Email:</strong> ' . $model->fornecedores->email . '<br>';



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

                                            ],
                                        ]); ?>
                                    </tr>




                                    <tbody>

                                    <tr>



                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-6">

                            </div>

                            <div class="col-6">
                                <table class="table">
                                    <tr>
                                        <th <?php  echo '<strong>Sub Total:</strong> ' . $model->valor;?>

                                    </tr>
                                    <tr>
                                        <th <?php  echo '<strong>Iva:</strong> ' . $model->valorIva;?>
                                    </tr>
                                    <tr>
                                        <th <?php  echo '<strong>Total:</strong> ' . $model->valorTotal;?>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>


                        <div class="row no-print">
                            <div class="col-12">






                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
