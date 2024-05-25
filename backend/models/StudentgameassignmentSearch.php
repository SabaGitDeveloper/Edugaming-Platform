<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Studentgameassignment;

/**
 * StudentgameassignmentSearch represents the model behind the search form of `backend\models\Studentgameassignment`.
 */
class StudentgameassignmentSearch extends Studentgameassignment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idStudentGameAssignment', 'Accuracy', 'Speed', 'tries', 'StudentID', 'AssignmentId'], 'integer'],
            [['CourseID'], 'safe'],
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
        $query = Studentgameassignment::find();

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
            'idStudentGameAssignment' => $this->idStudentGameAssignment,
            'Accuracy' => $this->Accuracy,
            'Speed' => $this->Speed,
            'tries' => $this->tries,
            'StudentID' => $this->StudentID,
            'AssignmentId' => $this->AssignmentId,
        ]);

        $query->andFilterWhere(['like', 'CourseID', $this->CourseID]);

        return $dataProvider;
    }
}
