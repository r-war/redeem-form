<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\Breadcrumbs;

$this->title='Add Voucher';
?>
<div class="row">
    <div class="col-md-12">
        <h1>Add Voucher</h1>
        <hr/>
        <?php

        echo Breadcrumbs::widget([
            'itemTemplate' => "<li>{link}</li>\n", // template for all links
            'links' => [
                ['label' => 'transaksi', 'url' => ['/transaksi/index']],
                ['label' => 'add Voucher', 'url' => ['/transaksi/add']],
                
            ],
        ]);

        ?>
    </div>
</div>
<div>
    <div class="col-md-2">
        <div class="list-group">
            <a href="<?= Url::to(['/add']) ?>" class="list-group-item">
                <i class="glyphicon glyphicon-plus"></i>Add Voucher
            </a>
            <a href="<?= Url::to(['/view']) ?>" class="list-group-item">
                <i class="glyphicon glyphicon-edit"></i>view Voucher
            </a>
        </div>
    </div>
    <div class="col-md-10">
        <?php $form= ActiveForm::begin([
        'id'=>'add-voucher',
        'options'=>['class'=>'form-horizontal']])?>
        <div class="row form-group">
            <?= $form->field($forms, 'kode_voucher')?>
        </div>
        <div class="row form-group">
            <?= $form->field($forms, 'tanggal')
                ->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd'])
                ->label('Tanggal masa berlaku') ?>
        </div>
        <div class="row form-group">
            <?=    Html::submitButton('submit', ['class'=>'btn btn-primary'])?>
        </div>
        <?php ActiveForm::end()?>
    </div>

</div>
