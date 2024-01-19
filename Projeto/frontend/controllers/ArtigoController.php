<?php

namespace frontend\controllers;

use common\models\Artigos;
use common\models\Carrinhocompras;
use common\models\Linhascarrinhocompras;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArtigoController implements the CRUD actions for Artigos model.
 */
class ArtigoController extends Controller
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

        $artigos = $dataProvider->getModels();

        return $this->render('index', ['dataProvider' => $dataProvider, 'artigos' => $artigos]);
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
        $model = new Artigos();

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

    public function actionAdicionarCarrinho($id, $quantidade)
    {
        // Encontrar o artigo pelo ID
        $artigo = Artigos::findOne($id);

        if ($artigo !== null) {
            if (!Yii::$app->user->isGuest) {
                $carrinho = Carrinhocompras::find()
                    ->where([
                        'users_id' => Yii::$app->user->id,
                        'estado' => 'ativo'
                    ])
                    ->andWhere(['not', ['estado' => 'finalizado']])
                    ->one();

                if ($carrinho === null) {

                    $carrinho = new Carrinhocompras();
                    $carrinho->users_id = Yii::$app->user->id;
                    $carrinho->data = date('Y-m-d-H-i-s');
                    $carrinho->estado = 'ativo';
                    $carrinho->save();
                }


                $linhaCarrinho = new Linhascarrinhocompras();
                $linhaCarrinho->carrinhocompras_id = $carrinho->id;
                $linhaCarrinho->artigos_id = $artigo->id;
                $linhaCarrinho->quantidade = $quantidade;
                $linhaCarrinho->valor = $artigo->preco;
                $linhaCarrinho->referencia = $artigo->referencia;
                $linhaCarrinho->save();

                // Atualizar os valores totais do carrinho
                $carrinho->valor = $carrinho->calculateTotalValueCarrinho();
                $carrinho->valorIva = $carrinho->calculateTotalIvaValueCarrinho();
                $carrinho->valorTotal = $carrinho->calculateTotalValueWithIvaCarrinho();
                $carrinho->save();

                // Redirecionar para a página do carrinho após adicionar ao carrinho
                return $this->redirect(['carrinho-compras/index']);
            } else {
                // O usuário não está logado, redirecione para a página de login ou mostre uma mensagem de erro
                return $this->redirect(['site/login']);
            }
        }

        // Redirecionar para alguma página caso o artigo não seja encontrado
        return $this->redirect(Yii::$app->request->referrer);
    }

    // ...


    /**
     * Updates an existing Artigos model.
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
     * Deletes an existing Artigos model.
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
