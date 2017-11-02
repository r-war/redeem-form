<?php
    use yii\widgets\ActiveForm;
    $forms= new \app\models\redeemForm();
?>
<?= $this->title='Redeem form' ?>
<?php $form=  ActiveForm::begin()?>
<div class="form-group">
    <?= $form->field($forms,'kode_voucher')->textInput()?>
</div>  
<div class="form-group">
    <?= $form->field($forms,'kode_reservasi')->textInput()?>
</div>
<div class="form-group">
    <?= $form->field($forms,'nama_merchant')->textInput()?>
</div>
 
<?phpActiveForm::end()?>