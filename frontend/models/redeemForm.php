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
            'kode_voucher'=>'Kode voucher',
            'kode_reservasi'=>'Kode reservasi',
            'id_merchant'=>'Nama merchant',
            'tanggal'=>'Tanggal transaksi',
            'jlh_bill'=>'Jumlah Bill',
        ];
    }
    public function rules() {
        return [
            [['kode_voucher','kode_reservasi'],'required','message'=>'harap diisi'],
            ['kode_voucher', 'validateVoucher',],
            ['kode_voucher','string','max'=>50],
            ['kode_reservasi', 'validateReservasi'],
            [['kode_reservasi'],'string','max'=>50],
            ['tanggal','required', 'message'=>'harap diisi'],['tanggal','safe'],
            ['jlh_bill','required','message'=>'harap diisi'],['tanggal','safe'],
            ['id_merchant','required','message'=>'harap diisi'],
            //['status','integer'],

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
        elseif(empty($this->kode_voucher))
        {
            return $this->addError($attribute, 'harap diisi');
        }
        
        
    }
    
    public function validateReservasi($attribute, $params){
        $result = Reservasi::find()->select('kode_reservasi')->column();
               
        if(!in_array($this->kode_reservasi, $result,true))
        {
            return $this->addError($attribute, 'kode reservasi salah');
        }
        elseif(empty($this->kode_reservasi))
        {
            return $this->addError($attribute, 'harap diisi');
        }
        
    }
    
    public function getDateVoucher(){
        return $this->tanggal_voucher= voucher::find()->select('tanggal','kode_voucher')->where(['kode_voucher'=>  $this->kode_voucher])->one();
    }
    
    public function getDateReservasi(){
        return $this->tanggal_reservasi= Reservasi::find()->select('tanggal','kode_reservasi')->where(['kode_reservasi'=>  $this->kode_reservasi])->one();
    }
    
    public function sendMail(){
        $nama= Merchant::find()->select(['nama'])->where(['id'=>  $this->id_merchant])->column();
        //var_dump($nama);exit();
        return \yii::$app->mailer->compose()
                ->setTo('rivaldi.leonhart@gmail.com')
                //->setTo('esmeraldapriska89@gmail.com')
                ->setFrom('rivwar25@gmail.com')
                ->setSubject('Redeem voucher')
                ->setTextBody($nama[0].' melakukan redeem dengan kode voucher '.$this->kode_voucher.' dan kode reservasi '.$this->kode_reservasi.'. Jumlah bill Rp.'.$this->jlh_bill.' pada tanggal '.$this->tanggal.' berhasil diredeem.')
                ->send();
    }
}
