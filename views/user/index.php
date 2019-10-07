<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],

            [
                'attribute' => 'first_name',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],
            [
                'attribute' => 'last_name',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],
            [
                'label' => 'Id Code',
                'attribute' => 'personal_code',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],
            [
                'attribute' => 'phone',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],
            [
                'format' => 'boolean',
                'attribute' => 'dead',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],
            [
                'attribute' => 'lang',
                'filterInputOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{leadCreate} {leadView} {leadUpdate} {leadDelete}',
                'headerOptions' => ['style' => 'width:20%'],
                'buttons' => [
                    'leadCreate' => function ($url, $model) {
                        $url = Url::to(['loan/create', 'user_id' => $model->getAttribute('id')]);
                        return Html::a('New Loan', $url, ['title' => 'view', 'class' => 'btn btn-xs btn-primary']);
                    },
                    'leadView' => function ($url, $model) {
                        $url = Url::to(['user/view', 'id' => $model->getAttribute('id')]);
                        return Html::a('View', $url, ['title' => 'view', 'class' => 'btn btn-xs btn-default']);
                    },
                    'leadUpdate' => function ($url, $model) {
                        $url = Url::to(['user/update', 'id' => $model->getAttribute('id')]);
                        return Html::a('Edit', $url, ['title' => 'update', 'class' => 'btn btn-xs btn-default']);
                    },
                    'leadDelete' => function ($url, $model) {
                        $url = Url::to(['user/delete', 'id' => $model->getAttribute('id')]);
                        return Html::a('Delete', $url, [
                            'title' => 'delete',
                            'class' => 'btn btn-xs btn-danger',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                            'data-method' => 'post',
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>


</div>
