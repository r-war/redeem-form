<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\transaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Redeem';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row "style="padding: 20px">
        <div class="col-md-2">
            <?=    Html::a('export',['/transaksi/excel'], ['class'=>'btn btn-primary'])?>
        </div>
        <div class="col-md-4" style="float: right">
            <?= $this->render('_search',['model'=>$searchModel])?>
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
            
             <?= Html::a('view redeem', ['index'], ['class' => 'list-group-item btn btn-primary']) ?>
            
        </div>
    </div>
    <div class="col-md-10">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                  'attribute'=>'id_merchant',
                   'value'=>'merchant.nama',
                ],
                'kode_voucher',
                'kode_reservasi',
                'tanggal',
                'jlh_bill',
                
                //['class' => 'yii\grid\ActionColumn',],
            ],
            
        ]); ?>
    </div>
        
    </div>
    
</div>
