<?php

namespace backend\models;

use backend\models\Fornecedores;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SearchFornecedores extends Fornecedores
{
    public $designacaoSocial;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['designacaoSocial'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Fornecedores::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'designacaoSocial', $this->designacaoSocial]);
        $query->andFilterWhere(['like', 'id', $this->id]);


        return $dataProvider;
    }
}