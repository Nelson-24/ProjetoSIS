<?php

namespace frontend\controllers;

use common\models\Fatura;
use Yii;
use yii\data\ActiveDataProvider;

class FaturaController extends \yii\web\Controller
{





    public function actionIndex()
    {
        $userId = Yii::$app->user->id;

        $dataProvider = new ActiveDataProvider([
            'query' => Fatura::find()->where(['users_id' => $userId]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}