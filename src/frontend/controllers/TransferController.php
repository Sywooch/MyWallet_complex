<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Transfer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\models\TransferAccount;
/**
 * TransferController implements the CRUD actions for Transfer model.
 */
class TransferController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transfer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Transfer::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transfer model.
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
     * Creates a new Transfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Transfer();

        $loaded = $model->load(Yii::$app->request->post());

        if (!$loaded) {
            $model->date = date('Y-m-d H:i:s');
        }

        $inAccounts = [];
        $outAccounts = [];
        if ($loaded) {
            $postAccs = Yii::$app->request->post();
            foreach (Yii::$app->request->post() as $k => $acc) {
                if (strpos($k, 'TransferAccount_in_') === 0) {
                    $account = new TransferAccount();
                    $account->id = str_replace('TransferAccount_in_', '', $k);
                    $account->type = 'in';
                    $account->load(Yii::$app->request->post());
                    $inAccounts[] = $account;
                }
            }
        }

        if ($loaded) {
            $valid = $model->validate();
            $valid = $valid && count($inAccounts);
            foreach ($inAccounts as $account) {
                $valid = $valid && $account->validate(['account_id', 'sum']);
            }

            if ($valid) {
                try {
                    Yii::$app->db->beginTransaction();

                    $model->save();
                    foreach ($inAccounts as $account) {
                        $acc = clone $account;
                        if (strpos($acc->id, 'new_') === 0) {
                            $acc->id = null;
                        }
                        $acc->transfer_id = $model->id;
                        $acc->type = 'in';
                        $acc->save();
                    }

                    Yii::$app->db->getTransaction()->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } catch (Exception $ex) {
                    dump($ex);
                    Yii::$app->db->getTransaction()->rollback();
                }
            }
        }

        return $this->render('create', [
                        'model' => $model,
                        'inAccounts' => $inAccounts,
                        'outAccounts' => $outAccounts,
                    ]);
    }

    /**
     * Updates an existing Transfer model.
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
     * Deletes an existing Transfer model.
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
     * Finds the Transfer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transfer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transfer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
