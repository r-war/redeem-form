<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class uploadForm extends model{
    public  $file;
    
    public function rules()
    {
        return [
            ['file','file'],
        ];
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

