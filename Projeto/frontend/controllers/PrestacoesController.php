<?php

namespace frontend\controllers;

use common\models\Carrinhocompras;
use common\models\Prestacoes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PrestacoesController implements the CRUD actions for Prestacoes model.
 */
class PrestacoesController extends Controller
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
     * Lists all Prestacoes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Prestacoes::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prestacoes model.
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
     * Creates a new Prestacoes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {

        $carrinho = Carrinhocompras::findOne($id);


        $date1 = date('y-m-d', strtotime('+30 days'));
        $date2 = date('y-m-d', strtotime('+60 days'));
        $date3 = date('y-m-d', strtotime('+90 days'));


        $carrinho->estado = 'Pago 3 Prestações';
        $carrinho->save();


        $prestacao = new Prestacoes();
        $prestacao->data = $date1;
        $prestacao->valor = $carrinho->valorTotal/3;
        $prestacao->user_id = Yii::$app->user->id;
        $prestacao->save();

        $prestacao2 = new Prestacoes();
        $prestacao2->data = $date2;
        $prestacao2->valor = $carrinho->valorTotal/3;
        $prestacao2->user_id = Yii::$app->user->id;
        $prestacao2->save();

        $prestacao3 = new Prestacoes();
        $prestacao3->data = $date3;
        $prestacao3->valor = $carrinho->valorTotal/3;
        $prestacao3->user_id = Yii::$app->user->id;
        $prestacao3->save();




        return $this->redirect(['carrinho-compras/index']);


    }



    /**
     * Updates an existing Prestacoes model.
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
     * Deletes an existing Prestacoes model.
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
     * Finds the Prestacoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Prestacoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prestacoes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
