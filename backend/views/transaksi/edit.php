<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = "Edit Voucher";

?>

<div class="row">
    <div class="col-md-12">
        <h1>Edit Voucher "<?php echo $tc['kode_voucher'] ?>"</h1>
        <hr/>
        <?php

        echo Breadcrumbs::widget([
            'itemTemplate' => "<li>{link}</li>\n", // template for all links
            'links' => [
                ['label' => 'transaksi', 'url' => ['/transaksi/index']],
                ['label' => 'View Voucher', 'url' => ['/transaksi/view']],
                'Edit '.$tc['kode_voucher'],
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
        <?php $form = ActiveForm::begin([
                'id' => 'teams-form',
                'options' => ['class' => 'form-horizontal']
            ])
        ?>

        <div class="form-group">
            <div class="col-lg-8">
            <?= $form->field($forms, 'kode_voucher')->textInput(['value'=>$tc->kode_voucher,'readOnly'=> true]); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-8">
            <?= $form->field($forms, 'tanggal')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd'])
                ->label('Tanggal masa berlaku') ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>