<?php

namespace backend\models;

use common\models\Profile;
use Yii;

/**
 * This is the model class for table "faturas".
 *
 * @property int $id
 * @property string $data
 * @property float $valorTotal
 * @property string $estado
 * @property string $opcaoEntrega
 * @property int $users_id
 * @property int $linhasfaturas_id
 * @property int $ivas_id
 *
 *
 * @property Profile $users
 * @property LinhasFaturas $linhasFaturas
 *
 *
 *
 * @property Carrinhocompras[] $carrinhocompras
 * @property Entregas[] $entregas
 * @property Ivas $ivas

 */
class Faturas extends \yii\db\ActiveRecord
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
            [['data', 'valorTotal', 'estado', 'opcaoEntrega', 'users_id', 'linhasfaturas_id', 'ivas_id'], 'required'],
            [['data'], 'safe'],
            [['valorTotal'], 'number'],
            [['users_id', 'linhasfaturas_id', 'ivas_id'], 'integer'],
            [['estado', 'opcaoEntrega'], 'string', 'max' => 45],
            [['ivas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ivas::class, 'targetAttribute' => ['ivas_id' => 'id']],
            [['linhasfaturas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Linhasfaturas::class, 'targetAttribute' => ['linhasfaturas_id' => 'id']],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['users_id' => 'id']],
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
            'linhasfaturas_id' => 'Linhasfaturas ID',
            'ivas_id' => 'Ivas ID',
        ];
    }

    /**
     * Gets query for [[Carrinhocompras]].
     *
     * @return \yii\db\ActiveQuery
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
        return $this->hasMany(LinhasFaturas::className(), ['fatura_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Profile::class, ['id' => 'users_id']);
    }
}
