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

class CarrinhoController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\Carrinhocompras';
    public $linha = 'common\models\Linhascarrinhocompras';
    public $fatura = 'common\models\Fatura';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }


    public function actionGetcarrinho($id)
    {
        // Obtém todos os carrinho relacionadas ao user
        $carrinhos = $this->modelClass::find()->where(['users_id' => $id])->all();

        if (!$carrinhos) {
            return ['success' => true, 'data' => 'Nenhum carrinho encontrada para o user especificado.'];
        }

        return ['success' => true, 'data' => $carrinhos];
    }
    public function actionPostcarrinho()
    {
        $rawBody = Yii::$app->request->getRawBody();
        $decodedBody = Json::decode($rawBody);
        $carrinho = new $this->modelClass;
        $carrinho->load($decodedBody, '');

        if ($carrinho->save()) {
            return ['success' => true, 'data' => $carrinho];
        } else {
            return ['success' => false, 'data' => $carrinho->errors];
        }
    }
    public function actionDeletecarrinho($id){
        $carrinho = new $this->modelClass;
        $linha = new $this->linha;
        $resLinha = $linha::deleteAll(['carrinhocompras_id' => $id]);
        $resCarrinho = $carrinho::deleteAll(['id' => $id]);
        if ($resLinha !=null && $resCarrinho !=null)
            return ['success' => true, 'message' => $resLinha. ' linha(s) eliminada(s) e '.$resCarrinho. ' carrinho eliminado'];
        else
            return ['success' => false, 'message' => 'id: '.$id. ' não existe'];
    }

    public function actionPutfinalizarcarrinho($id)
    {
        $carrinho = new $this->modelClass;
        $res = $carrinho::findOne(['id' => $id]);

        if ($res) {
            $res->estado = "finalizado";
            $res->save();
            return ['success' => true, 'message' => 'Estado atualizado com sucesso.'];
        } else {
            throw new \yii\web\NotFoundHttpException("O id não existe");
        }
    }


}