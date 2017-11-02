<?php
    use yii\widgets\ActiveForm;
    use yii\jui\DatePicker;
    use yii\helpers\Url;
    use yii\helpers\Html;
    
    
?>
<?= $this->title='Redeem form' ?>

<?php $form=  ActiveForm::begin()?>
<div class="row form-group">
    <?= $form->field($forms,'kode_voucher')->textInput()?>
</div>  
<div class="row form-group">
    <?= $form->field($forms,'kode_reservasi')->textInput()?>
</div>
<div class="row form-group">
    <?= $form->field($forms,'id_merchant')->dropDownList($nama,['prompt'=> 'mohon diplih'])->label('Nama Merchant')?>
</div>
<div class="row form-group">
    <?= $form->field($forms,'tanggal')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'yy-mm-dd']])->label('Tanggal Transaksi') ?>
</div>
<div class="row form-group">

        <?= $form->field($forms,'jlh_bill')->textInput()->label('Jumlah Transaksi')?>

</div>

<div class="row form-group">
    <?=    Html::submitButton('submit', ['class'=>'btn btn-primary'])?>
</div>
 
<?phpActiveForm::end()?>