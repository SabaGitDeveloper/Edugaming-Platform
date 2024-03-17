<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CoursesModerated;

/**
 * CoursesModeratedSearch represents the model behind the search form of `backend\models\CoursesModerated`.
 */
class CoursesModeratedSearch extends CoursesModerated
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCourses_Moderated', 'moderator_id'], 'integer'],
            [['course_id'], 'safe'],
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
        $query = CoursesModerated::find();

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
            'idCourses_Moderated' => $this->idCourses_Moderated,
            'moderator_id' => $this->moderator_id,
        ]);

        $query->andFilterWhere(['like', 'course_id', $this->course_id]);

        return $dataProvider;
    }
}
