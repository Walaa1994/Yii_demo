<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserDB;

/**
 * UserDBSearch represents the model behind the search form of `app\models\UserDB`.
 */
class UserDBSearch extends UserDB
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'permission', 'gender'], 'integer'],
            [['fisrt_name', 'last_name', 'username', 'email', 'password', 'photo', 'added_date', 'birthday', 'last_update'], 'safe'],
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
        $query = UserDB::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // Number of items per page
            ],
        ]);

        $dataProvider->sort->attributes['full_name'] = [
            'asc' => ['fisrt_name' => SORT_ASC, 'last_name' => SORT_ASC],
            'desc' => ['fisrt_name' => SORT_DESC, 'last_name' => SORT_DESC],
            'default' => SORT_ASC,
            'label' => 'Name',
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'permission' => $this->permission,
            'added_date' => $this->added_date,
            'gender' => $this->gender,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'fisrt_name', $this->fisrt_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'CONCAT(fisrt_name, " ", last_name)', $this->full_name])
            ->orderBy(['added_date' => SORT_DESC]); // Order by added_date in descending order

        return $dataProvider;
    }
}
