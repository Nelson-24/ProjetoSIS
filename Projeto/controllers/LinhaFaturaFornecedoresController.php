<?php

namespace backend\controllers;

use backend\models\Fatura;
use backend\models\Faturasfornecedores;
use backend\models\Linhafatura;
use backend\models\Linhasfaturasfornecedores;
use common\models\Artigos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * LinhaFaturaFornecedoresController implements the CRUD actions for Linhasfaturasfornecedores model.
 */
class LinhaFaturaFornecedoresController extends Controller
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
     * Lists all Linhasfaturasfornecedores models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Linhasfaturasfornecedores::find(),
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
     * Displays a single Linhasfaturasfornecedores model.
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
     * Creates a new Linhasfaturasfornecedores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($artigos_id)
    {
        $artigo = Artigos::findOne($artigos_id);
        $faturas = Faturasfornecedores::find()->orderBy(['id' => SORT_DESC])->one();


        if ($artigo && $faturas) {
            $model = new Linhasfaturasfornecedores();
            $model->artigos_id = $artigo->id;
            $model->valor = $artigo->preco;
            $model->faturasfornecedores_id = $faturas->id;
            $model->referencia = $artigo->referencia;

            if ($model->load(\Yii::$app->request->post()) && $model->save()) {




                return $this->redirect(['faturas-fornecedor/update', 'id' => $faturas->id]);
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

        $faturas = Faturasfornecedores::find()->all();

        return $this->render('selecionar_artigos', [
            'dataProvider' => $dataProvider,
            'faturas' => $faturas,

        ]);
    }


    /**
     * Updates an existing Linhasfaturasfornecedores model.
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
     * Deletes an existing Linhasfaturasfornecedores model.
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
     * Finds the Linhasfaturasfornecedores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Linhasfaturasfornecedores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Linhasfaturasfornecedores::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
