<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\voucher */

$this->title = 'Create Voucher';
$this->params['breadcrumbs'][] = ['label' => 'Vouchers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-2">
            <div class="list-group">
                <?= Html::a('Create voucher', ['voucher/create'], ['class' => 'list-group-item btn btn-primary']) ?>
                <?php
                /*<a href="<?= Url::to(['/edit']) ?>" class="list-group-item">
                    <i class="glyphicon glyphicon-edit"></i>edit Voucher
                </a>*/
                ?>
                <?= Html::a('view voucher', ['voucher/index'], ['class' => 'list-group-item btn btn-primary']) ?>
                <?= Html::a('view redeem', ['transaksi/index'], ['class' => 'list-group-item btn btn-primary']) ?>

            </div>
        </div>
        <div class="col-md-10">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
