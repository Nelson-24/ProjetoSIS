<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrinhocompras".
 *
 * @property int $id
 * @property string $data
 * @property float $valorTotal
 * @property string $estado
 * @property string $opcaoEntrega
 * @property int $ivas_id
 * @property float $valor
 * @property float $valorIva
 * @property int $users_id
 *
 * @property Linhascarrinhocompras[] $linhascarrinhocompras
 * @property User $users
 */
class Carrinhocompras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrinhocompras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
     /*       [['', '', '', '', 'ivas_id', 'valor', 'user_id'], 'required'],
            [['data'], 'safe'],
            [['valorTotal', 'valor', 'valorIva'], 'number'],
            [['ivas_id', 'user_id'], 'integer'],
            [['estadol', 'opcaoEntrega'], 'string', 'max' => 45],
            [['ivas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ivas::class, 'targetAttribute' => ['ivas_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],*/
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
            'estadol' => 'Estadol',
            'opcaoEntrega' => 'Opcao Entrega',
            'ivas_id' => 'Ivas ID',
            'valor' => 'Valor',
            'valorIva' => 'Valor Iva',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Ivas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIvas()
    {
        return $this->hasOne(Ivas::class, ['id' => 'ivas_id']);
    }

    /**
     * Gets query for [[Linhascarrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhascarrinhocompras()
    {
        return $this->hasMany(Linhascarrinhocompras::class, ['carrinhocompras_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function calculateTotalValueCarrinho()
    {
        $valor = 0;
        foreach ($this->getLinhascarrinhocompras()->all() as $linha) {
            $valor += $linha->getTotalValue();
        }
        return $valor;
    }


    public function calculateTotalValueWithIvaCarrinho()
    {
        $valorTotal = 0;
        foreach ($this->getLinhascarrinhocompras()->all() as $linha) {
            $valorTotal += $linha->getTotalValueWithIva();
        }
        return $valorTotal;
    }

    public function calculateTotalIvaValueCarrinho()
    {
        $valorIva = 0;
        foreach ($this->getLinhascarrinhocompras()->all() as $linha) {
            $valorIva += $linha->artigos->ivas->percentagem * $linha->getTotalValue();
        }
        return $valorIva;
    }



}
