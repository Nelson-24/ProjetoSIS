<?php
namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\helpers\Json;


class IvaController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\Ivas';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }



    public function actionPostiva()
    {
        $rawBody = Yii::$app->request->getRawBody();
        $decodedBody = Json::decode($rawBody);
        $model = new $this->modelClass;
        $model->load($decodedBody, '');

        if ($model->save()) {
            return ['success' => true, 'data' => $model];
        } else {
            return ['success' => false, 'data' => $model->errors];
        }
    }

    public function actionPutiva($id)
    {
        $rawBody = Yii::$app->request->getRawBody();
        $decodedBody = Json::decode($rawBody);

        $iva = $this->modelClass::findOne(['id' => $id]);

        if ($iva) {
            $iva->load($decodedBody, '');

            if ($iva->save()) {
                return ['success' => true, 'message' => 'Iva atualizado com sucesso.', 'Iva' => $iva];
            } else {
                return ['success' => false, 'message' => 'Erro ao salvar o iva', 'errors' => $iva->errors];
            }
        } else {
            throw new \yii\web\NotFoundHttpException("O id não existe");
        }
    }

    public function actionDeleteiva($id)
    {
        $model = new $this->modelClass;
        $recs = $model::deleteAll(['id' => $id]);
        if ($recs !=null)
            return ['success' => true, 'message' => $recs. ' Iva eliminado'];
        else
            return ['success' => false, 'message' => 'id: '.$recs. ' não existe'];
    }

}