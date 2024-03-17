<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ModeratorApprovalRequests;

/**
 * ModeratorApprovalRequestsSearch represents the model behind the search form of `backend\models\ModeratorApprovalRequests`.
 */
class ModeratorApprovalRequestsSearch extends ModeratorApprovalRequests
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idModerator_Approval_Requests', 'moderator_id', 'admin_id'], 'integer'],
            [['status'], 'safe'],
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
        $query = ModeratorApprovalRequests::find();

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
            'idModerator_Approval_Requests' => $this->idModerator_Approval_Requests,
            'moderator_id' => $this->moderator_id,
            'admin_id' => $this->admin_id,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
