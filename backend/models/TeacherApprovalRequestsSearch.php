<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TeacherApprovalRequests;

/**
 * TeacherApprovalRequestsSearch represents the model behind the search form of `backend\models\TeacherApprovalRequests`.
 */
class TeacherApprovalRequestsSearch extends TeacherApprovalRequests
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTeacher_Approval_Requests', 'teacher_id', 'Moderator_id'], 'integer'],
            [['status', 'date_sent', 'firstname', 'lastname', 'phoneNo', 'qualifications', 'experience'], 'safe'],
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
        $query = TeacherApprovalRequests::find();

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
            'idTeacher_Approval_Requests' => $this->idTeacher_Approval_Requests,
            'teacher_id' => $this->teacher_id,
            'Moderator_id' => $this->Moderator_id,
            'date_sent' => $this->date_sent,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'phoneNo', $this->phoneNo])
            ->andFilterWhere(['like', 'qualifications', $this->qualifications])
            ->andFilterWhere(['like', 'experience', $this->experience]);

        return $dataProvider;
    }
}
