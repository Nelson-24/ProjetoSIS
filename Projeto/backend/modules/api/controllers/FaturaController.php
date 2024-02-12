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

class FaturaController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\Fatura';
    public $carrinho = 'common\models\Carrinhocompras';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }
    public function actionPostfaturaporcarrinho($id){
        $carrinho = $this->carrinho::findOne(['id' => $id]);

        if ($carrinho) {
            $fatura = new $this->modelClass;
            $fatura->data = $carrinho->data;
            $fatura->valorTotal = $carrinho->valorTotal;
            $fatura->users_id = $carrinho->users_id;
            $fatura->valor = $carrinho->valor;
            $fatura->valorIva = $carrinho->valorIva;
            $fatura->opcaoEntrega = "0";
            $fatura->estado="Emitido";
            $fatura->save();

            if ($fatura->save()) {
                return ['success' => true, 'message' => 'Fatura emitida com sucesso'];
            } else {
                return ['success' => false, 'message' => 'Erro ao salvar a fatura', 'errors' => $fatura->errors];
            }
        } else {
            throw new \yii\web\NotFoundHttpException("O id de carrinho não existe");
        }
    }
    public function actionPutanularfatura($id){
        $fatura = new $this->modelClass;
        $res = $fatura::findOne(['id' => $id]);

        if ($res) {
            $res->estado = "Anulado";
            $res->save();
            return ['success' => true, 'message' => 'Fatura anulada atualizada com sucesso.'];
        } else {
            throw new \yii\web\NotFoundHttpException("O id da fatura não existe");
        }
    }

    public function actionGetfaturas(){
        $faturas = new $this->modelClass;
        $res = $faturas::find()->all();
        return $res;
    }
}