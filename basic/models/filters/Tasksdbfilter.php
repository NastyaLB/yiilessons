<?php

namespace app\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\TaskDB;

/**
 * TaskDBFilter represents the model behind the search form of `app\models\tables\TaskDB`.
 */
class Tasksdbfilter extends TaskDB
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['title', 'description', 'deadline'], 'safe'],
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
        $id = (int)\Yii::$app->request->get('id');
        
        if(isset($id) && $id != 0) {
            $query = TaskDB::find()->where(['id' => $id]);            
        } 
        else $query = TaskDB::find();
        
                

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           // 'pagination' => [ 'pageSize' => '3', ],
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
            'creator_id' => $this->creator_id,
            'responsible_id' => $this->responsible_id,
            'deadline' => $this->deadline,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
