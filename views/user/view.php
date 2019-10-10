<?php

use app\models\LoanSearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\PersonalCodeParser;
use DateTime;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'label' => 'Age',
                'value' => function ($model) {
                    return Yii::$app->personalCodeParser->parseAge($model->personal_code);
                }
            ]
        ],
    ]) ?>

</div>


<div class="user-loans">

    <?php
    $searchModel = new LoanSearch();
    $dataProvider = $searchModel->search(['LoanSearch' => ['user_id' => $model->id]]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'amount',
            'interest',
            'duration',
            'start_date',
            'end_date',
            'campaign',
            'status:boolean',
        ],
    ]);
    ?>

</div>
