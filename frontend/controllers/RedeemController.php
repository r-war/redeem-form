<?php
namespace frontend\controllers;

use Yii;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;

use app\models\redeemForm;
use app\models\Merchant;
use app\models\Transaksi;
use app\models\voucher;
use app\models\Reservasi;

class RedeemController extends Controller
{
     public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['redeem',],
                'rules' => [
                    [
                        'actions' => ['redeem',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionRedeem()
    {
        $forms = new redeemForm();
        
        if($forms->load(Yii::$app->request->post()) && $forms->validate())
        {   
            //Yii::$app->session->setFlash('success','berhasil');
            $nama= Merchant::find()->select(['nama','id'])->indexBy('id')->column();
            
            $tglvoucher= voucher::find()
                    ->select('tanggal')->where(['kode_voucher'=>$forms->kode_voucher])
                    ->column();
            $tglReservasi = Reservasi::find()
                ->select('tanggal')->where(['kode_reservasi'=>$forms->kode_reservasi])
                ->column();
            //var_dump(empty($tglvoucher));
            //exit();
            if((empty($tglvoucher)))
            {
                Yii::$app->session->setFlash('error','voucher belum berlaku');
                return $this->render('redeem',['forms'=>$forms,'nama'=>$nama]);
            }
            elseif($tglReservasi>$tglvoucher)
            {
                Yii::$app->session->setFlash('error','voucher yang anda masukkan sudah expired');
                return $this->render('redeem',['forms'=>$forms,'nama'=>$nama]);
            }   
            else
            {
                $request= Yii::$app->request;
            
                $tc = new Transaksi();
                $tc->tanggal=$request->post('redeemForm')['tanggal'];
                $tc->kode_reservasi=$request->post('redeemForm')['kode_reservasi'];
                $tc->kode_voucher=$request->post('redeemForm')['kode_voucher'];
                $tc->jlh_bill=$request->post('redeemForm')['jlh_bill'];
                $tc->id_merchant=$request->post('redeemForm')['id_merchant'];
                $tc->save();
                if ($forms->sendMail(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('success', 'terimakasih. redeem akan diprose oleh CS');
                } else {
                    Yii::$app->session->setFlash('error', 'ada error saat kirim email');
                }
                
                //Yii::$app->session->setFlash('success','data berhasil disimpan');
                
                return $this->redirect(Url::to(['redeem/redeem']));
            }
            
            //return $this->render('redeem/index');
              
        }
        else {
            $voucher= voucher::find()->select('kode_voucher','kode_voucher')->indexBy('kode_voucher')->column();
            $reservasi= Reservasi::find()->select('kode_reservasi','kode_reservasi')->indexBy('kode_reservasi')->column();
            $nama= Merchant::find()->select(['nama','id'])->indexBy('id')->column();
            return $this->render('redeem',['forms'=>$forms, 'nama'=>$nama,'reservasi'=>$reservasi,'voucher'=>$voucher]);
        
         }
        
        
    }
}
