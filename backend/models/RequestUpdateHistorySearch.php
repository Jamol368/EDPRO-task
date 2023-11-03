<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RequestUpdateHistory;

/**
 * RequestUpdateHistorySearch represents the model behind the search form of `backend\models\RequestUpdateHistory`.
 */
class RequestUpdateHistorySearch extends RequestUpdateHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_at'], 'integer'],
            [['user_id', 'request_id'], 'safe'],
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
        $query = RequestUpdateHistory::find();

        // add conditions that should always apply here

        $query->joinWith(['user', 'request']);

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
            'id' => $this->id,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'user.username', $this->user_id])
            ->andFilterWhere(['like', 'requests.request_name', $this->request_id]);

        return $dataProvider;
    }
}
