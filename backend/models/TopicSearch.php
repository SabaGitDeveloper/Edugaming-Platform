<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Topic;

/**
 * TopicSearch represents the model behind the search form of `backend\models\Topic`.
 */
class TopicSearch extends Topic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topicID', 'parent_id', 'has_children'], 'integer'],
            [['topic_title', 'topic_description', 'learning_target', 'course_code'], 'safe'],
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
        $query = Topic::find();

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
            'topicID' => $this->topicID,
            'parent_id' => $this->parent_id,
            'has_children' => $this->has_children,
        ]);

        $query->andFilterWhere(['like', 'topic_title', $this->topic_title])
            ->andFilterWhere(['like', 'topic_description', $this->topic_description])
            ->andFilterWhere(['like', 'learning_target', $this->learning_target])
            ->andFilterWhere(['like', 'course_code', $this->course_code]);

        return $dataProvider;
    }
}
