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
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'email:email',
            'personal_code',
            'phone',
            'active:boolean',
            'dead:boolean',
            'lang',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{leadCreate} {leadView} {leadUpdate} {leadDelete}',
                'buttons' => [
                    'leadCreate' => function ($url, $model) {
                        $url = Url::to(['loan/create', 'user_id' => $model->getAttribute('id')]);
                        return Html::a('New Loan', $url, ['title' => 'view', 'class' => 'label label-success']);
                    },
                    'leadView' => function ($url, $model) {
                        $url = Url::to(['user/view', 'id' => $model->getAttribute('id')]);
                        return Html::a('View', $url, ['title' => 'view', 'class' => 'label label-primary']);
                    },
                    'leadUpdate' => function ($url, $model) {
                        $url = Url::to(['user/update', 'id' => $model->getAttribute('id')]);
                        return Html::a('Edit', $url, ['title' => 'update', 'class' => 'label label-default']);
                    },
                    'leadDelete' => function ($url, $model) {
                        $url = Url::to(['user/delete', 'id' => $model->getAttribute('id')]);
                        return Html::a('Delete', $url, [
                            'title' => 'delete',
                            'class' => 'label label-danger',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                            'data-method' => 'post',
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>


</div>
