<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voucher".
 *
 * @property string $kode_voucher
 * @property string $tanggal
 *
 * @property Transaksi[] $transaksis
 */
class voucher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $global;
    public $import;
    public function search($params){
        $query= voucher::find();
        $dataProvider= new \yii\data\ActiveDataProvider([
            'query'=>$query,
        ]);
        
        $query->orFilterWhere(['like','kode_voucher', $this->global])
                ->orFilterWhere(['like','tanggal', $this->global]);
        return $dataProvider;
    }
    

    public static function tableName()
    {
        return 'voucher';
    }

    /**
     * @inheritdoc
     */
    
    
    public function rules()
    {
        return [
            ['kode_voucher', 'required'], 
            [['tanggal'], 'required'],
            [['tanggal'], 'safe'],
            [['kode_voucher'], 'string', 'max' => 50],
            ['global','safe'],
            ['import','file','extensions'=>['csv','xls','xlsx']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_voucher' => 'Kode Voucher',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function validateVoucher($attribute, $params)
    {
        $duplicate= voucher::find()->select('kode_voucher')->column();
        if (in_array($this->kode_voucher, $duplicate)){
            return $this->addError($attribute, 'voucher sudah digunakan');
        }
        
    }
    public function getTransaksi()
    {
        return $this->hasMany(Transaksi::className(), ['kode_voucher' => 'kode_voucher']);
    }
    
}
