<?php
namespace app\models;

use yii\base\Model;
use yii\db\mysql;

use app\models\voucher;
use app\models\Reservasi;
use app\models\Merchant;
use app\models\Transaksi;

class redeemForm extends Model
{
    public $kode_voucher;
    public $kode_reservasi;
    public $tanggal_voucher;
    public $tanggal_reservasi;
    public $id_merchant;
    public $tanggal;
    public $jlh_bill;
    
    public function attributeLabels() {
        return [
            'kode_voucher'=>'kode Voucher',
            'kode_reservasi'=>'kode reservasi',
            'id_merchant'=>'Nama merchant',
            'tanggal'=>'tanggal transaksi',
            'jlh_bill'=>'jumlah Bill',
        ];
    }
    public function rules() {
        return [
            ['kode_voucher', 'validateVoucher',],
            ['kode_voucher','string','max'=>50],
            ['kode_reservasi', 'validateReservasi'],
            [['kode_reservasi'],'string','max'=>50],
            ['tanggal','required', 'message'=>'harap diisi'],['tanggal','safe'],
            ['jlh_bill','required','message'=>'harap diisi'],['tanggal','safe'],
            ['id_merchant','required','message'=>'harap diisi'],

        ];
    }
    
    public function validateVoucher($attribute, $params){
        $result =  voucher::find()->select('kode_voucher')->column();
        $duplicate= Transaksi::find()->select('kode_voucher')->column();
        
        if(!(in_array($this->kode_voucher, $result)))
        {
            return $this->addError($attribute, 'voucher salah');
        }
        elseif (in_array($this->kode_voucher, $duplicate)){
            return $this->addError($attribute, 'voucher sudah digunakan');
        }
        
        
    }
    
    public function validateReservasi($attribute, $params){
        $result = Reservasi::find()->select('kode_reservasi')->column();
               
        if(!in_array($this->kode_reservasi, $result,true))
        {
            return $this->addError($attribute, 'kode reservasi salah');
        }
        
    }
    
    public function getDateVoucher(){
        return $this->tanggal_voucher= voucher::find()->select('tanggal','kode_voucher')->where(['kode_voucher'=>  $this->kode_voucher])->one();
    }
    
    public function getDateReservasi(){
        return $this->tanggal_reservasi= Reservasi::find()->select('tanggal','kode_reservasi')->where(['kode_reservasi'=>  $this->kode_reservasi])->one();
    }
}
