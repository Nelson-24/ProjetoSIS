<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [

                       'actions' => ['login', 'error', 'logout'],
                        'allow' => true,
                    ],
                    [

                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'funcionario'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'index' && !Yii::$app->user->can('loginBackend')) {
            Yii::$app->session->setFlash('error', 'Não tem permissão para aceder a esta página.');
            $this->actionLogout();
            $this->redirect(['site/login']);
            return false;
        }
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {

        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }

            $this->layout = 'blank';

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {

                return $this->goBack();
            }

            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);

    }

    public function actionSignup()
    {
        $model = new \backend\models\SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
