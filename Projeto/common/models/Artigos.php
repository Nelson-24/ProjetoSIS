<?php

namespace common\models;

use backend\models\LinhaFatura;
use Yii;
use yii\web\UploadedFile;



/**
 * This is the model class for table "artigos".
 *
 * @property int $id
 * @property string $referencia
 * @property string $descricao
 * @property float $preco
 * @property int $stock
 * @property int $categoria_id
 *  * @property string $imagem
 *
 * @property Categoria $categoria
 *  * @property Ivas $ivas
 *
 *
 * @property Linhascarrinhocompras[] $linhascarrinhocompras
 * @property LinhaFatura[] $linhasfaturas
 * @property Linhasfaturasfornecedores[] $linhasfaturasfornecedores
 */
class Artigos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artigos';
    }
    public $eventImage;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['referencia', 'descricao', 'preco', 'stock', 'categoria_id', 'imagem'], 'required'],
            [['eventImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['preco'], 'number'],
            [['stock', 'categoria_id'], 'integer'],
            [['referencia', 'descricao'], 'string', 'max' => 45],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['ivas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ivas::class, 'targetAttribute' => ['ivas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'referencia' => 'Referencia',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
            'stock' => 'Stock',
            'categoria_id' => 'Categoria ID',
            'ivas_id' => 'Iva ID',
            'imagem' =>'Imagem',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'categoria_id']);
    }

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
        return $this->hasMany(Linhascarrinhocompras::class, ['artigos_id' => 'id']);
    }

    /**
     * Gets query for [[Linhasfaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfaturas()
    {
        return $this->hasMany(Linhasfaturas::class, ['artigos_id' => 'id']);
    }

    /**
     * Gets query for [[Linhasfaturasfornecedores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfaturasfornecedores()
    {
        return $this->hasMany(Linhasfaturasfornecedores::class, ['artigos_id' => 'id']);
    }
}
