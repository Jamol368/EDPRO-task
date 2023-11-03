<?php

namespace backend\controllers;

use backend\models\RequestUpdateHistory;
use backend\models\RequestUpdateHistorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestUpdateHistoryController implements the CRUD actions for RequestUpdateHistory model.
 */
class RequestUpdateHistoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all RequestUpdateHistory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RequestUpdateHistorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequestUpdateHistory model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RequestUpdateHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return boolean
     */
    public function actionCreate(int $request_id)
    {
        $model = new RequestUpdateHistory();
        $model->user_id = \Yii::$app->user->id;
        $model->request_id = $request_id;

        if ($model->save()) {
            return true;
        }

        return false;
    }

    /**
     * Finds the RequestUpdateHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return RequestUpdateHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestUpdateHistory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
