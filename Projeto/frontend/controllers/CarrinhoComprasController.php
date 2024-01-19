<?php

namespace frontend\controllers;

use common\models\Carrinhocompras;
use common\models\Linhascarrinhocompras;
use common\models\Prestacoes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarrinhoComprasController implements the CRUD actions for  model.
 */
class CarrinhoComprasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Linhascarrinhocompras models.
     *
     * @return string
     */


    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $carrinho = Carrinhocompras::find()
                ->where([
                    'users_id' => Yii::$app->user->id,
                    'estado' => 'ativo'
                ])
                ->orderBy(['data' => SORT_DESC]) //
                ->one();

            if ($carrinho !== null) {
                // Encontrar todas as linhas de carrinho associadas a esse carrinho
                $linhasCarrinho = Linhascarrinhocompras::find()
                    ->where(['carrinhocompras_id' => $carrinho->id])
                    ->all();

                return $this->render('index', [
                    'linhasCarrinho' => $linhasCarrinho,
                    'model' => $carrinho,
                ]);
            } else {

                return $this->render('pagina-sem-carrinho');
            }
        } else {
            // O usuário não está logado, redirecione para a página de login ou mostre uma mensagem de erro
            return $this->redirect(['site/login']);
        }
    }

    public function actionFinalizarCarrinho($id)
    {
        $carrinho = CarrinhoCompras::findOne($id);

        if ($carrinho !== null) {
            $carrinho->estado = 'Pago';
            $carrinho->save();

            // Redirecionar para alguma página após finalizar o carrinho
            return $this->redirect(['carrinho-compras/index']);
        }

        // Redirecionar para alguma página caso o carrinho não seja encontrado
        return $this->redirect(Yii::$app->request->referrer);
    }





    /**
     * Displays a single Linhascarrinhocompras model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Linhascarrinhocompras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Carrinhocompras();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Linhascarrinhocompras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Linhascarrinhocompras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Linhascarrinhocompras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Carrinhocompras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carrinhocompras::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
