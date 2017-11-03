<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title='Views Redeemed Voucher';
?>
<div class="row">
    <div class="col-md-12">
        <h1>View Voucher</h1>
        <hr/>
        <?php

        echo Breadcrumbs::widget([
            'itemTemplate' => "<li>{link}</li>\n", // template for all links
            'links' => [
                ['label' => 'transaksi', 'url' => ['/transaksi/index']],
                ['label' => 'View Voucher', 'url' => ['/transaksi/view']],
                
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Voucher</th>
                    <th>tanggal</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($tc)>0){?>
                    <?php foreach ($tc as $tcs):?>
                <tr>
                    <td><?= Html::encode("{$tcs['kode_voucher']}") ?></td>
                    <td><?= Html::encode("{$tcs['tanggal']}") ?></td>
                    <td style="width:15%;text-align:center;">
                                <a class="btn btn-success btn-sm" href="<?php echo Url::to(['edit', 'id'=>$tcs['kode_voucher']]); ?>">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a> 
                    </td>
                </tr>
                <?php                    endforeach;?>
                <?php }else {?>
                <tr>
                    <td style="text-align: center; font-size: 15px; padding: 25px;" colspan="5">
                        No Data Found..</td>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
