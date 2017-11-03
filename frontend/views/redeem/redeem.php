<?php
    use yii\widgets\ActiveForm;
    use yii\jui\DatePicker;
    use yii\helpers\Url;
    use yii\helpers\Html;
    
    
?>

<?php $form=  ActiveForm::begin([
    'id'=>'redeem-form',
    'options'=>['class'=>'form-horizontal']])?>
<div class="row form-group">
    <?= $form->field($forms,'kode_voucher')
        //->dropDownList($voucher,['prompt'=>'mohon dipilih'])
        ->hint('Nomor voucher berada di kanan atas di belakang voucher')?>
</div>  
<div class="row form-group">
    <?= $form->field($forms,'kode_reservasi')
        //->dropDownList($reservasi,['prompt'=>'mohon dipilih'])
        ->hint('kode reservasi customer di DisTime dilihat pada aplikasi DT Merchant')?>
</div>
<div class="row form-group">
    <?= $form->field($forms,'id_merchant')->dropDownList($nama,['prompt'=> 'mohon diplih'])?>
</div>
<div class="row form-group">
    <?= $form->field($forms,'tanggal')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd'])->label('Tanggal Transaksi') ?>
</div>
<div class="row form-group">

        <?= $form->field($forms,'jlh_bill')->hint('Dalam rupiah')?>

</div>

<div class="row form-group">
    <?=    Html::submitButton('submit', ['class'=>'btn btn-primary'])?>
</div>
 
<?php ActiveForm::end(); ?>
