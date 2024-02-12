<?php

namespace backend\controllers;

use common\models\Artigos;
use common\models\Categoria;
use common\models\Ivas;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\components\MqttComponents;

/**
 * ArtigosController implements the CRUD actions for Artigos model.
 */
class ArtigosController extends Controller
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
     * Lists all Artigos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('verArtigos')) {
        $dataProvider = new ActiveDataProvider([
            'query' => Artigos::find(),
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

    /**
     * Displays a single Artigos model.
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
     * Creates a new Artigos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('criarArtigos')) {
            $model = new Artigos();

            // Obtém todas as categorias
            $categoria = Categoria::find()->all();
            $iva = Ivas::find()->all();

            if ($model->load(\Yii::$app->request->post())) {
                $model->save();

                $imagem = UploadedFile::getInstance($model , 'imagem');
                $imagem->saveAs('C:\wamp64\www\ProjetoPSI_\frontend\web\images\materiais\\' . $imagem->name);
                $model->imagem = $imagem->name;
                $model->save();



                $mqtt = new \PhpMqtt\Client\MqttClient('127.0.0.1', '1883', 'backend');
                $mqtt->connect();
                $mqtt->publish('Artigos', 'Artigo Criado'  .$model->descricao , 1);
                $mqtt->disconnect();

                return $this->redirect(['view', 'id' => $model->id]);
            }


            return $this->render('create', [
                'model' => $model,
                'categoria' => $categoria,
                'iva' => $iva,
            ]);
        } else {

            $this->redirect(['site/error']);
        }

    }

    /**
     * Updates an existing Artigos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('editarArtigos')) {
            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }


            $mqtt = new \PhpMqtt\Client\MqttClient('127.0.0.1', '1883', 'backend');
            $mqtt->connect();
            $mqtt->publish('Artigos', 'Artigo Atualizado'  .$model->descricao , 1);
            $mqtt->disconnect();

            return $this->render('update', [
                'model' => $model,
            ]);



            } else {

                $this->redirect(['site/error']);
        }
    }

    /**
     * Deletes an existing Artigos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarArtigos')) {

         $this->findModel($id)->delete();

            $mqtt = new \PhpMqtt\Client\MqttClient('127.0.0.1', '1883', 'backend');
            $mqtt->connect();
            $mqtt->publish('Artigos', 'Artigo Eliminado' , 1);
            $mqtt->disconnect();


        return $this->redirect(['index']);
        } else {

            $this->redirect(['site/error']);
        }
    }

    /**
     * Finds the Artigos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Artigos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artigos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
