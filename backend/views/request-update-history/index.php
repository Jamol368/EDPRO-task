<?php

use backend\models\RequestUpdateHistory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\RequestUpdateHistorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Request Update Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-update-history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'request_id',
                'value' => function ($model) {
                    return $model->request->request_name;
                }
            ],
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RequestUpdateHistory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
