<?php

namespace backend\models;

use common\models\Fatura;

/**
 * This is the model class for table "entregas".
 *
 * @property int $id
 * @property string $status
 * @property int $faturas_id
 *
 * @property Fatura $faturas
 */
class Entregas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entregas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'faturas_id'], 'required'],
            [['faturas_id'], 'integer'],
            [['status'], 'string', 'max' => 45],
            [['faturas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fatura::class, 'targetAttribute' => ['faturas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'faturas_id' => 'Faturas ID',
        ];
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasOne(Fatura::class, ['id' => 'faturas_id']);
    }




}
