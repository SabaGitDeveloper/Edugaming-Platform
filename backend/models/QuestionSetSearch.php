<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\QuestionSet;

/**
 * QuestionSetSearch represents the model behind the search form of `backend\models\QuestionSet`.
 */
class QuestionSetSearch extends QuestionSet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_setID', 'topicID', 'created_by'], 'integer'],
            [['course_code', 'date_created', 'difficulty_level', 'status'], 'safe'],
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
        $query = QuestionSet::find();

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
            'question_setID' => $this->question_setID,
            'topicID' => $this->topicID,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'course_code', $this->course_code])
            ->andFilterWhere(['like', 'difficulty_level', $this->difficulty_level])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
