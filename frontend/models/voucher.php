<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voucher".
 *
 * @property string $kode_voucher
 * @property string $tanggal
 * @property integer $status
 *
 * @property Transaksi[] $transaksis
 */
class Voucher extends \yii\db\ActiveRecord
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
            [['kode_voucher', 'status'], 'required'],
            [['tanggal'], 'safe'],
            [['status'], 'integer'],
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
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['kode_voucher' => 'kode_voucher']);
    }
}
