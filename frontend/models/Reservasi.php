<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservasi".
 *
 * @property string $kode_reservasi
 * @property string $tanggal
 */
class Reservasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_reservasi', 'tanggal'], 'required'],
            [['tanggal'], 'safe'],
            [['kode_reservasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_reservasi' => 'Kode Reservasi',
            'tanggal' => 'Tanggal',
        ];
    }
}
