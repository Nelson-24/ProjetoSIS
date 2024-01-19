<?php

namespace backend\controllers;

use app\models\SearchCliente;
use backend\models\Entregas;
use common\models\Fatura;
use backend\models\LinhaFatura;
use common\models\Artigos;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

/**
 * FaturasController implements the CRUD actions for Fatura model.
 */
class FaturasController extends Controller
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
     * Lists all Fatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('verFaturas')) {

        $dataProvider = new ActiveDataProvider([
            'query' => Fatura::find(),

//            'pagination' => [
//                'pageSize' => 50
//            ],
            'sort' => [
                'defaultOrder' => [
                    'estado' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Displays a single Fatura model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionSelecionarClientes(){


        $searchModel = new SearchCliente();

        $provider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('selecionar_clientes', [
            'dataProvider' => $provider,
            'searchModel' =>$searchModel,


        ]);
    }








    public function actionView($id)
    {
        $model = Fatura::findOne($id);
        $dataProvider = new ActiveDataProvider([
            'query' => LinhaFatura::find()->where(['faturas_id' => $id]),
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Fatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($users_id)
    {
        if (Yii::$app->user->can('criarFaturas')) {

        $model = new Fatura([
            'users_id' => $users_id,
            'valorTotal' => 0,
            'estado' => 'Em lançamento',
            'data' =>date('Y-m-d-H-i-s')
        ]);




        if ($model->save()) {
            return $this->render('create', [
                'model' => $model,

            ]);
        } else {
            $model->loadDefaultValues();
        }
        } else {

            $this->redirect(['site/error']);
        }
    }

   /* public function actionCreate($users_id)
    {
        $model = new Fatura();
        $linhafatura = new LinhaFatura();
        $model->users_id = $users_id;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', [
            'model' => $model,
            'linhafatura' => $linhafatura,
        ]);
    }*/

    /**
     * Updates an existing Fatura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('editarfaturas')) {

        $model = Fatura::findOne($id);

        $dataProvider = new ActiveDataProvider([
            'query' => LinhaFatura::find()->where(['faturas_id' => $id]),
        ]);

        $model->valor = $model->calculateTotalValue();
        $model->valorIva = $model ->calculateTotalIvaValue();
        $model->valorTotal = $model ->calculateTotalValueWithIva();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->estado = 'Não regularizado';


            if ($model->opcaoEntrega == 1) {
                $entrega = new Entregas();
                $entrega->faturas_id = $model->id;
                $entrega->status = 'Por Entregar';
                $entrega->save();
            }




            if ($model->save()) {
                foreach ($model->getLinhasFatura()->all() as $linha) {
                    $artigo = Artigos::findOne($linha->artigos_id);
                    if ($artigo) {
                        $artigo->stock -= $linha->quantidade; // Atualização do estoque do artigo
                        $artigo->save();
                    }
                }


                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
        } else {

            $this->redirect(['site/error']);
        }
    }




    /**
     * Deletes an existing Fatura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarFaturas')) {
        $model = Fatura::findOne($id);
        $model->estado = 'Anulado';
        $model->save();
        return $this->redirect(['index']);
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Finds the Fatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fatura::findOne(['id' => $id])) !== null) {
            return $model;
        }


        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
