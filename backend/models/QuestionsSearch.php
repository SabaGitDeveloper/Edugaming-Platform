<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Questions;

/**
 * QuestionsSearch represents the model behind the search form of `backend\models\Questions`.
 */
class QuestionsSearch extends Questions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['QuestionNo', 'QuestionSet'], 'integer'],
            [['QuestionStatement', 'Hints'], 'safe'],
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
        $query = Questions::find();

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
            'QuestionNo' => $this->QuestionNo,
            'QuestionSet' => $this->QuestionSet,
        ]);

        $query->andFilterWhere(['like', 'QuestionStatement', $this->QuestionStatement])
            ->andFilterWhere(['like', 'Hints', $this->Hints]);

        return $dataProvider;
    }
}
