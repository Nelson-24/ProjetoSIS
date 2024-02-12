<?php

namespace frontend\models;

use common\models\Profile;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $nome;
    public $nif;
    public $morada;
    public $contacto;
    public $id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],


            ['nif', 'required'],
            ['nome', 'required'],
            ['morada', 'required'],
            ['contacto', 'required'],
        ];
    }
    /**
     * Signs user up.
     *
     * @return User whether the creating new account was successful and email was sent
     */

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save(false);

            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->nome= $this->nome;
            $profile->nif = $this->nif;
            $profile->morada = $this->morada;
            $profile->contacto = $this->contacto;
            $profile->save(false);




            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('cliente');
            $auth->assign($authorRole, $user->getId());

            return $user;


        }

        return null;
    }



    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
