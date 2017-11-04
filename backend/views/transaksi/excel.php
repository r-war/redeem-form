<?php
$model= transaksi::find()->all();
        $filename= 'redeem.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=".$filename);
        echo '<table border="1" width="100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Merchant</th>
                <th>kode voucher</th>
                <th>kode reservasi</th>
                <th>tanggal</th>
                <th>jumlah bill</th>
            </tr>
        </thead>';
        foreach($model as $data){
            echo '
                <tr>
                    <td>'.$data['id'].'</td>
                    <td>'.$data->merchant['nama'].'</td>
                    <td>'.$data['kode_voucher'].'</td>
                    <td>'.$data['kode_reservasi'].'</td>
                    <td>'.$data['tanggal'].'</td>
                    <td>'.$data['jlh_bill'].'</td>
                </tr>
            ';
        }
    echo '</table>';
?>