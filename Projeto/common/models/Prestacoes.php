<?php

namespace common\models;

/**
 * This is the model class for table "prestacoes".
 *
 * @property int $id
 * @property float $valor
 * @property string $data
 * @property int $user_id
 */
class Prestacoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prestacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor', 'data', 'user_id'], 'required'],
            [['valor'], 'number'],
            [['data'], 'safe'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor' => 'Valor',
            'data' => 'Data',
            'user_id' => 'User ID',
        ];
    }
}
