<?php

namespace backend\controllers;

use app\models\SearchCliente;
use backend\models\Entregas;
use common\models\Fatura;
use backend\models\Faturasfornecedores;
use backend\models\Linhafatura;
use backend\models\Linhasfaturasfornecedores;
use backend\models\SearchFornecedores;
use common\models\Artigos;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaturasFornecedorController implements the CRUD actions for Faturasfornecedores model.
 */
class FaturasFornecedorController extends Controller
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
     * Lists all Faturasfornecedores models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('verFaturasFornecedores')) {
        $dataProvider = new ActiveDataProvider([
            'query' => Faturasfornecedores::find(),
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
        } else {

            $this->redirect(['site/error']);
        }

    }


    public function actionSelecionarFornecedores(){


        $searchModel = new SearchFornecedores();

        $provider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('selecionar_fornecedores', [
            'dataProvider' => $provider,
            'searchModel' =>$searchModel,


        ]);
    }

    /**
     * Displays a single Faturasfornecedores model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Faturasfornecedores::findOne($id);
        $dataProvider = new ActiveDataProvider([
            'query' => Linhasfaturasfornecedores::find()->where(['faturasfornecedores_id' => $id]),
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Faturasfornecedores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($fornecedores_id)
    {
        if (Yii::$app->user->can('criarFaturasFornecedores')) {

        $model = new Faturasfornecedores([
            'fornecedores_id' => $fornecedores_id,
            'valorTotal' => 0,
            'estado' => 'Em lançamento',
            'data' =>date('Y-m-d-H-i-s'),

        ]);




        if ($model->save()) {

            $mqtt = new \PhpMqtt\Client\MqttClient('127.0.0.1', '1883', 'backend');
            $mqtt->connect();
            $mqtt->publish('FaturasFornecedores', 'Fatura Criada' , 1);
            $mqtt->disconnect();

            return $this->render('create', [
                'model' => $model,

            ]);
        }
        else {
            $model->loadDefaultValues();
        }
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Updates an existing Faturasfornecedores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('editarFaturasFornecedores')) {
        $model = Faturasfornecedores::findOne($id);

        $dataProvider = new ActiveDataProvider([
            'query' => Linhasfaturasfornecedores::find()->where(['faturasfornecedores_id' => $id]),
        ]);
        $model->valor = $model->calculateTotalValue();
        $model->valorIva = $model ->calculateTotalIvaValue();
        $model->valorTotal = $model ->calculateTotalValueWithIva();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->estado = 'Emitido';






            if ($model->save()) {
                foreach ($model->getLinhasfaturasfornecedores()->all() as $linha) {
                    $artigo = Artigos::findOne($linha->artigos_id);
                    if ($artigo) {
                        $artigo->stock += $linha->quantidade;
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
     * Deletes an existing Faturasfornecedores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarFaturasFornecedores')) {
        $model = Faturasfornecedores::findOne($id);
        $model->estado = 'Anulado';
        $model->save();
        return $this->redirect(['index']);
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Finds the Faturasfornecedores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Faturasfornecedores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faturasfornecedores::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
