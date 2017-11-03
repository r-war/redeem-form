<?php

namespace backend\controllers;

class voucherController extends \yii\web\Controller
{
    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

}
