<?php
/** @var yii\web\View $this */

use common\models\Fatura;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<h1>fatura/index</h1>

<p>

</p>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'data',
        'valorTotal',
        'estado',
        'opcaoEntrega',
        //'users_id',
        //'ivas_id',
        [
            'class' => ActionColumn::className(),
            'template' => '{view}',

            'urlCreator' => function ($action, Fatura $model) {
                if ($action === 'view') {
                    return Url::to(['fatura/view', 'id' => $model->id]);
                }
            }
        ],
    ],
]); ?>