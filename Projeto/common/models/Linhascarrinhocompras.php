<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linhascarrinhocompras".
 *
 * @property int $id
 * @property int $quantidade
 * @property float $valor
 * @property string $referencia
 * @property int $artigos_id
 * @property int $carrinhocompras_id
 *
 * @property Artigos $artigos
 * @property Carrinhocompras $carrinhocompras
 */
class Linhascarrinhocompras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhascarrinhocompras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
      /*      [['quantidade', 'valor', 'referencia', 'artigos_id', 'carrinhocompras_id'], 'required'],
            [['quantidade', 'artigos_id', 'carrinhocompras_id'], 'integer'],
            [['valor'], 'number'],
            [['referencia'], 'string', 'max' => 45],
            [['carrinhocompras_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carrinhocompras::class, 'targetAttribute' => ['carrinhocompras_id' => 'id']],
            [['artigos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artigos::class, 'targetAttribute' => ['artigos_id' => 'id']],*/
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
            'carrinhocompras_id' => 'Carrinhocompras ID',
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
     * Gets query for [[Carrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhocompras()
    {
        return $this->hasOne(Carrinhocompras::class, ['id' => 'carrinhocompras_id']);
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
