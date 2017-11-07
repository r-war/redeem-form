<?php

namespace backend\controllers;

use Yii;
use app\models\voucher;
use app\models\voucherSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Expression;
/**
 * VoucherController implements the CRUD actions for voucher model.
 */
class VoucherController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all voucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model=new voucher();
        $searchModel = new voucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
         if ($model->load(Yii::$app->request->post())){
             $model->import= UploadedFile::getInstance($model, 'import');
            $filepath='uploads/'.$model->import->BaseName.'.'.$model->import->Extension;
            $model->import->saveAs($filepath);
            $inputFile= $filepath;
            try{
                $inputFileType=  \PHPExcel_IOFactory::identify($inputFile);
                $objReader= \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel= $objReader->load($inputFile);
            } catch (Exception $e) {
                die('error');
            }
            $sheet=$objPHPExcel->getSheet(0);
            $highestRow =$sheet->getHighestRow();
            //var_dump($highestRow);exit();
            $highestColumn =$sheet->getHighestColumn();
            $voucher= new voucher();
            for($row=1;$row<=$highestRow;$row++){
                $rowData=$sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

                if($row==1)
                {
                    continue;
                }elseif(empty($rowData[0][1])){
                    continue; 
                }else{
                    $voucher= voucher::findOne($rowData[0][0]);
                    $voucher->tanggal = date('Y-m-d', \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][1]));
                    $voucher->update();
                }
            }
            if($voucher->save())
            {
                Yii::$app->session->setFlash('success', "voucher berhasil diupdate");
                return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model'=>$model,
            ]);
            }
            else {
                Yii::$app->session->setFlash('failed', "terjadi kesalahan");
                return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model'=>$model,]);
            }
         }
        else{
            return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,]);
        }
    }

    /**
     * Displays a single voucher model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new voucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new voucher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing voucher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->kode_voucher]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing voucher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    public function actionImport()
    {
    }
    
    /**
     * Finds the voucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return voucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = voucher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
