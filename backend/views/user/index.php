<?php

use backend\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            [
                'attribute' => 'role',
                'value' => function($model) {
                    return $model->getUserRole();
                },
                'filter'=> Html::activeDropDownList($searchModel,'role', User::getUserRoles(), ['class' => 'form-control', 'prompt' => 'Select Role']),
            ],
            [
                'attribute' => 'active',
                'value' => function($model) {
                    return $model->getUserStatus();
                },
                'filter'=> Html::activeDropDownList($searchModel,'active', User::getUserStatuses(), ['class' => 'form-control', 'prompt' => 'Select Status']),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
