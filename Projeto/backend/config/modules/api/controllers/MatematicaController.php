<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class MatematicaController extends ActiveController
{
    public $modelClass = 'common\models\Artigos';

    public function actionRaizdois()
    {
        $raizdois=1.41;
        return "['raizdois'=>".$raizdois."]";
    }

}
