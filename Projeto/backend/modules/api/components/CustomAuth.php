<?php
namespace backend\modules\api\components;

use common\models\User;
use Yii;
use yii\filters\auth\AuthMethod;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;

class CustomAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        try {
            $jsonData = Yii::$app->request->getRawBody();
            Yii::info('JSON data: ' . $jsonData, 'api-authentication');

            $data = Json::decode($jsonData);
            Yii::info('Data: ' . $jsonData, 'api-authentication');

            $user_aux = $data['username'];
            $password = $data['password'];
            Yii::info('user: ' . $user_aux . 'password: '. $password, 'api-authentication');

            $user = User::findByUsername($user_aux);

            if ($user !== null && $user->validatePassword($password)) {
                // Autenticação bem-sucedida
                Yii::$app->params['id'] = $user->id;
                Yii::info('Autenticação bem-sucedida para o usuário: ' . $user_aux, 'api-authentication');
                return $user;
            } else {
                throw new ForbiddenHttpException('Username ou Password inválida'); // 403
            }
        } catch (\Exception $e) {
            Yii::error('Erro na autenticação: ' . $e->getMessage());
            throw new ForbiddenHttpException('No Authentication .'); // 403
        }
    }
}