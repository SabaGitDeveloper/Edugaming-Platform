<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GameAssignments;

/**
 * GameAssignmentsSearch represents the model behind the search form of `backend\models\GameAssignments`.
 */
class GameAssignmentsSearch extends GameAssignments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assignmentID', 'assigned_by', 'interface_type', 'question_setID','topicId'], 'integer'],
            [['course_code', 'date_assigned', 'due_date', 'game_mode'], 'safe'],
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
        $query = GameAssignments::find();

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
            'assignmentID' => $this->assignmentID,
            'assigned_by' => $this->assigned_by,
            'interface_type' => $this->interface_type,
            'question_setID' => $this->question_setID,
            'date_assigned' => $this->date_assigned,
            'due_date' => $this->due_date,
            'topicId' => $this->topicId,    //added by saba last 3 conditions
        ]);

        $query->andFilterWhere(['like', 'course_code', $this->course_code])
            ->andFilterWhere(['like', 'date_assigned', $this->date_assigned]);
            // ->andFilterWhere(['like', 'due_date', $this->due_date])
            // ->andFilterWhere(['like', 'game_mode', $this->game_mode]);

        return $dataProvider;
    }
}
