<?php
namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\helpers\Json;


class CategoriaController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\Categoria';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function actionPostcategoria()
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

    public function actionPutcategoria($id)
    {
        $rawBody = Yii::$app->request->getRawBody();
        $decodedBody = Json::decode($rawBody);

        $categoria = $this->modelClass::findOne(['id' => $id]);

        if ($categoria) {
            $categoria->load($decodedBody, '');

            if ($categoria->save()) {
                return ['success' => true, 'message' => 'Categoria atualizado com sucesso.', 'categoria' => $categoria];
            } else {
                return ['success' => false, 'message' => 'Erro ao salvar a categoria', 'errors' => $categoria->errors];
            }
        } else {
            throw new \yii\web\NotFoundHttpException("O id não existe");
        }
    }

    public function actionDeletecategoria($id)
    {
        $model = new $this->modelClass;
        $recs = $model::deleteAll(['id' => $id]);
        if ($recs !=null)
            return ['success' => true, 'message' => $recs. ' categoria(s) eliminado(s)'];
        else
            return ['success' => false, 'message' => 'id: '.$recs. ' não existe'];
    }


}