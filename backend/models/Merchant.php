<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 *
 * @property Transaksi[] $transaksis
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat'], 'required'],
            [['nama'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['id_merchant' => 'id']);
    }
}
