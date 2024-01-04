<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fornecedores".
 *
 * @property int $id
 * @property string $designacaoSocial
 * @property string $email
 * @property string $nif
 * @property string $morada
 * @property string $capitalSocial
 *
 * @property Faturasfornecedores[] $faturasfornecedores
 */
class Fornecedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fornecedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designacaoSocial', 'email', 'nif', 'morada', 'capitalSocial'], 'required'],
            [['designacaoSocial', 'email', 'nif', 'morada', 'capitalSocial'], 'string', 'max' => 45],
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
            'designacaoSocial' => 'Designacao Social',
            'email' => 'Email',
            'nif' => 'Nif',
            'morada' => 'Morada',
            'capitalSocial' => 'Capital Social',
        ];
    }

    /**
     * Gets query for [[Faturasfornecedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturasfornecedores()
    {
        return $this->hasMany(Faturasfornecedores::class, ['fornecedores_id' => 'id']);
    }
}
