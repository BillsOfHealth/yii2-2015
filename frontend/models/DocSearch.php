<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DocSearch represents the model behind the search form 
 */
class DocSearch extends Model
{
    public $zipcode;
    public $doctor;
    public $conceirge;
    public $hospital;
    public $miles;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zipcode'], 'required'],
            ['zipcode', 'integer', 'max' => 99999]
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
        $query = Model::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'doc_id' => $this->doc_id,
            //'faq_type_id' => $this->faq_type_id,
        ]);

        $query->andFilterWhere(['like', 'zipcode', $this->zipcode]);

        return $dataProvider;
    }
}
