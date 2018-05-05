<?php

namespace app\entities;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SpeechSearch represents the model behind the search form of `app\entities\Speech`.
 */
class SpeechSearch extends Speech
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'now', 'voting', 'sort_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'collective'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Speech::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ]
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
            'now' => $this->now,
            'voting' => $this->voting,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'collective', $this->collective])
              ->andFilterWhere(['like', 'member', $this->collective]);

        return $dataProvider;
    }
}
