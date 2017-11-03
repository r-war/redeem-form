<?php

namespace backend\controllers;

use Yii;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;

use app\models\transaksi;
use app\models\Merchant;
use app\models\voucher;
use app\models\Reservasi;

class TransaksiController extends \yii\web\Controller
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
                'only' => ['index',],
                'rules' => [
                    [
                        'actions' => ['index',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $query= transaksi::find();
        $tc=$query->orderBy('id')->all();
        return $this->render('index',['tc'=>$tc]);
    }
    
    public function actionAdd()
    {
        $forms= new voucher();$duplicate= voucher::find()->select('kode_voucher')->column();
        
        if($forms->load(Yii::$app->request->post()) && $forms->validate())
        {
            $request= \Yii::$app->request;
            /*if (!$forms->save()) 
                print_r($forms->getErrors()); // this would be helpful to find problem.
            else 
                Yii::$app->getSession()->setFlash('success', 'Your message has been successfully recorded.');
            */
            if (in_array($forms->kode_voucher, $duplicate))
            {
                Yii::$app->session->setFlash('error', 'voucher sudah ada');
                return $this->render('add',['forms'=>$forms]);
            }
            else{
                $forms->kode_voucher= $request->post('voucher')['kode_voucher'];
                $forms->tanggal=$request->post('voucher')['tanggal'];
                $forms->save();
                //var_dump($request); exit();
                Yii::$app->session->setFlash('success','voucher berhasil ditambahkan');
                return $this->redirect(Url::to(['index']));
            }
        }
        
        else{
            return $this->render('add',['forms'=>$forms]);
        }
        
        
    }
    
    public function actionEdit($id)
    {
        $forms= new voucher();
        if ($forms->load(Yii::$app->request->post()) && $forms->validate())
        {
            $request = Yii::$app->request;

            $tc = voucher::findOne(['kode_voucher', $id]);
            $tc->kode_voucher = $request->post('voucher')['kode_voucher'];
            $tc->tanggal = $request->post('voucher')['tanggal'];
            $tc->save();
            Yii::$app->session->setFlash('success','voucher berhasil diubah');
            return $this->redirect(Url::to(['view', 'id'=>$id]));
        }
        else 
        {
            $tc = voucher::findOne(['kode_voucher', $id]);
            return $this->render('edit', ['forms'=>$forms, 'tc'=>$tc]);
        }
        
    }
    
    public function actionView()
    {
        $query= voucher::find();
        $tc=$query->orderBy('kode_voucher')->all();
        return $this->render('view',['tc'=>$tc]);
    }

}
