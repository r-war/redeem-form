<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaksi;

/**
 * transaksiSearch represents the model behind the search form about `app\models\Transaksi`.
 */
class transaksiSearch extends Transaksi
{
    /**
     * @inheritdoc
     */
    public $global;
    public function rules()
    {
        return [
            [['id', 'jlh_bill',], 'integer'],
            [['tanggal', 'global', 'id_merchant','kode_voucher', 'kode_reservasi'], 'safe'],
            
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
        $query = Transaksi::find();

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
        $query->joinWith('merchant');
        // grid filtering conditions
        /*$query->andFilterWhere([
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'jlh_bill' => $this->jlh_bill,
            //'id_merchant' => $this->id_merchant,
        ]);*/
        
        $query->orFilterWhere(['like', 'kode_voucher', $this->global])
            ->orFilterWhere(['like', 'kode_reservasi', $this->global])
                ->orFilterWhere(['like', 'merchant.nama', $this->global]);

        return $dataProvider;
    }
}
