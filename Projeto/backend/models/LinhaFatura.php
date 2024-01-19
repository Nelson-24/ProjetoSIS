<?php

namespace backend\models;

use common\models\Artigos;
use common\models\Fatura;

/**
 * This is the model class for table "linhafatura".
 *
 * @property int $id
 * @property int $quantidade
 * @property float $valor
 * @property string $referencia
 * @property int $artigos_id
 * @property int $faturas_id
 *
 * @property Artigos $artigos
 * @property Fatura $faturas
 */
class Linhafatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhafatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantidade', 'valor', 'referencia', 'artigos_id', 'faturas_id'], 'required'],
            [['quantidade', 'artigos_id', 'faturas_id'], 'integer'],
            [['valor'], 'number'],
            [['referencia'], 'string', 'max' => 45],
            [['artigos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artigos::class, 'targetAttribute' => ['artigos_id' => 'id']],
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
            'quantidade' => 'Quantidade',
            'valor' => 'Valor',
            'referencia' => 'Referencia',
            'artigos_id' => 'Artigos ID',
            'faturas_id' => 'Faturas ID',
        ];
    }

    /**
     * Gets query for [[Artigos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArtigos()
    {
        return $this->hasOne(Artigos::class, ['id' => 'artigos_id']);
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

    public function getTotalValue()
    {
        return $this->quantidade * $this->valor;
    }

    public function getTotalValueWithIva()
    {
        $iva = 0;
        if ($this->artigos !== null && $this->artigos->ivas !== null) {
            $iva = $this->artigos->ivas->percentagem;
        }

        return $this->quantidade * ($iva + 1) * $this->valor;
    }


}
