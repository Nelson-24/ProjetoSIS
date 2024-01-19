<?php

namespace backend\models;


use Yii;

/**
 * This is the model class for table "faturasfornecedores".
 *
 * @property int $id
 * @property string $data
 * @property float $valorTotal
 * @property float $valor
 * @property float $valorIva
 * @property string $estado
 * @property int $fornecedores_id

 *
 * @property Fornecedores $fornecedores

 * @property Linhasfaturasfornecedores[] $linhasfaturasfornecedores
 */
class Faturasfornecedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturasfornecedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['fornecedores_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fornecedores::class, 'targetAttribute' => ['fornecedores_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'valorTotal' => 'Valor Total',
            'estado' => 'Estado',
            'fornecedores_id' => 'Fornecedores ID',

        ];
    }

    public function calculateTotalValue()
    {
        $valor = 0;
        foreach ($this->getLinhasfaturasfornecedores()->all() as $linha) {
            $valor += $linha->getTotalValue();
        }
        return $valor;
    }


    public function calculateTotalValueWithIva()
    {
        $valorTotal = 0;
        foreach ($this->getLinhasfaturasfornecedores()->all() as $linha) {
            $valorTotal += $linha->getTotalValueWithIva();
        }
        return $valorTotal;
    }

    public function calculateTotalIvaValue()
    {
        $valorIva = 0;
        foreach ($this->getLinhasfaturasfornecedores()->all() as $linha) {
            $valorIva += $linha->artigos->ivas->percentagem * $linha->getTotalValue();
        }
        return $valorIva;
    }





    /**
     * Gets query for [[Fornecedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFornecedores()
    {
        return $this->hasOne(Fornecedores::class, ['id' => 'fornecedores_id']);
    }

    /**
     * Gets query for [[Ivas]].
     *
     * @return \yii\db\ActiveQuery
     */


    /**
     * Gets query for [[Linhasfaturasfornecedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfaturasfornecedores()
    {
        return $this->hasMany(Linhasfaturasfornecedores::class, ['faturasfornecedores_id' => 'id']);
    }
}
