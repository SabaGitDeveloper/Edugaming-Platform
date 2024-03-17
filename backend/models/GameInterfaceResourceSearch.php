<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GameInterfaceResource;

/**
 * GameInterfaceResourceSearch represents the model behind the search form of `backend\models\GameInterfaceResource`.
 */
class GameInterfaceResourceSearch extends GameInterfaceResource
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idGameInterfaceResource', 'Resource_id', 'Interface_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = GameInterfaceResource::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idGameInterfaceResource' => $this->idGameInterfaceResource,
            'Resource_id' => $this->Resource_id,
            'Interface_id' => $this->Interface_id,
        ]);

        return $dataProvider;
    }
}
