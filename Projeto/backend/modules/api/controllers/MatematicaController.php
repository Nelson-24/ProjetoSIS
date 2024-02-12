<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\helpers\Json;
class MatematicaController extends ActiveController
{

    public $modelClass = 'common\models\Categoria';



    public function actionraizdois(){

      $resultado = ['raizdois' => 1.41];
        return $resultado;
    }

}