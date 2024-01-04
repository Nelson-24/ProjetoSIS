<?php
namespace backend\modules\api\controllers;
use backend\modules\api\components\CustomAuth;
use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\helpers\Json;

class ArtigoController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\Artigo';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            //'class' => QueryParamAuth::className(),
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth'],
        ];
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

//    public function checkAccess($action, $model = null, $params = [])
//    {
//        // Basic Auth
////        if ($this->user) {
////            if ($this->user->id == 1) {
////                if ($action === "delete") {
////                    throw new \yii\web\ForbiddenHttpException('Proibido');
////                }
////            }
////        }
//
//        //Query Parameter
////        if(\Yii::$app->params['id'] != 1)
////        {
////            if($action==="delete")
////            {
////                throw new \yii\web\ForbiddenHttpException('Proibido');
////            }
////        }
//    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCount()
    {
        $artigosmodel = new $this->modelClass;
        $registos = $artigosmodel::find()->all();
        return ['count' => count($registos)];
    }
    public function actionJson()
    {
        $artigosmodel = new $this->modelClass;
        $registos = $artigosmodel::find()->all();
        return $this->asJson($registos);
    }

}