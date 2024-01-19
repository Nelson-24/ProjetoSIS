<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\helpers\Json;
use yii\web\User;
use common\models\Artigos;
use common\models\Carrinhocompras;
use common\models\Linhascarrinhocompras;
class LinhaController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\Linhascarrinhocompras';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }


//Linhas de carrinho
    public function actionGetlinhasporcarrinho($id)
    {
        // Obtém todas as linhas de carrinho relacionadas ao carrinho
        $linhas = $this->modelClass::find()->where(['carrinhocompras_id' => $id])->all();

        if ($linhas) {
            return $linhas;
        }
        else{
            return null;
        }
    }
    public function actionPostlinha()
    {
        $rawBody = Yii::$app->request->getRawBody();
        $decodedBody = Json::decode($rawBody);

        $linha = new $this->modelClass;
        $linha->quantidade = $decodedBody['quantidade'];
        $linha->artigos_id = $decodedBody['artigo_id'];
        $linha->carrinhocompras_id = $decodedBody['carrinho_id'];

        if ($linha->save()) {
            return ['success' => true, 'data' => $linha];
        } else {
            return ['success' => false, 'data' => $linha->errors];
        }
    }

    public function actionDeletelinha($id){
        $linha = new $this->modelClass;
        $resLinha = $linha::deleteAll(['id' => $id]);
        if ($resLinha !=null)
            return ['success' => true, 'message' => $resLinha. ' linha eliminada'];
        else
            return ['success' => false, 'message' => 'id: '.$id. ' não existe'];
    }

    public function putQuantidadeporlinha($id){
        $rawBody = Yii::$app->request->getRawBody();
        $decodedBody = Json::decode($rawBody);
        $nova_quantidade = $decodedBody['quantidade'];
        $linha = new $this->modelClass;
        $res = $linha::findOne(['id' => $id]);

        if ($res) {
            $res->quantiade = $nova_quantidade;
            $res->save();
            return ['success' => true, 'message' => 'Quantidade atualizada com sucesso.'];
        } else {
            throw new \yii\web\NotFoundHttpException("O id não existe");
        }
    }

}