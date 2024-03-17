<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CourseTeacher;

/**
 * CourseTeacherSearch represents the model behind the search form of `backend\models\CourseTeacher`.
 */
class CourseTeacherSearch extends CourseTeacher
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCourse_Teacher', 'Teacher_id'], 'integer'],
            [['Course_id'], 'safe'],
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
        $query = CourseTeacher::find();

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
            'idCourse_Teacher' => $this->idCourse_Teacher,
            'Teacher_id' => $this->Teacher_id,
        ]);

        $query->andFilterWhere(['like', 'Course_id', $this->Course_id]);

        return $dataProvider;
    }
}
