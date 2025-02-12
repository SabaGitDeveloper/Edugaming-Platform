<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StudentJoinRequests;

/**
 * StudentJoinRequestsSearch represents the model behind the search form of `backend\models\StudentJoinRequests`.
 */
class StudentJoinRequestsSearch extends StudentJoinRequests
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idStudent_join_Requests', 'student_id', 'teacher_id'], 'integer'],
            [['course_id', 'status', 'date_sent', 'firstname', 'lastname', 'phoneNo', 'qualifications'], 'safe'],
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
        $query = StudentJoinRequests::find();

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
            'idStudent_join_Requests' => $this->idStudent_join_Requests,
            'student_id' => $this->student_id,
            'teacher_id' => $this->teacher_id,
            'date_sent' => $this->date_sent,
        ]);

        $query->andFilterWhere(['like', 'course_id', $this->course_id])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'phoneNo', $this->phoneNo])
            ->andFilterWhere(['like', 'qualifications', $this->qualifications]);

        return $dataProvider;
    }
}
