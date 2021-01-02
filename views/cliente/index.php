<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <br />
        <?= Html::a(Html::tag('span', '', ['class'=>'glyphicon glyphicon-plus']).' New', ['create'], ['class' => 'btn btn-success']) ?>
        <br /><br />
    </p>

    <?php Pjax::begin(['enablePushState'=>false]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'nombre',
                'format'=>'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->nombre), ['view', 'id' => $data->id], ['data-pjax'=>0]);
                },
            ],
            'contacto',
            'telefono',
            'email:email',
        ],
        'layout'=>'{items}{pager}{summary}',
    ]); ?>
    <?php Pjax::end(); ?>
</div>
