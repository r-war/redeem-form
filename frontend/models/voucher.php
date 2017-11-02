<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voucher".
 *
 * @property string $kode_voucher
 * @property string $tanggal
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
            [['kode_voucher', 'tanggal'], 'required'],
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
}
