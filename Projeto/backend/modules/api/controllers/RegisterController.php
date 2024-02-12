<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Profile;
use common\models\User;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Application;

class RegisterController extends ActiveController
{
    public $user=null;
    public $modelClass = 'common\models\User';
    public $profile = 'common\models\Profile';

    public function actionRegister(){
        $rawBody = Yii::$app->request->getRawBody();
        $decodedBody = Json::decode($rawBody);

        $username = $decodedBody['username'];
        $email = $decodedBody['email'];
        $password = $decodedBody['password'];

        // Criar instância de User e definir atributos
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();

        // Salvar o usuário
        if (!$user->save()) {
            return $this->asJson(['success' => false, 'message' => 'Erro ao criar o user', 'errors' => $user->errors]);
        }

        // Extrair dados para criação do perfil
        $nome = $decodedBody['nome'];
        $nif = $decodedBody['nif'];
        $morada = $decodedBody['morada'];
        $contacto = $decodedBody['contacto'];

        // Criar instância de Profile e definir atributos
        $profile = new Profile();
        $profile->user_id = $user->id; // Chave estrangeira
        $profile->nome = $nome;
        $profile->nif = $nif;
        $profile->morada = $morada;
        $profile->contacto = $contacto;

        // Salvar o perfil
        if (!$profile->save()) {
            // Se falhar, excluir o usuário criado anteriormente
            $user->delete();
            return $this->asJson(['success' => false, 'message' => 'Erro ao criar o profile', 'errors' => $profile->errors]);
        }

        return $this->asJson(['success' => true, 'message' => 'User registado com sucesso']);
    }
}