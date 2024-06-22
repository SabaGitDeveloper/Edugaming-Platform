<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OptionsPuzzle;

/**
 * OptionsPuzzleSearch represents the model behind the search form of `backend\models\OptionsPuzzle`.
 */
class OptionsPuzzleSearch extends OptionsPuzzle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['optionID', 'questionNo', 'sequence_number', 'display_number'], 'integer'],
            [['option_text'], 'safe'],
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
        $query = OptionsPuzzle::find();

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
            'optionID' => $this->optionID,
            'questionNo' => $this->questionNo,
            'sequence_number' => $this->sequence_number,
            'display_number' => $this->display_number,
        ]);

        $query->andFilterWhere(['like', 'option_text', $this->option_text]);

        return $dataProvider;
    }
}
