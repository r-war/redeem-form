<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

use yii\bootstrap\Widget;


/* @var $this yii\web\View */
/* @var $searchModel app\models\voucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vouchers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row "style="padding: 10px">
        <div class="col-md-1">
            <?= Html::a('view all',['index'],['class'=>'btn btn-primary']) ?>
        </div>
        <div class="col-md-1">
            <?= Html::a('redeem',['index?voucherSearch%5Bstatus%5D=1'],['class'=>'btn btn-primary']) ?>
        </div>
        <div class="col-md-4" style="float: right">
            <?= $this->render('_search',['model'=>$searchModel])?>
        </div>
    </div>
    <div class="row" style="padding: 10px">
        <div class="col-md-1">
            <?php $form=  ActiveForm::begin();
                echo $form->field($model, 'import')->fileInput()->label(false);
                echo Html::submitButton('import', ['class' => 'btn btn-primary']);
                ActiveForm::end();?> 
        </div>
    </div>
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
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'kode_voucher',
                'tanggal',
                //'status',

                ['class' => 'yii\grid\ActionColumn',
                    'visibleButtons'=>['delete'=>false,'update'=>true,'view'=>false],
                    //'template'=>'{update}','controller'=>'update'],
                ],
            ],
            ]); ?>
        </div>
    </div>
    
</div>
