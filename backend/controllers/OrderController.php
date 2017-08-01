<?php

namespace backend\controllers;

use Yii;
use backend\models\Order;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\OrderItem;
use yii\db\Expression;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
public function actionLihat()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('lihat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex() {

        $billOrders = Order::find()->orderBy('id DESC')->all();
        return $this->render ('index', [ 'n' => 1, 'billOrders' => $billOrders ]); }



 public function actionKirim() {

        $billOrders = Order::find()->where(['status'=>'pay'])->orderBy('id DESC')->all();
        return $this->render ('index', [ 'n' => 1, 'billOrders' => $billOrders ]); }

        public function actionDetail($id) { 
            $billOrder = Order::findOne($id); 
            $billOrderDetails = OrderItem::find()->where(['order_id' => $id])->orderBy('id DESC')->all (); 
            return $this->render ('detail', [ 'billOrder' => $billOrder, 'billOrderDetails' => $billOrderDetails, 'n'=> 1
                ]);
        }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

public function actionPay($id) {
 $billOrder = Order::findOne($id);
  $billOrder->status = 'pay';
   $billOrder->save();
    return $this->redirect(['index']);
     }

    public function actionSend($id) {
     $billOrder = Order::findOne($id);
     $billOrder->status = 'send';
       $billOrder->save();
       return $this->redirect(['kirim']); }


        public function actionCancel($id) {
            $billOrder = Order::findOne($id);
             $billOrder->status = 'cancel';
              $billOrder->updated_at = null;
              $billOrder->save();
              return $this->redirect(['index']);}


}
