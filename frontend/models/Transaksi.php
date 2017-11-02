<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi".
 *
 * @property integer $id
 * @property string $tanggal
 * @property integer $jlh_bill
 * @property integer $id_merchant
 * @property string $kode_voucher
 * @property string $kode_reservasi
 *
 * @property Merchant $idMerchant
 * @property Reservasi $kodeReservasi
 * @property Voucher $kodeVoucher
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal', 'jlh_bill', 'id_merchant', 'kode_voucher', 'kode_reservasi'], 'required'],
            [['tanggal'], 'safe'],
            [['jlh_bill', 'id_merchant'], 'integer'],
            [['kode_voucher', 'kode_reservasi'], 'string', 'max' => 50],
            [['id_merchant'], 'exist', 'skipOnError' => true, 'targetClass' => Merchant::className(), 'targetAttribute' => ['id_merchant' => 'id']],
            [['kode_reservasi'], 'exist', 'skipOnError' => true, 'targetClass' => Reservasi::className(), 'targetAttribute' => ['kode_reservasi' => 'kode_reservasi']],
            [['kode_voucher'], 'exist', 'skipOnError' => true, 'targetClass' => Voucher::className(), 'targetAttribute' => ['kode_voucher' => 'kode_voucher']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'jlh_bill' => 'Jlh Bill',
            'id_merchant' => 'Id Merchant',
            'kode_voucher' => 'Kode Voucher',
            'kode_reservasi' => 'Kode Reservasi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMerchant()
    {
        return $this->hasOne(Merchant::className(), ['id' => 'id_merchant']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeReservasi()
    {
        return $this->hasOne(Reservasi::className(), ['kode_reservasi' => 'kode_reservasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeVoucher()
    {
        return $this->hasOne(Voucher::className(), ['kode_voucher' => 'kode_voucher']);
    }
}
