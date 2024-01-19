<?php

namespace backend\models;

use common\models\Artigos;
use Yii;

/**
 * This is the model class for table "linhasfaturasfornecedores".
 *
 * @property int $id
 * @property int $quantidade
 * @property float $valor
 * @property string $referencia
 * @property int $artigos_id
 * @property int $faturasfornecedores_id
 *
 * @property Artigos $artigos
 * @property Faturasfornecedores $faturasfornecedores
 */
class Linhasfaturasfornecedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhasfaturasfornecedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantidade', 'valor', 'referencia', 'artigos_id', 'faturasfornecedores_id'], 'required'],
            [['quantidade', 'artigos_id', 'faturasfornecedores_id'], 'integer'],
            [['valor'], 'number'],
            [['referencia'], 'string', 'max' => 45],
            [['artigos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artigos::class, 'targetAttribute' => ['artigos_id' => 'id']],
            [['faturasfornecedores_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faturasfornecedores::class, 'targetAttribute' => ['faturasfornecedores_id' => 'id']],
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
            'faturasfornecedores_id' => 'Faturasfornecedores ID',
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
     * Gets query for [[Faturasfornecedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturasfornecedores()
    {
        return $this->hasOne(Faturasfornecedores::class, ['id' => 'faturasfornecedores_id']);
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
