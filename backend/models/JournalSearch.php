<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Journal;
use yii\helpers\ArrayHelper;
/**
 * JournalSearch represents the model behind the search form of `backend\models\Journal`.
 */
class JournalSearch extends Journal
{
    /**
     * {@inheritdoc}
     */
	public function attributes(){
		
		return ArrayHelper::merge(parent::attributes(), ['user.surname', 'book.name']);
		
	}
	
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_book', 'dateBegin', 'dateEnd', 'status'], 'integer'],
			[['user.surname'], 'safe'],
			[['book.name'], 'safe'],
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
        $query = Journal::find();
		$query->joinWith(['user' => function($query){
			
			$query->from(['user' => 'users']);
		}
			]);
		$query->joinWith(['book' => function($query){
			
			$query->from(['book' => 'books']);
		}
			]);

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
		
		$dataProvider->sort->attributes['book.name'] = [
		'asc' => ['book.name' => SORT_ASC], 
		'desc' => ['book.name' => SORT_DESC],  
		];
		
		$dataProvider->sort->attributes['user.surname'] = [
		'asc' => ['user.surname' => SORT_ASC], 
		'desc' => ['user.surname' => SORT_DESC],  
		];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_user' => $this->id_user,
            'id_book' => $this->id_book,
            'dateBegin' => $this->dateBegin,
            'dateEnd' => $this->dateEnd,
            'status' => $this->status,
            /* 'user.surname' => $this->user.surname,
            'book.name' => $this->book.name, */
			
        ]);
		$query->andFilterWhere(['like', 'book.name', $this->getAttribute('book.name')]);
		$query->andFilterWhere(['like', 'user.surname', $this->getAttribute('user.surname')]);

        return $dataProvider;
    }
}
