<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Html::encode($model->nombre);
?>
<div class="cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Html::tag('span', '', ['class'=>'glyphicon glyphicon-chevron-left']).' Return', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'contacto',
            'telefono',
            'email:email',
        ],
    ]) ?>

</div>
