<?php
namespace frontend\controllers;

use Yii;
use app\models\redeemForm;
use app\models\Merchant;
use app\models\Transaksi;

class RedeemController extends \yii\web\Controller
{
    public function actionRedeem()
    {
        $forms = new redeemForm();
        $tc= new Transaksi();
        
        if(!isEmpty($forms->tanggal_voucher)&& $forms->tanggal_reservasi < $forms->tanggal_voucher)
        {
            $request= Yii::$app->request;
            
            $tc = new Transaksi();
            $tc->tanggal=$request->post('redeemForm')['tanggal'];
            $tc->kode_reservasi=$request->post('redeemForm')['kode_reservasi'];
            $tc->kode_voucher=$request->post('redeemForm')['kode_voucher'];
            $tc->jlh_bill=$request->post('redeemForm')['jlh_bill'];
            $tc->id_merchant=$request->post('redeemForm')['id_merchant'];
            
            $this->render($view);
        }
        
        $nama= Merchant::find()->select(['nama','id'])->indexBy('id')->column();
        return $this->render('redeem',['forms'=>$forms, 'nama'=>$nama]);
    }

}
