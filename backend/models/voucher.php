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
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['kode_voucher' => 'kode_voucher']);
    }
}
