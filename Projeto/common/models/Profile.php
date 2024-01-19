<?php

namespace common\models;

use app\models\Carrinhocompras;
use app\models\Faturas;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $nome
 * @property string $nif
 * @property string $morada
 * @property string $contacto
 *
 * @property Carrinhocompras[] $carrinhocompras
 * @property Faturas[] $faturas
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @var int|mixed|null
     *
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nif', 'morada', 'contacto'], 'required'],
            [['nome', 'nif', 'morada', 'contacto'], 'string', 'max' => 45],
            [['nif'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'nif' => 'Nif',
            'morada' => 'Morada',
            'contacto' => 'Contacto',
        ];
    }

    /**
     * Gets query for [[Carrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhocompras()
    {
        return $this->hasMany(Carrinhocompras::class, ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Faturas::class, ['users_id' => 'id']);
    }
}
