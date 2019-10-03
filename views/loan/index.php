<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'amount',
//            'interest',
            'duration',
            'start_date',
            //'end_date',
            //'campaign',
            //'status:boolean',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($action) {
                        return Html::a('View', $action, ['title' => 'view', 'class' => 'btn btn-xs btn-primary']);
                    },
                    'update' => function ($action) {
                        return Html::a('Edit', $action, ['title' => 'update', 'class' => 'btn btn-xs btn-default']);
                    },
                    'delete' => function ($url) {
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
