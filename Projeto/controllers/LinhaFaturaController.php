<?php

namespace backend\controllers;

use common\models\Fatura;
use backend\models\LinhaFatura;
use common\models\Artigos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * LinhaFaturaController implements the CRUD actions for LinhaFatura model.
 */
class LinhaFaturaController extends Controller
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
     * Lists all LinhaFatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LinhaFatura::find(),
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
     * Displays a single LinhaFatura model.
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
     * Creates a new LinhaFatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
   /*  ESTE É O QUE VEIO COM O CONTROLER     public function actionCreate()
    {
        $model = new LinhaFatura();

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
*/

 /* este é o novo   public function actionCreate($artigos_id)
    {



        $artigo = Artigos::findOne($artigos_id);

        if ($artigo) {
            $model = new LinhaFatura();
            $model->artigos_id = $artigo->id;
            $model ->referencia = $artigo->referencia;
            $model->valor = $artigo->preco;
            $model->faturas_id = $model->getFaturas();

            return $this->render('create', [
                'model' => $model,
                'artigo' => $artigo,

            ]);
        }
    }*/
    public function actionCreate($artigos_id)
    {
        $artigo = Artigos::findOne($artigos_id);
        $faturas = Fatura::find()->orderBy(['id' => SORT_DESC])->one();


        if ($artigo && $faturas) {
            $model = new LinhaFatura();
            $model->artigos_id = $artigo->id;
            $model->valor = $artigo->preco;
            $model->faturas_id = $faturas->id;
            $model->referencia = $artigo->referencia;

            if ($model->load(\Yii::$app->request->post()) && $model->save()) {




                return $this->redirect(['faturas/update', 'id' => $faturas->id]);
            }

            return $this->render('create', [
                'model' => $model,
                'artigo' => $artigo,



            ]);
        }
    }

    public function actionSelecionarArtigos()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Artigos::find(),
        ]);

        $faturas = Fatura::find()->all();

        return $this->render('selecionar_artigos', [
            'dataProvider' => $dataProvider,
            'faturas' => $faturas,

        ]);
    }




    /*
     * Updates an existing LinhaFatura model.
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
     * Deletes an existing LinhaFatura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $linhaFatura = $this->findModel($id);
        $fatura_id = $linhaFatura->faturas_id; // Obtém o ID da fatura antes de excluir a linha

        $linhaFatura->delete();

        // Redireciona de volta para o formulário de atualização da fatura com o ID da fatura
        return $this->redirect(['faturas/update', 'id' => $fatura_id]);
    }
    /**
     * Finds the LinhaFatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LinhaFatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LinhaFatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
