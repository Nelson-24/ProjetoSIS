<?php

namespace backend\modules\api\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use backend\modules\api\components\CustomAuth;

/**
 * Default controller for the `api` module
 */
class UserController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\User';
    /**
     * Renders the index view for the module
     * @return array|array[]|string
     */

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            //'class' => CustomAuth::className(),
            //'class' => QueryParamAuth::className(),
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth'],
        ];
        //$behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        return $behaviors;
    }

    public function auth($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password))
        {
            $this->user = $user; //guardar user autenticado
            return $user;
        }
        throw new \yii\web\ForbiddenHttpException('No authentication'); //403
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        // Se o código chegar até aqui, a autenticação foi bem-sucedida
        // O usuário autenticado está disponível como Yii::$app->user->identity

       // if (!Yii::$app->user->isGuest && Yii::$app->user->identity !== null) {
            // Acesso seguro às propriedades do usuário
            //Yii::info('Autenticação bem-sucedida para o usuário: ' . Yii::$app->user->identity->username);

            $user = Yii::$app->user->identity;

        // Retorna os dados que você deseja enviar de volta para o cliente (por exemplo, authKey e email)
        return [
            'success' => true,
            'token' => $user->auth_key,
            'email' => $user->email,
            'message' => 'Login bem sucedido',
        ];
    }
}