<?php

namespace backend\controllers;

use backend\models\SignupForm;
use common\models\User;
use app\models\_search;
use Yii;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FuncionariosController implements the CRUD actions for User model.
 */
class FuncionariosController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */

    public function actionIndex(){
        if (Yii::$app->user->can('verFuncionarios')) {

        $searchModel = new _search();

        $provider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $provider,
            'searchModel' =>$searchModel,


        ]);
        } else {

            $this->redirect(['site/error']);
        }
    }



    /**
     * Displays a single User model.
     * @param int $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('criarFuncionarios')) {

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {

            $mqtt = new \PhpMqtt\Client\MqttClient('127.0.0.1', '1883', 'backend');
            $mqtt->connect();
            $mqtt->publish('Funcionarios', 'Funcionario Criado', 1);
            $mqtt->disconnect();



            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('editarFuncionarios')) {

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {


            $mqtt = new \PhpMqtt\Client\MqttClient('127.0.0.1', '1883', 'backend');
            $mqtt->connect();
            $mqtt->publish('Funcionarios', 'Funcionario Atualizado', 1);
            $mqtt->disconnect();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarFuncionarios')) {


        $this->findModel($id)->delete();

            $mqtt = new \PhpMqtt\Client\MqttClient('127.0.0.1', '1883', 'backend');
            $mqtt->connect();
            $mqtt->publish('Funcionarios', 'Funcionario Eliminado', 1);
            $mqtt->disconnect();

        return $this->redirect(['index']);
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
