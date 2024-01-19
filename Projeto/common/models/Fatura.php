<?php

namespace common\models;

use common\models\Carrinhocompras;
use backend\models\Entregas;
use backend\models\LinhaFatura;

/**
 * This is the model class for table "faturas".
 *
 * @property int $id
 * @property string $data
 * @property float $valorTotal
 * @property float $valor
 * @property float $valorIva
 * @property string $estado
 * @property string $opcaoEntrega
 * @property int $users_id
 * @property int $ivas_id
 *
 *
 * @property User $users
 * @property LinhaFatura $linhasFaturas
 *
 *
 *
 * @property Carrinhocompras[] $carrinhocompras
 * @property Entregas[] $entregas
 * @property Ivas $ivas
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [


            [['opcaoEntrega'], 'boolean'],

            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['users_id' => 'id']],

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
            'opcaoEntrega' => 'Opcao Entrega',
            'users_id' => 'Users ID',

            'ivas_id' => 'Ivas ID',
        ];
    }

    /**
     * Gets query for [[Carrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function calculateTotalValue()
    {
        $valor = 0;
        foreach ($this->getLinhasFatura()->all() as $linha) {
            $valor += $linha->getTotalValue();
        }
        return $valor;
    }


    public function calculateTotalValueWithIva()
    {
        $valorTotal = 0;
        foreach ($this->getLinhasFatura()->all() as $linha) {
            $valorTotal += $linha->getTotalValueWithIva();
        }
        return $valorTotal;
    }

    public function calculateTotalIvaValue()
    {
        $valorIva = 0;
        foreach ($this->getLinhasFatura()->all() as $linha) {
            $valorIva += $linha->artigos->ivas->percentagem * $linha->getTotalValue();
        }
        return $valorIva;
    }





/*
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->opcaoEntrega == 1 && $insert) {
            $entrega = new Entregas();
            $entrega->faturas_id = $this->id;
            $entrega->status = 'Por Entregar';
            $entrega->save();
        }
    }
*/

    public function getCarrinhocompras()
    {
        return $this->hasMany(Carrinhocompras::class, ['faturas_id' => 'id']);
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entregas::class, ['faturas_id' => 'id']);
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
     * Gets query for [[Linhasfaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
  public function getLinhasFatura()
    {
        return $this->hasMany(Linhafatura::className(), ['faturas_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'users_id']);
    }
}
