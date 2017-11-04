<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use kartik\export\ExportMenu;
use yii\bootstrap\Modal;

$this->title='Views Redeemed Voucher';
?>
<?phpkartik\grid\GridView::widget()
        ?>
<div class="row">
    <div class="col-md-12">
        <h1>View Redeemed Voucher </h1>
        <hr/>
        <?php

        echo Breadcrumbs::widget([
            'itemTemplate' => "<li>{link}</li>\n", // template for all links
            'links' => [
                ['label' => 'transaksi', 'url' => ['/transaksi/index']],
            ],
        ]);

        ?>
    </div>
</div>

<div style="padding: 20px">
    <?=    Html::a('export',['/transaksi/excel'], ['class'=>'btn btn-primary'])?>
</div>

<div >
    <div class="col-md-2">
        <div class="list-group">
            <a href="<?= Url::to(['/add']) ?>" class="list-group-item">
                <i class="glyphicon glyphicon-plus"></i>Add Voucher
            </a>
            <?php
            /*<a href="<?= Url::to(['/edit']) ?>" class="list-group-item">
                <i class="glyphicon glyphicon-edit"></i>edit Voucher
            </a>*/
            ?>
            <a href="<?= Url::to(['/view']) ?>" class="list-group-item">
                <i class="glyphicon glyphicon-edit"></i>view Voucher
            </a>
            
        </div>
    </div>
    <div class="col-md-10">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nama Merchant</th>
                    <th>tanggal transaksi</th>
                    <th>Kode Voucher</th>
                    <th>Kode Reservasi</th>
                    <th>Jumlah bill</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($tc)>0){?>
                    <?php foreach ($tc as $tcs):?>
                <tr>
                    
                    <td><?= Html::encode("{$tcs['id']}") ?></td>
                    <td><?= Html::encode("{$tcs->merchant['nama']}") ?></td>
                    <td><?= Html::encode("{$tcs['tanggal']}") ?></td>
                    <td><?= Html::encode("{$tcs['kode_voucher']}") ?></td>
                    <td><?= Html::encode("{$tcs['kode_reservasi']}") ?></td>
                    <td><?= Html::encode("{$tcs['jlh_bill']}") ?></td>
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
