<?php

namespace common\models;

use backend\models\Faturasfornecedores;
use Yii;

/**
 * This is the model class for table "ivas".
 *
 * @property int $id
 * @property string $percentagem
 * @property string $descricao
 *
 * @property Carrinhocompras[] $carrinhocompras
 * @property Faturasfornecedores[] $faturasfornecedores
 *  * @property Artigos[] $artigos
 */
class Ivas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['percentagem', 'descricao'], 'required'],
            [['percentagem', 'descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'percentagem' => 'Percentagem',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[Carrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhocompras()
    {
        return $this->hasMany(Carrinhocompras::class, ['ivas_id' => 'id']);
    }

    /**
     * Gets query for [[Faturasfornecedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturasfornecedores()
    {
        return $this->hasMany(Faturasfornecedores::class, ['ivas_id' => 'id']);
    }
}
