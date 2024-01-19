<?php

namespace frontend\controllers;

use common\models\User;
use Yii;

class UserController extends \yii\web\Controller
{
    public function actionProfile()
    {
        // Obtém o ID do usuário logado
        $userId = Yii::$app->user->identity->id;

        // Obtém os detalhes do usuário
        $model = User::findOne($userId);

        return $this->render('profile', [
            'model' => $model, // Passa o modelo do usuário para a view
        ]);
    }
}
